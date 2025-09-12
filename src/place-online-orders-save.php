<?php
require_once __DIR__ . '/../partials/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = $_POST['name'];
    $phone    = $_POST['phone'];
    $email    = $_POST['email'];
    $address  = $_POST['address'];
    $city     = $_POST['city'];
    $state    = $_POST['state'];
    $pincode  = $_POST['pincode'];
    $payment  = $_POST['payment_method'];
    $channel  = $_POST['channel'];
    $cartData = json_decode($_POST['cartData'], true);

    if (!$cartData || count($cartData) == 0) {
        echo json_encode(["status" => "error", "message" => "Cart is empty"]);
        exit;
    }

    mysqli_begin_transaction($link);

    try {
        // 1️⃣ Insert customer
        $sqlCustomer = "INSERT INTO customers 
            (name, phone, email, address, city, state, pincode, created_at) 
            VALUES (?,?,?,?,?,?,?,NOW())";
        $stmtCustomer = mysqli_prepare($link, $sqlCustomer);
        mysqli_stmt_bind_param($stmtCustomer, "sssssss", 
            $name, $phone, $email, $address, $city, $state, $pincode
        );
        mysqli_stmt_execute($stmtCustomer);
        $customerId = mysqli_insert_id($link);

        // 2️⃣ Calculate total amount
        $totalAmount = 0;
        foreach ($cartData as $item) {
            $totalAmount += floatval($item['price']) * intval($item['qty']);
        }

        // Generate unique order number
        $datePrefix = date('Ymd'); 
        $query = mysqli_query($link, "SELECT COUNT(*) as count FROM online_orders WHERE DATE(created_at) = CURDATE()");
        $row = mysqli_fetch_assoc($query);
        $countToday = $row['count'] + 1;
        $order_number = "ORD-" . $datePrefix . "-" . str_pad($countToday, 5, "0", STR_PAD_LEFT);

        // 3️⃣ Insert order with customer_id and total_amount
        $sqlOrder = "INSERT INTO online_orders 
            (order_number, customer_id, total_amount, payment_method, channel, status, created_at) 
            VALUES (?,?,?,?,?, 'Pending', NOW())";
        $stmtOrder = mysqli_prepare($link, $sqlOrder);
        mysqli_stmt_bind_param($stmtOrder, "sidss", $order_number, $customerId, $totalAmount, $payment, $channel);
        mysqli_stmt_execute($stmtOrder);
        $orderId = mysqli_insert_id($link);

        // 3️⃣ Insert each item & reduce stock
        foreach ($cartData as $item) {
            $productId = intval($item['id']);
            $qty       = intval($item['qty']);
            $price     = floatval($item['price']);
            $subtotal  = $price * $qty;

            // Insert item
            $sqlItem = "INSERT INTO online_order_items (order_id, product_id, qty, price, subtotal) 
                        VALUES (?,?,?,?,?)";
            $stmtItem = mysqli_prepare($link, $sqlItem);
            mysqli_stmt_bind_param($stmtItem, "iiidd", $orderId, $productId, $qty, $price, $subtotal);
            mysqli_stmt_execute($stmtItem);

            // Reduce stock
            $sqlStock = "UPDATE products SET stock_quantity = stock_quantity - ? WHERE id = ? AND stock_quantity >= ?";
            $stmtStock = mysqli_prepare($link, $sqlStock);
            mysqli_stmt_bind_param($stmtStock, "iii", $qty, $productId, $qty);
            mysqli_stmt_execute($stmtStock);

            if (mysqli_affected_rows($link) == 0) {
                throw new Exception("Not enough stock for product ID: $productId");
            }
        }

        mysqli_commit($link);
        echo json_encode(["status" => "success", "message" => "✅ Order placed successfully!", 'order_number' => $order_number]);
    } catch (Exception $e) {
        mysqli_rollback($link);
        echo json_encode(["status" => "error", "message" => "❌ Order failed: " . $e->getMessage()]);
    }
}
?>
