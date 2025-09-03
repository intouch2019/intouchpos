<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Function to check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
}

// Function to redirect if not logged in
function requireLogin() {
    if (!isLoggedIn()) {
        header("Location: ../src/signin.php");
        exit();
    }
}

// Function to redirect if already logged in
function redirectIfLoggedIn() {
    if (isLoggedIn()) {
//        header("Location: /ttkpos/dreampos/php/template/src/dashboard.php");
        header("Location: ../src/dashboard.php");
        exit();
    }
}

// Function to get current user data
function getCurrentUser() {
    if (isLoggedIn()) {
        return [
            'id' => $_SESSION['user_id'],
            'username' => $_SESSION['username'],
            'email' => $_SESSION['email'],
            'full_name' => $_SESSION['full_name'],
            'role' => $_SESSION['role']
        ];
    }
    return null;
}

// Function to check user role
function hasRole($role) {
    $user = getCurrentUser();
    return $user && $user['role'] === $role;
}

// Function to check if user has admin privileges
function isAdmin() {
    return hasRole('admin');
}

// Function to check if user is manager or admin
function isManagerOrAdmin() {
    $user = getCurrentUser();
    return $user && ($user['role'] === 'admin' || $user['role'] === 'manager');
}
?> 