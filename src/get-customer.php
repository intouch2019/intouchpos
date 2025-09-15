<?php
require_once __DIR__ . '/../partials/config.php';

$phone = $_GET['phone'] ?? '';
$response = ['status' => 'error', 'message' => 'Customer not found'];

if ($phone) {
    $sql = "SELECT id, name, email FROM customers WHERE phone = ? and is_active = 1";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "s", $phone);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($customer = mysqli_fetch_assoc($result)) {
        // fetch addresses
        $addrSql = "SELECT id, address, city, state, pincode, is_default 
                    FROM customer_addresses 
                    WHERE customer_id = ?";
        $addrStmt = mysqli_prepare($link, $addrSql);
        mysqli_stmt_bind_param($addrStmt, "i", $customer['id']);
        mysqli_stmt_execute($addrStmt);
        $addrResult = mysqli_stmt_get_result($addrStmt);

        $addresses = [];
        while ($a = mysqli_fetch_assoc($addrResult)) {
            $addresses[] = $a;
        }

        $response = [
            'status' => 'success',
            'data' => [
                'id'       => $customer['id'],
                'name'     => $customer['name'],
                'email'    => $customer['email'],
                'addresses'=> $addresses
            ]
        ];
    }
}

header('Content-Type: application/json');
echo json_encode($response);
?>