<?php
require_once __DIR__ . '/../auth/auth_middleware.php';
require_once __DIR__ . '/../partials/config.php';
requireLogin();

//header('Content-Type: application/json');

$current_user = getCurrentUser();
$user_id = $current_user['id'];

try {
    // Get cart items with product details
    $sql = "SELECT c.quantity, p.id, p.name, p.price, p.sku 
            FROM cart c 
            JOIN products p ON c.product_id = p.id 
            WHERE c.user_id = ?";
    
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    $cart_items = [];
    $subtotal = 0;
    
    while ($row = mysqli_fetch_assoc($result)) {
        $item_total = $row['price'] * $row['quantity'];
        $subtotal += $item_total;
        
        $cart_items[] = [
            'id' => $row['id'],
            'name' => $row['name'],
            'price' => floatval($row['price']),
            'quantity' => intval($row['quantity']),
            'sku' => $row['sku'],
            'total' => $item_total
        ];
    }
    
    // No tax for now
    $tax_rate = 0;
    $tax_amount = 0;
    $total = $subtotal;
    
    echo json_encode([
        'success' => true,
        'cart_items' => $cart_items,
        'subtotal' => $subtotal,
        'tax_amount' => $tax_amount,
        'tax_rate' => $tax_rate * 100,
        'total' => $total,
        'item_count' => count($cart_items)
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error fetching cart data: ' . $e->getMessage()
    ]);
}
?>