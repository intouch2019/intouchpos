<?php
require_once __DIR__ . '/../auth/auth_middleware.php';
require_once __DIR__ . '/../partials/config.php';
requireLogin();

header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);

$return_items = $input['return_items'] ?? [];
$exchange_items = $input['exchange_items'] ?? [];
$customer_id = $input['customer_id'] ?? null;

if (empty($return_items) || empty($exchange_items)) {
    echo json_encode(['success' => false, 'message' => 'Return and exchange items are required']);
    exit;
}

try {
    mysqli_begin_transaction($link);
    
    // Calculate totals
    $return_total = 0;
    foreach ($return_items as $item) {
        $return_total += $item['price'] * $item['quantity'];
    }
    
    $exchange_total = 0;
    foreach ($exchange_items as $item) {
        $exchange_total += $item['price'] * $item['quantity'];
    }
    
    $balance_amount = $return_total - $exchange_total;
    
    // Insert exchange record
    $exchange_sql = "INSERT INTO exchanges (return_items, exchange_items, return_total, exchange_total, balance_amount, customer_id, user_id) 
                     VALUES (?, ?, ?, ?, ?, ?, ?)";
    $exchange_stmt = mysqli_prepare($link, $exchange_sql);
    
    if (!$exchange_stmt) {
        throw new Exception('Failed to prepare exchange statement: ' . mysqli_error($link));
    }
    
    $return_items_json = json_encode($return_items);
    $exchange_items_json = json_encode($exchange_items);
    $current_user_id = getCurrentUser()['id'];
    
    // Handle null customer_id
    $customer_id_param = ($customer_id && $customer_id !== 'walkin') ? (int)$customer_id : null;
    
    mysqli_stmt_bind_param($exchange_stmt, "ssdddii", 
        $return_items_json, $exchange_items_json, $return_total, $exchange_total, $balance_amount, $customer_id_param, $current_user_id);
    
    if (!mysqli_stmt_execute($exchange_stmt)) {
        throw new Exception('Failed to create exchange record: ' . mysqli_stmt_error($exchange_stmt));
    }
    
    $exchange_id = mysqli_insert_id($link);
    
    // Create order record for the exchange
    $order_number = 'EXC-' . date('Ymd') . '-' . str_pad($exchange_id, 4, '0', STR_PAD_LEFT);
    $order_sql = "INSERT INTO orders (order_number, customer_id, user_id, subtotal, total_amount, payment_method, payment_status, order_status, notes) 
                  VALUES (?, ?, ?, ?, ?, 'cash', 'completed', 'completed', ?)";
    $order_stmt = mysqli_prepare($link, $order_sql);
    
    $notes = 'Exchange transaction - Exchange ID: ' . $exchange_id;
    mysqli_stmt_bind_param($order_stmt, "siidds", 
        $order_number, $customer_id_param, $current_user_id, $exchange_total, $exchange_total, $notes);
    
    if (!mysqli_stmt_execute($order_stmt)) {
        throw new Exception('Failed to create order record: ' . mysqli_stmt_error($order_stmt));
    }
    
    $order_id = mysqli_insert_id($link);
    
    // Insert order items for exchange products
    foreach ($exchange_items as $item) {
        $item_sql = "INSERT INTO order_items (order_id, product_id, quantity, unit_price, total_price) 
                     VALUES (?, ?, ?, ?, ?)";
        $item_stmt = mysqli_prepare($link, $item_sql);
        $total_price = $item['price'] * $item['quantity'];
        mysqli_stmt_bind_param($item_stmt, "iiidd", 
            $order_id, $item['product_id'], $item['quantity'], $item['price'], $total_price);
        mysqli_stmt_execute($item_stmt);
    }
    
    // Update product stock for returned items (increase stock)
    foreach ($return_items as $item) {
        $update_stock_sql = "UPDATE products SET stock_quantity = stock_quantity + ? WHERE id = ?";
        $update_stmt = mysqli_prepare($link, $update_stock_sql);
        mysqli_stmt_bind_param($update_stmt, "ii", $item['quantity'], $item['product_id']);
        mysqli_stmt_execute($update_stmt);
    }
    
    // Update product stock for exchange items (decrease stock)
    foreach ($exchange_items as $item) {
        $update_stock_sql = "UPDATE products SET stock_quantity = stock_quantity - ? WHERE id = ?";
        $update_stmt = mysqli_prepare($link, $update_stock_sql);
        mysqli_stmt_bind_param($update_stmt, "ii", $item['quantity'], $item['product_id']);
        mysqli_stmt_execute($update_stmt);
    }
    
    mysqli_commit($link);
    
    echo json_encode([
        'success' => true,
        'exchange_id' => $exchange_id,
        'order_id' => $order_id,
        'order_number' => $order_number,
        'return_total' => $return_total,
        'exchange_total' => $exchange_total,
        'balance_amount' => $balance_amount,
        'message' => 'Exchange processed successfully'
    ]);
    
} catch (Exception $e) {
    mysqli_rollback($link);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>