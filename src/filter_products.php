<?php
require_once '../partials/config.php';

// Get filter parameters
$category_filter = $_GET['category'] ?? '';
$sort_filter = $_GET['sort'] ?? '';
$search = $_GET['search'] ?? '';

// Build products query with filters
$where_conditions = ["p.is_active = 1"];
$params = [];

if($category_filter) {
    $where_conditions[] = "p.category_id = ?";
    $params[] = $category_filter;
}



if($search) {
    $where_conditions[] = "(p.name LIKE ? OR p.sku LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
}

$where_clause = implode(' AND ', $where_conditions);

// Set order clause
$order_clause = "ORDER BY p.id DESC";
if($sort_filter == 'name_asc') $order_clause = "ORDER BY p.name ASC";
elseif($sort_filter == 'name_desc') $order_clause = "ORDER BY p.name DESC";
elseif($sort_filter == 'price_asc') $order_clause = "ORDER BY p.price ASC";
elseif($sort_filter == 'price_desc') $order_clause = "ORDER BY p.price DESC";
elseif($sort_filter == 'recent') $order_clause = "ORDER BY p.created_at DESC";

$products_query = "SELECT p.*, c.name as category_name 
                  FROM products p 
                  LEFT JOIN categories c ON p.category_id = c.id 
                  WHERE $where_clause 
                  $order_clause";

if($params) {
    $stmt = mysqli_prepare($link, $products_query);
    $types = str_repeat('s', count($params));
    mysqli_stmt_bind_param($stmt, $types, ...$params);
    mysqli_stmt_execute($stmt);
    $products_result = mysqli_stmt_get_result($stmt);
} else {
    $products_result = mysqli_query($link, $products_query);
}

// Generate table rows
while($product = mysqli_fetch_assoc($products_result)): ?>
<tr>
    <td>
        <label class="checkboxs">
            <input type="checkbox">
            <span class="checkmarks"></span>
        </label>
    </td>
    <td><?php echo htmlspecialchars($product['sku']); ?></td>
    <td>
        <div class="d-flex align-items-center">
            <a href="javascript:void(0);" class="avatar avatar-md me-2">
                <img src="<?php echo !empty($product['image']) ? 'assets/img/products/' . htmlspecialchars($product['image']) : 'assets/img/products/images(1).jpg'; ?>" alt="product">
            </a>
            <a href="javascript:void(0);"><?php echo htmlspecialchars($product['name']); ?></a>
        </div>
    </td>
    <td><?php echo htmlspecialchars($product['category_name'] ?? 'N/A'); ?></td>
    <td>N/A</td>
    <td><?php echo number_format($product['price'], 2); ?></td>
    <td>Pc</td>
    <td><?php echo htmlspecialchars($product['stock_quantity']); ?></td>
    <td>
        <div class="d-flex align-items-center">
            <span>
                <a href="javascript:void(0);" class="avatar avatar-md me-2">
                    <img src="assets/img/users/default-user.jpg" alt="user">
                </a>
            </span>
            <a href="javascript:void(0);">Admin</a>
        </div>
    </td>
    <td class="action-table-data">
        <div class="edit-delete-action">
            <a class="me-2 edit-icon p-2" href="product-details.php?id=<?php echo $product['id']; ?>">
                <i data-feather="eye" class="feather-eye"></i>
            </a>
            <a class="me-2 p-2" href="edit-product.php?id=<?php echo $product['id']; ?>">
                <i data-feather="edit" class="feather-edit"></i>
            </a>
            <a class="p-2" href="javascript:void(0);" onclick="deleteProduct(<?php echo $product['id']; ?>)">
                <i data-feather="trash-2" class="feather-trash-2"></i>
            </a>
        </div>
    </td>
</tr>
<?php endwhile; ?>