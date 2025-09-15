<?php
require_once __DIR__ . '/../auth/auth_middleware.php';
require_once __DIR__ . '/../partials/config.php';
requireLogin();

header('Content-Type: application/json');

// --- helper function to prepare safely ---
function safePrepare($link, $sql) {
    $stmt = mysqli_prepare($link, $sql);
    if ($stmt === false) {
        throw new Exception("MySQL prepare failed: " . mysqli_error($link));
    }
    return $stmt;
}

// Get current user
$current_user = getCurrentUser();
if (!$current_user) {
    echo json_encode(['success' => false, 'message' => 'User not authenticated']);
    exit;
}

try {
    $input = json_decode(file_get_contents('php://input'), true);
    $order_id = $input['order_id'] ?? 0;
    $created_by = $current_user['id'];

    if (!$order_id) {
        echo json_encode(['success' => false, 'message' => 'Online Order ID required']);
        exit;
    }

    // --- Get online order details ---
    $order_sql = "SELECT * FROM online_orders WHERE id = ? AND status = 'Pending'";
    $order_stmt = safePrepare($link, $order_sql);
    mysqli_stmt_bind_param($order_stmt, "i", $order_id);
    mysqli_stmt_execute($order_stmt);
    $order_result = mysqli_stmt_get_result($order_stmt);

    if (!$order_result || mysqli_num_rows($order_result) === 0) {
        throw new Exception('Online order not found or already revived');
    }

    $order = mysqli_fetch_assoc($order_result);

    // --- Get online order items with product details ---
    $items_sql = "SELECT oi.product_id, oi.qty, oi.price, p.name AS product_name
                  FROM online_order_items oi
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

    // --- Generate new order number ---
    $order_number = 'ORD-' . date('Ymd') . '-' . str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);

    // --- Insert into orders ---
    $insert_order_sql = "INSERT INTO orders (
        order_number, customer_id, user_id, subtotal, tax_amount, discount_amount,
        total_amount, payment_method, payment_status, order_status, online_order_id, created_at
    ) VALUES (?, ?, ?, ?, 0, 0, ?, ?, 'pending', 'completed', ?, NOW())";

    $insert_order_stmt = safePrepare($link, $insert_order_sql);

    $customer_id    = $order['customer_id'] ?? null;
    $total_amount   = $order['total_amount'];
    $payment_method = $order['payment_method'];

    mysqli_stmt_bind_param(
        $insert_order_stmt,
        "siidssi",
        $order_number,   // string
        $customer_id,    // int
        $created_by,     // int
        $total_amount,   // double (subtotal)
        $total_amount,   // double (total_amount)
        $payment_method, // string
        $order_id        // int (online_order_id reference)
    );

    if (!mysqli_stmt_execute($insert_order_stmt)) {
        throw new Exception('Failed to create order: ' . mysqli_error($link));
    }

    $new_order_id = mysqli_insert_id($link);

    // --- Insert order items ---
    $item_sql = "INSERT INTO order_items (order_id, product_id, quantity, unit_price, total_price)
                 VALUES (?, ?, ?, ?, ?)";
    $item_stmt = safePrepare($link, $item_sql);

    foreach ($order_items as $item) {
        $product_id  = $item['product_id'];
        $quantity    = $item['qty'];
        $unit_price  = $item['price'];
        $total_price = $quantity * $unit_price;

        mysqli_stmt_bind_param($item_stmt, "iiidd", $new_order_id, $product_id, $quantity, $unit_price, $total_price);

        if (!mysqli_stmt_execute($item_stmt)) {
            throw new Exception('Failed to add order item: ' . mysqli_error($link));
        }
    }

    // --- Mark online order as revived ---
    $update_online_sql = "UPDATE online_orders SET status = 'Processing' WHERE id = ?";
    $update_stmt = safePrepare($link, $update_online_sql);
    mysqli_stmt_bind_param($update_stmt, "i", $order_id);
    mysqli_stmt_execute($update_stmt);

    echo json_encode([
        'success' => true,
        'order' => $order,
        'order_items' => $order_items,
        'message' => 'Order revived successfully',
        'revived_order_id' => $new_order_id
    ]);

} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>
