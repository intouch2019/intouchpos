<?php
// Script to update product images and fix database issues
require_once 'partials/config.php';

echo "<h2>Updating Product Images and Database</h2>";

if ($link) {
    echo "<div style='color: green; margin: 10px 0;'>✅ Database connection successful!</div>";
    
    // Update products with proper image names
    $update_queries = [
        "UPDATE products SET image = 'pos-product-01.png' WHERE name LIKE '%iPhone%'",
        "UPDATE products SET image = 'pos-product-15.png' WHERE name LIKE '%Samsung%'",
        "UPDATE products SET image = 'pos-product-04.png' WHERE name LIKE '%Nike%'",
        "UPDATE products SET image = 'pos-product-03.png' WHERE name LIKE '%Watch%'",
        "UPDATE products SET image = 'pos-product-12.png' WHERE name LIKE '%MacBook%'",
        "UPDATE products SET image = 'pos-product-08.png' WHERE name LIKE '%Sony%'",
        "UPDATE products SET image = 'pos-product-12.png' WHERE name LIKE '%Dell%'",
        "UPDATE products SET image = 'pos-product-05.png' WHERE name LIKE '%LG%'"
    ];
    
    echo "<h3>Updating Product Images:</h3>";
    foreach ($update_queries as $query) {
        if (mysqli_query($link, $query)) {
            echo "<div style='color: green; margin: 5px 0;'>✅ Updated: " . substr($query, 0, 50) . "...</div>";
        } else {
            echo "<div style='color: red; margin: 5px 0;'>❌ Error: " . mysqli_error($link) . "</div>";
        }
    }
    
    // Update categories with proper image names
    $category_updates = [
        "UPDATE categories SET image = 'pos-product-01.png' WHERE name = 'All'",
        "UPDATE categories SET image = 'pos-product-08.png' WHERE name = 'Headset'",
        "UPDATE categories SET image = 'pos-product-04.png' WHERE name = 'Shoes'",
        "UPDATE categories SET image = 'pos-product-15.png' WHERE name = 'Mobiles'",
        "UPDATE categories SET image = 'pos-product-03.png' WHERE name = 'Watches'",
        "UPDATE categories SET image = 'pos-product-12.png' WHERE name = 'Laptops'",
        "UPDATE categories SET image = 'pos-product-05.png' WHERE name = 'Appliance'"
    ];
    
    echo "<h3>Updating Category Images:</h3>";
    foreach ($category_updates as $query) {
        if (mysqli_query($link, $query)) {
            echo "<div style='color: green; margin: 5px 0;'>✅ Updated: " . substr($query, 0, 50) . "...</div>";
        } else {
            echo "<div style='color: red; margin: 5px 0;'>❌ Error: " . mysqli_error($link) . "</div>";
        }
    }
    
    // Check current products
    echo "<h3>Current Products:</h3>";
    $products_query = "SELECT id, name, image, category_id FROM products WHERE is_active = 1";
    $products_result = mysqli_query($link, $products_query);
    
    if ($products_result) {
        while ($product = mysqli_fetch_assoc($products_result)) {
            echo "<div style='margin: 5px 0;'>";
            echo "<strong>" . $product['name'] . "</strong> - Image: " . $product['image'];
            echo "</div>";
        }
    }
    
    echo "<hr>";
    echo "<p><a href='src/pos.php'>Go to POS Page</a></p>";
    
} else {
    echo "<div style='color: red; margin: 10px 0;'>❌ Database connection failed!</div>";
}
?>

<style>
body { font-family: Arial, sans-serif; margin: 20px; background-color: #f8f9fa; }
h2, h3 { color: #333; }
div { padding: 5px; }
a { color: #007bff; text-decoration: none; font-weight: bold; }
a:hover { text-decoration: underline; }
</style> 