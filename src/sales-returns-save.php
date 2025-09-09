<?php
require_once __DIR__ . '/../partials/config.php'; // DB connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect POST data
    $customer_id   = intval($_POST['customer_id']);
    $return_date   = date('Y-m-d', strtotime($_POST['sales_return_date'])); 
    $order_id      = mysqli_real_escape_string($link, $_POST['order_id']);
    $order_tax     = floatval($_POST['order_tax']);
    $order_discount= floatval($_POST['order_discount']);
    $order_shipping= floatval($_POST['order_shipping']);
    $status        = mysqli_real_escape_string($link, $_POST['sales_return_status']);
    $grand_total   = floatval($_POST['grand_total'] ?? 0);

    // Product arrays
    $product_ids   = $_POST['product_id'] ?? [];
    $quantities    = $_POST['quantity'] ?? [];
    $unit_prices   = $_POST['unit_price'] ?? [];
    $discounts     = $_POST['discount'] ?? [];
    $tax_percents  = $_POST['tax_percentage'] ?? [];
    $subtotals     = $_POST['subtotal'] ?? [];

    if (empty($customer_id) || empty($order_id) || count($product_ids) === 0) {
        die("❌ Required fields are missing.");
    }

    // ✅ Start transaction
    mysqli_begin_transaction($link);

    try {

        // Get order number
        $query_prno = "SELECT order_number FROM orders WHERE id = $order_id";
        $result_prno = mysqli_query($link, $query_prno);
        $order_no = '';

        if ($result_prno && mysqli_num_rows($result_prno) > 0) {
            $row = mysqli_fetch_assoc($result_prno);
            $order_no = $row['order_number'];
        }

        if ($grand_total <= 0) {
            $grand_total = 0;
            for ($i = 0; $i < count($product_ids); $i++) {
                $grand_total += floatval($subtotals[$i]);
            }
            $grand_total = $grand_total + $order_shipping + ($grand_total * ($order_tax / 100)) - $order_discount;
        }

        // Insert into sales_returns
        $sql = "INSERT INTO sales_returns 
        (customer_id, return_date, order_id, order_no, order_tax, discount, shipping, grand_total, status) 
        VALUES ('$customer_id', '$return_date', '$order_id', '$order_no', '$order_tax', '$order_discount', '$order_shipping', '$grand_total', '$status')";
        
        if (!mysqli_query($link, $sql)) {
            throw new Exception("Error inserting sales_returns: " . mysqli_error($link));
        }

        $sales_return_id = mysqli_insert_id($link);

        // Insert items
        for ($i = 0; $i < count($product_ids); $i++) {
            $pid   = intval($product_ids[$i]);
            $qty   = floatval($quantities[$i]);
            $price = floatval($unit_prices[$i]);
            $disc  = floatval($discounts[$i]);
            $taxP  = floatval($tax_percents[$i]);
            $subtotal = floatval($subtotals[$i]);

            // tax amount calculation (safe fallback if JS skipped)
            $lineSubtotal = ($qty * $price) - $disc;
            $taxAmount    = $lineSubtotal * ($taxP / 100);

            $sqlItem = "INSERT INTO sales_return_items 
            (sales_return_id, product_id, return_qty, unit_price, discount, tax_percentage, tax_amount, subtotal) 
            VALUES ('$sales_return_id', '$pid', '$qty', '$price', '$disc', '$taxP', '$taxAmount', '$subtotal')";

            if (!mysqli_query($link, $sqlItem)) {
                throw new Exception("Error inserting item: " . mysqli_error($link));
            }

            if ($status === 'Received') {
                $updateStock = "UPDATE products 
                SET stock_quantity = stock_quantity + $qty 
                WHERE id = $pid";
                if (!mysqli_query($link, $updateStock)) {
                    throw new Exception("Error updating stock: " . mysqli_error($link));
                }
            }
        }

        // ✅ Commit transaction
        mysqli_commit($link);

        echo "<script>alert('✅ Sales return saved successfully!'); window.location.href='sales-returns.php';</script>";
    } catch (Exception $e) {
        mysqli_rollback($link);
        die("❌ Transaction failed: " . $e->getMessage());
    }
}
?>
