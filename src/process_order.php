<?php
require_once __DIR__ . '/../auth/auth_middleware.php';
require_once __DIR__ . '/../partials/config.php';

// Ensure user is logged in
requireLogin();

// Set content type to JSON
header('Content-Type: application/json');

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

// Get JSON input
$input = file_get_contents('php://input');
$data = json_decode($input, true);

// Validate input
if (!$data) {
    echo json_encode(['success' => false, 'message' => 'Invalid JSON data']);
    exit;
}

// Validate required fields
$required_fields = ['cart_items', 'payment_method', 'customer_id', 'subtotal', 'total_amount'];
foreach ($required_fields as $field) {
    if (!isset($data[$field])) {
        echo json_encode(['success' => false, 'message' => "Missing required field: $field"]);
        exit;
    }
}

// Validate cart items
if (empty($data['cart_items']) || !is_array($data['cart_items'])) {
    echo json_encode(['success' => false, 'message' => 'Cart is empty or invalid']);
    exit;
}

// Get current user
$current_user = getCurrentUser();
if (!$current_user) {
    echo json_encode(['success' => false, 'message' => 'User not authenticated']);
    exit;
}

try {
    // Start transaction
    mysqli_begin_transaction($link);
    
    // Generate order number
    $order_number = 'ORD' . date('Ymd') . sprintf('%04d', rand(1, 9999));
    
    // Prepare order data
    $customer_id = $data['customer_id'] === 'walkin' ? null : (int)$data['customer_id'];
    $payment_method = mysqli_real_escape_string($link, $data['payment_method']);
    $subtotal = (float)$data['subtotal'];
    $tax_amount = isset($data['tax_amount']) ? (float)$data['tax_amount'] : 0;
    $discount_amount = isset($data['discount_amount']) ? (float)$data['discount_amount'] : 0;
    $total_amount = (float)$data['total_amount'];
    $notes = isset($data['notes']) ? mysqli_real_escape_string($link, $data['notes']) : '';
    $created_by = $current_user['id'];
    
    // Insert order
    $order_sql = "INSERT INTO orders (
        order_number, 
        customer_id, 
        user_id, 
        payment_method, 
        subtotal, 
        tax_amount, 
        discount_amount, 
        total_amount, 
        notes, 
        order_status
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'completed')";
    
    $order_stmt = mysqli_prepare($link, $order_sql);
    if (!$order_stmt) {
        throw new Exception('Failed to prepare order statement: ' . mysqli_error($link));
    }
    
    mysqli_stmt_bind_param($order_stmt, 'siisdddss', 
        $order_number, 
        $customer_id, 
        $created_by, 
        $payment_method, 
        $subtotal, 
        $tax_amount, 
        $discount_amount, 
        $total_amount, 
        $notes
    );
    
    if (!mysqli_stmt_execute($order_stmt)) {
        throw new Exception('Failed to insert order: ' . mysqli_stmt_error($order_stmt));
    }
    
    $order_id = mysqli_insert_id($link);
    mysqli_stmt_close($order_stmt);
    
    // Insert order items and update stock
    $item_sql = "INSERT INTO order_items (
        order_id, 
        product_id, 
        quantity, 
        unit_price, 
        total_price
    ) VALUES (?, ?, ?, ?, ?)";
    
    $item_stmt = mysqli_prepare($link, $item_sql);
    if (!$item_stmt) {
        throw new Exception('Failed to prepare order item statement: ' . mysqli_error($link));
    }
    
    $stock_sql = "UPDATE products SET stock_quantity = stock_quantity - ? WHERE id = ? AND stock_quantity >= ?";
    $stock_stmt = mysqli_prepare($link, $stock_sql);
    if (!$stock_stmt) {
        throw new Exception('Failed to prepare stock update statement: ' . mysqli_error($link));
    }
    
    foreach ($data['cart_items'] as $item) {
        $product_id = (int)$item['id'];
        $quantity = (int)$item['quantity'];
        $unit_price = (float)$item['price'];
        $total_price = $unit_price * $quantity;
        
        // Validate product exists and has sufficient stock
        $check_sql = "SELECT stock_quantity FROM products WHERE id = ? AND is_active = 1";
        $check_stmt = mysqli_prepare($link, $check_sql);
        mysqli_stmt_bind_param($check_stmt, 'i', $product_id);
        mysqli_stmt_execute($check_stmt);
        $result = mysqli_stmt_get_result($check_stmt);
        $product = mysqli_fetch_assoc($result);
        mysqli_stmt_close($check_stmt);
        
        if (!$product) {
            throw new Exception("Product with ID $product_id not found or inactive");
        }
        
        if ($product['stock_quantity'] < $quantity) {
            throw new Exception("Insufficient stock for product ID $product_id. Available: {$product['stock_quantity']}, Required: $quantity");
        }
        
        // Insert order item
        mysqli_stmt_bind_param($item_stmt, 'iiidd', $order_id, $product_id, $quantity, $unit_price, $total_price);
        if (!mysqli_stmt_execute($item_stmt)) {
            throw new Exception('Failed to insert order item: ' . mysqli_stmt_error($item_stmt));
        }
        
        // Update stock
        mysqli_stmt_bind_param($stock_stmt, 'iii', $quantity, $product_id, $quantity);
        if (!mysqli_stmt_execute($stock_stmt)) {
            throw new Exception('Failed to update stock: ' . mysqli_stmt_error($stock_stmt));
        }
        
        // Check if stock was actually updated
        if (mysqli_stmt_affected_rows($stock_stmt) === 0) {
            throw new Exception("Failed to update stock for product ID $product_id - insufficient quantity");
        }
    }
    
    mysqli_stmt_close($item_stmt);
    mysqli_stmt_close($stock_stmt);
    
    // Clear user's cart after successful order
    $clear_cart_sql = "DELETE FROM cart WHERE user_id = ?";
    $clear_stmt = mysqli_prepare($link, $clear_cart_sql);
    if ($clear_stmt) {
        mysqli_stmt_bind_param($clear_stmt, 'i', $created_by);
        mysqli_stmt_execute($clear_stmt);
        mysqli_stmt_close($clear_stmt);
    }
    
    // Commit transaction
    mysqli_commit($link);
    
    // Return success response
    echo json_encode([
        'success' => true,
        'message' => 'Order placed successfully',
        'order_id' => $order_id,
        'order_number' => $order_number,
        'total_amount' => $total_amount,
        'payment_method' => $payment_method,
        'redirect_url' => 'orders.php'
    ]);
    
} catch (Exception $e) {
    // Rollback transaction on error
    mysqli_rollback($link);
    
    // Log error (you might want to implement proper logging)
    error_log("Order processing error: " . $e->getMessage());
    
    // Return error response
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>