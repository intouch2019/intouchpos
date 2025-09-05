<?php 
ob_start();
require_once '../partials/config.php';

// Get filter parameters
$category_filter = $_GET['category'] ?? '';
$sort_filter = $_GET['sort'] ?? '';
$search = $_GET['search'] ?? '';

// Fetch categories for dropdown
$categories = [];
$categories_query = "SELECT * FROM categories WHERE is_active = 1 ORDER BY name ASC";
$categories_result = mysqli_query($link, $categories_query);
if($categories_result) {
    while($row = mysqli_fetch_assoc($categories_result)) {
        $categories[] = $row;
    }
}

// Fetch distinct created_by values for dropdown
$created_by_list = [];
$created_by_query = "SELECT DISTINCT created_by FROM products WHERE created_by IS NOT NULL AND created_by != '' ORDER BY created_by ASC";
$created_by_result = mysqli_query($link, $created_by_query);
if($created_by_result) {
    while($row = mysqli_fetch_assoc($created_by_result)) {
        $created_by_list[] = $row['created_by'];
    }
}

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

if(!$products_result) {
    die("Error: " . mysqli_error($link));
}
?>

    <!-- ========================
        Start Page Content
    ========================= -->

    <div class="page-wrapper">

        <!-- Start Content -->
        <div class="content">
            <div class="page-header">
                <div class="add-item d-flex">
                    <div class="page-title">
                        <h4 class="fw-bold">Products</h4>
                        <h6>Manage your products</h6>
                    </div>
                </div>
                <ul class="table-top-head">
                    <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="Pdf"><img src="assets/img/icons/pdf.svg" alt="img"></a>
                    </li>
                    <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="Excel"><img src="assets/img/icons/excel.svg" alt="img"></a>
                    </li>
                    <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh"><i class="ti ti-refresh"></i></a>
                    </li>
                    <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i class="ti ti-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="page-btn">
                    <a href="add-product.php" class="btn btn-primary"><i class="ti ti-circle-plus me-1"></i>Add Product</a>
                </div>	
                <div class="page-btn import">
                    <a href="#" class="btn btn-primary color" data-bs-toggle="modal" data-bs-target="#view-notes"><i
                        data-feather="download" class="me-2"></i>Import Product</a>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
                    <div class="search-set">
                        <div class="search-input">
<!--                            <input type="text" placeholder="Search products..." class="form-control" id="searchInput" value="<?php echo htmlspecialchars($search); ?>">
                            <span class="btn-searchset" onclick="searchProducts()"><i class="ti ti-search fs-14 feather-search"></i></span>-->
                        </div>
                    </div>
                    <div class="d-flex table-dropdown my-xl-auto right-content align-items-center flex-wrap row-gap-3">

