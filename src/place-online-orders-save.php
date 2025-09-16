<?php
require_once __DIR__ . '/../partials/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = trim($_POST['name']);
    $phone    = trim($_POST['phone']);
    $email    = trim($_POST['email']);
    $address  = trim($_POST['address']);
    $city     = trim($_POST['city']);
    $state    = trim($_POST['state']);
    $pincode  = trim($_POST['pincode']);
    $payment  = trim($_POST['payment_method']);
    $channel  = trim($_POST['channel']);
    $cartData = json_decode($_POST['cartData'], true);
    $selectedAddressId = isset($_POST['address_id']) ? intval($_POST['address_id']) : 0;

    if (!$cartData || count($cartData) == 0) {
        echo json_encode(["status" => "error", "message" => "Cart is empty"]);
        exit;
    }

    mysqli_begin_transaction($link);

    try {
        // 1️⃣ Check if customer already exists by phone
        $sqlCheck = "SELECT id FROM customers WHERE phone = ? AND is_active = 1 LIMIT 1";
        $stmtCheck = mysqli_prepare($link, $sqlCheck);
        mysqli_stmt_bind_param($stmtCheck, "s", $phone);
        mysqli_stmt_execute($stmtCheck);
        $result = mysqli_stmt_get_result($stmtCheck);
        $existingCustomer = mysqli_fetch_assoc($result);

        if ($existingCustomer) {
            $customerId = $existingCustomer['id'];
        } else {
            // Insert new customer
            $sqlCustomer = "INSERT INTO customers 
            (name, phone, email, address, city, state, pincode, created_at) 
            VALUES (?,?,?,?,?,?,?,NOW())";
            $stmtCustomer = mysqli_prepare($link, $sqlCustomer);
            mysqli_stmt_bind_param($stmtCustomer, "sssssss", 
                $name, $phone, $email, $address, $city, $state, $pincode
            );
            mysqli_stmt_execute($stmtCustomer);
            $customerId = mysqli_insert_id($link);
        }

        // Check if customer already has an address
        $sqlHasAddress = "SELECT COUNT(*) as count FROM customer_addresses WHERE customer_id = ?";
        $stmtHasAddress = mysqli_prepare($link, $sqlHasAddress);
        mysqli_stmt_bind_param($stmtHasAddress, "i", $customerId);
        mysqli_stmt_execute($stmtHasAddress);
        $resHasAddress = mysqli_stmt_get_result($stmtHasAddress);
        $rowHasAddress = mysqli_fetch_assoc($resHasAddress);

        $is_default = ($rowHasAddress['count'] == 0) ? 1 : 0; // First address = default, others = non-default

        if ($selectedAddressId > 0) {
            // ✅ User selected an existing address
            $addressId = $selectedAddressId;
        } else {
            // ✅ User entered a new address → insert into customer_addresses
            $is_default = ($rowHasAddress['count'] == 0) ? 1 : 0;

            $sqlAddress = "INSERT INTO customer_addresses 
            (customer_id, address, city, state, pincode, is_default, created_at)
            VALUES (?,?,?,?,?,?,NOW())";
            $stmtAddress = mysqli_prepare($link, $sqlAddress);
            mysqli_stmt_bind_param($stmtAddress, "issssi", $customerId, $address, $city, $state, $pincode, $is_default);
            mysqli_stmt_execute($stmtAddress);

            $addressId = mysqli_insert_id($link);
        }

        // 2️⃣ Calculate total amount
        $totalAmount = 0;
        foreach ($cartData as $item) {
            $totalAmount += floatval($item['price']) * intval($item['qty']);
        }

        // Generate unique order number (daily reset)
        $datePrefix = date('Ymd'); 
        $query = mysqli_query($link, "SELECT COUNT(*) as count FROM online_orders WHERE DATE(created_at) = CURDATE()");
        $row = mysqli_fetch_assoc($query);
        $countToday = $row['count'] + 1;
        $order_number = "ORD-" . $datePrefix . "-" . str_pad($countToday, 5, "0", STR_PAD_LEFT);

        // 🔍 Find store by pincode
        $sqlStore = "SELECT id FROM users WHERE pincode = ? AND role = 'admin' AND is_active = 1 LIMIT 1";
        $stmtStore = mysqli_prepare($link, $sqlStore);
        mysqli_stmt_bind_param($stmtStore, "s", $pincode);
        mysqli_stmt_execute($stmtStore);
        $resultStore = mysqli_stmt_get_result($stmtStore);
        $store = mysqli_fetch_assoc($resultStore);

        if (!$store) {
            throw new Exception("No store found for pincode: " . $pincode);
        }

        $storeId = $store['id'];

        // 3️⃣ Insert order with customer_id and total_amount
        $sqlOrder = "INSERT INTO online_orders 
        (order_number, customer_id, address_id, total_amount, payment_method, channel, status, store_id, created_at) 
        VALUES (?,?,?,?,?, ?, 'Pending', ?, NOW())";
        $stmtOrder = mysqli_prepare($link, $sqlOrder);
        mysqli_stmt_bind_param($stmtOrder, "siidsss", $order_number, $customerId, $addressId, $totalAmount, $payment, $channel, $storeId);
        mysqli_stmt_execute($stmtOrder);
        $orderId = mysqli_insert_id($link);

        // 4️⃣ Insert each item & reduce stock
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
            $sqlStock = "UPDATE products 
            SET stock_quantity = stock_quantity - ? 
            WHERE id = ? AND stock_quantity >= ?";
            $stmtStock = mysqli_prepare($link, $sqlStock);
            mysqli_stmt_bind_param($stmtStock, "iii", $qty, $productId, $qty);
            mysqli_stmt_execute($stmtStock);

            if (mysqli_affected_rows($link) == 0) {
                throw new Exception("Not enough stock for product ID: $productId");
            }
        }

        mysqli_commit($link);

        echo json_encode([
            "status" => "success", 
            "message" => "✅ Order placed successfully!", 
            "order_number" => $order_number
        ]);

    } catch (Exception $e) {
        mysqli_rollback($link);
        echo json_encode([
            "status" => "error", 
            "message" => "❌ Order failed: " . $e->getMessage()
        ]);
    }
}
?>
