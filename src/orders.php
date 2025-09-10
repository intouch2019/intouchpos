<?php 
ob_start();
require_once __DIR__ . '/../auth/auth_middleware.php';
require_once __DIR__ . '/../partials/config.php';
requireLogin();

// Get current user
$current_user = getCurrentUser();

// Get filter parameters
$product_filter = $_GET['product'] ?? '';
$user_filter = $_GET['user'] ?? '';
$payment_filter = $_GET['payment'] ?? '';
$date_filter = $_GET['date'] ?? '';
$search = $_GET['search'] ?? '';

// Build WHERE clause
$where_conditions = [];
$params = [];
$types = '';

$where_conditions[] = " hold_reference is NULL ";

if (!empty($product_filter)) {
    $where_conditions[] = "p.name LIKE ?";
    $params[] = "%$product_filter%";
    $types .= 's';
}

if (!empty($user_filter)) {
    $where_conditions[] = "u.full_name LIKE ?";
    $params[] = "%$user_filter%";
    $types .= 's';
}

if (!empty($payment_filter)) {
    $where_conditions[] = "o.payment_method = ?";
    $params[] = $payment_filter;
    $types .= 's';
}

if (!empty($date_filter)) {
    switch($date_filter) {
        case 'today':
            $where_conditions[] = "DATE(o.created_at) = CURDATE()";
            break;
        case 'last_7_days':
            $where_conditions[] = "o.created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY)";
            break;
        case 'last_month':
            $where_conditions[] = "o.created_at >= DATE_SUB(NOW(), INTERVAL 1 MONTH)";
            break;
    }
}

if (!empty($search)) {
    $where_conditions[] = "(o.order_number LIKE ? OR c.name LIKE ? OR u.full_name LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
    $params[] = "%$search%";
    $types .= 'sss';
}

// Get orders with filters
$orders = [];
$sql = "SELECT DISTINCT o.*, COALESCE(c.name, 'Walk in Customer') AS customer_name, 
    c.phone AS customer_phone, 
    u.full_name AS created_by_name
FROM orders o
LEFT JOIN customers c ON o.customer_id = c.id
LEFT JOIN users u ON o.user_id = u.id
LEFT JOIN order_items oi ON o.id = oi.order_id
LEFT JOIN products p ON oi.product_id = p.id";

if (!empty($where_conditions)) {
    $sql .= " WHERE " . implode(' AND ', $where_conditions);
}

$sql .= " ORDER BY o.created_at DESC";

if (!empty($params)) {
    $stmt = mysqli_prepare($link, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, $types, ...$params);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        while ($row = mysqli_fetch_assoc($result)) {
            $orders[] = $row;
        }
        mysqli_stmt_close($stmt);
    }
} else {
    $result = mysqli_query($link, $sql);
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $orders[] = $row;
        }
    }
}

// Get filter options
$products = mysqli_query($link, "SELECT DISTINCT p.name FROM products p JOIN order_items oi ON p.id = oi.product_id WHERE p.is_active = 1 ORDER BY p.name");
$users = mysqli_query($link, "SELECT DISTINCT full_name FROM users ORDER BY full_name");
$payment_methods = ['cash', 'card', 'mobile_money'];

// Get all orders with product names for JavaScript filtering
$all_orders_sql = "SELECT DISTINCT o.*, COALESCE(c.name, 'Walk in Customer') AS customer_name, 
    c.phone AS customer_phone, 
    u.full_name AS created_by_name,
    GROUP_CONCAT(DISTINCT p.name SEPARATOR '|') AS order_products
