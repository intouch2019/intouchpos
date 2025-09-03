<?php
require_once __DIR__ . '/../partials/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['purchase_id']);
    $supplier_id   = intval($_POST['supplier_id']);
    $purchase_date = date('Y-m-d', strtotime($_POST['purchase_date'])); 
    $reference_no  = mysqli_real_escape_string($link, $_POST['reference_no']);
    $order_tax     = floatval($_POST['order_tax'] ?? 0);
    $discount      = floatval($_POST['order_discount'] ?? 0);
    $shipping      = floatval($_POST['shipping'] ?? 0);
    $status        = mysqli_real_escape_string($link, $_POST['status']);
    $description   = mysqli_real_escape_string($link, $_POST['description'] ?? '');

    // ✅ Step 1: Restore stock from old items
    $oldItems = mysqli_query($link, "SELECT product_id, quantity FROM purchase_items WHERE purchase_id = $id");
    while ($old = mysqli_fetch_assoc($oldItems)) {
        $pid = intval($old['product_id']);
        $qty = intval($old['quantity']);
        mysqli_query($link, "UPDATE products SET stock_quantity = stock_quantity - $qty WHERE id = $pid");
    }

    // ✅ Step 2: Remove old items
    mysqli_query($link, "DELETE FROM purchase_items WHERE purchase_id = $id");

    // ✅ Step 3: Recalculate grand total from new items
    $grand_total = 0;
    foreach ($_POST['total_cost'] as $tc) {
        $grand_total += floatval($tc);
    }

    // ✅ Step 4: Update purchase table
    $query = "UPDATE purchase SET 
                supplier_id   = '$supplier_id', 
                purchase_date = '$purchase_date', 
                reference_no  = '$reference_no', 
                order_tax     = '$order_tax', 
                discount      = '$discount', 
                shipping      = '$shipping', 
                grand_total   = '$grand_total',
                status        = '$status',
                description   = '$description'
              WHERE id = $id";
    mysqli_query($link, $query);

    // ✅ Step 5: Insert updated items + update stock
    foreach ($_POST['product_id'] as $i => $pid) {
        $pid        = intval($pid);
        $qty        = intval($_POST['quantity'][$i]);
        $price      = floatval($_POST['purchase_price'][$i]);
        $disc       = floatval($_POST['discount'][$i]);
        $tax_perc   = floatval($_POST['tax_percentage'][$i]);
        $tax_amount = floatval($_POST['tax_amount'][$i]);
        $unit_cost  = floatval($_POST['unit_cost'][$i]);
        $total_cost = floatval($_POST['total_cost'][$i]);

        $sql = "INSERT INTO purchase_items 
                    (purchase_id, product_id, quantity, purchase_price, discount, tax_percentage, tax_amount, unit_cost, total_cost) 
                VALUES 
                    ('$id','$pid','$qty','$price','$disc','$tax_perc','$tax_amount','$unit_cost','$total_cost')";
        mysqli_query($link, $sql);

        // ✅ Add back new qty to stock
        $updateStock = "UPDATE products SET stock_quantity = stock_quantity + $qty WHERE id = $pid";
        mysqli_query($link, $updateStock);
    }

    echo json_encode(["status" => "success"]);
}
?>
