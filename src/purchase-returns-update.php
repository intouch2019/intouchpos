<?php
require_once __DIR__ . '/../partials/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $return_id = intval($_POST['purchase_return_id']); // ID of return entry
    //$supplier_id   = intval($_POST['supplier_id']);
    //$purchase_id   = intval($_POST['purchase_id']);
    //$purchase_no   = mysqli_real_escape_string($link, $_POST['purchase_no']);
    $return_date   = date('Y-m-d', strtotime($_POST['return_date']));
    $order_tax     = floatval($_POST['order_tax'] ?? 0.00);
    $discount      = floatval($_POST['order_discount'] ?? 0.00);
    $shipping      = floatval($_POST['shipping'] ?? 0.00);
    $status        = mysqli_real_escape_string($link, $_POST['status']);
    $description   = mysqli_real_escape_string($link, $_POST['description'] ?? '');

    // ✅ Step 1: Restore stock from old return items
    $oldItems = mysqli_query($link, "SELECT product_id, return_qty FROM purchase_return_items WHERE purchase_return_id = $return_id");
    while ($old = mysqli_fetch_assoc($oldItems)) {
        $pid = intval($old['product_id']);
        $rqty = intval($old['return_qty']);
        mysqli_query($link, "UPDATE products SET stock_quantity = stock_quantity + $rqty WHERE id = $pid");
    }

    // ✅ Step 2: Remove old return items
    mysqli_query($link, "DELETE FROM purchase_return_items WHERE purchase_return_id = $return_id");

    // ✅ Step 3: Recalculate total return amount
    $total_return_amount = 0;
    foreach ($_POST['total_cost'] as $tc) {
        $total_return_amount += floatval($tc);
    }

    // ✅ Step 4: Update purchase_returns table
    $query = "UPDATE purchase_returns SET 
                return_date        = '$return_date',
                status             = '$status',
                description        = '$description',
                total_return_amount= '$total_return_amount'
              WHERE id = $return_id";
    mysqli_query($link, $query);

    // ✅ Step 5: Insert updated return items + minus stock
    foreach ($_POST['product_id'] as $i => $pid) {
        $pid        = intval($pid);
        $purchased_qty = intval($_POST['prod_qty'][$i]);
        $return_qty = intval($_POST['edit_return_qty'][$i]);
        $price      = floatval($_POST['purchase_price'][$i]);
        $tax_perc   = floatval($_POST['tax_percentage'][$i]);
        $tax_amount = floatval($_POST['tax_amount'][$i]);
        $unit_cost  = floatval($_POST['unit_cost'][$i]);
        $total_cost = floatval($_POST['total_cost'][$i]);

        $sql = "INSERT INTO purchase_return_items 
                    (purchase_return_id, product_id, purchased_qty, return_qty, purchase_price, tax_percentage, tax_amount, unit_cost, total_return) 
                VALUES 
                    ('$return_id','$pid','$purchased_qty','$return_qty','$price','$tax_perc','$tax_amount','$unit_cost','$total_cost')";
        mysqli_query($link, $sql);

        // ✅ Reduce stock (since items are returned)
        $updateStock = "UPDATE products SET stock_quantity = stock_quantity - $return_qty WHERE id = $pid";
        mysqli_query($link, $updateStock);
    }

    echo json_encode(["status" => "success"]);
}
?>
