<?php
require_once __DIR__ . '/partials/config.php';

// Read and execute the cart table creation SQL
$sql_file = __DIR__ . '/create_cart_table.sql';
$sql_content = file_get_contents($sql_file);

// Split SQL statements by semicolon
$statements = array_filter(array_map('trim', explode(';', $sql_content)));

$success = true;
$messages = [];

foreach ($statements as $statement) {
    if (empty($statement) || strpos($statement, '--') === 0) {
        continue; // Skip empty statements and comments
    }
    
    if (mysqli_query($link, $statement)) {
        $messages[] = "✓ Executed: " . substr($statement, 0, 50) . "...";
    } else {
        $success = false;
        $messages[] = "✗ Error: " . mysqli_error($link) . " in statement: " . substr($statement, 0, 50) . "...";
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Cart Setup - DreamsPOS</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .success { color: green; }
        .error { color: red; }
        .message { margin: 10px 0; padding: 10px; border-radius: 5px; }
        .success-msg { background: #d4edda; border: 1px solid #c3e6cb; }
        .error-msg { background: #f8d7da; border: 1px solid #f5c6cb; }
    </style>
</head>
<body>
    <h1>Cart Table Setup</h1>
    
    <?php if ($success): ?>
        <div class="message success-msg">
            <h2 class="success">✓ Cart table setup completed successfully!</h2>
            <p>The cart table has been created and is ready to use.</p>
        </div>
    <?php else: ?>
        <div class="message error-msg">
            <h2 class="error">✗ Cart table setup failed!</h2>
            <p>There were errors during the setup process.</p>
        </div>
    <?php endif; ?>
    
    <h3>Execution Log:</h3>
    <ul>
        <?php foreach ($messages as $message): ?>
            <li class="<?php echo strpos($message, '✓') === 0 ? 'success' : 'error'; ?>">
                <?php echo htmlspecialchars($message); ?>
            </li>
        <?php endforeach; ?>
    </ul>
    
    <p><a href="src/pos.php">← Back to POS</a></p>
</body>
</html>