<!--                        <div class="dropdown me-2">
                            <a href="javascript:void(0);" class="dropdown-toggle btn btn-white btn-md d-inline-flex align-items-center" data-bs-toggle="dropdown" id="createdByDropdownBtn">
                                All Created By
                            </a>
                            <ul class="dropdown-menu  dropdown-menu-end p-3">
                                <li>
                                    <a href="javascript:void(0);" onclick="filterByCreatedBy('')" class="dropdown-item rounded-1">All Created By</a>
                                </li>
                                <?php foreach($created_by_list as $creator): ?>
                                <li>
                                    <a href="javascript:void(0);" onclick="filterByCreatedBy('<?php echo htmlspecialchars($creator); ?>')" class="dropdown-item rounded-1"><?php echo htmlspecialchars($creator); ?></a>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>-->
                        <div class="dropdown me-2">
                            <a href="javascript:void(0);" class="dropdown-toggle btn btn-white btn-md d-inline-flex align-items-center" data-bs-toggle="dropdown" id="categoryDropdownBtn">
                                All Categories
                            </a>
                            <ul class="dropdown-menu  dropdown-menu-end p-3">
                                <li>
                                    <a href="javascript:void(0);" onclick="filterByCategory('')" class="dropdown-item rounded-1">All Categories</a>
                                </li>
                                <?php foreach($categories as $category): ?>
                                <li>
                                    <a href="javascript:void(0);" onclick="filterByCategory('<?php echo $category['id']; ?>')" class="dropdown-item rounded-1"><?php echo htmlspecialchars($category['name']); ?></a>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <!-- <div class="dropdown me-2">
                            <a href="javascript:void(0);" class="dropdown-toggle btn btn-white btn-md d-inline-flex align-items-center" data-bs-toggle="dropdown">
                                Brand
                            </a>
                            <ul class="dropdown-menu  dropdown-menu-end p-3">
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">Lenovo</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">Beats</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">Nike</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">Apple</a>
                                </li>
                            </ul>
                        </div> -->
                        <div class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle btn btn-white btn-md d-inline-flex align-items-center" data-bs-toggle="dropdown">
                                Sort By : Last 7 Days
                            </a>
                            <ul class="dropdown-menu  dropdown-menu-end p-3">
                                <li>
                                    <a href="javascript:void(0);" onclick="sortProducts('recent')" class="dropdown-item rounded-1">Recently Added</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" onclick="sortProducts('name_asc')" class="dropdown-item rounded-1">Name A-Z</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" onclick="sortProducts('name_desc')" class="dropdown-item rounded-1">Name Z-A</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" onclick="sortProducts('price_asc')" class="dropdown-item rounded-1">Price Low-High</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" onclick="sortProducts('price_desc')" class="dropdown-item rounded-1">Price High-Low</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead class="thead-light">
                                <tr>
                                    <th class="no-sort">
                                        <label class="checkboxs">
                                            <input type="checkbox" id="select-all">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </th>
                                    <th>SKU</th>
                                    <th>Product</th>
                                    <th>Category</th>
                                    <th>Brand</th>
                                    <th>Price</th>
                                    <th>Unit</th>
                                    <th>Qty</th>
                                    <!--<th>Created By</th>-->
                                    <th class="no-sort"></th>
                                </tr>
                            </thead>
                            <tbody id="productsTableBody">
                                <?php while($product = mysqli_fetch_assoc($products_result)): ?>
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
<!--                                    <td>
                                        <div class="d-flex align-items-center">-->
<!--                                            <span>
                                                <a href="javascript:void(0);" class="avatar avatar-md me-2">
                                                    <img src="assets/img/users/default-user.jpg" alt="user">
                                                </a>
                                            </span>-->
<!--                                            <a href="javascript:void(0);">Admin</a>
                                        </div>
                                    </td>-->
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
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /product list -->
        </div>
        <!-- End Content -->
    
        <?php require_once '../partials/footer.php'; ?>

    </div>

    <!-- ========================
        End Page Content
    ========================= -->

<script>
function deleteProduct(productId) {
    if(confirm('Are you sure you want to delete this product?')) {
        window.location.href = 'delete-product.php?id=' + productId;
    }
}

let currentFilters = {
    category: '',
    sort: '',
    search: ''
};

function loadProducts() {
    const params = new URLSearchParams(currentFilters);
    
    fetch('filter_products.php?' + params)
        .then(response => response.text())
        .then(html => {
            document.getElementById('productsTableBody').innerHTML = html;
            // Re-initialize Feather icons
            if(typeof feather !== 'undefined') {
                feather.replace();
            }
        })
        .catch(error => console.error('Error:', error));
}

function filterByCategory(categoryId) {
    currentFilters.category = categoryId;
    // Update button text
    const btn = document.getElementById('categoryDropdownBtn');
    if(categoryId === '') {
        btn.textContent = 'All Categories';
    } else {
        const selectedItem = event.target.textContent;
        btn.textContent = selectedItem;
    }
    loadProducts();
}





function sortProducts(sortType) {
    currentFilters.sort = sortType;
    loadProducts();
}

function searchProducts() {
    currentFilters.search = document.getElementById('searchInput').value;
    loadProducts();
}

document.getElementById('searchInput').addEventListener('keypress', function(e) {
    if(e.key === 'Enter') {
        searchProducts();
    }
});

document.getElementById('searchInput').addEventListener('input', function() {
    clearTimeout(this.searchTimeout);
    this.searchTimeout = setTimeout(() => {
        searchProducts();
    }, 300);
});
</script>

<?php
$content = ob_get_clean();

require_once '../partials/main.php'; ?>      