<?php
require_once __DIR__ . '/../auth/auth_middleware.php';
require_once __DIR__ . '/../partials/config.php';
requireLogin();

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

$status = $_GET['status'] ?? 'all';

try {
    $sql = "SELECT o.*, c.name as customer_name, u.full_name as cashier_name 
            FROM orders o 
            LEFT JOIN customers c ON o.customer_id = c.id 
            LEFT JOIN users u ON o.user_id = u.id 
            WHERE 1=1";
    
    if ($status === 'hold') {
        $sql .= " AND o.hold_reference IS NOT NULL";
    } elseif ($status === 'unpaid') {
        $sql .= " AND o.payment_status = 'pending' AND o.hold_reference IS NULL";
    } elseif ($status === 'paid') {
        $sql .= " AND o.payment_status = 'completed'";
    }
    
    $sql .= " ORDER BY o.created_at DESC LIMIT 50";
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
        'orders' => $orders
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}

mysqli_close($link);
?>