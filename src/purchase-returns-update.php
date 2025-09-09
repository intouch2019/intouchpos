<?php
require_once __DIR__ . '/../partials/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $return_id     = intval($_POST['purchase_return_id']);
    $return_date   = date('Y-m-d', strtotime($_POST['return_date']));
    $order_tax     = floatval($_POST['order_tax'] ?? 0.00);
    $discount      = floatval($_POST['order_discount'] ?? 0.00);
    $shipping      = floatval($_POST['shipping'] ?? 0.00);
    $status        = mysqli_real_escape_string($link, $_POST['status']);
    $description   = mysqli_real_escape_string($link, $_POST['description'] ?? '');

    mysqli_begin_transaction($link);

    try {
        // ✅ Step 0: Get old status
        $oldRes = mysqli_query($link, "SELECT status FROM purchase_returns WHERE id = $return_id");
        if (!$oldRes || mysqli_num_rows($oldRes) === 0) {
            throw new Exception("Purchase return not found.");
        }
        $oldData = mysqli_fetch_assoc($oldRes);
        $oldStatus = $oldData['status'];

        // ✅ Step 1: Restore stock from old items (only if old status = Received)
        if ($oldStatus === 'Received') {
            $oldItems = mysqli_query($link, "SELECT product_id, return_qty FROM purchase_return_items WHERE purchase_return_id = $return_id");
            while ($old = mysqli_fetch_assoc($oldItems)) {
                $pid = intval($old['product_id']);
                $rqty = intval($old['return_qty']);
                $restore = "UPDATE products SET stock_quantity = stock_quantity + $rqty WHERE id = $pid";
                if (!mysqli_query($link, $restore)) {
                    throw new Exception("Stock restore failed: " . mysqli_error($link));
                }
            }
        }

        // ✅ Step 2: Delete old return items
        if (!mysqli_query($link, "DELETE FROM purchase_return_items WHERE purchase_return_id = $return_id")) {
            throw new Exception("Failed deleting old items: " . mysqli_error($link));
        }

        // ✅ Step 3: Recalculate total return amount
        $total_return_amount = 0;
        foreach ($_POST['total_cost'] as $tc) {
            $total_return_amount += floatval($tc);
        }

        // ✅ Step 4: Update purchase_returns row
        $query = "UPDATE purchase_returns SET 
                    return_date = '$return_date',
                    status = '$status',
                    order_tax = '$order_tax',
                    discount = '$discount',
                    shipping = '$shipping',
                    description = '$description',
                    total_return_amount = '$total_return_amount'
                  WHERE id = $return_id";
        if (!mysqli_query($link, $query)) {
            throw new Exception("Update purchase_returns failed: " . mysqli_error($link));
        }

        // ✅ Step 5: Insert updated return items + update stock if Received
        foreach ($_POST['product_id'] as $i => $pid) {
            $pid          = intval($pid);
            $purchased_qty= intval($_POST['prod_qty'][$i]);
            $return_qty   = intval($_POST['edit_return_qty'][$i]);
            $price        = floatval($_POST['purchase_price'][$i]);
            $tax_perc     = floatval($_POST['tax_percentage'][$i]);
            $tax_amount   = floatval($_POST['tax_amount'][$i]);
            $unit_cost    = floatval($_POST['unit_cost'][$i]);
            $total_cost   = floatval($_POST['total_cost'][$i]);

            $sql = "INSERT INTO purchase_return_items 
                        (purchase_return_id, product_id, purchased_qty, return_qty, purchase_price, tax_percentage, tax_amount, unit_cost, total_return) 
                    VALUES 
                        ('$return_id','$pid','$purchased_qty','$return_qty','$price','$tax_perc','$tax_amount','$unit_cost','$total_cost')";
            if (!mysqli_query($link, $sql)) {
                throw new Exception("Insert item failed: " . mysqli_error($link));
            }

            if ($status === 'Received') {
                $updateStock = "UPDATE products SET stock_quantity = stock_quantity - $return_qty WHERE id = $pid";
                if (!mysqli_query($link, $updateStock)) {
                    throw new Exception("Stock update failed: " . mysqli_error($link));
                }
            }
        }

        mysqli_commit($link);
        echo json_encode(["status" => "success"]);

    } catch (Exception $e) {
        mysqli_rollback($link);
        echo json_encode(["status" => "error", "message" => $e->getMessage()]);
    }
}
?>
