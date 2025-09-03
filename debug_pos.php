<?php
// Debug script for POS issues
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>POS Debug Information</h2>";

// Test 1: Basic PHP functionality
echo "<h3>Test 1: PHP Functionality</h3>";
echo "<div style='color: green; margin: 5px 0;'>✅ PHP is working</div>";

// Test 2: Database connection
echo "<h3>Test 2: Database Connection</h3>";
require_once 'partials/config.php';

if ($link) {
    echo "<div style='color: green; margin: 5px 0;'>✅ Database connection successful</div>";
} else {
    echo "<div style='color: red; margin: 5px 0;'>❌ Database connection failed</div>";
    exit();
}

// Test 3: Authentication middleware
echo "<h3>Test 3: Authentication Files</h3>";
if (file_exists('auth/auth_middleware.php')) {
    echo "<div style='color: green; margin: 5px 0;'>✅ auth_middleware.php exists</div>";
} else {
    echo "<div style='color: red; margin: 5px 0;'>❌ auth_middleware.php missing</div>";
}

if (file_exists('auth/login_handler.php')) {
    echo "<div style='color: green; margin: 5px 0;'>✅ login_handler.php exists</div>";
} else {
    echo "<div style='color: red; margin: 5px 0;'>❌ login_handler.php missing</div>";
}

// Test 4: Partial files
echo "<h3>Test 4: Required Files</h3>";
$required_files = [
    'partials/main.php',
    'partials/session.php',
    'partials/body.php',
    'partials/head-css.php',
    'partials/title-meta.php'
];

foreach ($required_files as $file) {
    if (file_exists($file)) {
        echo "<div style='color: green; margin: 5px 0;'>✅ $file exists</div>";
    } else {
        echo "<div style='color: red; margin: 5px 0;'>❌ $file missing</div>";
    }
}

// Test 5: Database tables
echo "<h3>Test 5: Database Tables</h3>";
$tables = ['users', 'categories', 'products', 'customers', 'orders', 'order_items'];

foreach ($tables as $table) {
    $result = mysqli_query($link, "SHOW TABLES LIKE '$table'");
    if (mysqli_num_rows($result) > 0) {
        $count_result = mysqli_query($link, "SELECT COUNT(*) as count FROM $table");
        $count = mysqli_fetch_assoc($count_result);
        echo "<div style='color: green; margin: 5px 0;'>✅ Table '$table' exists (" . $count['count'] . " records)</div>";
    } else {
        echo "<div style='color: red; margin: 5px 0;'>❌ Table '$table' missing</div>";
    }
}

// Test 6: Session functionality
echo "<h3>Test 6: Session</h3>";
session_start();
if (session_status() === PHP_SESSION_ACTIVE) {
    echo "<div style='color: green; margin: 5px 0;'>✅ Sessions working</div>";
} else {
    echo "<div style='color: red; margin: 5px 0;'>❌ Sessions not working</div>";
}

echo "<hr>";
echo "<h3>Next Steps:</h3>";
echo "<ul>";
echo "<li><a href='test_pos.php'>Run POS Database Test</a></li>";
echo "<li><a href='src/pos.php'>Try POS Page</a></li>";
echo "<li><a href='status.php'>Check System Status</a></li>";
echo "</ul>";
?>

<style>
body { font-family: Arial, sans-serif; margin: 20px; background-color: #f8f9fa; }
h2, h3 { color: #333; }
div { padding: 5px; }
ul { list-style-type: none; padding-left: 0; }
li { margin: 10px 0; }
a { color: #007bff; text-decoration: none; font-weight: bold; }
a:hover { text-decoration: underline; }
</style> 