<?php
require_once __DIR__ . '/../partials/config.php';

// Check if form submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Sanitize main purchase fields
    $supplier_id   = intval($_POST['return_supplier_id']);
    $return_date = date('Y-m-d', strtotime($_POST['purchase_date'])); 
    $purchase_id  = $_POST['purchase_reference'];
    $order_tax     = floatval($_POST['order_tax'] ?? 0.00);
    $discount      = floatval($_POST['order_discount'] ?? 0.00);
    $shipping      = floatval($_POST['shipping'] ?? 0.00);
    $status        = mysqli_real_escape_string($link, $_POST['status']);
    $description   = mysqli_real_escape_string($link, $_POST['description'] ?? '');

    // Calculate grand total from items
    $grand_total = 0;
    foreach ($_POST['total_cost'] as $tc) {
        $grand_total += floatval($tc);
    }

    // Get purchase reference number
    $query_prno = "SELECT reference_no FROM purchase WHERE id = $purchase_id";
    $result_prno = mysqli_query($link, $query_prno);
    $purchase_no = '';

    if ($result_prno && mysqli_num_rows($result_prno) > 0) {
        $row = mysqli_fetch_assoc($result_prno);
        $purchase_no = $row['reference_no'];
    }

    // Insert purchase
    $query = "INSERT INTO purchase_returns (supplier_id, purchase_id, purchase_no, return_date, order_tax, discount, shipping, status, description, total_return_amount) 
    VALUES ('$supplier_id', '$purchase_id', '$purchase_no', '$return_date', '$order_tax', '$discount', '$shipping', '$status', '$description', '$grand_total')";

    if (mysqli_query($link, $query)) {
        $return_id = mysqli_insert_id($link);

        // Insert purchase items
        $product_ids      = $_POST['product_id'];
        $prod_qty         = $_POST['prod_qty'];
        $return_qty       = $_POST['return_qty'];
        $purchase_prices  = $_POST['purchase_price'];
        $tax_percentages  = $_POST['tax_percentage'];
        $tax_amounts      = $_POST['tax_amount'];
        $unit_costs       = $_POST['unit_cost'];
        $total_costs      = $_POST['total_cost'];

        for ($i = 0; $i < count($product_ids); $i++) {
            $pid        = intval($product_ids[$i]);
            $p_qty      = intval($prod_qty[$i]);
            $r_qty      = intval($return_qty[$i]);
            $pprice     = floatval($purchase_prices[$i]);
            $taxPerc    = floatval($tax_percentages[$i]);
            $taxAmt     = floatval($tax_amounts[$i]);
            $unitCost   = floatval($unit_costs[$i]);
            $totalCost  = floatval($total_costs[$i]);

            $itemQuery = "INSERT INTO purchase_return_items (purchase_return_id, product_id, purchased_qty, return_qty, purchase_price, tax_percentage, tax_amount, unit_cost, total_return) 
            VALUES ('$return_id', '$pid', '$p_qty', '$r_qty', '$pprice', '$taxPerc', '$taxAmt', '$unitCost', '$totalCost')";
            mysqli_query($link, $itemQuery);

            // ✅ Update stock quantity in products table
            $updateStock = "UPDATE products SET stock_quantity = stock_quantity - $r_qty WHERE id = $pid";
            mysqli_query($link, $updateStock);
        }

        // ✅ Success response
        header("Location: purchase-returns.php");
        exit;
    } else {
        die("Error saving purchase: " . mysqli_error($link));
    }
}
?>