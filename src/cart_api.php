<?php
require_once __DIR__ . '/../auth/auth_middleware.php';
require_once __DIR__ . '/../partials/config.php';

//header('Content-Type: application/json');
requireLogin();

$current_user = getCurrentUser();
$user_id = $current_user['id'];

$action = $_POST['action'] ?? $_GET['action'] ?? '';

switch ($action) {
    case 'add':
        addToCart($link, $user_id);
        break;
    case 'update':
        updateCart($link, $user_id);
        break;
    case 'remove':
        removeFromCart($link, $user_id);
        break;
    case 'clear':
        clearCart($link, $user_id);
        break;
    case 'get':
        getCart($link, $user_id);
        break;
    case 'add_exchange':
        addExchangeToCart($link, $user_id);
        break;
    case 'remove_exchange':
        removeExchangeFromCart($link, $user_id);
        break;
    default:
        echo json_encode(['success' => false, 'message' => 'Invalid action']);
}

function addToCart($link, $user_id) {
    $product_id = intval($_POST['product_id'] ?? 0);
    $quantity   = intval($_POST['quantity'] ?? 1);
    $batch_code = trim($_POST['batch'] ?? '');

    if ($product_id <= 0 || $quantity <= 0 || $batch_code === '') {
        echo json_encode(['success' => false, 'message' => 'Invalid product, quantity, or batch']);
        return;
    }

    // Validate batch exists & get stock
    $batch_sql = "SELECT id, stock_quantity, mrp FROM product_batches WHERE product_id = ? AND batch_code = ?";
    $stmt = mysqli_prepare($link, $batch_sql);
    mysqli_stmt_bind_param($stmt, "is", $product_id, $batch_code);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (!$batch = mysqli_fetch_assoc($result)) {
        echo json_encode(['success' => false, 'message' => 'Batch not found']);
        return;
    }

    $stock_quantity = (int)$batch['stock_quantity'];
    $mrp = $batch['mrp'];

    if ($stock_quantity <= 0) {
        echo json_encode(['success' => false, 'message' => 'Batch is out of stock']);
        return;
    }

    $check_sql = "SELECT id, quantity FROM cart WHERE user_id = ? AND product_id = ? AND batch_code = ?";
    $stmt = mysqli_prepare($link, $check_sql);
    mysqli_stmt_bind_param($stmt, "iis", $user_id, $product_id, $batch_code);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($existing = mysqli_fetch_assoc($result)) {
        // Update existing quantity
        $new_quantity = $existing['quantity'] + $quantity;

        $update_sql = "UPDATE cart SET quantity = ?, mrp = ? WHERE id = ?";
        $stmt = mysqli_prepare($link, $update_sql);
        mysqli_stmt_bind_param($stmt, "idi", $new_quantity, $mrp, $existing['id']);

        if (mysqli_stmt_execute($stmt)) {
            echo json_encode(['success' => true, 'message' => 'Cart updated']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update cart: ' . mysqli_stmt_error($stmt)]);
        }
    } else {
        // Insert new row
        echo $insert_sql = "INSERT INTO cart (user_id, product_id, quantity, batch_code, mrp) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($link, $insert_sql);
        mysqli_stmt_bind_param($stmt, "iiisd", $user_id, $product_id, $quantity, $batch_code, $mrp);

        if (mysqli_stmt_execute($stmt)) {
            echo json_encode(['success' => true, 'message' => 'Item added to cart']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to add item to cart: ' . mysqli_stmt_error($stmt)]);
        }
    }
}

function updateCart($link, $user_id) {
    $product_id = intval($_POST['product_id'] ?? 0);
    $quantity = intval($_POST['quantity'] ?? 0);
    $batch = $_POST['batch'] ?? '';
    
//    if ($product_id <= 0) {
//        echo json_encode(['success' => false, 'message' => 'Invalid product']);
    if ($product_id <= 0 || empty($batch)) {
        echo json_encode(['success' => false, 'message' => 'Invalid product or batch']);
        return;
    }
    
    if ($quantity <= 0) {
        removeFromCart($link, $user_id);
        return;
    }
    
    // Check stock
    $batch_sql = "SELECT pb.stock_quantity AS stock_quantity, pb.mrp FROM product_batches pb INNER JOIN products p ON p.id = pb.product_id WHERE p.id = ? AND pb.batch_code = ?  AND is_active = 1";
    $stmt = mysqli_prepare($link, $batch_sql);
    mysqli_stmt_bind_param($stmt, "is", $product_id, $batch);
//    $product_sql = "SELECT stock_quantity FROM products WHERE id = ? AND is_active = 1";
//    $stmt = mysqli_prepare($link, $product_sql);
//    mysqli_stmt_bind_param($stmt, "i", $product_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
//    if (!$batch_info = mysqli_fetch_assoc($result)) {
//        echo json_encode(['success' => false, 'message' => 'Product batch not found']);
    if (!$product = mysqli_fetch_assoc($result)) {
        echo json_encode(['success' => false, 'message' => 'Product not found']);
        return;
    }
    
//    if ($quantity > $batch_info['stock_quantity']) {
//        echo json_encode(['success' => false, 'message' => 'Not enough stock in this batch.']);
    if ($quantity > $product['stock_quantity']) {
        echo json_encode(['success' => false, 'message' => 'Not enough stock available']);
        return;
    }
    
    $update_sql = "UPDATE cart SET quantity = ?, mrp = ?, updated_at = CURRENT_TIMESTAMP WHERE user_id = ? AND product_id = ? AND batch_code = ?";
    $stmt = mysqli_prepare($link, $update_sql);
    mysqli_stmt_bind_param($stmt, "idiis", $quantity, $product['mrp'], $user_id, $product_id, $batch);

    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(['success' => true, 'message' => 'Cart updated']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update cart']);
    }
}

function removeFromCart($link, $user_id) {
    $product_id = intval($_POST['product_id'] ?? 0);
    $batch = mysqli_real_escape_string($link, $_POST['batch'] ?? '');
    
//    if ($product_id <= 0 || empty($batch)) {
//        echo json_encode(['success' => false, 'message' => 'Invalid product or batch']);
    if ($product_id <= 0) {
        echo json_encode(['success' => false, 'message' => 'Invalid product']);
        return;
    }
    
//    $delete_sql = "DELETE FROM cart WHERE user_id = ? AND product_id = ? AND batch = ?";
    $delete_sql = "DELETE FROM cart WHERE user_id = ? AND product_id = ?";
    $stmt = mysqli_prepare($link, $delete_sql);
//    mysqli_stmt_bind_param($stmt, "iis", $user_id, $product_id, $batch);
    mysqli_stmt_bind_param($stmt, "ii", $user_id, $product_id);
    
    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(['success' => true, 'message' => 'Item removed from cart']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to remove item']);
    }
}

function clearCart($link, $user_id) {
    $delete_sql = "DELETE FROM cart WHERE user_id = ?";
    $stmt = mysqli_prepare($link, $delete_sql);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    
    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(['success' => true, 'message' => 'Cart cleared']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to clear cart']);
    }
}

function getCart($link, $user_id) {
    // Get regular products
//    $sql = "SELECT c.*, p.name, p.price, p.image, p.stock_quantity, c.batch
    $sql = "SELECT c.*, p.name, p.price, p.image, p.stock_quantity
            FROM cart c 
            JOIN products p ON c.product_id = p.id 
            WHERE c.user_id = ? AND c.exchange_name IS NULL AND p.is_active = 1 
            ORDER BY c.created_at ASC";
    
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    $cart_items = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $cart_items[] = [
            'id' => $row['product_id'],
            'name' => $row['name'],
            'batch_code' => $row['batch_code'],
            'price' => floatval($row['mrp']),
//            'price' => floatval($row['price']),
            'quantity' => intval($row['quantity']),
//            'mrp' => $row['mrp'],
            'image' => $row['image'],
            'stock_quantity' => intval($row['stock_quantity'])
//            'batch' => $row['batch']
        ];
    }
    
    // Get exchange items (negative product_ids)
    $exchange_sql = "SELECT * FROM cart WHERE user_id = ? AND exchange_name IS NOT NULL ORDER BY created_at ASC";    
    $stmt = mysqli_prepare($link, $exchange_sql);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    while ($row = mysqli_fetch_assoc($result)) {
        $cart_items[] = [
            'id' => $row['product_id'], // This will be negative for exchange items
            'name' => $row['exchange_name'],
            'batch_code' => $row['batch_code'],
//            'price' => floatval($row['mrp']),
            'price' => floatval($row['exchange_price']),
            'quantity' => intval($row['quantity']),
//            'mrp' => $row['mrp'],
            'image' => 'exchange.png',
            'stock_quantity' => 999,
            'is_exchange' => true
        ];
    }
    
    echo json_encode(['success' => true, 'cart' => $cart_items]);
}

function addExchangeToCart($link, $user_id) {
    $product_id = intval($_POST['product_id'] ?? 0);
    $quantity = intval($_POST['quantity'] ?? 1);
    $price = floatval($_POST['price'] ?? 0);
    $batch = $_POST['batch'] ?? '';
    $name = $_POST['name'] ?? '';
//    print_r($batch);
    if (empty($name)) {
        echo json_encode(['success' => false, 'message' => 'Invalid exchange item']);
        return;
    }
    
    // Use negative product_id for exchange items to avoid unique constraint conflicts
    $exchange_product_id = -abs($product_id);
    
    // Check if exchange item with same negative product_id already exists
    $check_sql = "SELECT id, quantity FROM cart WHERE user_id = ? AND product_id = ? AND batch_code = ? AND exchange_name IS NOT NULL";
    $stmt = mysqli_prepare($link, $check_sql);
    mysqli_stmt_bind_param($stmt, "iis", $user_id, $exchange_product_id, $batch);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if ($existing = mysqli_fetch_assoc($result)) {
        // Update existing exchange item
        $new_quantity = $existing['quantity'] + $quantity;
        $update_sql = "UPDATE cart SET quantity = ?, exchange_price = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ?";
        $stmt = mysqli_prepare($link, $update_sql);
        mysqli_stmt_bind_param($stmt, "idi", $new_quantity, $price, $existing['id']);
        
        if (mysqli_stmt_execute($stmt)) {
            echo json_encode(['success' => true, 'message' => 'Exchange item updated']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update exchange item']);
        }
    } else {
        // Insert new exchange item with negative product_id
        $insert_sql = "INSERT INTO cart (user_id, product_id, quantity, exchange_name, exchange_price, batch_code) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($link, $insert_sql);
        mysqli_stmt_bind_param($stmt, "iiisds", $user_id, $exchange_product_id, $quantity, $name, $price, $batch);
        
        if (mysqli_stmt_execute($stmt)) {
            echo json_encode(['success' => true, 'message' => 'Exchange item added']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to add exchange item: ' . mysqli_error($link)]);
        }
    }
}

function removeExchangeFromCart($link, $user_id) {
    $product_id = intval($_POST['product_id'] ?? 0);
    $batch = $_POST['batch'] ?? "";

    if ($product_id >= 0) {
        echo json_encode(['success' => false, 'message' => 'Invalid exchange item ID']);
        return;
    }
    if ($batch == "") {
        echo json_encode(['success' => false, 'message' => 'Invalid exchange item batch']);
        return;
    }
    
    $delete_sql = "DELETE FROM cart WHERE user_id = ? AND product_id = ? AND batch_code = ?";
    $stmt = mysqli_prepare($link, $delete_sql);
    mysqli_stmt_bind_param($stmt, "iis", $user_id, $product_id, $batch);
    
    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(['success' => true, 'message' => 'Exchange item removed']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to remove exchange item']);
    }
}
?>