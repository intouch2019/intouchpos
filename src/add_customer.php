<?php
require_once __DIR__ . '/../auth/auth_middleware.php';
require_once __DIR__ . '/../partials/config.php';

// Ensure user is logged in
requireLogin();

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: pos.php');
    exit;
}

// Get current user
$current_user = getCurrentUser();
if (!$current_user) {
    $_SESSION['error'] = 'User not authenticated';
    header('Location: pos.php');
    exit;
}

// Validate and sanitize input
$name = trim($_POST['name'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$email = trim($_POST['email'] ?? '');
$address = trim($_POST['address'] ?? '');

// Validate required fields
if (empty($name)) {
    $_SESSION['error'] = 'Customer name is required';
    header('Location: pos.php');
    exit;
}

if (empty($phone)) {
    $_SESSION['error'] = 'Customer phone is required';
    header('Location: pos.php');
    exit;
}

// Validate email format if provided
if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error'] = 'Invalid email format';
    header('Location: pos.php');
    exit;
}

try {
    // Check if customer with same phone already exists
    $check_sql = "SELECT id FROM customers WHERE phone = ?";
    $check_stmt = mysqli_prepare($link, $check_sql);
    mysqli_stmt_bind_param($check_stmt, 's', $phone);
    mysqli_stmt_execute($check_stmt);
    $result = mysqli_stmt_get_result($check_stmt);
    
    if (mysqli_num_rows($result) > 0) {
        $_SESSION['error'] = 'Customer with this phone number already exists';
        mysqli_stmt_close($check_stmt);
        header('Location: pos.php');
        exit;
    }
    mysqli_stmt_close($check_stmt);
    
    // Check if customer with same email already exists (if email provided)
    if (!empty($email)) {
        $check_email_sql = "SELECT id FROM customers WHERE email = ?";
        $check_email_stmt = mysqli_prepare($link, $check_email_sql);
        mysqli_stmt_bind_param($check_email_stmt, 's', $email);
        mysqli_stmt_execute($check_email_stmt);
        $email_result = mysqli_stmt_get_result($check_email_stmt);
        
        if (mysqli_num_rows($email_result) > 0) {
            $_SESSION['error'] = 'Customer with this email already exists';
            mysqli_stmt_close($check_email_stmt);
            header('Location: pos.php');
            exit;
        }
        mysqli_stmt_close($check_email_stmt);
    }
    
    // Insert new customer
    $insert_sql = "INSERT INTO customers (name, phone, email, address, is_active, created_by, created_at) VALUES (?, ?, ?, ?, 1, ?, NOW())";
    $insert_stmt = mysqli_prepare($link, $insert_sql);
    
    if (!$insert_stmt) {
        throw new Exception('Failed to prepare statement: ' . mysqli_error($link));
    }
    
    mysqli_stmt_bind_param($insert_stmt, 'ssssi', $name, $phone, $email, $address, $current_user['id']);
    
    if (mysqli_stmt_execute($insert_stmt)) {
        $customer_id = mysqli_insert_id($link);
        $_SESSION['success'] = 'Customer added successfully';
        mysqli_stmt_close($insert_stmt);
        
        // Redirect back to POS with success flag
        header('Location: pos.php?customer_added=1&new_customer_id=' . $customer_id);
        exit;
    } else {
        throw new Exception('Failed to insert customer: ' . mysqli_stmt_error($insert_stmt));
    }
    
} catch (Exception $e) {
    // Log error
    error_log("Customer creation error: " . $e->getMessage());
    
    $_SESSION['error'] = 'Failed to add customer: ' . $e->getMessage();
    header('Location: pos.php');
    exit;
}
?>