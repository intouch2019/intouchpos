<?php
require_once __DIR__ . '/../auth/auth_middleware.php';
require_once __DIR__ . '/../partials/config.php';
requireLogin();

//header('Content-Type: application/json');

try {
    $input = json_decode(file_get_contents('php://input'), true);
    $order_id = $input['order_id'] ?? 0;
    $current_user = getCurrentUser();

    if (!$order_id) {
        throw new Exception("Order ID is required");
    }

    // Fetch order
    $sql = "SELECT * FROM online_orders WHERE id = ? AND status = 'Pending'";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "i", $order_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $order = mysqli_fetch_assoc($result);

    if (!$order) {
        throw new Exception("Order not found or already processed");
    }

    // Mark rejection
    $sql = "INSERT INTO online_order_rejections (order_id, store_id) VALUES (?, ?)";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $order_id, $current_user['id']);
    mysqli_stmt_execute($stmt);

    // Get rejecting store's pincode
    $sql = "SELECT pincode FROM users WHERE id = ?";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "i", $current_user['id']);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $store = mysqli_fetch_assoc($result);
    $store_pincode = $store['pincode'] ?? null;

    if (!$store_pincode) {
        throw new Exception("Store pincode not found");
    }

    // Get all rejected stores for this order
    $sql = "SELECT store_id FROM online_order_rejections WHERE order_id = ?";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "i", $order_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $rejected_stores = array_column(mysqli_fetch_all($result, MYSQLI_ASSOC), 'store_id');

    $new_store = null;

    // If there are rejected stores, exclude them
    if (!empty($rejected_stores)) {
        $placeholders = implode(',', array_fill(0, count($rejected_stores), '?'));
        $types = str_repeat('i', count($rejected_stores));

        $sql = "SELECT id, pincode 
                FROM users 
                WHERE pincode = ? AND id NOT IN ($placeholders) 
                LIMIT 1";

        $stmt = mysqli_prepare($link, $sql);

        // Merge parameters: pincode first, then rejected stores
        $params = array_merge([$store_pincode], $rejected_stores);
        mysqli_stmt_bind_param($stmt, "i" . $types, ...$params);
    } else {
        // No rejected stores, just search in same pincode
        $sql = "SELECT id, pincode FROM users WHERE pincode = ? LIMIT 1";
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, "i", $store_pincode);
    }

    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $new_store = mysqli_fetch_assoc($result);

    // If no same-pincode store left, pick nearest
    if (!$new_store) {
        if (!empty($rejected_stores)) {
            $placeholders = implode(',', array_fill(0, count($rejected_stores), '?'));
            $types = str_repeat('i', count($rejected_stores));

            $sql = "SELECT id, pincode 
                    FROM users 
                    WHERE id NOT IN ($placeholders) AND pincode IS NOT null
                    ORDER BY ABS(pincode - ?) ASC 
                    LIMIT 1";

            $stmt = mysqli_prepare($link, $sql);
            $params = array_merge($rejected_stores, [$store_pincode]);
            mysqli_stmt_bind_param($stmt, $types . "i", ...$params);
        } else {
            $sql = "SELECT id, pincode 
                    FROM users WHERE pincode IS NOT null
                    ORDER BY ABS(pincode - ?) ASC 
                    LIMIT 1";

            $stmt = mysqli_prepare($link, $sql);
            mysqli_stmt_bind_param($stmt, "i", $store_pincode);
        }

        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $new_store = mysqli_fetch_assoc($result);
    }

    if (!$new_store) {
        throw new Exception("No alternative store available for this order");
    }

    // Assign to new store
    $sql = "UPDATE online_orders SET store_id = ? WHERE id = ?";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $new_store['id'], $order_id);
    mysqli_stmt_execute($stmt);

    echo json_encode([
        "success" => true,
        "message" => "Order rejected successfully & reassigned to store (Pincode: {$new_store['pincode']})"
    ]);

} catch (Exception $e) {
    echo json_encode(["success" => false, "message" => $e->getMessage()]);
}
?>