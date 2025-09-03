<?php
require_once 'partials/config.php';

echo "<h2>Testing Order System</h2>";

// Test 1: Check if tables exist
echo "<h3>1. Checking Database Tables:</h3>";
$tables = ['users', 'categories', 'products', 'customers', 'orders', 'order_items'];
foreach ($tables as $table) {
    $result = mysqli_query($link, "SHOW TABLES LIKE '$table'");
    if (mysqli_num_rows($result) > 0) {
        echo "✓ Table '$table' exists<br>";
    } else {
        echo "✗ Table '$table' missing<br>";
    }
}

// Test 2: Check orders table structure
echo "<h3>2. Checking Orders Table Structure:</h3>";
$result = mysqli_query($link, "DESCRIBE orders");
if ($result) {
    echo "<table border='1' style='border-collapse: collapse;'>";
    echo "<tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>{$row['Field']}</td>";
        echo "<td>{$row['Type']}</td>";
        echo "<td>{$row['Null']}</td>";
        echo "<td>{$row['Key']}</td>";
        echo "<td>{$row['Default']}</td>";
        echo "</tr>";
    }
    echo "</table>";
}

// Test 3: Check if sample data exists
echo "<h3>3. Checking Sample Data:</h3>";
$result = mysqli_query($link, "SELECT COUNT(*) as count FROM users");
$row = mysqli_fetch_assoc($result);
echo "Users: {$row['count']}<br>";

$result = mysqli_query($link, "SELECT COUNT(*) as count FROM categories");
$row = mysqli_fetch_assoc($result);
echo "Categories: {$row['count']}<br>";

$result = mysqli_query($link, "SELECT COUNT(*) as count FROM products");
$row = mysqli_fetch_assoc($result);
echo "Products: {$row['count']}<br>";

$result = mysqli_query($link, "SELECT COUNT(*) as count FROM customers");
$row = mysqli_fetch_assoc($result);
echo "Customers: {$row['count']}<br>";

$result = mysqli_query($link, "SELECT COUNT(*) as count FROM orders");
$row = mysqli_fetch_assoc($result);
echo "Orders: {$row['count']}<br>";

echo "<h3>4. Navigation:</h3>";
echo "<a href='src/signin.php'>Login</a> | ";
echo "<a href='src/pos.php'>POS System</a> | ";
echo "<a href='src/orders.php'>View Orders</a> | ";
echo "<a href='setup.php'>Run Setup</a>";
?>