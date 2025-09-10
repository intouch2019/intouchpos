<?php
require_once __DIR__ . '/../auth/auth_middleware.php';
require_once __DIR__ . '/../partials/config.php';
requireLogin();

header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);
$order_id = $input['order_id'] ?? 0;

if (!$order_id) {
    echo json_encode(['success' => false, 'message' => 'Order ID required']);
    exit;
}

try {
    // Restore the order by removing _REVIVED suffix
    $restore_sql = "UPDATE orders SET hold_reference = REPLACE(hold_reference, '_REVIVED', '') WHERE id = ? AND hold_reference LIKE '%_REVIVED'";
    $restore_stmt = mysqli_prepare($link, $restore_sql);
    mysqli_stmt_bind_param($restore_stmt, "i", $order_id);
    mysqli_stmt_execute($restore_stmt);
    
    if (mysqli_affected_rows($link) > 0) {
        echo json_encode([
            'success' => true,
            'message' => 'Order restored to hold successfully'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Order not found or already restored'
        ]);
    }
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>