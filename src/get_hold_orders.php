<?php
require_once __DIR__ . '/../auth/auth_middleware.php';
require_once __DIR__ . '/../partials/config.php';
requireLogin();

header('Content-Type: application/json');

$type = $_GET['type'] ?? 'hold';

try {
    $where_condition = "";
    
    switch($type) {
        case 'hold':
            $where_condition = "WHERE o.hold_reference IS NOT NULL AND o.hold_reference NOT LIKE '%_REVIVED'";
            break;
        case 'unpaid':
            $where_condition = "WHERE (o.hold_reference IS NULL OR o.hold_reference = '') AND (o.payment_status = 'pending' OR o.payment_status IS NULL)";
            break;
        case 'paid':
            $where_condition = "WHERE (o.payment_status = 'completed' OR o.order_status = 'completed')";
            break;
        default:
            $where_condition = "WHERE o.hold_reference IS NOT NULL";
    }
    
    $sql = "SELECT o.*, COALESCE(c.name, 'Walk-in Customer') as customer_name 
            FROM orders o 
            LEFT JOIN customers c ON o.customer_id = c.id 
            $where_condition 
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
        'count' => count($orders),
        'sql' => $sql,
        'type' => $type
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage(),
        'type' => $type
    ]);
}
?>