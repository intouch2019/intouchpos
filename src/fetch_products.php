<?php
// Ensure there are no whitespaces or newlines before this PHP tag.
require_once __DIR__ . '/../auth/auth_middleware.php';
require_once __DIR__ . '/../partials/config.php';
requireLogin();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$categoryId = $_POST['categoryId'] ?? 'all';
$products = [];

if ($categoryId === 'all') {
    $sql = "SELECT * FROM products WHERE is_active = 1 ORDER BY name";
    $result = mysqli_query($link, $sql);
} else {
    $categoryId = (int)$categoryId;
    $sql = "SELECT * FROM products WHERE is_active = 1 AND category_id = ? ORDER BY name";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $categoryId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
}

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $products[] = $row;
    }
}

if (empty($products)) {
    echo "<div class='text-center text-muted'>No products found for this category.</div>";
    exit;
}

ob_start();
foreach ($products as $product):
    $price = isset($product['price']) && $product['price'] !== null ? (float)$product['price'] : 0.00;
    $stockQty = isset($product['stock_quantity']) && $product['stock_quantity'] !== null ? (int)$product['stock_quantity'] : 0;
    $minStock = isset($product['min_stock_level']) && $product['min_stock_level'] !== null ? (int)$product['min_stock_level'] : 0;
    $name = isset($product['name']) ? $product['name'] : 'Unnamed Product';
    $image = isset($product['image']) && $product['image'] !== '' ? $product['image'] : 'images(1).jpg';
?>
    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-3 product-item"
     data-category="<?php echo (int)$product['category_id']; ?>" 
     data-product-id="<?php echo (int)$product['id']; ?>"
     data-product-name="<?php echo htmlspecialchars($name, ENT_QUOTES); ?>" 
     data-product-price="<?php echo $price; ?>">
    <div class="product-info card mb-0">
        <a href="javascript:void(0);" class="pro-img add-to-cart-trigger">
            <img src="assets/img/products/<?php echo htmlspecialchars($image); ?>"
                 alt="<?php echo htmlspecialchars($name); ?>"
                 onerror="this.src='assets/img/products/images(1).png'">
            <span><i class="ti ti-circle-check-filled"></i></span>
        </a>
        <h6 class="product-name">
            <a href="javascript:void(0);"><?php echo htmlspecialchars($name); ?></a>
        </h6>
        <div class="d-flex align-items-center justify-content-between price">
            <p class="text-gray-9 mb-0">₹<?php echo number_format($price, 2); ?></p>
            <div class="qty-item m-0">
                <a href="javascript:void(0);" class="dec d-flex justify-content-center align-items-center quantity-trigger"
                   data-action="decrease"><i class="ti ti-minus"></i></a>
                <input type="text" class="form-control text-center product-qty" name="qty" value="1"
                       min="1" max="<?php echo $stockQty; ?>">
                <a href="javascript:void(0);" class="inc d-flex justify-content-center align-items-center quantity-trigger"
                   data-action="increase"><i class="ti ti-plus"></i></a>
            </div>
        </div>
        <?php if ($stockQty > 0 && $stockQty <= $minStock): ?>
            <div class="stock-warning">
                <small class="text-danger">Low Stock: <?php echo $stockQty; ?> left</small>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php
endforeach;
$html = ob_get_clean();
echo $html;
?>