FROM orders o
LEFT JOIN customers c ON o.customer_id = c.id
LEFT JOIN users u ON o.user_id = u.id
LEFT JOIN order_items oi ON o.id = oi.order_id
LEFT JOIN products p ON oi.product_id = p.id
GROUP BY o.id
ORDER BY o.created_at DESC";
$all_orders_result = mysqli_query($link, $all_orders_sql);
$all_orders = [];
if ($all_orders_result) {
    while ($row = mysqli_fetch_assoc($all_orders_result)) {
        $all_orders[] = $row;
    }
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
                        <h4 class="fw-bold">Order List</h4>
                        <h6>Manage your orders</h6>
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
            </div>
            
            <!-- /product list -->
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
                    <div class="search-set">
                        <div class="search-input">
<!--                            <input type="text" id="search-input" placeholder="Search orders..." value="<?= htmlspecialchars($search) ?>">
                            <span class="btn-searchset" onclick="performSearch()"><i class="ti ti-search fs-14 feather-search"></i></span>-->
                        </div>
                    </div>
                    <div class="d-flex table-dropdown my-xl-auto right-content align-items-center flex-wrap row-gap-3">
                        <div class="dropdown me-2">
                            <a href="javascript:void(0);" class="dropdown-toggle btn btn-white btn-md d-inline-flex align-items-center" data-bs-toggle="dropdown" id="product-filter-btn">
                                Product
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                <li><a href="javascript:void(0);" class="dropdown-item rounded-1" onclick="applyFilter('product', '')">All Products</a></li>
                                <?php while($product = mysqli_fetch_assoc($products)): ?>
                                <li><a href="javascript:void(0);" class="dropdown-item rounded-1" onclick="applyFilter('product', '<?= htmlspecialchars($product['name']) ?>')"><?= htmlspecialchars($product['name']) ?></a></li>
                                <?php endwhile; ?>
                            </ul>
                        </div>
                        <div class="dropdown me-2">
                            <a href="javascript:void(0);" class="dropdown-toggle btn btn-white btn-md d-inline-flex align-items-center" data-bs-toggle="dropdown" id="user-filter-btn">
                                Created By
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                <li><a href="javascript:void(0);" class="dropdown-item rounded-1" onclick="applyFilter('user', '')">All Users</a></li>
                                <?php while($user = mysqli_fetch_assoc($users)): ?>
                                <li><a href="javascript:void(0);" class="dropdown-item rounded-1" onclick="applyFilter('user', '<?= htmlspecialchars($user['full_name']) ?>')"><?= htmlspecialchars($user['full_name']) ?></a></li>
                                <?php endwhile; ?>
                            </ul>
                        </div>
                        <div class="dropdown me-2">
                            <a href="javascript:void(0);" class="dropdown-toggle btn btn-white btn-md d-inline-flex align-items-center" data-bs-toggle="dropdown" id="payment-filter-btn">
                                Payment Method
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                <li><a href="javascript:void(0);" class="dropdown-item rounded-1" onclick="applyFilter('payment', '')">All Methods</a></li>
                                <?php foreach($payment_methods as $method): ?>
                                <li><a href="javascript:void(0);" class="dropdown-item rounded-1" onclick="applyFilter('payment', '<?= $method ?>')"><?= ucfirst($method) ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>

                        <div class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle btn btn-white btn-md d-inline-flex align-items-center" data-bs-toggle="dropdown" id="date-filter-btn">
                                All Time
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                <li><a href="javascript:void(0);" class="dropdown-item rounded-1" onclick="applyFilter('date', '')">All Time</a></li>
                                <li><a href="javascript:void(0);" class="dropdown-item rounded-1" onclick="applyFilter('date', 'today')">Today</a></li>
                                <li><a href="javascript:void(0);" class="dropdown-item rounded-1" onclick="applyFilter('date', 'last_7_days')">Last 7 Days</a></li>
                                <li><a href="javascript:void(0);" class="dropdown-item rounded-1" onclick="applyFilter('date', 'last_month')">Last Month</a></li>
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
                                    <th>Order ID </th>
                                    <th>Customer</th>
                                    <th>Payment Type</th>
                                    <th>Amount</th>
                                    <th>Date & Time</th>
                                    <th>Status</th>
                                    <th class="no-sort"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($orders as $order){ ?> 
<tr>
    <td>
        <label class="checkboxs">
            <input type="checkbox">
            <span class="checkmarks"></span>
        </label>
    </td>
    <td><?= $order['order_number']; ?></td>
    <td><?= $order['customer_name']; ?></td>
    <td><?= $order['payment_method']; ?></td>
    <td><?= $order['total_amount']; ?></td>
    <td><?= $order['created_at']; ?></td>
    <td>
        <span class="bg-success fs-10 text-white p-1 rounded">
            <i class="ti ti-point-filled me-1"></i><?= $order['payment_status']; ?>
        </span>
    </td>
    <td class="d-flex">
        <div class="edit-delete-action d-flex align-items-center">
            <a class="me-2 edit-icon p-2 border d-flex align-items-center rounded" href="invoice-details.php?order_id=<?= $order['id']; ?>">
                <i data-feather="eye" class="action-eye"></i>
            </a>
            <a class="me-2 p-2 d-flex align-items-center border rounded" href="javascript:void(0);" onclick="viewOrderProducts(<?= $order['id']; ?>)" data-bs-toggle="modal" data-bs-target="#order-products">
                <i data-feather="edit" class="feather-edit"></i>
            </a>
            <a class="p-2 d-flex align-items-center border rounded" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete">
                <i data-feather="trash-2" class="feather-trash-2"></i>
            </a>
        </div>
    </td>
</tr>
<?php } ?>

<!--                                <tr>
                                    <td>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </td>
                                    <td>5573158</td>
                                    <td>
                                        <div class="userimgname">
                                            <span class="avatar avatar-md me-2">
                                            <a href="javascript:void(0);" >
                                                <img src="assets/img/users/user-13.jpg" alt="product">
                                            </a>
                                            </span>
                                                <a href="javascript:void(0);">Francis Chang</a>
                                        </div>
                                    </td>
                                    
                                    <td>PayPal</td>
                                    <td>$160</td>
                                    <td>10 Dec 2024, 10:30 AM</td>
                                    <td><span class="bg-cyan fs-10 text-white p-1 rounded"><i class="ti ti-point-filled me-1"></i>Pending</span></td>
                                    <td class="d-flex">
                                        <div class="edit-delete-action d-flex align-items-center">
                                            <a class="me-2 edit-icon p-2 border d-flex align-items-center rounded" href="invoice-details.php">
                                                <i data-feather="eye" class="action-eye"></i>
                                            </a>
                                            <a class="me-2 p-2 d-flex align-items-center border rounded" href="edit-product.php">
                                                <i data-feather="edit" class="feather-edit"></i>
                                            </a>
                                            <a class="p-2 d-flex align-items-center border rounded" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete">
                                                <i data-feather="trash-2" class="feather-trash-2"></i>
                                            </a>
                                        </div>
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </td>
                                    <td>4837512</td>
                                    <td>
                                        <div class="userimgname">
                                            <span class="avatar avatar-md me-2">
                                            <a href="javascript:void(0);" >
                                                <img src="assets/img/users/user-11.jpg" alt="product">
                                            </a>
                                        </span>
                                                <a href="javascript:void(0);">Antonio Engle</a>
                                        </div>
                                    </td>
                                    
                                    <td>Debit Card</td>
                                    <td>$110</td>
                                    <td>27 Nov 2024, 03:15 PM</td>
                                    <td><span class="bg-success fs-10 text-white p-1 rounded"><i class="ti ti-point-filled me-1"></i>Complete</span></td>
                                    <td class="d-flex">
                                        <div class="edit-delete-action d-flex align-items-center">
                                            <a class="me-2 edit-icon p-2 border d-flex align-items-center rounded" href="invoice-details.php">
                                                <i data-feather="eye" class="action-eye"></i>
                                            </a>
                                            <a class="me-2 p-2 d-flex align-items-center border rounded" href="edit-product.php">
                                                <i data-feather="edit" class="feather-edit"></i>
                                            </a>
                                            <a class="p-2 d-flex align-items-center border rounded" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete">
                                                <i data-feather="trash-2" class="feather-trash-2"></i>
                                            </a>
                                        </div>
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </td>
                                    <td>4628754</td>
                                    <td>
                                        <div class="userimgname">
                                            <span class="avatar avatar-md me-2">
                                            <a href="javascript:void(0);" >
                                                <img src="assets/img/users/user-32.jpg" alt="product">
                                            </a>
                                        </span>
                                                <a href="javascript:void(0);">Leo Kelly</a>
                                        </div>
                                    </td>
                                    
                                    <td>PayPal</td>
                                    <td>$120</td>
                                    <td>18 Nov 2024, 09:00 AM</td>
                                    <td><span class="bg-success fs-10 text-white p-1 rounded"><i class="ti ti-point-filled me-1"></i>Complete</span></td>
                                    <td class="d-flex">
                                        <div class="edit-delete-action d-flex align-items-center">
                                            <a class="me-2 edit-icon p-2 border d-flex align-items-center rounded" href="invoice-details.php">
                                                <i data-feather="eye" class="action-eye"></i>
                                            </a>
                                            <a class="me-2 p-2 d-flex align-items-center border rounded" href="edit-product.php">
                                                <i data-feather="edit" class="feather-edit"></i>
                                            </a>
                                            <a class="p-2 d-flex align-items-center border rounded" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete">
                                                <i data-feather="trash-2" class="feather-trash-2"></i>
                                            </a>
                                        </div>
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </td>
                                    <td>4279685</td>
                                    <td>
                                        <div class="userimgname">
                                            <span class="avatar avatar-md me-2">
                                            <a href="javascript:void(0);" >
                                                <img src="assets/img/users/user-02.jpg" alt="product">
                                            </a>
                                        </span>
                                                <a href="javascript:void(0);">Annette Walker</a>
                                        </div>
                                    </td>
                                    
                                    <td>PayPal</td>
                                    <td>$80</td>
                                    <td>06 Nov 2024, 10:45 AM</td>
                                    <td><span class="bg-purple fs-10 text-white p-1 rounded"><i class="ti ti-point-filled me-1"></i>Proccessing</span></td>
                                    <td class="d-flex">
                                        <div class="edit-delete-action d-flex align-items-center">
                                            <a class="me-2 edit-icon p-2 border d-flex align-items-center rounded" href="invoice-details.php">
                                                <i data-feather="eye" class="action-eye"></i>
                                            </a>
                                            <a class="me-2 p-2 d-flex align-items-center border rounded" href="edit-product.php">
                                                <i data-feather="edit" class="feather-edit"></i>
                                            </a>
                                            <a class="p-2 d-flex align-items-center border rounded" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete">
                                                <i data-feather="trash-2" class="feather-trash-2"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </td>
                                    <td>3754250</td>
                                    <td>
                                        <div class="userimgname">
                                            <span class="avatar avatar-md me-2">
                                            <a href="javascript:void(0);" >
                                                <img src="assets/img/users/user-05.jpg" alt="product">
                                            </a>
                                        </span>
                                                <a href="javascript:void(0);">John Weaver</a>
                                        </div>
                                    </td>
                                    
                                    <td>Debit Card</td>
                                    <td>$320</td>
                                    <td>25 Oct 2024, 06:30 PM</td>
                                    <td><span class="bg-success fs-10 text-white p-1 rounded"><i class="ti ti-point-filled me-1"></i>Complete</span></td>
                                    <td class="d-flex">
                                        <div class="edit-delete-action d-flex align-items-center">
                                            <a class="me-2 edit-icon p-2 border d-flex align-items-center rounded" href="invoice-details.php">
                                                <i data-feather="eye" class="action-eye"></i>
                                            </a>
                                            <a class="me-2 p-2 d-flex align-items-center border rounded" href="edit-product.php">
                                                <i data-feather="edit" class="feather-edit"></i>
                                            </a>
                                            <a class="p-2 d-flex align-items-center border rounded" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete">
                                                <i data-feather="trash-2" class="feather-trash-2"></i>
                                            </a>
                                        </div>
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </td>
                                    <td>3459687</td>
                                    <td>
                                        <div class="userimgname">
                                            <span class="avatar avatar-md me-2">
                                            <a href="javascript:void(0);" >
                                                <img src="assets/img/users/user-08.jpg" alt="product">
                                            </a>
                                            </span>
                                                <a href="javascript:void(0);">Gary Hennessy</a>
                                        </div>
                                    </td>
                                    
                                    <td>PayPal</td>
                                    <td>$60</td>
                                    <td>14 Oct 2024, 02:45 PM</td>
                                    <td><span class="bg-success fs-10 text-white p-1 rounded"><i class="ti ti-point-filled me-1"></i>Complete</span></td>
                                    <td class="d-flex">
                                        <div class="edit-delete-action d-flex align-items-center">
                                            <a class="me-2 edit-icon p-2 border d-flex align-items-center rounded" href="invoice-details.php">
                                                <i data-feather="eye" class="action-eye"></i>
                                            </a>
                                            <a class="me-2 p-2 d-flex align-items-center border rounded" href="edit-product.php">
                                                <i data-feather="edit" class="feather-edit"></i>
                                            </a>
                                            <a class="p-2 d-flex align-items-center border rounded" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete">
                                                <i data-feather="trash-2" class="feather-trash-2"></i>
                                            </a>
                                        </div>	
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </td>
                                    <td>2186348</td>
                                    <td>
                                        <div class="userimgname">
                                            <span class="avatar avatar-md me-2">
                                            <a href="javascript:void(0);" >
                                                <img src="assets/img/users/user-04.jpg" alt="product">
                                            </a>
                                        </span>
                                                <a href="javascript:void(0);">Eleanor Panek</a>
                                        </div>
                                    </td>
                                    
                                    <td>Credit Card</td>
                                    <td>$540</td>
                                    <td>14 Oct 2024, 02:45 PM</td>
                                    <td><span class="bg-cyan fs-10 text-white p-1 rounded"><i class="ti ti-point-filled me-1"></i>Pending</span></td>
                                    <td class="d-flex">
                                        <div class="edit-delete-action d-flex align-items-center">
                                            <a class="me-2 edit-icon p-2 border d-flex align-items-center rounded" href="invoice-details.php">
                                                <i data-feather="eye" class="action-eye"></i>
                                            </a>
                                            <a class="me-2 p-2 d-flex align-items-center border rounded" href="edit-product.php">
                                                <i data-feather="edit" class="feather-edit"></i>
                                            </a>
                                            <a class="p-2 d-flex align-items-center border rounded" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete">
                                                <i data-feather="trash-2" class="feather-trash-2"></i>
                                            </a>
                                        </div>	
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </td>
                                    <td>3754250</td>
                                    <td>
                                        <div class="userimgname">
                                            <span class="avatar avatar-md me-2">
                                            <a href="javascript:void(0);" >
                                                <img src="assets/img/users/user-09.jpg" alt="product">
                                            </a>
                                        </span>
                                                <a href="javascript:void(0);">William Levy</a>
                                        </div>
                                    </td>
                                    
                                    <td>PayPal</td>
                                    <td>$200</td>
                                    <td>03 Oct 2024, 11:20 AM</td>
                                    <td><span class="bg-success fs-10 text-white p-1 rounded"><i class="ti ti-point-filled me-1"></i>Complete</span></td>
                                    <td class="d-flex">
                                        <div class="edit-delete-action d-flex align-items-center">
                                            <a class="me-2 edit-icon p-2 border d-flex align-items-center rounded" href="invoice-details.php">
                                                <i data-feather="eye" class="action-eye"></i>
                                            </a>
                                            <a class="me-2 p-2 d-flex align-items-center border rounded" href="edit-product.php">
                                                <i data-feather="edit" class="feather-edit"></i>
                                            </a>
                                            <a class="p-2 d-flex align-items-center border rounded" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete">
                                                <i data-feather="trash-2" class="feather-trash-2"></i>
                                            </a>
                                        </div>	
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </td>
                                    <td>2973542</td>
                                    <td>
                                        <div class="userimgname">
                                            <span class="avatar avatar-md me-2">
                                            <a href="javascript:void(0);" >
                                                <img src="assets/img/users/user-10.jpg" alt="product">
                                            </a>
                                        </span>
                                                <a href="javascript:void(0);">Charlotte Klotz</a>
                                        </div>
                                    </td>
                                    
                                    <td>Credit Card</td>
                                    <td>$45</td>
                                    <td>20 Sep 2024, 07:10 PM</td>
                                    <td><span class="bg-success fs-10 text-white p-1 rounded"><i class="ti ti-point-filled me-1"></i>Complete</span></td>
                                    <td class="d-flex">
                                        <div class="edit-delete-action d-flex align-items-center">
                                            <a class="me-2 edit-icon p-2 border d-flex align-items-center rounded" href="invoice-details.php">
                                                <i data-feather="eye" class="action-eye"></i>
                                            </a>
                                            <a class="me-2 p-2 d-flex align-items-center border rounded" href="edit-product.php">
                                                <i data-feather="edit" class="feather-edit"></i>
                                            </a>
                                            <a class="p-2 d-flex align-items-center border rounded" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete">
                                                <i data-feather="trash-2" class="feather-trash-2"></i>
                                            </a>
                                        </div>	
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </td>
                                    <td>3754250</td>
                                    <td>
                                        <div class="userimgname">
                                            <span class="avatar avatar-md me-2">
                                            <a href="javascript:void(0);" >
                                                <img src="assets/img/users/user-10.jpg" alt="product">
                                            </a>
                                        </span>
                                                <a href="javascript:void(0);">Charlotte Klotz</a>
                                        </div>
                                    </td>
                                    
                                    <td>Debit Card</td>
                                    <td>$45</td>
                                    <td>14 Oct 2024, 02:45 PM</td>
                                    <td>550</td>
                                    <td class="d-flex">
                                        <div class="edit-delete-action d-flex align-items-center">
                                            <a class="me-2 edit-icon p-2 border d-flex align-items-center rounded" href="invoice-details.php">
                                                <i data-feather="eye" class="action-eye"></i>
                                            </a>
                                            <a class="me-2 p-2 d-flex align-items-center border rounded" href="edit-product.php">
                                                <i data-feather="edit" class="feather-edit"></i>
                                            </a>
                                            <a class="p-2 d-flex align-items-center border rounded" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete">
                                                <i data-feather="trash-2" class="feather-trash-2"></i>
                                            </a>
                                        </div>	
                                    </td>
                                </tr>-->
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

    <!-- Order Products Modal -->
    <div class="modal fade" id="order-products" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Order Products</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="order-products-content">
                        <div class="text-center p-3">
                            <p>Loading products...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Order Products Modal -->

    <script>
    function viewOrderProducts(orderId) {
        const content = document.getElementById('order-products-content');
        content.innerHTML = '<div class="text-center p-3"><p>Loading products...</p></div>';
        
        fetch(`get_order_items.php?order_id=${orderId}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                displayOrderProducts(data.items);
            } else {
                content.innerHTML = '<div class="text-center p-3"><p class="text-danger">Error loading products</p></div>';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            content.innerHTML = '<div class="text-center p-3"><p class="text-danger">Error loading products</p></div>';
        });
    }
    
    function viewOrder(orderId) {
        window.location.href = `invoice-details.php?order_id=${orderId}`;
    }
    
    let allOrders = <?= json_encode($all_orders) ?>;
    let currentFilters = {
        product: '',
        user: '',
        payment: '',
        date: '',
        search: ''
    };
    
    function applyFilter(type, value) {
        currentFilters[type] = value;
        
        // Update button text
        const btnTexts = {
            product: value || 'Product',
            user: value || 'Created By', 
            payment: value ? value.charAt(0).toUpperCase() + value.slice(1) : 'Payment Method',
            date: getDateText(value)
        };
        
        if (btnTexts[type]) {
            document.getElementById(type + '-filter-btn').textContent = btnTexts[type];
        }
        
        filterOrders();
    }
    
    function getDateText(value) {
        switch(value) {
            case 'today': return 'Today';
            case 'last_7_days': return 'Last 7 Days';
            case 'last_month': return 'Last Month';
            default: return 'All Time';
        }
    }
    
    function performSearch() {
        currentFilters.search = document.getElementById('search-input').value;
        filterOrders();
    }
    
    function filterOrders() {
        let filtered = allOrders.filter(order => {
            // Search filter
            if (currentFilters.search) {
                const search = currentFilters.search.toLowerCase();
                if (!order.order_number.toLowerCase().includes(search) && 
                    !order.customer_name.toLowerCase().includes(search) &&
                    !(order.created_by_name && order.created_by_name.toLowerCase().includes(search))) {
                    return false;
                }
            }
            
            // Product filter
            if (currentFilters.product) {
                if (!order.order_products || !order.order_products.includes(currentFilters.product)) {
                    return false;
                }
            }
            
            // Payment filter
            if (currentFilters.payment && order.payment_method !== currentFilters.payment) {
                return false;
            }
            
            // User filter
            if (currentFilters.user && (!order.created_by_name || !order.created_by_name.includes(currentFilters.user))) {
                return false;
            }
            
            // Date filter
            if (currentFilters.date) {
                const orderDate = new Date(order.created_at);
                const now = new Date();
                
                switch(currentFilters.date) {
                    case 'today':
                        if (orderDate.toDateString() !== now.toDateString()) return false;
                        break;
                    case 'last_7_days':
                        const sevenDaysAgo = new Date(now.getTime() - 7 * 24 * 60 * 60 * 1000);
                        if (orderDate < sevenDaysAgo) return false;
                        break;
                    case 'last_month':
                        const oneMonthAgo = new Date(now.getFullYear(), now.getMonth() - 1, now.getDate());
                        if (orderDate < oneMonthAgo) return false;
                        break;
                }
            }
            
            return true;
        });
        
        updateTable(filtered);
    }
    
    function updateTable(orders) {
        // Destroy existing DataTable if it exists
        if ($.fn.DataTable.isDataTable('.datatable')) {
            $('.datatable').DataTable().destroy();
        }
        
        const tbody = document.querySelector('.datatable tbody');
        tbody.innerHTML = '';
        
        orders.forEach(order => {
            const row = `
                <tr>
                    <td>
                        <label class="checkboxs">
                            <input type="checkbox">
                            <span class="checkmarks"></span>
                        </label>
                    </td>
                    <td>${order.order_number}</td>
                    <td>${order.customer_name}</td>
                    <td>${order.payment_method}</td>
                    <td>${order.total_amount}</td>
                    <td>${order.created_at}</td>
                    <td>
                        <span class="bg-success fs-10 text-white p-1 rounded">
                            <i class="ti ti-point-filled me-1"></i>${order.payment_status || 'paid'}
                        </span>
                    </td>
                    <td class="d-flex">
                        <div class="edit-delete-action d-flex align-items-center">
                            <a class="me-2 edit-icon p-2 border d-flex align-items-center rounded" href="invoice-details.php?order_id=${order.id}">
                                <i data-feather="eye" class="action-eye"></i>
                            </a>
                            <a class="me-2 p-2 d-flex align-items-center border rounded" href="javascript:void(0);" onclick="viewOrderProducts(${order.id})" data-bs-toggle="modal" data-bs-target="#order-products">
                                <i data-feather="edit" class="feather-edit"></i>
                            </a>
                            <a class="p-2 d-flex align-items-center border rounded" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete">
                                <i data-feather="trash-2" class="feather-trash-2"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            `;
            tbody.innerHTML += row;
        });
        
        // Reinitialize DataTable with new data
        $('.datatable').DataTable({
            paging: true,
            searching: false,
            info: true,
            lengthChange: false,
            pageLength: 10
        });
        
        // Reinitialize feather icons
        if (typeof feather !== 'undefined') {
            feather.replace();
        }
    }
    
    // Allow search on Enter key
    document.getElementById('search-input').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            performSearch();
        }
    });
    
    document.getElementById('search-input').addEventListener('input', function() {
        performSearch();
    });
    
    function displayOrderProducts(items) {
        const content = document.getElementById('order-products-content');
        
        if (items.length === 0) {
            content.innerHTML = '<div class="text-center p-3"><p>No products found</p></div>';
            return;
        }
        
        let html = '<div class="table-responsive"><table class="table"><thead><tr><th>Product</th><th>Quantity</th><th>Price</th><th>Total</th></tr></thead><tbody>';
        
        items.forEach(item => {
            html += `
                <tr>
                    <td>${item.product_name}</td>
                    <td>${item.quantity}</td>
                    <td>$${parseFloat(item.price).toFixed(2)}</td>
                    <td>$${parseFloat(item.total).toFixed(2)}</td>
                </tr>
            `;
        });
        
        html += '</tbody></table></div>';
        content.innerHTML = html;
    }
    </script>

<?php
$content = ob_get_clean();

require_once '../partials/main.php'; ?>      