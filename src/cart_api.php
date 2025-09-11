<?php
require_once __DIR__ . '/../auth/auth_middleware.php';
require_once __DIR__ . '/../partials/config.php';

header('Content-Type: application/json');
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
    $quantity = intval($_POST['quantity'] ?? 1);
    
    if ($product_id <= 0 || $quantity <= 0) {
        echo json_encode(['success' => false, 'message' => 'Invalid product or quantity']);
        return;
    }
    
    // Check if product exists and get stock
    $product_sql = "SELECT stock_quantity FROM products WHERE id = ? AND is_active = 1";
    $stmt = mysqli_prepare($link, $product_sql);
    mysqli_stmt_bind_param($stmt, "i", $product_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if (!$product = mysqli_fetch_assoc($result)) {
        echo json_encode(['success' => false, 'message' => 'Product not found']);
        return;
    }
    
    // Check if product has stock
    if ($product['stock_quantity'] <= 0) {
        echo json_encode(['success' => false, 'message' => 'Product is out of stock']);
        return;
    }
    
    // Check if item already exists in cart
    $check_sql = "SELECT quantity FROM cart WHERE user_id = ? AND product_id = ?";
    $stmt = mysqli_prepare($link, $check_sql);
    mysqli_stmt_bind_param($stmt, "ii", $user_id, $product_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if ($existing = mysqli_fetch_assoc($result)) {
        // Update existing item
        $new_quantity = $existing['quantity'] + $quantity;
        if ($new_quantity > $product['stock_quantity']) {
            echo json_encode(['success' => false, 'message' => 'Not enough stock available']);
            return;
        }
        
        $update_sql = "UPDATE cart SET quantity = ?, updated_at = CURRENT_TIMESTAMP WHERE user_id = ? AND product_id = ?";
        $stmt = mysqli_prepare($link, $update_sql);
        mysqli_stmt_bind_param($stmt, "iii", $new_quantity, $user_id, $product_id);
        
        if (mysqli_stmt_execute($stmt)) {
            echo json_encode(['success' => true, 'message' => 'Cart updated']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update cart']);
        }
    } else {
        // Add new item
        if ($product['stock_quantity'] <= 0) {
            echo json_encode(['success' => false, 'message' => 'Product is out of stock']);
            return;
        }
        
        if ($quantity > $product['stock_quantity']) {
            echo json_encode(['success' => false, 'message' => 'Not enough stock available']);
            return;
        }
        
        $insert_sql = "INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($link, $insert_sql);
        mysqli_stmt_bind_param($stmt, "iii", $user_id, $product_id, $quantity);
        
        if (mysqli_stmt_execute($stmt)) {
            echo json_encode(['success' => true, 'message' => 'Item added to cart']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to add item to cart']);
        }
    }
}

function updateCart($link, $user_id) {
    $product_id = intval($_POST['product_id'] ?? 0);
    $quantity = intval($_POST['quantity'] ?? 0);
    
    if ($product_id <= 0) {
        echo json_encode(['success' => false, 'message' => 'Invalid product']);
        return;
    }
    
    if ($quantity <= 0) {
        removeFromCart($link, $user_id);
        return;
    }
    
    // Check stock
    $product_sql = "SELECT stock_quantity FROM products WHERE id = ? AND is_active = 1";
    $stmt = mysqli_prepare($link, $product_sql);
    mysqli_stmt_bind_param($stmt, "i", $product_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if (!$product = mysqli_fetch_assoc($result)) {
        echo json_encode(['success' => false, 'message' => 'Product not found']);
        return;
    }
    
    if ($quantity > $product['stock_quantity']) {
        echo json_encode(['success' => false, 'message' => 'Not enough stock available']);
        return;
    }
    
    $update_sql = "UPDATE cart SET quantity = ?, updated_at = CURRENT_TIMESTAMP WHERE user_id = ? AND product_id = ?";
    $stmt = mysqli_prepare($link, $update_sql);
    mysqli_stmt_bind_param($stmt, "iii", $quantity, $user_id, $product_id);
    
    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(['success' => true, 'message' => 'Cart updated']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update cart']);
    }
}

function removeFromCart($link, $user_id) {
    $product_id = intval($_POST['product_id'] ?? 0);
    
    if ($product_id <= 0) {
        echo json_encode(['success' => false, 'message' => 'Invalid product']);
        return;
    }
    
    $delete_sql = "DELETE FROM cart WHERE user_id = ? AND product_id = ?";
    $stmt = mysqli_prepare($link, $delete_sql);
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
            'price' => floatval($row['price']),
            'quantity' => intval($row['quantity']),
            'image' => $row['image'],
            'stock_quantity' => intval($row['stock_quantity'])
        ];
    }
    
    // Get exchange items
    $exchange_sql = "SELECT * FROM cart WHERE user_id = ? AND exchange_name IS NOT NULL ORDER BY created_at ASC";
    $stmt = mysqli_prepare($link, $exchange_sql);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    while ($row = mysqli_fetch_assoc($result)) {
        $cart_items[] = [
            'id' => $row['product_id'],
            'name' => $row['exchange_name'],
            'price' => floatval($row['exchange_price']),
            'quantity' => intval($row['quantity']),
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
    $name = $_POST['name'] ?? '';
    
    if (empty($name)) {
        echo json_encode(['success' => false, 'message' => 'Invalid exchange item']);
        return;
    }
    
    // For exchange discount, use product_id 0, for exchange products use actual product_id
    $exchange_product_id = $product_id;
    
    $insert_sql = "INSERT INTO cart (user_id, product_id, quantity, exchange_name, exchange_price) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($link, $insert_sql);
    mysqli_stmt_bind_param($stmt, "iiisd", $user_id, $exchange_product_id, $quantity, $name, $price);
    
    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(['success' => true, 'message' => 'Exchange item added']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to add exchange item: ' . mysqli_error($link)]);
    }
}

function removeExchangeFromCart($link, $user_id) {
    $product_id = intval($_POST['product_id'] ?? 0);
    
    if ($product_id >= 0) {
        echo json_encode(['success' => false, 'message' => 'Invalid exchange item ID']);
        return;
    }
    
    $delete_sql = "DELETE FROM cart WHERE user_id = ? AND product_id = ?";
    $stmt = mysqli_prepare($link, $delete_sql);
    mysqli_stmt_bind_param($stmt, "ii", $user_id, $product_id);
    
    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(['success' => true, 'message' => 'Exchange item removed']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to remove exchange item']);
    }
}
?>