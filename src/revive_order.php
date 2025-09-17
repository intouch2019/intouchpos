<?php
// Remove ALL output buffering and ensure no whitespace before <?php
while (ob_get_level()) {
    ob_end_clean();
}

// Add these to ensure no output before headers
ob_start();
header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../auth/auth_middleware.php';
require_once __DIR__ . '/../partials/config.php';
requireLogin();

ini_set('display_errors', 0);
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

// --- helper function to prepare safely ---
function safePrepare($link, $sql) {
    $stmt = mysqli_prepare($link, $sql);
    if ($stmt === false) {
        throw new Exception("MySQL prepare failed: " . mysqli_error($link));
    }
    return $stmt;
}

try {
    $input = json_decode(file_get_contents('php://input'), true);
    $order_id = $input['order_id'] ?? 0;

    if (!$order_id) {
        echo json_encode(['success' => false, 'message' => 'Order ID required']);
        exit;
    }

    // --- Get order details ---
    $order_sql = "SELECT * FROM orders WHERE id = ? AND hold_reference IS NOT NULL";
    $order_stmt = safePrepare($link, $order_sql);
    mysqli_stmt_bind_param($order_stmt, "i", $order_id);
    mysqli_stmt_execute($order_stmt);
    $order_result = mysqli_stmt_get_result($order_stmt);

    if (!$order_result || mysqli_num_rows($order_result) === 0) {
        throw new Exception('Hold order not found');
    }

    $order = mysqli_fetch_assoc($order_result);

    // --- Get order items with product details ---
    $items_sql = "SELECT oi.product_id, oi.quantity, oi.unit_price, oi.batch_code,
                         p.name AS product_name, p.image AS product_image
                  FROM order_items oi
                  JOIN products p ON oi.product_id = p.id
                  WHERE oi.order_id = ?";
    $items_stmt = safePrepare($link, $items_sql);
    mysqli_stmt_bind_param($items_stmt, "i", $order_id);
    mysqli_stmt_execute($items_stmt);
    $items_result = mysqli_stmt_get_result($items_stmt);

    $order_items = [];
    while ($item = mysqli_fetch_assoc($items_result)) {
        $order_items[] = $item;
    }

    // --- Mark order as revived (if not already revived) ---
    $update_sql = "UPDATE orders 
                   SET hold_reference = CASE
                       WHEN hold_reference NOT LIKE '%_REVIVED' 
                            THEN CONCAT(hold_reference, '_REVIVED')
                       ELSE hold_reference 
                   END
                   WHERE id = ?";
    $update_stmt = safePrepare($link, $update_sql);
    mysqli_stmt_bind_param($update_stmt, "i", $order_id);
    mysqli_stmt_execute($update_stmt);

    ob_end_clean();

    echo json_encode([
        'success' => true,
        'order' => $order,
        'order_items' => $order_items,
        'message' => 'Order loaded successfully',
        'revived_order_id' => $order_id
    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;

} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}
?>
