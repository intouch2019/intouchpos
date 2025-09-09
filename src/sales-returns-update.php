<?php
require_once __DIR__ . '/../partials/config.php'; // DB connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sales_return_id = intval($_POST['sales_return_id']);
    $return_date     = date('Y-m-d', strtotime($_POST['sales_return_date']));
    $order_tax       = floatval($_POST['order_tax']);
    $order_discount  = floatval($_POST['order_discount']);
    $order_shipping  = floatval($_POST['order_shipping']);
    $status          = mysqli_real_escape_string($link, $_POST['sales_return_status']);
    $grand_total     = floatval($_POST['grand_total'] ?? 0);

    $product_ids   = $_POST['product_id'] ?? [];
    $quantities    = $_POST['quantity'] ?? [];
    $unit_prices   = $_POST['unit_price'] ?? [];
    $discounts     = $_POST['discount'] ?? [];
    $tax_percents  = $_POST['tax_percentage'] ?? [];
    $subtotals     = $_POST['subtotal'] ?? [];

    if (empty($sales_return_id) || count($product_ids) === 0) {
        echo json_encode(["status" => "error", "message" => "Required fields are missing"]);
        exit;
    }

    mysqli_begin_transaction($link);

    try {
        // Recalculate grand total if not given
        if ($grand_total <= 0) {
            $grand_total = 0;
            for ($i = 0; $i < count($product_ids); $i++) {
                $grand_total += floatval($subtotals[$i]);
            }
            $grand_total = $grand_total + $order_shipping + ($grand_total * ($order_tax / 100)) - $order_discount;
        }

        // Update sales_returns
        $sqlUpdate = "UPDATE sales_returns SET 
            return_date = '$return_date',
            order_tax = '$order_tax',
            discount = '$order_discount',
            shipping = '$order_shipping',
            grand_total = '$grand_total',
            status = '$status'
            WHERE id = '$sales_return_id'";
        if (!mysqli_query($link, $sqlUpdate)) {
            throw new Exception("Error updating sales_returns: " . mysqli_error($link));
        }

        // Rollback stock if previously received
        $prev = mysqli_query($link, "SELECT status FROM sales_returns WHERE id = '$sales_return_id'");
        $prevRow = mysqli_fetch_assoc($prev);
        if ($prevRow && $prevRow['status'] === 'Received') {
            $oldItems = mysqli_query($link, "SELECT product_id, return_qty FROM sales_return_items WHERE sales_return_id = '$sales_return_id'");
            while ($oi = mysqli_fetch_assoc($oldItems)) {
                mysqli_query($link, "UPDATE products SET stock_quantity = stock_quantity - {$oi['return_qty']} WHERE id = {$oi['product_id']}");
            }
        }

        // Delete old items
        mysqli_query($link, "DELETE FROM sales_return_items WHERE sales_return_id = '$sales_return_id'");

        // Insert new items
        for ($i = 0; $i < count($product_ids); $i++) {
            $pid   = intval($product_ids[$i]);
            $qty   = floatval($quantities[$i]);
            $price = floatval($unit_prices[$i]);
            $disc  = floatval($discounts[$i]);
            $taxP  = floatval($tax_percents[$i]);
            $subtotal = floatval($subtotals[$i]);

            $lineSubtotal = ($qty * $price) - $disc;
            $taxAmount    = $lineSubtotal * ($taxP / 100);

            $sqlItem = "INSERT INTO sales_return_items 
            (sales_return_id, product_id, return_qty, unit_price, discount, tax_percentage, tax_amount, subtotal) 
            VALUES ('$sales_return_id', '$pid', '$qty', '$price', '$disc', '$taxP', '$taxAmount', '$subtotal')";
            if (!mysqli_query($link, $sqlItem)) {
                throw new Exception("Error inserting item: " . mysqli_error($link));
            }

            if ($status === 'Received') {
                $updateStock = "UPDATE products SET stock_quantity = stock_quantity + $qty WHERE id = $pid";
                if (!mysqli_query($link, $updateStock)) {
                    throw new Exception("Error updating stock: " . mysqli_error($link));
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
