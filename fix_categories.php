<?php
require_once __DIR__ . '/partials/config.php';

echo "<h2>Fixing Product Categories</h2>";

// Update products with correct category IDs
$updates = [
    "UPDATE products SET category_id = 4 WHERE name LIKE '%iPhone%' OR name LIKE '%Samsung%'",
    "UPDATE products SET category_id = 3 WHERE name LIKE '%Nike%'", 
    "UPDATE products SET category_id = 5 WHERE name LIKE '%Watch%'",
    "UPDATE products SET category_id = 6 WHERE name LIKE '%MacBook%' OR name LIKE '%Dell%'",
    "UPDATE products SET category_id = 2 WHERE name LIKE '%Sony%'",
    "UPDATE products SET category_id = 7 WHERE name LIKE '%LG%'"
];

foreach ($updates as $sql) {
    if (mysqli_query($link, $sql)) {
        echo "✓ Updated products<br>";
    } else {
        echo "✗ Error: " . mysqli_error($link) . "<br>";
    }
}

echo "<h3>Final Products:</h3>";
$prod_result = mysqli_query($link, "SELECT p.id, p.name, p.category_id, c.name as category_name FROM products p LEFT JOIN categories c ON p.category_id = c.id");
while ($prod = mysqli_fetch_assoc($prod_result)) {
    echo "Product: {$prod['name']} → Category: {$prod['category_name']} (ID: {$prod['category_id']})<br>";
}

echo "<p><strong>Done! Categories are now fixed.</strong></p>";
?>