<?php
require_once __DIR__ . '/../auth/auth_middleware.php';
require_once __DIR__ . '/../partials/config.php';
requireLogin();

header('Content-Type: application/json');

try {
    
    $sql = "SELECT o.*, c.name as customer_name 
            FROM online_orders o 
            LEFT JOIN customers c ON o.customer_id = c.id WHERE o.status = 'Pending'
            ORDER BY o.created_at DESC 
            LIMIT 20";
    
    $result = mysqli_query($link, $sql);
    
    if (!$result) {
        throw new Exception('Database query failed: ' . mysqli_error($link));
    }
    
    $orders = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $orders[] = $row;
    }
    
    echo json_encode([
        'success' => true,
        'orders' => $orders,
        'count' => count($orders)
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>