<?php
require_once __DIR__ . '/../partials/config.php';

header('Content-Type: application/json');

$product_id = isset($_GET['product_id']) ? (int)$_GET['product_id'] : 0;

if ($product_id > 0) {
    $batches = [];
    $sql = "SELECT id, batch_code, expiry_date, stock_quantity FROM product_batches WHERE product_id = ? AND stock_quantity > 0 ORDER BY expiry_date ASC";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "i", $product_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $batches[] = ['batch_id' => $row['id'],'batch_no' => $row['batch_code'], 'stock' => $row['stock_quantity']];
        }
        echo json_encode(['success' => true, 'batches' => $batches]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to fetch batches.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid product ID.']);
}
?>