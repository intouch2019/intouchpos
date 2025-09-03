<?php
require_once 'partials/config.php';

// Update orders table structure to match process_order.php expectations
$sql = "
-- Check if orders table exists and update structure
ALTER TABLE orders 
ADD COLUMN IF NOT EXISTS created_by INT AFTER status,
ADD COLUMN IF NOT EXISTS notes TEXT AFTER total_amount,
MODIFY COLUMN payment_method ENUM('cash', 'card', 'mobile_money') DEFAULT 'cash',
ADD CONSTRAINT IF NOT EXISTS fk_orders_created_by FOREIGN KEY (created_by) REFERENCES users(id);

-- Update existing orders to have created_by if null
UPDATE orders SET created_by = 1 WHERE created_by IS NULL;
";

// Execute the update
if (mysqli_multi_query($link, $sql)) {
    echo "Orders table updated successfully!<br>";
    
    // Process all results
    do {
        if ($result = mysqli_store_result($link)) {
            mysqli_free_result($result);
        }
    } while (mysqli_next_result($link));
    
} else {
    echo "Error updating orders table: " . mysqli_error($link) . "<br>";
}

echo "<a href='src/pos.php'>Go to POS</a> | <a href='src/orders.php'>View Orders</a>";
?>