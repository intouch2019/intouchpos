<?php
require_once __DIR__ . '/partials/config.php';

echo "<h2>Testing Products Display</h2>";

// Get products
$products = [];
$prod_sql = "SELECT p.*, c.name as category_name FROM products p 
             LEFT JOIN categories c ON p.category_id = c.id 
             WHERE p.is_active = 1 ORDER BY p.name";
$prod_result = mysqli_query($link, $prod_sql);
if ($prod_result) {
    while ($row = mysqli_fetch_assoc($prod_result)) {
        $products[] = $row;
    }
}

echo "<p>Found " . count($products) . " products</p>";

foreach ($products as $product) {
    echo "<div style='border: 1px solid #ccc; margin: 10px; padding: 10px;'>";
    echo "<h4>{$product['name']}</h4>";
    echo "<p>Category ID: {$product['category_id']}</p>";
    echo "<p>Category Name: {$product['category_name']}</p>";
    echo "<p>Price: \${$product['price']}</p>";
    echo "</div>";
}
?>