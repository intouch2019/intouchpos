<?php
require_once __DIR__ . '/../auth/auth_middleware.php';
require_once __DIR__ . '/../partials/config.php';
requireLogin();

//header('Content-Type: application/json');

// Get current user
$current_user = getCurrentUser();
try {
    
    $sql = "SELECT o.*, c.name as customer_name 
        FROM online_orders o 
        LEFT JOIN customers c ON o.customer_id = c.id 
        WHERE o.status = 'Pending' AND o.store_id = ? 
        ORDER BY o.created_at DESC 
        LIMIT 20";

    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "i", $current_user['id']);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
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