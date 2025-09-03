<?php
// Test POS functionality
require_once 'partials/config.php';

echo "<h2>POS System Test</h2>";

// Test database connection
if ($link) {
    echo "<div style='color: green; margin: 10px 0;'>✅ Database connection successful!</div>";
    
    // Test categories query
    echo "<h3>Testing Categories:</h3>";
    $cat_sql = "SELECT id, name, image FROM categories WHERE is_active = 1 ORDER BY name";
    $cat_result = mysqli_query($link, $cat_sql);
    if ($cat_result) {
        echo "<div style='color: green; margin: 5px 0;'>✅ Categories query successful</div>";
        $cat_count = mysqli_num_rows($cat_result);
        echo "<div style='margin-left: 20px; color: blue;'>Found " . $cat_count . " categories</div>";
        
        if ($cat_count > 0) {
            echo "<ul>";
            while ($cat = mysqli_fetch_assoc($cat_result)) {
                echo "<li>" . $cat['name'] . " (ID: " . $cat['id'] . ")</li>";
            }
            echo "</ul>";
        }
    } else {
        echo "<div style='color: red; margin: 5px 0;'>❌ Categories query failed: " . mysqli_error($link) . "</div>";
    }
    
    // Test products query
    echo "<h3>Testing Products:</h3>";
    $prod_sql = "SELECT p.*, c.name as category_name FROM products p 
                 LEFT JOIN categories c ON p.category_id = c.id 
                 WHERE p.is_active = 1 ORDER BY p.name";
    $prod_result = mysqli_query($link, $prod_sql);
    if ($prod_result) {
        echo "<div style='color: green; margin: 5px 0;'>✅ Products query successful</div>";
        $prod_count = mysqli_num_rows($prod_result);
        echo "<div style='margin-left: 20px; color: blue;'>Found " . $prod_count . " products</div>";
        
        if ($prod_count > 0) {
            echo "<ul>";
            while ($prod = mysqli_fetch_assoc($prod_result)) {
                echo "<li>" . $prod['name'] . " - $" . $prod['price'] . " (Category: " . $prod['category_name'] . ")</li>";
            }
            echo "</ul>";
        }
    } else {
        echo "<div style='color: red; margin: 5px 0;'>❌ Products query failed: " . mysqli_error($link) . "</div>";
    }
    
    // Test users query
    echo "<h3>Testing Users:</h3>";
    $user_sql = "SELECT id, username, email, full_name, role FROM users WHERE is_active = 1";
    $user_result = mysqli_query($link, $user_sql);
    if ($user_result) {
        echo "<div style='color: green; margin: 5px 0;'>✅ Users query successful</div>";
        $user_count = mysqli_num_rows($user_result);
        echo "<div style='margin-left: 20px; color: blue;'>Found " . $user_count . " users</div>";
        
        if ($user_count > 0) {
            echo "<ul>";
            while ($user = mysqli_fetch_assoc($user_result)) {
                echo "<li>" . $user['full_name'] . " (" . $user['email'] . ") - " . $user['role'] . "</li>";
            }
            echo "</ul>";
        }
    } else {
        echo "<div style='color: red; margin: 5px 0;'>❌ Users query failed: " . mysqli_error($link) . "</div>";
    }
    
} else {
    echo "<div style='color: red; margin: 10px 0;'>❌ Database connection failed!</div>";
}

echo "<hr>";
echo "<p><a href='src/pos.php'>Try POS Page</a></p>";
?>

<style>
body { font-family: Arial, sans-serif; margin: 20px; background-color: #f8f9fa; }
h2, h3 { color: #333; }
div { padding: 5px; }
ul { list-style-type: none; padding-left: 20px; }
li { margin: 5px 0; }
a { color: #007bff; text-decoration: none; font-weight: bold; }
a:hover { text-decoration: underline; }
</style> 