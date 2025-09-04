<?php
require_once __DIR__ . '/../partials/config.php';

// Check if form submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Sanitize main purchase fields
    $supplier_id   = intval($_POST['supplier_id']);
    $purchase_date = date('Y-m-d', strtotime($_POST['purchase_date'])); 
    $reference_no  = mysqli_real_escape_string($link, $_POST['reference_no']);
    $order_tax     = floatval($_POST['order_tax'] ?? 0);
    $discount      = floatval($_POST['order_discount'] ?? 0);
    $shipping      = mysqli_real_escape_string($link, $_POST['shipping'] ?? '');
    $status        = mysqli_real_escape_string($link, $_POST['status']);
    $description   = mysqli_real_escape_string($link, $_POST['description'] ?? '');
    $purchase_status = 0;
    // Calculate grand total from items
    $grand_total = 0;
    foreach ($_POST['total_cost'] as $tc) {
        $grand_total += floatval($tc);
    }

    // Insert purchase
    $query = "INSERT INTO purchase (supplier_id, purchase_date, reference_no, order_tax, discount, shipping, grand_total, status, description, purchase_status) 
    VALUES ('$supplier_id', '$purchase_date', '$reference_no', '$order_tax', '$discount', '$shipping', '$grand_total', '$status', '$description', '$purchase_status')";

    if (mysqli_query($link, $query)) {
        $purchase_id = mysqli_insert_id($link);

        // Insert purchase items
        $product_ids      = $_POST['product_id'];
        $quantities       = $_POST['quantity'];
        $purchase_prices  = $_POST['purchase_price'];
        $discounts        = $_POST['discount'];
        $tax_percentages  = $_POST['tax_percentage'];
        $tax_amounts      = $_POST['tax_amount'];
        $unit_costs       = $_POST['unit_cost'];
        $total_costs      = $_POST['total_cost'];

        for ($i = 0; $i < count($product_ids); $i++) {
            $pid        = intval($product_ids[$i]);
            $qty        = intval($quantities[$i]);
            $pprice     = floatval($purchase_prices[$i]);
            $disc       = floatval($discounts[$i]);
            $taxPerc    = floatval($tax_percentages[$i]);
            $taxAmt     = floatval($tax_amounts[$i]);
            $unitCost   = floatval($unit_costs[$i]);
            $totalCost  = floatval($total_costs[$i]);

            $itemQuery = "INSERT INTO purchase_items (purchase_id, product_id, quantity, purchase_price, discount, tax_percentage, tax_amount, unit_cost, total_cost) 
            VALUES ('$purchase_id', '$pid', '$qty', '$pprice', '$disc', '$taxPerc', '$taxAmt', '$unitCost', '$totalCost')";
            mysqli_query($link, $itemQuery);

            // ✅ Update stock quantity in products table
            $updateStock = "UPDATE products SET stock_quantity = stock_quantity + $qty WHERE id = $pid";
            mysqli_query($link, $updateStock);
        }

        // ✅ Success response
        header("Location: purchase-list.php");
        exit;
    } else {
        die("Error saving purchase: " . mysqli_error($link));
    }
}
?>