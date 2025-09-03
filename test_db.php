<?php
// Database test script for DreamsPOS
require_once __DIR__ . '/partials/config.php';

echo "<h2>DreamsPOS Database Test</h2>";

// Test database connection
if ($link) {
    echo "<div style='color: green; margin: 10px 0;'>✅ Database connection successful!</div>";
    
    // Check if database exists
    $result = mysqli_query($link, "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '" . DB_NAME . "'");
    if (mysqli_num_rows($result) > 0) {
        echo "<div style='color: green; margin: 10px 0;'>✅ Database '" . DB_NAME . "' exists!</div>";
        
        // Check tables
        $tables = ['users', 'categories', 'products', 'customers', 'orders', 'order_items'];
        echo "<h3>Table Status:</h3>";
        
        foreach ($tables as $table) {
            $table_result = mysqli_query($link, "SHOW TABLES LIKE '$table'");
            if (mysqli_num_rows($table_result) > 0) {
                echo "<div style='color: green; margin: 5px 0;'>✅ Table '$table' exists</div>";
                
                // Count records
                $count_result = mysqli_query($link, "SELECT COUNT(*) as count FROM $table");
                if ($count_result) {
                    $count = mysqli_fetch_assoc($count_result);
                    echo "<div style='margin-left: 20px; color: blue;'>Records: " . $count['count'] . "</div>";
                }
            } else {
                echo "<div style='color: red; margin: 5px 0;'>❌ Table '$table' does not exist</div>";
            }
        }
        
        // Check for admin user
        $user_result = mysqli_query($link, "SELECT COUNT(*) as count FROM users WHERE role = 'admin'");
        if ($user_result) {
            $admin_count = mysqli_fetch_assoc($user_result);
            echo "<h3>Admin Users:</h3>";
            echo "<div style='margin: 5px 0;'>Total admin users: " . $admin_count['count'] . "</div>";
            
            if ($admin_count['count'] > 0) {
                $admin_list = mysqli_query($link, "SELECT username, email FROM users WHERE role = 'admin'");
                while ($admin = mysqli_fetch_assoc($admin_list)) {
                    echo "<div style='margin-left: 20px; color: green;'>👤 " . $admin['username'] . " (" . $admin['email'] . ")</div>";
                }
            }
        }
        
    } else {
        echo "<div style='color: red; margin: 10px 0;'>❌ Database '" . DB_NAME . "' does not exist!</div>";
        echo "<p>Please create the database manually or run the setup script.</p>";
    }
} else {
    echo "<div style='color: red; margin: 10px 0;'>❌ Database connection failed!</div>";
    echo "<p>Please check your database configuration in config.php</p>";
}

echo "<hr>";
echo "<h3>Next Steps:</h3>";
echo "<ul>";
echo "<li><a href='setup.php'>Run Setup Script</a> - Create tables and admin user</li>";
echo "<li><a href='src/signin.php'>Go to Login</a> - If setup is complete</li>";
echo "<li><a href='database_schema.sql'>View Database Schema</a> - SQL structure</li>";
echo "</ul>";
?>

<style>
body { font-family: Arial, sans-serif; margin: 20px; }
h2, h3 { color: #333; }
div { padding: 5px; }
a { color: #007bff; text-decoration: none; }
a:hover { text-decoration: underline; }
</style> 