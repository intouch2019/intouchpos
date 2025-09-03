<?php
require_once __DIR__ . '/../auth/auth_middleware.php';
require_once __DIR__ . '/../partials/config.php';

// Check if user is logged in
requireLogin();

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $customer_name = trim($_POST['customer_name'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $city = trim($_POST['city'] ?? '');
    $country = trim($_POST['country'] ?? '');

    // Validate required fields
    if (empty($customer_name) || empty($phone)) {
        $_SESSION['error'] = 'Customer name and phone are required.';
        header('Location: ../src/pos.php');
        exit;
    }
    
    // Validate email format if provided
    if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = 'Please enter a valid email address.';
        header('Location: ../src/pos.php');
        exit;
    }
    
    // Check if customer already exists
    $check_sql = "SELECT id FROM customers WHERE phone = ? OR (email = ? AND email != '')";
    $check_stmt = mysqli_prepare($link, $check_sql);
    mysqli_stmt_bind_param($check_stmt, "ss", $phone, $email);
    mysqli_stmt_execute($check_stmt);
    $result = mysqli_stmt_get_result($check_stmt);
    
    if (mysqli_num_rows($result) > 0) {
        $_SESSION['error'] = 'Customer with this phone number or email already exists.';
        header('Location: ../src/pos.php');
        exit;
    }
    
    // First, let's add city and country columns if they don't exist
    $alter_sql1 = "ALTER TABLE customers ADD COLUMN IF NOT EXISTS city VARCHAR(100)";
    $alter_sql2 = "ALTER TABLE customers ADD COLUMN IF NOT EXISTS country VARCHAR(100)";
    $alter_sql3 = "ALTER TABLE customers ADD COLUMN IF NOT EXISTS updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP";
    
    mysqli_query($link, $alter_sql1);
    mysqli_query($link, $alter_sql2);
    mysqli_query($link, $alter_sql3);
    
    // Insert new customer
    $insert_sql = "INSERT INTO customers (name, phone, email, address, city, country, created_at) VALUES (?, ?, ?, ?, ?, ?, NOW())";
    $insert_stmt = mysqli_prepare($link, $insert_sql);
    mysqli_stmt_bind_param($insert_stmt, "ssssss", $customer_name, $phone, $email, $address, $city, $country);
    
    if (mysqli_stmt_execute($insert_stmt)) {
        $_SESSION['success'] = 'Customer added successfully!';
    } else {
        $_SESSION['error'] = 'Error adding customer: ' . mysqli_error($link);
    }
    
    mysqli_stmt_close($insert_stmt);
    mysqli_stmt_close($check_stmt);
    
    // Redirect back to POS page
    header('Location: ../src/pos.php');
    exit;
} else {
    // If not POST request, redirect to POS page
    header('Location: ../src/pos.php');
    exit;
}
?>