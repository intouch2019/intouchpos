<?php
require_once __DIR__ . '/../partials/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['purchase_id']);

    // Fetch items first to update stock
    $itemsQuery = mysqli_query($link, "SELECT product_id, return_qty FROM purchase_return_items WHERE purchase_return_id = $id");
    while ($item = mysqli_fetch_assoc($itemsQuery)) {
        $pid = intval($item['product_id']);
        $qty = intval($item['return_qty']);

        // Restore stock (subtract purchased quantity)
        $updateStock = "UPDATE products SET stock_quantity = stock_quantity + $qty WHERE id = $pid";
        mysqli_query($link, $updateStock);
    }

    // Delete purchase items
    mysqli_query($link, "DELETE FROM purchase_return_items WHERE purchase_return_id = $id");

    // Delete purchase
    $deletePurchase = mysqli_query($link, "DELETE FROM purchase_returns WHERE id = $id");

    if ($deletePurchase) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => mysqli_error($link)]);
    }
}
?>
