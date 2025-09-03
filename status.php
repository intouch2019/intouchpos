<?php
// Status check script for DreamsPOS
require_once __DIR__ . '/partials/config.php';

echo "<h2>DreamsPOS System Status</h2>";

// Test database connection
if ($link) {
    echo "<div style='color: green; margin: 10px 0;'>✅ Database connection successful!</div>";
    
    // Check tables and data
    $tables = ['users', 'categories', 'products', 'customers', 'orders', 'order_items'];
    $table_status = [];
    
    foreach ($tables as $table) {
        $table_result = mysqli_query($link, "SHOW TABLES LIKE '$table'");
        $exists = mysqli_num_rows($table_result) > 0;
        $table_status[$table] = $exists;
        
        if ($exists) {
            $count_result = mysqli_query($link, "SELECT COUNT(*) as count FROM $table");
            $count = mysqli_fetch_assoc($count_result);
            echo "<div style='color: green; margin: 5px 0;'>✅ Table '$table' exists (" . $count['count'] . " records)</div>";
        } else {
            echo "<div style='color: red; margin: 5px 0;'>❌ Table '$table' missing</div>";
        }
    }
    
    // Check if all tables exist
    $all_tables_exist = array_sum($table_status) == count($tables);
    
    // Check for admin users
    $admin_result = mysqli_query($link, "SELECT COUNT(*) as count FROM users WHERE role = 'admin'");
    $admin_count = mysqli_fetch_assoc($admin_result);
    
    echo "<h3>System Status:</h3>";
    if ($all_tables_exist && $admin_count['count'] > 0) {
        echo "<div style='color: green; font-weight: bold; margin: 10px 0;'>🎉 System is ready to use!</div>";
    } elseif ($all_tables_exist) {
        echo "<div style='color: orange; font-weight: bold; margin: 10px 0;'>⚠️ Tables created but no admin user found</div>";
    } else {
        echo "<div style='color: red; font-weight: bold; margin: 10px 0;'>❌ System needs setup</div>";
    }
    
    echo "<h3>Actions:</h3>";
    echo "<ul>";
    if (!$all_tables_exist) {
        echo "<li><a href='setup.php'>Run Setup</a> - Create missing tables</li>";
    } elseif ($admin_count['count'] == 0) {
        echo "<li><a href='setup.php'>Create Admin User</a> - Set up first admin account</li>";
    } else {
        echo "<li><a href='src/signin.php'>Login</a> - Access the system</li>";
        echo "<li><a href='src/pos.php'>POS System</a> - Go to POS interface</li>";
        echo "<li><a href='src/dashboard.php'>Dashboard</a> - View statistics</li>";
    }
    echo "</ul>";
    
} else {
    echo "<div style='color: red; margin: 10px 0;'>❌ Database connection failed!</div>";
    echo "<p>Please check your database configuration in config.php</p>";
}

echo "<hr>";
echo "<p><small>You can also check <a href='test_db.php'>detailed database status</a> here.</small></p>";
?>

<style>
body { font-family: Arial, sans-serif; margin: 20px; background-color: #f8f9fa; }
h2, h3 { color: #333; }
div { padding: 5px; }
ul { list-style-type: none; padding-left: 0; }
li { margin: 10px 0; }
a { color: #007bff; text-decoration: none; font-weight: bold; }
a:hover { text-decoration: underline; }
.card { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
</style> 