<?php
require_once __DIR__ . '/../partials/config.php';

// Fix the specific order with _REVIVED suffix
$order_id = 29;

$sql = "UPDATE orders SET hold_reference = REPLACE(hold_reference, '_REVIVED', '') WHERE id = ?";
$stmt = mysqli_prepare($link, $sql);
mysqli_stmt_bind_param($stmt, "i", $order_id);

if (mysqli_stmt_execute($stmt)) {
    echo "Order $order_id restored successfully!";
} else {
    echo "Error: " . mysqli_error($link);
}
?>