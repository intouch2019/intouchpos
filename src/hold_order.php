<?php
require_once __DIR__ . '/../auth/auth_middleware.php';
require_once __DIR__ . '/../partials/config.php';
requireLogin();

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);

if (!$input) {
    echo json_encode(['success' => false, 'message' => 'Invalid JSON data']);
    exit;
}

// Validate required fields
if (empty($input['cart_items']) || empty($input['hold_reference'])) {
    echo json_encode(['success' => false, 'message' => 'Missing required fields']);
    exit;
}

// Handle walk-in customers
$customer_id = isset($input['customer_id']) && $input['customer_id'] !== '' && $input['customer_id'] !== 'walkin' ? $input['customer_id'] : null;

$cart_items = $input['cart_items'];
$subtotal = $input['subtotal'] ?? 0;
$total_amount = $input['total_amount'] ?? 0;
$hold_reference = $input['hold_reference'];
$notes = $input['notes'] ?? '';

try {
    mysqli_begin_transaction($link);

    $order_number = 'ORD-' . date('Ymd') . '-' . str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);

    $order_sql = "INSERT INTO orders (
        order_number, customer_id, subtotal, tax_amount, discount_amount,
        total_amount, payment_method, payment_status, order_status, notes, hold_reference, created_at
    ) VALUES (?, ?, ?, 0, 0, ?, 'pending', 'pending', 'hold', ?, ?, NOW())";

    $order_stmt = mysqli_prepare($link, $order_sql);
    if (!$order_stmt) {
        throw new Exception('Failed to prepare order statement: ' . mysqli_error($link));
    }

    // Binding: "siddss" → string, int, double, double, string, string
    // If $customer_id is null, MySQL will insert NULL
    mysqli_stmt_bind_param(
        $order_stmt,
        "siddss",
        $order_number,
        $customer_id,
        $subtotal,
        $total_amount,
        $notes,
        $hold_reference
    );

    if (!mysqli_stmt_execute($order_stmt)) {
        throw new Exception('Failed to create hold order: ' . mysqli_error($link));
    }

    $order_id = mysqli_insert_id($link);

    $item_sql = "INSERT INTO order_items (order_id, product_id, quantity, unit_price, total_price)
                 VALUES (?, ?, ?, ?, ?)";
    $item_stmt = mysqli_prepare($link, $item_sql);
    if (!$item_stmt) {
        throw new Exception('Failed to prepare item statement: ' . mysqli_error($link));
    }

    foreach ($cart_items as $item) {
        $product_id = $item['id'];
        $quantity = $item['quantity'];
        $unit_price = $item['price'];
        $total_price = $quantity * $unit_price;

        mysqli_stmt_bind_param($item_stmt, "iiidd", $order_id, $product_id, $quantity, $unit_price, $total_price);

        if (!mysqli_stmt_execute($item_stmt)) {
            throw new Exception('Failed to add order item: ' . mysqli_error($link));
        }
    }

    mysqli_commit($link);

    echo json_encode([
        'success' => true,
        'message' => 'Order held successfully',
        'order_id' => $order_id,
        'hold_reference' => $hold_reference
    ]);
} catch (Exception $e) {
    mysqli_rollback($link);

    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}

mysqli_close($link);
?>