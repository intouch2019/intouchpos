<?php
require_once __DIR__ . '/../partials/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['sales_id']);

    mysqli_begin_transaction($link);

    try {
        // ✅ Check return status first
        $res = mysqli_query($link, "SELECT status FROM sales_returns WHERE id = $id");
        if (!$res || mysqli_num_rows($res) === 0) {
            throw new Exception("Sales return not found.");
        }
        $row = mysqli_fetch_assoc($res);
        $status = $row['status'];

        // ✅ If status was Received, rollback stock
        if ($status === 'Received') {
            $itemsQuery = mysqli_query($link, "SELECT product_id, return_qty FROM sales_return_items WHERE sales_return_id = $id");
            while ($item = mysqli_fetch_assoc($itemsQuery)) {
                $pid = intval($item['product_id']);
                $qty = intval($item['return_qty']);
                $updateStock = "UPDATE products SET stock_quantity = stock_quantity - $qty WHERE id = $pid";
                if (!mysqli_query($link, $updateStock)) {
                    throw new Exception("Error updating stock: " . mysqli_error($link));
                }
            }
        }

        // ✅ Delete items
        if (!mysqli_query($link, "DELETE FROM sales_return_items WHERE sales_return_id = $id")) {
            throw new Exception("Error deleting items: " . mysqli_error($link));
        }

        // ✅ Delete return record
        if (!mysqli_query($link, "DELETE FROM sales_returns WHERE id = $id")) {
            throw new Exception("Error deleting sales return: " . mysqli_error($link));
        }

        mysqli_commit($link);
        echo json_encode(["status" => "success"]);

    } catch (Exception $e) {
        mysqli_rollback($link);
        echo json_encode(["status" => "error", "message" => $e->getMessage()]);
    }
}
?>
