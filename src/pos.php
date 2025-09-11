<?php 
ob_start();
require_once __DIR__ . '/../auth/auth_middleware.php';
require_once __DIR__ . '/../partials/config.php';
requireLogin();

// Get current user
$current_user = getCurrentUser();

// Get categories
$categories = [];
// Add "All" category first
$categories[] = ['id' => 'all', 'name' => 'All', 'image' => 'assets/img/products/images(1).jpg'];

$cat_sql = "SELECT id, name, image FROM categories WHERE is_active = 1 ORDER BY name";
$cat_result = mysqli_query($link, $cat_sql);
if ($cat_result) {
    while ($row = mysqli_fetch_assoc($cat_result)) {
        $categories[] = $row;
    }
}

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

// Get customers
$customers = [];
$cust_sql = "SELECT id, name, phone, email FROM customers WHERE is_active = 1 ORDER BY name";
$cust_result = mysqli_query($link, $cust_sql);
if ($cust_result) {
    while ($row = mysqli_fetch_assoc($cust_result)) {
        $customers[] = $row;
    }
}

// Get active discount schemes
$schemes = [];
$scheme_sql = "SELECT name, value, type, min_purchase, valid_from, valid_to, description 
               FROM schemes 
               WHERE is_active = 1 
               AND NOW() BETWEEN valid_from AND valid_to";
$scheme_result = mysqli_query($link, $scheme_sql);
if ($scheme_result) {
    while ($row = mysqli_fetch_assoc($scheme_result)) {
        $schemes[] = $row;
    }
}
$schemes_json = json_encode($schemes);

// Initialize receipt variables for modal
$company_name = "InTouch POS";
$company_phone = "+1 234 567 8900";
$company_email = "info@intouchpos.com";
$customer_name = "";
$customer_id = "";
$invoice_no = "";
$order_date = date('d.m.Y');
$order_items = [];
$subtotal = 0;
$discount = 0;
$shipping = 0;
$tax = 0;
$tax_percentage = 5;
$total_bill = 0;
$due_amount = 0;
$total_payable = 0;
$sale_number = "";

// At the top of your page
if (isset($_GET['action']) && $_GET['action'] === 'getOrderItems' && isset($_GET['order_id'])) {

    $orderId = (int) $_GET['order_id'];
    $products = [];

    // Query order items joined with products
    $sql = "
        SELECT 
            oi.quantity,
            oi.unit_price,
            p.name AS product_name,
            p.image AS product_image
        FROM order_items oi
        JOIN products p ON p.id = oi.product_id
        WHERE oi.order_id = $orderId
    ";
    $result = mysqli_query($link, $sql);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $products[] = [
                'name'     => $row['product_name'],
                'quantity' => $row['quantity'],
                'price'    => $row['unit_price'],
                'image'    => !empty($row['product_image']) ? $row['product_image'] : 'assets/img/default.png'
            ];
        }
    }

    // Query order_number
    $order_number = '';
    $sql_order = "SELECT order_number FROM orders WHERE id = $orderId";
    $result_order = mysqli_query($link, $sql_order);
    if ($result_order && $row_order = mysqli_fetch_assoc($result_order)) {
        $order_number = $row_order['order_number'];
    }

    header('Content-Type: application/json');
    echo json_encode([
        'order_number' => $order_number,
        'products'     => $products
    ]);
    exit;
}

?>

    <!-- ========================
        Start Page Content
    ========================= -->

    <div class="page-wrapper pos-pg-wrapper ms-0">

        <!-- Start Content -->
		<div class="content pos-design p-0">

			<div class="row pos-wrapper">

				<!-- Products -->
				<div class="col-md-12 col-lg-7 col-xl-8 d-flex">
					<div class="pos-categories tabs_wrapper p-0 flex-fill">
						<div class="content-wrap">
							<div class="tab-wrap">
								<ul class="tabs owl-carousel pos-category5" id="categoryTabs">
                                                                    <?php foreach ($categories as $index => $category): ?>
                                                                        <li id="category_<?php echo $category['id']; ?>" data-id="<?php echo $category['id']; ?>" <?php echo $index === 0 ? 'class="active"' : ''; ?>>
                                                                            <a href="javascript:void(0);">
                                                                                <img src="assets/img/products/<?php echo $category['image'] ? $category['image'] : 'images(1).jpg'; ?>" alt="<?php echo htmlspecialchars($category['name']); ?>" onerror="this.src='assets/img/products/images(1).jpg'">
                                                                            </a>
                                                                            <h6><a href="javascript:void(0);"><?php echo htmlspecialchars($category['name']); ?></a></h6>
                                                                        </li>
                                                                    <?php endforeach; ?>
                                                                </ul>
							</div>
							<div class="tab-content-wrap">
								<div class="d-flex align-items-center justify-content-between flex-wrap mb-2">
									<div class="mb-3">
										<h5 class="mb-1">Welcome, <?php echo htmlspecialchars($current_user['full_name']); ?></h5>
										<p><?php echo date('F d, Y'); ?></p>
										<?php if (isset($_SESSION['success'])): ?>
											<div class="alert alert-success alert-dismissible fade show" role="alert">
												<?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
												<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
											</div>
										<?php endif; ?>
										<?php if (isset($_SESSION['error'])): ?>
											<div class="alert alert-danger alert-dismissible fade show" role="alert">
												<?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
												<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
											</div>
										<?php endif; ?>
									</div>
									<div class="d-flex align-items-center flex-wrap mb-2">
										<div class="input-icon-start search-pos position-relative mb-2 me-3">
											<span class="input-icon-addon">
												<i class="ti ti-search"></i>
											</span>
											<input type="text" id="searchProduct" class="form-control" placeholder="Search Product" onkeyup="searchProducts()">
										</div>
										<a href="products.php" class="btn btn-sm btn-dark mb-2 me-2"><i class="ti ti-tag me-1"></i>View All Products</a>
										<a href="pos-settings.php" class="btn btn-sm btn-primary mb-2 me-2"><i class="ti ti-settings me-1"></i>POS Settings</a>
									</div>
								</div>
								<div class="pos-products">
									<div class="tabs_container">
										<div class="tab_content active" data-tab="all">
											<div class="row g-3" id="productsContainer">
												<?php foreach ($products as $product): ?>
												<div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-3 product-item" data-category="<?php echo $product['category_id']; ?>" data-sku="<?php echo htmlspecialchars($product['sku']); ?>" style="display: block;">
													<div class="product-info card mb-0<?php echo ($product['stock_quantity'] <= 0) ? ' out-of-stock' : ''; ?>">
														<a href="javascript:void(0);" class="pro-img"<?php echo ($product['stock_quantity'] > 0) ? ' onclick="addToCart(' . $product['id'] . ', \'' . htmlspecialchars($product['name']) . '\', ' . $product['price'] . ')"' : ''; ?>>
															<img src="assets/img/products/<?php echo $product['image'] ? $product['image'] : 'images(1).jpg'; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" onerror="this.src='assets/img/products/images(1).png'">
															<span><i class="ti ti-circle-check-filled"></i></span>
														</a>
														<h6 class="product-name"><a href="javascript:void(0);"><?php echo htmlspecialchars($product['name']); ?></a></h6>
														<p class="product-sku text-muted mb-2">SKU: <?php echo htmlspecialchars($product['sku']); ?></p>
														<div class="d-flex align-items-center justify-content-between price">
															<p class="text-gray-9 mb-0"><?php echo number_format($product['price'], 2); ?></p>
															<p class="text-gray-9 mb-0">QTY: <?php echo $product['stock_quantity']; ?></p>
                                                                                                                        <div class="qty-item m-0" style="display:none">
																<a href="javascript:void(0);" class="dec d-flex justify-content-center align-items-center" data-bs-toggle="tooltip" data-bs-placement="top" title="minus" onclick="decreaseQuantity(this)"><i class="ti ti-minus"></i></a>
																<input type="text" class="form-control text-center product-qty" name="qty" value="1" min="1" max="<?php echo $product['stock_quantity']; ?>">
																<a href="javascript:void(0);" class="inc d-flex justify-content-center align-items-center" data-bs-toggle="tooltip" data-bs-placement="top" title="plus" onclick="increaseQuantity(this)"><i class="ti ti-plus"></i></a>
															</div>
														</div>
														<?php if ($product['stock_quantity'] <= $product['min_stock_level']): ?>
														<div class="stock-warning">
															<small class="text-danger">Low Stock: <?php echo $product['stock_quantity']; ?> left</small>
														</div>
														<?php endif; ?>
													</div>
												</div>
												<?php endforeach; ?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /Products -->

				<!-- Order Details -->
				<div class="col-md-12 col-lg-5 col-xl-4 ps-0 theiaStickySidebar d-lg-flex">
					<aside class="product-order-list bg-secondary-transparent flex-fill">
						<div class="mb-3">
							<button class="btn btn-purple w-100" onclick="showSchemesModal()"><i class="ti ti-discount-2 me-1"></i>Available Schemes</button>
						</div>
						<div class="card">
							<div class="card-body">
								<div class="order-head d-flex align-items-center justify-content-between w-100">
									<div>
										<h3>Order List</h3>
									</div>
									<div class="d-flex align-items-center gap-2">
										<span class="badge badge-dark fs-10 fw-medium badge-xs">#ORD123</span>
										<a class="link-danger fs-16" href="javascript:void(0);"><i class="ti ti-trash-x-filled"></i></a>
									</div>
								</div>
								<div class="customer-info block-section">
									<h5 class="mb-2">Customer Information <span class="text-danger">*</span></h5>
									<div class="d-flex align-items-center gap-2">
                                                                            <div class="flex-grow-1">
                                                                                <select class="select" id="customerSelect" required onchange="updateCustomerInfo()">
                                                                                    <option value="">Select Customer</option>
                                                                                    <option value="walkin">Walk in Customer</option>
                                                                                    <?php foreach ($customers as $customer): ?>
<!--                                                                                    <option value="<?php echo $customer['id']; ?>" 
                                                                                            data-name="<?php // echo htmlspecialchars($customer['name']); ?>"
                                                                                            data-phone="<?php // echo htmlspecialchars($customer['phone']); ?>"
                                                                                            data-bonus="<?php // echo isset($customer['bonus_points']) ? $customer['bonus_points'] : 0; ?>"
                                                                                            data-loyalty="<?php // echo isset($customer['loyalty_amount']) ? number_format($customer['loyalty_amount'], 2) : '0.00'; ?>">
                                                                                        <?php // echo htmlspecialchars($customer['name']); ?> - <?php // echo htmlspecialchars($customer['phone']); ?>
                                                                                    </option>-->
                                                                                    <option value="<?php echo $customer['id']; ?>" 
                                                                                            data-name="<?php echo htmlspecialchars($customer['name']); ?>"
                                                                                            data-phone="<?php echo htmlspecialchars($customer['phone']); ?>"
                                                                                            data-bonus=" 100 "
                                                                                            data-loyalty="10.0">
                                                                                        <?php echo htmlspecialchars($customer['name']); ?> - <?php echo htmlspecialchars($customer['phone']); ?>
                                                                                    </option>
                                                                                    <?php endforeach; ?>
                                                                                </select>
                                                                            </div>
                                                                            <a href="#" class="btn btn-teal btn-icon fs-20" data-bs-toggle="modal" data-bs-target="#create">
                                                                                <i class="ti ti-user-plus"></i>
                                                                            </a>
                                                                            <a href="#" class="btn btn-info btn-icon fs-20" data-bs-toggle="modal" data-bs-target="#barcode">
                                                                                <i class="ti ti-scan"></i>
                                                                            </a>
                                                                        </div>
                                                                        <!-- Dynamic Customer Info Display -->
                                                                        <div class="customer-item border border-orange bg-orange-100 d-flex align-items-center justify-content-between flex-wrap gap-2 mt-3" 
                                                                             id="customerDetails" style="display: none;">
                                                                            <div>
                                                                                <h6 class="fs-16 fw-bold mb-1" id="customerName"></h6>
                                                                                <div class="d-inline-flex align-items-center gap-2 customer-bonus">
                                                                                    <p class="fs-13 d-inline-flex align-items-center gap-1 mb-0">
                                                                                        Bonus: <span class="badge bg-cyan fs-13 fw-bold p-1" id="customerBonus">0</span>
                                                                                    </p>
                                                                                    <p class="fs-13 d-inline-flex align-items-center gap-1 mb-0">
                                                                                        Loyalty: <span class="badge bg-teal fs-13 fw-bold p-1" id="customerLoyalty">0.00</span>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                            <div class="d-flex gap-2">
                                                                                <a href="javascript:void(0);" class="btn btn-orange btn-sm" >Apply</a>
                                                                                <!--<a href="javascript:void(0);" class="btn btn-orange btn-sm" onclick="applyCustomer()">Apply</a>-->
                                                                                <a href="javascript:void(0);" class="close-icon" onclick="clearCustomer()">
                                                                                    <i class="ti ti-x"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
								</div>
								<div class="product-added block-section">
									<div class="head-text d-flex align-items-center justify-content-between mb-3">
										<div class="d-flex align-items-center">
											<h5 class="me-2">Order Details</h5>
											<div class="badge bg-light text-gray-9 fs-12 fw-semibold py-2 border rounded">Items : <span class="text-teal" id="cartItemCount">0</span></div>
										</div>
										<a href="javascript:void(0);" onclick="clearCartWithRestore()" class="d-flex align-items-center clear-icon fs-10 fw-medium">Clear all</a>
									</div>
									<div class="product-wrap">
										<div class="empty-cart" id="emptyCart">
											<div class="fs-24 mb-1">
												<i class="ti ti-shopping-cart"></i>
											</div>
											<p class="fw-bold">No Products Selected</p>
										</div>
										<div class="product-list border-0 p-0" id="cartItems" style="display: none;">
											<div class="table-responsive">
												<table class="table table-borderless">
													<thead>
														<tr>
															<th class="fw-bold bg-light">Item</th>
															<th class="fw-bold bg-light">QTY</th>
															<th class="fw-bold bg-light text-end">Cost</th>
														</tr>
													</thead>
													<tbody id="cartItemsList">
														<!-- Cart items will be dynamically inserted here -->
													</tbody>
												</table>
											</div>
								</div>
								</div>
								<!-- Dynamic Discount Item -->
								<div id="discount-item-container">
									<!-- Discount item will be injected here by JavaScript -->
								</div>
								</div>
								<div class="order-total bg-total bg-white p-0">
									<h5 class="mb-3">Payment Summary</h5>
									<table class="table table-responsive table-borderless">
										<tr>
											<td>Shipping<a href="#" class="ms-3 link-default" data-bs-toggle="modal" data-bs-target="#shipping-cost">
                                                                                                <!--<i class="ti ti-edit"></i>-->
                                                                                            </a></td>
											<td class="text-gray-9 text-end" id="shippingCost">0.00</td>
										</tr>
										<tr>
											<td>Tax<a href="#" class="ms-3 link-default" data-bs-toggle="modal" data-bs-target="#order-tax">
                                                                                                <!--<i class="ti ti-edit"></i>-->
                                                                                            </a></td>
											<td class="text-gray-9 text-end" id="taxAmount">0.00</td>
										</tr>
										<tr>
											<td>Coupon<a href="#" class="ms-3 link-default" data-bs-toggle="modal" data-bs-target="#coupon-code">
                                                                                                <!--<i class="ti ti-edit"></i>-->
                                                                                            </a></td>
											<td class="text-gray-9 text-end" id="couponAmount">0.00</td>
										</tr>
										<tr>												
											<td><span class="text-danger">Discount</span><a href="#" class="ms-3 link-default" data-bs-toggle="modal" data-bs-target="#discount">
                                                                                                <!--<i class="ti ti-edit"></i>-->
                                                                                            </a></td>
											<td class="text-danger text-end" id="discountAmount">0.00</td>
										</tr>
										<tr>												
											<td>
												<div class="form-check form-switch">
													<input class="form-check-input" type="checkbox" role="switch" id="round" checked>
													<label class="form-check-label" for="round">Roundoff</label>
												</div>
											</td>
											<td class="text-gray-9 text-end" id="roundoffAmount">0.00</td>
										</tr>
										<tr>
											<td>Sub Total</td>
											<td class="text-gray-9 text-end" id="cartSubtotal">0.00</td>
										</tr>
										<tr>
											<td class="fw-bold border-top border-dashed">Total Payable</td>
											<td class="text-gray-9 fw-bold text-end border-top border-dashed" id="cartTotal">0.00</td>
										</tr>
									</table>
								</div>
							</div>
						</div>
						<div class="card payment-method">
							<div class="card-body">
								<h5 class="mb-3">Select Payment</h5>
								<div class="row align-items-center methods g-2">
									<div class="col-sm-6 col-md-4 d-flex">
										<a href="javascript:void(0);" class="payment-item d-flex align-items-center justify-content-center p-2 flex-fill" onclick="selectPaymentMethod('cash')">
											<img src="assets/img/icons/cash-icon.svg" class="me-2" alt="img">
											<p class="fs-14 fw-medium">Cash</p>
										</a>
									</div>
									<div class="col-sm-6 col-md-4 d-flex">
										<a href="javascript:void(0);" class="payment-item d-flex align-items-center justify-content-center p-2 flex-fill" onclick="selectPaymentMethod('card')">
											<img src="assets/img/icons/card.svg" class="me-2" alt="img">
											<p class="fs-14 fw-medium">Card</p>
										</a>
									</div>
									<div class="col-sm-6 col-md-4 d-flex">
										<a href="javascript:void(0);" class="payment-item d-flex align-items-center justify-content-center p-2 flex-fill" onclick="selectPaymentMethod('points')">
											<img src="assets/img/icons/points.svg" class="me-2" alt="img">
											<p class="fs-14 fw-medium">Points</p>
										</a>
									</div>
									<div class="col-sm-6 col-md-4 d-flex">
										<a href="javascript:void(0);" class="payment-item d-flex align-items-center justify-content-center p-2 flex-fill" onclick="selectPaymentMethod('deposit')">
											<img src="assets/img/icons/deposit.svg" class="me-2" alt="img">
											<p class="fs-14 fw-medium">Deposit</p>
										</a>
									</div>
									<div class="col-sm-6 col-md-4 d-flex">
										<a href="javascript:void(0);" class="payment-item d-flex align-items-center justify-content-center p-2 flex-fill" onclick="selectPaymentMethod('cheque')">
											<img src="assets/img/icons/cheque.svg" class="me-2" alt="img">
											<p class="fs-14 fw-medium">Cheque</p>
										</a>
									</div>
									<div class="col-sm-6 col-md-4 d-flex">
										<a href="javascript:void(0);" class="payment-item d-flex align-items-center justify-content-center p-2 flex-fill" onclick="selectPaymentMethod('gift_card')">
											<img src="assets/img/icons/giftcard.svg" class="me-2" alt="img">
											<p class="fs-14 fw-medium">Gift Card</p>
										</a>
									</div>
									<div class="col-sm-6 col-md-4 d-flex">
										<a href="javascript:void(0);" class="payment-item d-flex align-items-center justify-content-center p-2 flex-fill" onclick="selectPaymentMethod('scan')">
											<img src="assets/img/icons/scan-icon.svg" class="me-2" alt="img">
											<p class="fs-14 fw-medium">Scan</p>
										</a>
									</div>
									<div class="col-sm-6 col-md-4 d-flex">
										<a href="javascript:void(0);" class="payment-item d-flex align-items-center justify-content-center p-2 flex-fill" onclick="selectPaymentMethod('pay_later')">
											<img src="assets/img/icons/paylater.svg" class="me-2" alt="img">
											<p class="fs-14 fw-medium">Pay Later</p>
										</a>
									</div>
									<div class="col-sm-6 col-md-4 d-flex">
										<a href="javascript:void(0);" class="payment-item d-flex align-items-center justify-content-center p-2 flex-fill" onclick="selectPaymentMethod('external')">
											<img src="assets/img/icons/external.svg" class="me-2" alt="img">
											<p class="fs-14 fw-medium">External</p>
										</a>
									</div>
									<div class="col-sm-6 col-md-4 d-flex">
										<a href="javascript:void(0);" class="payment-item d-flex align-items-center justify-content-center p-2 flex-fill" onclick="selectPaymentMethod('split')">
											<img src="assets/img/icons/split-bill.svg" class="me-2" alt="img">
											<p class="fs-14 fw-medium">Split Bill</p>
										</a>
									</div>
								</div>
							</div>
						</div>
						<div class="btn-row d-flex align-items-center justify-content-between gap-3">
							<a href="javascript:void(0);" class="btn btn-white d-flex align-items-center justify-content-center flex-fill m-0" data-bs-toggle="modal" data-bs-target="#hold-order"><i  class="ti ti-printer me-2"></i>Print Order</a>
							<a href="javascript:void(0);" class="btn btn-secondary d-flex align-items-center justify-content-center flex-fill m-0" onclick="showPaymentOptions()"><i  class="ti ti-shopping-cart me-2"></i>Place Order</a>
						</div>
					</aside>
				</div>
				<!-- /Order Details -->

			</div>

			<div class="pos-footer bg-white p-3 border-top">
				<div class="d-flex align-items-center justify-content-center flex-wrap gap-2">
					<a href="javascript:void(0);" class="btn btn-orange d-inline-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#hold-order"><i  class="ti ti-player-pause me-2"></i>Hold</a>
					<a href="javascript:void(0);" class="btn btn-info d-inline-flex align-items-center justify-content-center"><i  class="ti ti-trash me-2"></i>Void</a>
					<a href="javascript:void(0);" class="btn btn-warning d-inline-flex align-items-center justify-content-center" onclick="openExchange()"><i  class="ti ti-refresh me-2"></i>Exchange</a>
					<a href="javascript:void(0);" class="btn btn-cyan d-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#payment-completedd"><i  class="ti ti-cash-banknote me-2"></i>Payment</a>
					<a href="javascript:void(0);" class="btn btn-secondary d-inline-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#orders"><i class="ti ti-shopping-cart me-2"></i>View Orders</a>
					<!--<a href="orders.php" class="btn btn-secondary d-inline-flex align-items-center justify-content-center" ><i class="ti ti-shopping-cart me-2"></i>View Orders</a>-->
					<a href="javascript:void(0);" class="btn btn-indigo d-inline-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#reset"><i class="ti ti-reload me-2"></i>Reset</a>
					<a href="javascript:void(0);" class="btn btn-danger d-inline-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#recents"><i class="ti ti-refresh-dot me-2"></i>Transaction</a>
				</div>
			</div>
		</div>
        <!-- End Content -->
        
        <div id="modal-overlay" class="modal-overlay">
    <div class="custom-modal">
        <div class="modal-header">
            <div id="modal-icon" class="modal-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                </svg>
            </div>
            <h3 id="modal-title" class="modal-title">Success</h3>
        </div>
        <p id="modal-message" class="modal-message">Item added to cart successfully!</p>
        <div class="modal-buttons">
            <button class="btn btn-secondary" onclick="closeModal()">Close</button>
            <button class="btn btn-primary" onclick="closeModal()">Continue Shopping</button>
        </div>
    </div>
</div>

<!-- Toast Container -->
<div id="toast-container" class="toast-container"></div>
    
        <?php 
        // Set page variable for modal conditions
        $page = 'pos.php';
        require_once __DIR__ . '/../partials/footer.php'; 
        require_once __DIR__ . '/../partials/modal-popup.php'; 
        require_once __DIR__ . '/../partials/modal-popup-new.php'; 
        require_once __DIR__ . '/../partials/pos-modals.php'; 
        require_once __DIR__ . '/../partials/exchange-modal.php'; 
        ?>

        <!-- Schemes Modal -->
        <div class="modal fade" id="schemes-modal" tabindex="-1">
            <div class="modal-dialog modal-xl">
                <div class="modal-content border-0 shadow-lg">
                    <div class="modal-header bg-gradient-purple text-white border-0">
                        <h4 class="modal-title d-flex align-items-center mb-0">
                            <div class="scheme-icon-wrapper me-3">
                                <i class="ti ti-discount-2 fs-24"></i>
                            </div>
                            <div class="fw-bold">Available Discount Schemes</div>
                        </h4>
                        <button type="button" class="btn btn-sm text-white" data-bs-dismiss="modal" style="background: rgba(255,255,255,0.2); border: none; border-radius: 50%; width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;">
                            <i class="ti ti-x fs-18"></i>
                        </button>
                    </div>
                    <div class="modal-body p-4">
                        <?php if (empty($schemes)): ?>
                            <div class="empty-state text-center py-5">
                                <div class="empty-icon mb-4">
                                    <i class="ti ti-discount-off"></i>
                                </div>
                                <h5 class="text-muted mb-2">No Active Schemes</h5>
                                <p class="text-muted mb-0">There are currently no active discount schemes available.</p>
                            </div>
                        <?php else: ?>
                            <div class="schemes-grid">
                                <?php foreach ($schemes as $index => $scheme): ?>
                                    <div class="scheme-card" data-aos="fade-up" data-aos-delay="<?php echo $index * 100; ?>">
                                        <div class="scheme-header">
                                            <div class="discount-badge">
                                                <span class="discount-value">
                                                    <?php echo $scheme['type'] === 'percentage' ? $scheme['value'] . '%' : number_format($scheme['value'], 0); ?>
                                                </span>
                                                <span class="discount-text">OFF</span>
                                            </div>
                                            <div class="status-badge">
                                                <i class="ti ti-circle-check-filled"></i>
                                                <span>ACTIVE</span>
                                            </div>
                                        </div>
                                        <div class="scheme-body">
                                            <h5 class="scheme-title"><?php echo htmlspecialchars($scheme['name']); ?></h5>
                                            <p class="scheme-description"><?php echo htmlspecialchars($scheme['description']); ?></p>
                                            <div class="scheme-details">
                                                <div class="detail-item">
                                                    <i class="ti ti-shopping-cart"></i>
                                                    <span>Min. Purchase: <strong><?php echo number_format($scheme['min_purchase'], 0); ?></strong></span>
                                                </div>
                                                <div class="detail-item">
                                                    <i class="ti ti-calendar"></i>
                                                    <span>Valid: <?php echo date('M d', strtotime($scheme['valid_from'])); ?> - <?php echo date('M d, Y', strtotime($scheme['valid_to'])); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="scheme-footer">
                                            <div class="auto-apply-text">
                                                <i class="ti ti-sparkles"></i>
                                                <span>Auto-applied at checkout</span>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="modal-footer border-0 bg-light">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            <i class="ti ti-x me-1"></i>Close
                        </button>
                    </div>
                </div>
            </div>
        </div>




    </div>

    <!-- ========================
        End Page Content
    ========================= -->

    <script>
        // Global cart variable
        let cart = [];
        
        function showModal(type, title, message) {
            const overlay = document.getElementById('modal-overlay');
            const icon = document.getElementById('modal-icon');
            const titleEl = document.getElementById('modal-title');
            const messageEl = document.getElementById('modal-message');
            const buttonsEl = document.querySelector('.modal-buttons');

            // Update content
            titleEl.textContent = title;
            messageEl.textContent = message;

            // Update icon and style based on type
            if (type === 'success') {
                icon.className = 'modal-icon success';
                icon.innerHTML = '<svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>';
            } else if (type === 'error') {
                icon.className = 'modal-icon error';
                icon.innerHTML = '<svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/></svg>';
            }

            // Show only OK button for success/error messages
            buttonsEl.innerHTML = '<button class="btn btn-primary" onclick="closeModal()">OK</button>';

            overlay.style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('modal-overlay').style.display = 'none';
        }

        // Toast Functions
        function showToast(type, title, message, duration = 4000) {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');
            toast.className = `toast ${type}`;

            const iconSvg = type === 'success' 
                ? '<svg width="20" height="20" viewBox="0 0 24 24" fill="#10b981"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>'
                : '<svg width="20" height="20" viewBox="0 0 24 24" fill="#ef4444"><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/></svg>';

            toast.innerHTML = `
                <div class="toast-icon">${iconSvg}</div>
                <div class="toast-content">
                    <div class="toast-title">${title}</div>
                    <div class="toast-message">${message}</div>
                </div>
                <button class="toast-close" onclick="removeToast(this)">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                    </svg>
                </button>
            `;

            container.appendChild(toast);

            // Auto remove after duration
            setTimeout(() => {
                if (toast.parentNode) {
                    removeToast(toast.querySelector('.toast-close'));
                }
            }, duration);
        }

        function removeToast(closeBtn) {
            const toast = closeBtn.closest('.toast');
            toast.style.animation = 'slideOutRight 0.3s ease';
            setTimeout(() => {
                if (toast.parentNode) {
                    toast.parentNode.removeChild(toast);
                }
            }, 300);
        }

        // Demo functions
        function showSuccessModal() {
            showModal('success', 'Success!', 'Item added to cart successfully!');
        }

        function showErrorModal() {
            showModal('error', 'Error', 'Failed to add item to cart. Please try again.');
        }

        function showSuccessToast() {
            showToast('success', 'Success!', 'Item added to cart successfully!');
        }

        function showErrorToast() {
            showToast('error', 'Error', 'Failed to add item to cart.');
        }

        // Close modal when clicking outside
        document.getElementById('modal-overlay').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Your updated addToCart function
        function addToCart(productId, productName, price) {
            // Get quantity from product input
            const productElement = document.querySelector(`[onclick*="addToCart(${productId}"]`).closest('.product-item');
            const quantityInput = productElement.querySelector('.product-qty');
            const quantity = parseInt(quantityInput.value) || 1;
            
            // Add to database
            fetch('cart_api.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `action=add&product_id=${productId}&quantity=${quantity}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    loadCart();
                    quantityInput.value = 1;

                    // Use Toast instead of Modal
                    showToast('success', 'Success!', `${productName} added to cart!`);

                } else {
                    showToast('error', 'Error', data.message || 'Failed to add item to cart');
                    loadCart();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('error', 'Connection Error', 'Failed to add item to cart');
                loadCart();
            });
        }
        
        // Function to update cart display
        function updateCartDisplay() {
            const cartContainer = document.getElementById('cartItems');
            const emptyCart = document.getElementById('emptyCart');
            const cartItemsList = document.getElementById('cartItemsList');
            const cartItemCount = document.getElementById('cartItemCount');
            
            if (cart.length === 0) {
                // Show empty cart
                if (cartContainer) cartContainer.style.display = 'none';
                if (emptyCart) emptyCart.style.display = 'block';
                if (cartItemCount) cartItemCount.textContent = '0';
                
                // Clear cart items list completely
                if (cartItemsList) cartItemsList.innerHTML = '';
                
                // Reset totals
                document.getElementById('cartTotal').textContent = '0.00';
                document.getElementById('cartSubtotal').textContent = '0.00';
                
                // Clear discount when cart is empty
                document.getElementById('discountAmount').textContent = '0.00';
                document.getElementById('discount-item-container').innerHTML = '';
                
                return;
            }
            
            // Hide empty cart and show cart items
            if (cartContainer) cartContainer.style.display = 'block';
            if (emptyCart) emptyCart.style.display = 'none';
            
            // Update item count
            if (cartItemCount) cartItemCount.textContent = cart.length;
            
            // Clear existing items completely
            if (cartItemsList) {
                cartItemsList.innerHTML = '';
            }
            
            let calculatedSubtotal = 0;
            
            cart.forEach((item, index) => {
                const itemTotal = item.price * item.quantity;
                calculatedSubtotal += itemTotal;
                
                if (cartItemsList) {
                    cartItemsList.innerHTML += `
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <a class="delete-icon" href="javascript:void(0);" onclick="removeFromCart(${item.id})">
                                        <i class="ti ti-trash-x-filled"></i>
                                    </a>
                                    <h6 class="fs-13 fw-normal">${item.name}</h6>
                                </div>
                            </td>
                            <td>
                                <div class="qty-item m-0">
                                    <a href="javascript:void(0);" class="dec d-flex justify-content-center align-items-center" data-bs-toggle="tooltip" data-bs-placement="top" title="minus" onclick="decreaseCartQuantity(${item.id})"><i class="ti ti-minus"></i></a>
                                    <input type="text" class="form-control text-center" name="qty" value="${item.quantity}" readonly>
                                    <a href="javascript:void(0);" class="inc d-flex justify-content-center align-items-center" data-bs-toggle="tooltip" data-bs-placement="top" title="plus" onclick="increaseCartQuantity(${item.id})"><i class="ti ti-plus"></i></a>
                                </div>
                            </td>
                            <td class="fs-13 fw-semibold text-gray-9 text-end">${itemTotal.toFixed(2)}</td>
                        </tr>
                    `;
                }
            });
            
            // Update subtotal using calculated value
            document.getElementById('cartSubtotal').textContent = calculatedSubtotal.toFixed(2);
            
            // Apply or remove discount based on subtotal
            applyDiscount();

            // Calculate and update final total
            const finalTotal = getCartTotal();
            document.getElementById('cartTotal').textContent =  finalTotal.toFixed(2);
            
            // Update payment modal totals
            updatePaymentModalTotals();
        }
        
        // Function to remove item from cart
        function removeFromCart(productId) {
            const action = productId < 0 ? 'remove_exchange' : 'remove';
            
            fetch('cart_api.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `action=${action}&product_id=${productId}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    loadCart();
                    // Check if cart is now empty and restore revived order if needed
                    setTimeout(() => {
                        if (cart.length === 0 && revivedOrderId) {
                            restoreOrder(revivedOrderId);
                        }
                    }, 100);
                } else {
                    showModal('error', 'Error', data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showModal('error', 'Connection Error', 'Failed to remove item from cart');
            });
        }
        
        // Function to increase cart item quantity
        function increaseCartQuantity(productId) {
            const item = cart.find(item => item.id === productId);
            if (item) {
                updateCartQuantity(productId, item.quantity + 1);
            }
        }
        
        // Function to decrease cart item quantity
        function decreaseCartQuantity(productId) {
            const item = cart.find(item => item.id === productId);
            if (item) {
                if (item.quantity > 1) {
                    updateCartQuantity(productId, item.quantity - 1);
                } else {
                    removeFromCart(productId);
                }
            }
        }
        
        // Function to update cart quantity
        function updateCartQuantity(productId, quantity) {
            fetch('cart_api.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `action=update&product_id=${productId}&quantity=${quantity}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    loadCart();
                } else {
                    showModal('error', 'Error', data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showModal('error', 'Connection Error', 'Failed to update cart');
            });
        }
        
        // Get schemes from PHP
        const schemes = <?php echo $schemes_json; ?>;

        // Function to apply discount based on cart total
        function applyDiscount() {
            const subtotal = getCartSubtotal();
            const discountContainer = document.getElementById('discount-item-container');
            const discountAmountEl = document.getElementById('discountAmount');
            let appliedDiscount = false;

            // Find and apply the first valid scheme
            for (const scheme of schemes) {
                if (subtotal >= scheme.min_purchase) {
                    let discountValue = 0;
                    let discountText = '';

                    if (scheme.type === 'percentage') {
                        discountValue = subtotal * (scheme.value / 100);
                        discountText = `${scheme.description}`;
                    } else { // Assuming 'flat'
                        discountValue = scheme.value;
                        discountText = `${scheme.description}`;
                    }

                    discountAmountEl.textContent = `-${discountValue.toFixed(2)}`;

                    // Show the discount item in the cart
                    discountContainer.innerHTML = `
                        <div class="discount-item d-flex align-items-center justify-content-between bg-purple-transparent mt-3 flex-nowrap gap-2">
                            <div class="d-flex align-items-center flex-grow-1 overflow-hidden">
                                <span class="bg-purple discount-icon br-5 flex-shrink-0 me-2">
                                    <img src="assets/img/icons/discount-icon.svg" alt="img">
                                </span>
                                <div>
                                    <h6 class="fs-14 fw-bold text-purple mb-1">${discountText}</h6>
                                    <p class="mb-0">${scheme.name}</p>
                                </div>
                            </div>
                            <a href="javascript:void(0);" class="close-icon" onclick="removeDiscount()"><i class="ti ti-trash"></i></a>
                        </div>
                    `;
                    appliedDiscount = true;
                    break; // Apply only the first matching scheme
                }
            }

            if (!appliedDiscount) {
                discountAmountEl.textContent = '0.00';
                discountContainer.innerHTML = '';
            }

            // Recalculate total after discount change
            const finalTotal = getCartTotal();
            document.getElementById('cartTotal').textContent = finalTotal.toFixed(2);
        }

        // Function to show confirmation modal
        function showConfirmModal(title, message, onConfirm) {
            const overlay = document.getElementById('modal-overlay');
            const icon = document.getElementById('modal-icon');
            const titleEl = document.getElementById('modal-title');
            const messageEl = document.getElementById('modal-message');
            const buttonsEl = document.querySelector('.modal-buttons');

            // Update content
            titleEl.textContent = title;
            messageEl.textContent = message;

            // Set warning icon
            icon.className = 'modal-icon warning';
            icon.innerHTML = '<svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M1 21h22L12 2 1 21zm12-3h-2v-2h2v2zm0-4h-2v-4h2v4z"/></svg>';

            // Update buttons for confirmation
            buttonsEl.innerHTML = `
                <button class="btn btn-secondary" onclick="closeModal()">Cancel</button>
                <button class="btn btn-danger" onclick="confirmAction()">Confirm</button>
            `;

            // Store callback
            window.confirmCallback = onConfirm;

            overlay.style.display = 'flex';
        }

        // Function to handle confirmation
        function confirmAction() {
            closeModal();
            if (window.confirmCallback) {
                window.confirmCallback();
                window.confirmCallback = null;
            }
        }

        // Function to clear cart
        function clearCart() {
    showConfirmModal(
        'Clear Cart',
        'Are you sure you want to clear all items from the cart? This action cannot be undone.',
        function() {
            // On confirm
            fetch('cart_api.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'action=clear'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    loadCart();
                    // Use modal instead of toast
                    showModal('success', 'Cart Cleared', 'All items have been removed from the cart');
                } else {
                    showModal('error', 'Error', data.message || 'Failed to clear cart');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showModal('error', 'Connection Error', 'Failed to clear cart. Please check your connection.');
            });
        }
    );
}

function filterProducts(categoryId) {
    console.log('Filtering by category:', categoryId);
    
    // Get all product items
    const productItems = document.querySelectorAll('.product-item');
    console.log('Total products found:', productItems.length);
    
    // Remove active class from all category tabs
    const categoryTabs = document.querySelectorAll('#categoryTabs li');
    categoryTabs.forEach(tab => tab.classList.remove('active'));
    
    // Add active class to selected tab
    const activeTab = document.querySelector(`#categoryTabs li[data-id="${categoryId}"]`);
    if (activeTab) {
        activeTab.classList.add('active');
        console.log('Set active tab:', categoryId);
    }
    
    // Clear search input when filtering by category
    const searchInput = document.getElementById('searchProduct');
    if (searchInput) {
        searchInput.value = '';
    }
    
    let visibleCount = 0;
    
    // Filter products
    productItems.forEach((item, index) => {
        const itemCategoryId = item.getAttribute('data-category');
        console.log(`Product ${index}: category=${itemCategoryId}, looking for=${categoryId}`);
        
        if (categoryId === 'all') {
            item.style.display = 'block';
            visibleCount++;
        } else {
            // Convert both to strings for comparison
            if (String(itemCategoryId) === String(categoryId)) {
                item.style.display = 'block';
                visibleCount++;
                console.log(`Showing product ${index} (category match)`);
            } else {
                item.style.display = 'none';
                console.log(`Hiding product ${index} (category mismatch)`);
            }
        }
    });
    
    console.log(`Filtered complete. Showing ${visibleCount} products.`);
}

// Enhanced search function that works with category filtering
function searchProducts() {
    const searchTerm = document.getElementById('searchProduct').value.toLowerCase().trim();
    const productItems = document.querySelectorAll('.product-item');
    
    console.log('Searching for:', searchTerm);
    
    if (searchTerm === '') {
        // If search is empty, restore category filter
        const activeTab = document.querySelector('#categoryTabs li.active');
        const activeCategoryId = activeTab ? activeTab.getAttribute('data-id') : 'all';
        console.log('Search cleared, restoring category filter:', activeCategoryId);
        filterProducts(activeCategoryId);
        return;
    }
    
    // Remove active state from category tabs when searching
    const categoryTabs = document.querySelectorAll('#categoryTabs li');
    categoryTabs.forEach(tab => tab.classList.remove('active'));
    
    let foundCount = 0;
    
    // Filter products by search term
    productItems.forEach(item => {
        const productNameElement = item.querySelector('.product-name a');
        const productSku = item.getAttribute('data-sku') || '';
        
        if (productNameElement) {
            const productName = productNameElement.textContent.toLowerCase();
            const skuLower = productSku.toLowerCase();
            
            if (productName.includes(searchTerm) || skuLower.includes(searchTerm)) {
                item.style.display = 'block';
                foundCount++;
            } else {
                item.style.display = 'none';
            }
        }
    });
    
    console.log(`Search complete. Found ${foundCount} matching products.`);
}

// Initialize category filtering when DOM is ready
function initializeCategoryFiltering() {
    console.log('Initializing category filtering...');
    
    // Add click event listeners to category tabs
    const categoryTabs = document.querySelectorAll('#categoryTabs li');
    console.log('Found category tabs:', categoryTabs.length);
    
    categoryTabs.forEach((tab, index) => {
        const categoryId = tab.getAttribute('data-id');
        console.log(`Tab ${index}: id=${categoryId}`);
        
        // Add click handler
        tab.addEventListener('click', function(e) {
            e.preventDefault();
            console.log('Category tab clicked:', categoryId);
            filterProducts(categoryId);
        });
    });
    
    // Set initial state - show all products with "All" category active
    filterProducts('all');
    
    console.log('Category filtering initialized successfully');
}

// Debug function to check product data
function debugProducts() {
    const productItems = document.querySelectorAll('.product-item');
    console.log('=== PRODUCT DEBUG INFO ===');
    console.log('Total products:', productItems.length);
    
    productItems.forEach((item, index) => {
        const categoryId = item.getAttribute('data-category');
        const productName = item.querySelector('.product-name a')?.textContent || 'Unknown';
        console.log(`Product ${index}: "${productName}" - Category: ${categoryId}`);
    });
    
    const categories = document.querySelectorAll('#categoryTabs li');
    console.log('=== CATEGORY DEBUG INFO ===');
    console.log('Total categories:', categories.length);
    
    categories.forEach((cat, index) => {
        const catId = cat.getAttribute('data-id');
        const catName = cat.querySelector('h6 a')?.textContent || 'Unknown';
        console.log(`Category ${index}: "${catName}" - ID: ${catId}`);
    });
}

        // Function to increase quantity
        function increaseQuantity(button) {
            const input = button.parentElement.querySelector('.product-qty');
            const currentValue = parseInt(input.value);
            const maxValue = parseInt(input.getAttribute('max'));
            if (currentValue < maxValue) {
                input.value = currentValue + 1;
            }
        }
        
        // Function to decrease quantity
        function decreaseQuantity(button) {
            const input = button.parentElement.querySelector('.product-qty');
            const currentValue = parseInt(input.value);
            if (currentValue > 1) {
                input.value = currentValue - 1;
            }
        }
        
        // Function to show payment options when Place Order is clicked
        function showPaymentOptions() {
            if (cart.length === 0) {
                showModal('error', 'Empty Cart', 'Cart is empty. Please add items before placing order.');
                return;
            }
            
            // Check if customer is selected
            const customerSelect = document.getElementById('customerSelect');
            if (!customerSelect || !customerSelect.value) {
                showModal('error', 'Customer Required', 'Please select a customer before placing order.');
                if (customerSelect) {
                    customerSelect.focus();
                }
                return;
            }
            
            // Update quick payment modal totals
            updateQuickPaymentModal();
            
            // Show payment options modal
            const paymentModal = new bootstrap.Modal(document.getElementById('quick-payment-modal'));
            paymentModal.show();
        }
        
        // Function to update quick payment modal totals
        function updateQuickPaymentModal() {
            const total = getCartTotal();
            const itemCount = cart.length;
            
            document.getElementById('quick-total-amount').textContent =  total.toFixed(2);
            document.getElementById('quick-item-count').textContent = itemCount + ' item(s)';
            
            // Update customer name
            const customerSelect = document.getElementById('customerSelect');
            const customerNameElement = document.getElementById('quick-customer-name');
            if (customerSelect && customerNameElement) {
                const selectedOption = customerSelect.options[customerSelect.selectedIndex];
                customerNameElement.textContent = selectedOption ? selectedOption.text : 'Walk in Customer';
            }
        }
        
        // Function to handle quick payment selection
        function selectQuickPayment(paymentMethod) {
            // Close the quick payment modal
            const quickModal = bootstrap.Modal.getInstance(document.getElementById('quick-payment-modal'));
            if (quickModal) {
                quickModal.hide();
            }
            
            // Call the main payment method selection
            selectPaymentMethod(paymentMethod);
        }
        
        // Global variable to store selected payment method
        let selectedPaymentMethod = null;
        
        // Function to validate and place order from payment modals
        function validateAndPlaceOrder(paymentMethod) {
            let isValid = true;
            let errorMessage = '';
            
            // Validate based on payment method
            if (paymentMethod === 'cash') {
                const received = parseFloat(document.getElementById('cash-received').value) || 0;
                const total = getCartTotal();
                if (received < total) {
                    isValid = false;
                    errorMessage = 'Cash received amount must be greater than or equal to total amount.';
                }
            } else if (paymentMethod === 'card') {
                // No validation required for card payment
            } else if (paymentMethod === 'points') {
                const pointsToUse = parseFloat(document.getElementById('points-to-use').value) || 0;
                if (pointsToUse <= 0) {
                    isValid = false;
                    errorMessage = 'Please enter valid points amount.';
                }
            } else if (paymentMethod === 'deposit') {
                const depositAmount = parseFloat(document.getElementById('deposit-amount').value) || 0;
                if (depositAmount <= 0) {
                    isValid = false;
                    errorMessage = 'Please enter valid deposit amount.';
                }
            } else if (paymentMethod === 'cheque') {
                const chequeNumber = document.getElementById('cheque-number').value.trim();
                const bankName = document.getElementById('bank-name').value.trim();
                
                if (!chequeNumber || !bankName) {
                    isValid = false;
                    errorMessage = 'Please fill in cheque number and bank name.';
                }
            } else if (paymentMethod === 'gift_card') {
                const giftCardNumber = document.getElementById('gift-card-number').value.trim();
                
                if (!giftCardNumber) {
                    isValid = false;
                    errorMessage = 'Please enter gift card number.';
                }
            } else if (paymentMethod === 'scan') {
                const scanCode = document.getElementById('scan-code').value.trim();
                
                if (!scanCode) {
                    isValid = false;
                    errorMessage = 'Please scan or enter payment code.';
                }
            } else if (paymentMethod === 'split') {
                const amount1 = parseFloat(document.getElementById('split-amount-1').value) || 0;
                const amount2 = parseFloat(document.getElementById('split-amount-2').value) || 0;
                const total = getCartTotal();
                
                if (Math.abs((amount1 + amount2) - total) > 0.01) {
                    isValid = false;
                    errorMessage = 'Split payment amounts must equal the total amount.';
                }
            }
            
            if (!isValid) {
                showModal('error', 'Validation Error', errorMessage);
                return;
            }
            
            // Close the payment modal
            const openModals = document.querySelectorAll('.modal.show');
            openModals.forEach(modal => {
                const modalInstance = bootstrap.Modal.getInstance(modal);
                if (modalInstance) {
                    modalInstance.hide();
                }
            });
            
            // Place the order
            placeOrder(paymentMethod);
        }
        
        // Function to select payment method directly
        function selectPaymentMethod(paymentMethod) {
            if (cart.length === 0) {
                showModal('error', 'Empty Cart', 'Cart is empty. Please add items before selecting payment method.');
                return;
            }
            
            // Check if customer is selected
            const customerSelect = document.getElementById('customerSelect');
            if (!customerSelect || !customerSelect.value) {
                showModal('error', 'Customer Required', 'Please select a customer before selecting payment method.');
                if (customerSelect) {
                    customerSelect.focus();
                }
                return;
            }
            
            // Store selected payment method
            selectedPaymentMethod = paymentMethod;
            
            // Update payment modal totals before showing
            updatePaymentModalTotals();
            
            // Show detailed payment modal based on method
            if (paymentMethod === 'cash') {
                updatePaymentModalTotals();
                const modal = new bootstrap.Modal(document.getElementById('payment-cash'));
                modal.show();
            } else if (paymentMethod === 'card') {
                updatePaymentModalTotals();
                const modal = new bootstrap.Modal(document.getElementById('payment-card'));
                modal.show();
            } else if (paymentMethod === 'points') {
                updatePaymentModalTotals();
                const modal = new bootstrap.Modal(document.getElementById('payment-points'));
                modal.show();
            } else if (paymentMethod === 'deposit') {
                updatePaymentModalTotals();
                const modal = new bootstrap.Modal(document.getElementById('payment-deposit'));
                modal.show();
            } else if (paymentMethod === 'cheque') {
                updatePaymentModalTotals();
                const modal = new bootstrap.Modal(document.getElementById('payment-cheque'));
                modal.show();
            } else if (paymentMethod === 'gift_card') {
                updatePaymentModalTotals();
                const modal = new bootstrap.Modal(document.getElementById('gift-payment'));
                modal.show();
            } else if (paymentMethod === 'scan') {
                updatePaymentModalTotals();
                const modal = new bootstrap.Modal(document.getElementById('scan-payment'));
                modal.show();
            } else if (paymentMethod === 'split') {
                updatePaymentModalTotals();
                const modal = new bootstrap.Modal(document.getElementById('split-payment'));
                modal.show();
            } else {
                // For other simple methods like pay_later and external, confirm and place order directly
                const total = getCartTotal();
                const customerName = customerSelect.options[customerSelect.selectedIndex].text;
                
                const confirmMessage = `Place order for ${customerName} using ${paymentMethod.replace('_', ' ').toUpperCase()} payment (${total.toFixed(2)})?`;
                
                showConfirmModal('Confirm Order', confirmMessage, function() {
                    placeOrder(paymentMethod);
                });
            }
        }
        
        // Function to place order
        function placeOrder(paymentMethod) {
            if (cart.length === 0) {
                showModal('error', 'Empty Cart', 'Cart is empty. Please add items before placing order.');
                return;
            }
            
            // Check if customer is selected
            const customerSelect = document.getElementById('customerSelect');
            if (!customerSelect || !customerSelect.value) {
                showModal('error', 'Customer Required', 'Please select a customer before placing order.');
                // Focus on customer dropdown
                if (customerSelect) {
                    customerSelect.focus();
                }
                return;
            }
            
            // Get current totals
            const subtotal = getCartSubtotal();
            const total = getCartTotal();
            
            // Get customer ID
            const customerId = customerSelect.value;
            
            // Prepare order data
            const orderData = {
                cart_items: cart,
                payment_method: paymentMethod,
                customer_id: customerId,
                subtotal: subtotal,
                tax_amount: 0, // You can add tax calculation logic here
                discount_amount: 0, // You can add discount calculation logic here
                total_amount: total,
                notes: ''
            };
            
            // Show loading state
            const placeOrderBtn = document.querySelector('.btn-secondary[onclick="showPaymentOptions()"]');
            if (placeOrderBtn) {
                placeOrderBtn.innerHTML = '<i class="ti ti-loader me-2"></i>Placing Order...';
                placeOrderBtn.disabled = true;
            }
            
            // Submit order to backend
            fetch('process_order.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(orderData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success message
//                    showModal('success', 'Order Placed', `Order placed successfully!\nOrder Number: ${data.order_number}\nTotal: ${data.total_amount.toFixed(2)}`);
                    
                    // Clear cart from database
                    fetch('cart_api.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: 'action=clear'
                    });
                    
                    // Clear local cart
                    cart = [];
                    updateCartDisplay();
                    
                    // Close any open modals
                    const openModals = document.querySelectorAll('.modal.show');
                    openModals.forEach(modal => {
                        const modalInstance = bootstrap.Modal.getInstance(modal);
                        if (modalInstance) {
                            modalInstance.hide();
                        }
                    });
                    
                    // Reset payment modal fields
                    resetPaymentModals();
                    
                    // Show success modal with order details
                    showOrderSuccessModal(data);
                    
                    // Store last order data for receipt
                    window.lastOrderData = {
                        order_number: data.order_number,
                        customer_name: customerSelect.options[customerSelect.selectedIndex].text,
                        customer_id: customerId,
                        total_amount: data.total_amount,
                        cart_items: [...cart],
                        subtotal: subtotal,
                        discount: parseFloat(document.getElementById('discountAmount').textContent.replace('-', '')) || 0,
                        shipping: parseFloat(document.getElementById('shippingCost').textContent) || 0,
                        tax: parseFloat(document.getElementById('taxAmount').textContent) || 0
                    };
                    
                    // Redirect to orders page after a short delay
                    setTimeout(() => {
                        window.location.href = 'orders.php';
                    }, 3000);
                    
                } else {
                    showModal('error', 'Order Error', 'Error placing order: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showModal('error', 'Connection Error', 'Error placing order. Please try again.');
            })
            .finally(() => {
                // Restore button state
                if (placeOrderBtn) {
                    placeOrderBtn.innerHTML = '<i class="ti ti-shopping-cart me-2"></i>Place Order';
                    placeOrderBtn.disabled = false;
                }
            });
        }
        

        
        // Function to get cart total
        function getCartTotal() {
            const subtotal = getCartSubtotal();
            const shipping = parseFloat(document.getElementById('shippingCost').textContent) || 0;
            const tax = parseFloat(document.getElementById('taxAmount').textContent) || 0;
            const coupon = parseFloat(document.getElementById('couponAmount').textContent) || 0;
            const discount = parseFloat(document.getElementById('discountAmount').textContent) || 0;
            const roundoff = parseFloat(document.getElementById('roundoffAmount').textContent) || 0;
            
            let total = subtotal + shipping + tax - coupon - discount + roundoff;
            
            // Apply roundoff if enabled
            const roundoffCheckbox = document.getElementById('round');
            if (roundoffCheckbox && roundoffCheckbox.checked) {
                // The discount is already negative, so we add it
                let totalBeforeRoundoff = subtotal + shipping + tax - coupon + discount;
                const rounded = Math.round(totalBeforeRoundoff);
                const roundoffValue = rounded - totalBeforeRoundoff;
                document.getElementById('roundoffAmount').textContent = roundoffValue.toFixed(2);
                total = rounded;
            } else {
                document.getElementById('roundoffAmount').textContent = '0.00';
                const rounded = Math.round(total);
                const roundoffValue = rounded - total;
                document.getElementById('roundoffAmount').textContent = roundoffValue.toFixed(2);
                total = rounded;
            }
            
            return Math.max(0, total);
        }
        
        // Function to get cart subtotal (includes exchange calculations)
        function getCartSubtotal() {
            return cart.reduce((total, item) => {
                // Include all items - regular products and exchange items (including negative prices)
                return total + (item.price * item.quantity);
            }, 0);
        }
        
        // Function to reset payment modals
        function resetPaymentModals() {
            // Reset cash payment modal
            document.getElementById('cash-received').value = '';
            document.getElementById('cash-change').textContent = '0.00';
            
            // Reset card payment modal
            document.getElementById('card-number').value = '';
            document.getElementById('card-expiry').value = '';
            document.getElementById('card-cvv').value = '';
            
            // Reset other modals as needed
            document.getElementById('cheque-number').value = '';
            document.getElementById('bank-name').value = '';
            document.getElementById('gift-card-number').value = '';
            document.getElementById('scan-code').value = '';
        }
        
        // Function to update payment modal totals
        function updatePaymentModalTotals() {
            const total = getCartTotal();
            const totalFormatted =  total.toFixed(2);

            // Update all payment modal totals
            const totalElements = [
                'cash-total-amount',
                'card-total-amount', 
                'points-total-amount',
                'deposit-total-amount',
                'cheque-total-amount',
                'gift-total-amount',
                'scan-total-amount',
                'split-total-amount',
                'quick-total-amount'
            ];

            totalElements.forEach(id => {
                const element = document.getElementById(id);
                if (element) {
                    element.textContent = totalFormatted;
                }
            });

            // Set cart total as default value in cash received field
            const cashReceivedInput = document.getElementById('cash-received');
            if (cashReceivedInput) {
                cashReceivedInput.value = total.toFixed(2);
                // Trigger change calculation
                calculateCashChange();
            }

            // Set cart total as default value in card received field
            const cardReceivedInputs = document.querySelectorAll('#payment-card input[type="text"]');
            if (cardReceivedInputs.length > 0) {
                cardReceivedInputs[0].value = total.toFixed(2); // First input is received amount
                cardReceivedInputs[1].value = total.toFixed(2); // Second input is paying amount
            }

            // Update quick payment modal item count
            const itemCount = cart.length;
            const quickItemCount = document.getElementById('quick-item-count');
            if (quickItemCount) {
                quickItemCount.textContent = itemCount + ' item(s)';
            }
        }

        
        // Function to calculate cash change
        function calculateCashChange() {
            const total = getCartTotal();
            const received = parseFloat(document.getElementById('cash-received').value) || 0;
            const change = received - total;
            
            document.getElementById('cash-change').textContent = Math.max(0, change).toFixed(2);
        }
        
        // Function to calculate split payment amounts
        function calculateSplitAmounts() {
            const total = getCartTotal();
            const amount1 = parseFloat(document.getElementById('split-amount-1').value) || 0;
            const amount2 = total - amount1;
            
            document.getElementById('split-amount-2').value = Math.max(0, amount2).toFixed(2);
        }
        
        // Function to show order success modal
        function showOrderSuccessModal(orderData) {
            // Update modal content
            document.getElementById('completed-order-number').textContent = orderData.order_number;
            document.getElementById('completed-total-amount').textContent =  orderData.total_amount.toFixed(2);
            document.getElementById('completed-payment-method').textContent = orderData.payment_method.replace('_', ' ').toUpperCase();
            
            // Show the modal
            const successModal = new bootstrap.Modal(document.getElementById('payment-completed'));
            successModal.show();
        }
        
        // Function to load cart from database
        function loadCart() {
            fetch('cart_api.php?action=get')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    cart = data.cart;
                    updateCartDisplay();
                } else {
                    console.error('Failed to load cart:', data.message);
                }
            })
            .catch(error => {
                console.error('Error loading cart:', error);
            });
        }
        
        // Function to prepare hold order modal
        function prepareHoldModal() {
            if (cart.length === 0) {
                showModal('error', 'Empty Cart', 'Cart is empty. Please add items before holding order.');
                return false;
            }
            
            // Check if customer is selected
            const customerSelect = document.getElementById('customerSelect');
            if (!customerSelect || !customerSelect.value) {
                showModal('error', 'Customer Required', 'Please select a customer before holding order.');
                if (customerSelect) {
                    customerSelect.focus();
                }
                return false;
            }
            
            // Generate hold reference
            const holdRef = 'HOLD-' + Date.now();
            
            // Update hold modal with order details
            const customerName = customerSelect.options[customerSelect.selectedIndex].text;
            const total = getCartTotal();
            const itemCount = cart.length;
            
            document.getElementById('hold-customer-name').textContent = customerName;
            document.getElementById('hold-total-amount').textContent = total.toFixed(2);
            document.getElementById('hold-item-count').textContent = itemCount + ' item(s)';
            document.getElementById('hold-reference').textContent = holdRef;
            document.getElementById('hold-notes').value = '';
            
            // Store reference for later use
            window.currentHoldReference = holdRef;
            
            return true;
        }
        
        // Function to confirm hold order
        function confirmHoldOrder() {
            const customerSelect = document.getElementById('customerSelect');
            const holdRef = window.currentHoldReference;
            
            // Prepare hold data
            const holdData = {
                cart_items: cart,
                customer_id: customerSelect.value,
                subtotal: getCartSubtotal(),
                total_amount: getCartTotal(),
                hold_reference: holdRef,
                notes: document.getElementById('hold-notes').value || 'Order on hold'
            };
            
            // Submit hold order to backend
            fetch('hold_order.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(holdData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Close modal
                    const holdModal = bootstrap.Modal.getInstance(document.getElementById('hold-order'));
                    holdModal.hide();
                    
                    showModal('success', 'Order Held', `Order held successfully!\nReference: ${holdRef}\nYou can retrieve this order from pending orders.`);
                    
                    // Clear cart from database
                    fetch('cart_api.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: 'action=clear'
                    });
                    
                    // Clear local cart
                    cart = [];
                    updateCartDisplay();
                    
                    // Clear hold notes
                    document.getElementById('hold-notes').value = '';
                    
                    // Keep customer selected for next order
                    
                } else {
                    showModal('error', 'Hold Error', 'Error holding order: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showModal('error', 'Connection Error', 'Error holding order. Please try again.');
            });
        }
        
        // Function to load orders by status
        function loadOrders(status) {
            const containerId = status + '-orders';
            const container = document.getElementById(containerId);
            
            if (!container) return;
            
            container.innerHTML = '<div class="text-center p-3"><p>Loading orders...</p></div>';
            
            fetch(`orders_api.php?status=${status}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    displayOrders(data.orders, containerId);
                } else {
                    container.innerHTML = '<div class="text-center p-3"><p class="text-danger">Error loading orders</p></div>';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                container.innerHTML = '<div class="text-center p-3"><p class="text-danger">Error loading orders</p></div>';
            });
        }
        
        // Function to display orders
        function displayOrders(orders, containerId) {
            const container = document.getElementById(containerId);
            
            if (orders.length === 0) {
                container.innerHTML = '<div class="text-center p-3"><p>No orders found</p></div>';
                return;
            }
            
            let html = '';
            orders.forEach(order => {
                const date = new Date(order.created_at).toLocaleString();
                const notes = order.notes ? `<div class="bg-info-transparent p-1 rounded text-center my-3"><p class="text-info fw-medium">${order.notes}</p></div>` : '';
                
                html += `
                    <div class="card bg-light mb-3">
                        <div class="card-body">
                            <span class="badge bg-dark fs-12 mb-2">Order ID : ${order.order_number || '#' + order.id}</span>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <p class="fs-15 mb-1"><span class="fs-14 fw-bold text-gray-9">Cashier :</span> ${order.cashier_name || 'N/A'}</p>
                                    <p class="fs-15"><span class="fs-14 fw-bold text-gray-9">Total :</span> ${parseFloat(order.total_amount).toFixed(2)}</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="fs-15 mb-1"><span class="fs-14 fw-bold text-gray-9">Customer :</span> ${order.customer_name || 'Walk-in'}</p>
                                    <p class="fs-15"><span class="fs-14 fw-bold text-gray-9">Date :</span> ${date}</p>
                                </div>
                            </div>
                            ${notes}
                            <div class="d-flex align-items-center justify-content-center flex-wrap gap-2">
                                <a href="javascript:void(0);" class="btn btn-md btn-teal" onclick="viewOrderProducts(${order.id})">View Products</a>
                                <a href="javascript:void(0);" class="btn btn-md btn-indigo" onclick="printOrder(${order.id})">Print</a>
                            </div>
                        </div>
                    </div>
                `;
            });
            
            container.innerHTML = html;
        }
        
        // Function to open order (restore to cart)
        function openOrder(orderId) {
            // Implementation for opening/restoring order to cart
            console.log('Opening order:', orderId);
        }
        
        // Function to view order products
        function viewOrderProducts(orderId) {
            console.log('Viewing products for order:', orderId);

            // Close any currently open modals first
            const openModals = document.querySelectorAll('.modal.show');
            openModals.forEach(openModalEl => {
                const openModalInstance = bootstrap.Modal.getInstance(openModalEl) || bootstrap.Modal.getOrCreateInstance(openModalEl);
                openModalInstance.hide();
            });

            // Now fetch and open the products modal
            fetch(window.location.pathname + '?action=getOrderItems&order_id=' + orderId)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok, status ' + response.status);
                    }
                    return response.json();
                })
                .then(data => {
                    if (!data.products || data.products.length === 0) {
                        showModal('error', 'No Products', 'No products found for this order.');
                        return;
                    }

                    // Update modal header
                    document.querySelector('#products .badge').textContent =
                        'Order ID : #' + (data.order_number || orderId);
                    document.querySelector('#products .fs-16').textContent =
                        'Number of Products : ' + data.products.length;

                    // Build products HTML
                    let productsHtml = '';
                    data.products.forEach(p => {
                        productsHtml += `
                            <div class="product-list bg-white align-items-center justify-content-between">
                                <div class="d-flex align-items-center product-info">
                                    <a href="javascript:void(0);" class="pro-img">
                                        <img src="assets/img/products/${p.image || 'images(1).jpg'}" alt="${p.name || ''}">
                                    </a>
                                    <div class="info">
                                        <h6><a href="javascript:void(0);">${p.name || ''}</a></h6>
                                        <p>Quantity : ${p.quantity || 0}</p>
                                    </div>
                                </div>
                                <p class="text-teal fw-bold">${p.price !== undefined ? parseFloat(p.price).toFixed(2) : '0.00'}</p>
                            </div>
                        `;
                    });

                    // Fill modal body
                    document.querySelector('#products .product-wrap').innerHTML = productsHtml;

                    // Show the products modal after a tiny delay (allow first to hide)
                    const modalEl = document.getElementById('products');
                    const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
                    setTimeout(() => modal.show(), 300); // <-- wait for animation to finish
                })
                .catch(err => {
                    console.error('Error loading order products:', err);
                    showModal('error', 'Load Error', 'Failed to load order products: ' + err.message);
                });
        }
    
        // Function to print order
        function printOrder(orderId) {
            // Implementation for printing order
            console.log('Printing order:', orderId);
        }
        
        // Function to show print receipt modal with current cart data from database
        function showPrintReceiptFromCart() {
            // Fetch cart data from database
            fetch('receipt_api.php')
            .then(response => response.json())
            .then(data => {
                if (!data.success) {
                    showModal('error', 'Load Error', 'Error loading cart data: ' + data.message);
                    return;
                }
                
                if (data.cart_items.length === 0) {
                    showModal('error', 'Empty Cart', 'Cart is empty. Cannot generate receipt.');
                    return;
                }
                
                // Get customer info
                const customerSelect = document.getElementById('customerSelect');
                const customerName = customerSelect && customerSelect.value ? 
                    customerSelect.options[customerSelect.selectedIndex].text : 'Walk in Customer';
                const customerId = customerSelect && customerSelect.value ? 
                    '#' + customerSelect.value : '#WALKIN';
                
                // Generate invoice number
                const invoiceNo = 'INV' + Date.now();
                
                // Get current date
                const currentDate = new Date().toLocaleDateString();
                
                // Populate receipt header data
                document.getElementById('receipt-customer-name').textContent = customerName;
                document.getElementById('receipt-invoice-no').textContent = invoiceNo;
                document.getElementById('receipt-customer-id').textContent = customerId;
                document.getElementById('receipt-date').textContent = currentDate;
                
                // Populate items from database
                const receiptItems = document.getElementById('receipt-items');
                receiptItems.innerHTML = '';
                
                data.cart_items.forEach((item, index) => {
                    receiptItems.innerHTML += `
                        <tr>
                            <td>${index + 1}. ${item.name}</td>
                            <td>${item.price.toFixed(2)}</td>
                            <td>${item.quantity}</td>
                            <td class="text-end">${item.total.toFixed(2)}</td>
                        </tr>
                    `;
                });
                
                // Get discount from UI
                const discount = parseFloat(document.getElementById('discountAmount').textContent.replace('-', '')) || 0;
                const shipping = parseFloat(document.getElementById('shippingCost').textContent) || 0;
                
                // Calculate final totals (no tax)
                const finalTotal = data.subtotal + shipping - discount;
                
                // Populate totals
                document.getElementById('receipt-subtotal').textContent = data.subtotal.toFixed(2);
                document.getElementById('receipt-discount').textContent = discount > 0 ? '-' + discount.toFixed(2) : '0.00';
                document.getElementById('receipt-shipping').textContent = shipping.toFixed(2);
                document.getElementById('receipt-tax').textContent = '0.00';
                document.getElementById('receipt-total-bill').textContent = finalTotal.toFixed(2);
                document.getElementById('receipt-due').textContent = '0.00';
                document.getElementById('receipt-total-payable').textContent = finalTotal.toFixed(2);
                
                // Set sale number
                document.getElementById('receipt-sale-number').textContent = 'Sale ' + Date.now().toString().slice(-4);
                
            })
            .catch(error => {
                console.error('Error:', error);
                showModal('error', 'Connection Error', 'Failed to load cart data for receipt.');
            });
        }
        
        // Function to show print receipt modal with current cart data (legacy)
        function showPrintReceipt() {
            showPrintReceiptFromCart();
        }
        
        // Function to print receipt
        function printReceipt() {
            window.print();
        }
        
        // Initialize cart display on page load
        document.addEventListener('DOMContentLoaded', function() {
    loadCart(); // Your existing code
    
    // Debug function to see what we're working with
    setTimeout(() => {
        debugProducts();
    }, 1000);
    
    // Initialize category filtering
    initializeCategoryFiltering();
    
    // Add event listener for hold modal
    const holdModal = document.getElementById('hold-order');
    if (holdModal) {
        holdModal.addEventListener('show.bs.modal', function(event) {
            if (!prepareHoldModal()) {
                event.preventDefault();
                return false;
            }
        });
    }
    
    // Your existing code continues here (customer handling, event listeners, etc.)
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('customer_added') === '1') {
        // ... your existing customer code
    }
    

    
    // Your existing event listeners
    document.getElementById('cash-received').addEventListener('input', calculateCashChange);
    document.getElementById('split-amount-1').addEventListener('input', calculateSplitAmounts);
    
            
            // Update payment modal totals when cart changes
            const observer = new MutationObserver(function(mutations) {
                mutations.forEach(function(mutation) {
                    if (mutation.type === 'childList' || mutation.type === 'attributes') {
                        updatePaymentModalTotals();
                    }
                });
            });
            
            // Observe cart changes
            const cartContainer = document.getElementById('cartItemsList');
            if (cartContainer) {
                observer.observe(cartContainer, { childList: true, subtree: true });
            }
        });
        
        function updateCustomerInfo() {
    const select = document.getElementById('customerSelect');
    const customerDetails = document.getElementById('customerDetails');
    const customerName = document.getElementById('customerName');
    const customerBonus = document.getElementById('customerBonus');
    const customerLoyalty = document.getElementById('customerLoyalty');

    const selectedOption = select.options[select.selectedIndex];
    const selectedValue = select.value;

    // Hide details if no customer or walk-in selected
    if (selectedValue === '' || selectedValue === 'walkin') {
        customerDetails.style.display = 'none';
        return;
    }

    // Get data from selected option's data attributes
    const name = selectedOption.getAttribute('data-name');
    const bonus = selectedOption.getAttribute('data-bonus');
    const loyalty = selectedOption.getAttribute('data-loyalty');

    // Update customer information display
    if (name) {
        customerName.textContent = name;
        customerBonus.textContent = bonus || '0';
        customerLoyalty.textContent =  (loyalty || '0.00');
        
        // Show customer details
        customerDetails.style.display = 'flex';
    }
}

function applyCustomer() {
    const select = document.getElementById('customerSelect');
    const selectedValue = select.value;
    
    if (selectedValue && selectedValue !== '' && selectedValue !== 'walkin') {
        const customerName = document.getElementById('customerName').textContent;
        
        // Add your logic here to apply customer to order/form
        showModal('success', 'Customer Applied', 'Customer ' + customerName + ' applied successfully!');
        
        // Example: Update a hidden form field
        // document.getElementById('selected_customer_id').value = selectedValue;
    }
}

function clearCustomer() {
    document.getElementById('customerSelect').value = '';
    document.getElementById('customerDetails').style.display = 'none';
    
    // Clear any form fields if needed
    // document.getElementById('selected_customer_id').value = '';
}







function displayOrders(orders, containerId) {
    const container = document.getElementById(containerId);
    
    if (orders.length === 0) {
        container.innerHTML = '<div class="text-center p-3"><p>No orders found</p></div>';
        return;
    }
    
    let html = '';
    orders.forEach(order => {
        const date = new Date(order.created_at).toLocaleString();
        const notes = order.notes ? `<div class="bg-info-transparent p-1 rounded text-center my-3"><p class="text-info fw-medium">${order.notes}</p></div>` : '';
        
        // Add revive button only for hold orders (containerId === 'onhold')
        const reviveButton = containerId === 'onhold' ? 
            `<a href="javascript:void(0);" class="btn btn-md btn-success" onclick="reviveOrder(${order.id})">Revive Order</a>` : '';
        
        html += `
            <div class="card bg-light mb-3">
                <div class="card-body">
                    <span class="badge bg-dark fs-12 mb-2">Order ID : ${order.order_number || '#' + order.id}</span>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <p class="fs-15 mb-1"><span class="fs-14 fw-bold text-gray-9">Cashier :</span> ${order.cashier_name || 'N/A'}</p>
                            <p class="fs-15"><span class="fs-14 fw-bold text-gray-9">Total :</span> ${parseFloat(order.total_amount).toFixed(2)}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="fs-15 mb-1"><span class="fs-14 fw-bold text-gray-9">Customer :</span> ${order.customer_name || 'Walk-in'}</p>
                            <p class="fs-15"><span class="fs-14 fw-bold text-gray-9">Date :</span> ${date}</p>
                        </div>
                    </div>
                    ${notes}
                    <div class="d-flex align-items-center justify-content-center flex-wrap gap-2">
                        <a href="javascript:void(0);" class="btn btn-md btn-teal" onclick="viewOrderProducts(${order.id})">View Products</a>
                        <a href="javascript:void(0);" class="btn btn-md btn-indigo" onclick="printOrder(${order.id})">Print</a>
                        ${reviveButton}
                    </div>
                </div>
            </div>
        `;
    });
    
    container.innerHTML = html;
}

// Load orders function
function loadOrders(type) {
    fetch('get_hold_orders.php?type=' + type)
    .then(response => response.json())
    .then(data => {
        let containerId;
        if (type === 'hold') {
            containerId = 'onhold';
        } else if (type === 'unpaid') {
            containerId = 'unpaid';
        } else if (type === 'paid') {
            containerId = 'paid';
        }
        
        if (data.success && data.orders) {
            displayOrders(data.orders, containerId);
        } else {
            displayOrders([], containerId);
        }
    })
    .catch(error => {
        console.error('Error loading orders:', error);
    });
}

// Track revived order
let revivedOrderId = null;

// Revive order function
function reviveOrder(orderId) {
    if (!confirm('Are you sure you want to revive this order?')) {
        return;
    }
    
    fetch('revive_order.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ order_id: orderId })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Clear current cart
            clearCart();
            
            // Track revived order ID
            revivedOrderId = data.revived_order_id;
            
            // Load order items into cart
            data.order_items.forEach(item => {
                addToCart(item.product_id, item.quantity, item.price);
            });
            
            // Select customer if order has one
            if (data.order.customer_id) {
                const customerSelect = document.getElementById('customerSelect');
                if (customerSelect) {
                    customerSelect.value = data.order.customer_id;
                    updateCustomerInfo();
                }
            }
            
            // Close orders modal
            const ordersModal = bootstrap.Modal.getInstance(document.getElementById('orders'));
            if (ordersModal) {
                ordersModal.hide();
            }
            
            // Refresh hold orders list
            loadOrders('hold');
            
            showModal('success', 'Order Revived', 'Order has been loaded into your cart successfully!');
        } else {
            showModal('error', 'Error', data.message || 'Failed to revive order');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showModal('error', 'Error', 'Failed to revive order');
    });
}

// Restore order function
function restoreOrder(orderId) {
    fetch('restore_order.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ order_id: orderId })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            revivedOrderId = null;
        }
    })
    .catch(error => {
        console.error('Error restoring order:', error);
    });
}

// Override clearCart to restore order if needed
function clearCartWithRestore() {
    if (revivedOrderId) {
        restoreOrder(revivedOrderId);
    }
    clearCart();
}

// Exchange functionality
let returnItems = [];
let exchangeItems = [];

// Open exchange modal
function openExchange() {
    if (cart.length === 0) {
        showModal('error', 'Empty Cart', 'Add items to cart first to exchange');
        return;
    }
    
    // Check if customer is selected
    const customerSelect = document.getElementById('customerSelect');
    if (!customerSelect || !customerSelect.value) {
        showModal('error', 'Customer Required', 'Please select a customer before exchange.');
        if (customerSelect) {
            customerSelect.focus();
        }
        return;
    }
    
    // Reset exchange data
    returnItems = [];
    exchangeItems = [];
    
    // Load return items and exchange products
    loadReturnItems();
    loadExchangeProducts();
    
    // Show modal
    const exchangeModal = new bootstrap.Modal(document.getElementById('exchange-modal'));
    exchangeModal.show();
}

// Load current cart items (what customer is exchanging)
function loadReturnItems() {
    const container = document.getElementById('return-items-list');
    let html = '';
    
    cart.forEach(item => {
        html += `
            <div class="p-2 border rounded mb-2">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <strong>${item.name}</strong><br>
                        <small>Qty: ${item.quantity} × ${item.price.toFixed(2)}</small>
                    </div>
                    <span class="fw-bold">${(item.quantity * item.price).toFixed(2)}</span>
                </div>
            </div>
        `;
    });
    
    container.innerHTML = html;
    updateReturnTotal();
}

// Load all products for exchange selection
function loadExchangeProducts() {
    fetch('get_all_products.php')
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            displayExchangeProducts(data.products);
        } else {
            showModal('error', 'Error', 'Failed to load products');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showModal('error', 'Error', 'Failed to load products');
    });
}

// Display exchange products
function displayExchangeProducts(products) {
    const container = document.getElementById('exchange-products-grid');
    let html = '';
    
    products.forEach(product => {
        html += `
            <div class="card mb-2">
                <div class="card-body p-2">
                    <div class="d-flex align-items-center">
                        <img src="assets/img/products/${product.image || 'images(1).jpg'}" alt="${product.name}" class="me-2" style="width: 40px; height: 40px; object-fit: cover;">
                        <div class="flex-grow-1">
                            <h6 class="mb-1">${product.name}</h6>
                            <small class="text-muted">Price: ${parseFloat(product.price).toFixed(2)}</small>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <input type="number" class="form-control form-control-sm" style="width: 60px;" min="0" value="0" id="exchange-qty-${product.id}" onchange="updateExchangeSelection()">
                            <button class="btn btn-sm btn-primary" onclick="addToExchange(${product.id}, '${product.name}', ${product.price})">
                                <i class="ti ti-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        `;
    });
    
    container.innerHTML = html;
}

// Add product to exchange list
function addToExchange(productId, productName, price) {
    const qtyInput = document.getElementById(`exchange-qty-${productId}`);
    const quantity = parseInt(qtyInput.value) || 0;
    
    if (quantity <= 0) {
        showModal('error', 'Invalid Quantity', 'Please enter a valid quantity');
        return;
    }
    
    // Calculate current cart total (what customer is paying for)
    const cartTotal = getCartTotal();
    
    if (cartTotal === 0) {
        showModal('error', 'Empty Cart', 'Please add items to cart first');
        return;
    }
    
    // Calculate new exchange total if this item is added
    const currentExchangeTotal = exchangeItems.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    const newItemTotal = price * quantity;
    const newExchangeTotal = currentExchangeTotal + newItemTotal;
    
    // Check if new exchange total exceeds cart total
    if (newExchangeTotal > cartTotal) {
        const maxAllowed = cartTotal - currentExchangeTotal;
        showModal('error', 'Exchange Limit Exceeded', `Exchange total cannot exceed cart total.\nCart Total: ${cartTotal.toFixed(2)}\nCurrent Exchange: ${currentExchangeTotal.toFixed(2)}\nMax Additional: ${maxAllowed.toFixed(2)}`);
        return;
    }
    
    // Check if item already exists in exchange list
    const existingIndex = exchangeItems.findIndex(item => item.product_id === productId);
    
    if (existingIndex >= 0) {
        exchangeItems[existingIndex].quantity += quantity;
    } else {
        exchangeItems.push({
            product_id: productId,
            name: productName,
            price: price,
            quantity: quantity
        });
    }
    
    qtyInput.value = 0;
    updateExchangeTotal();
    updateExchangeBalance();
    updateSelectedExchangeList();
}

// Set all cart items as return items (since we're exchanging the whole cart)
function updateReturnSelection() {
    returnItems = cart.map(item => ({
        product_id: item.id,
        name: item.name,
        price: item.price,
        quantity: item.quantity
    }));
    
    updateReturnTotal();
    updateExchangeBalance();
}

// Update exchange selection
function updateExchangeSelection() {
    updateExchangeTotal();
    updateExchangeBalance();
}

// Update return total
function updateReturnTotal() {
    const total = getCartTotal();
    document.getElementById('return-total').textContent = total.toFixed(2);
}

// Update exchange total
function updateExchangeTotal() {
    const total = exchangeItems.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    document.getElementById('exchange-total').textContent = total.toFixed(2);
}

// Update selected exchange products list
function updateSelectedExchangeList() {
    const container = document.getElementById('selected-exchange-list');
    
    if (exchangeItems.length === 0) {
        container.innerHTML = `
            <div class="text-center text-muted p-3">
                <i class="ti ti-package fs-24 mb-2"></i>
                <p class="mb-0">No exchange products selected</p>
            </div>
        `;
        return;
    }
    
    let html = '';
    exchangeItems.forEach((item, index) => {
        html += `
            <div class="d-flex justify-content-between align-items-center p-2 border rounded mb-2">
                <div class="d-flex align-items-center">
                    <span class="badge bg-success me-2">
                        <i class="ti ti-refresh"></i>
                    </span>
                    <div>
                        <h6 class="mb-1">${item.name}</h6>
                        <small class="text-muted">Qty: ${item.quantity} × ${item.price.toFixed(2)}</small>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span class="fw-bold text-success">${(item.price * item.quantity).toFixed(2)}</span>
                    <button class="btn btn-sm btn-outline-danger" onclick="removeExchangeItem(${index})">
                        <i class="ti ti-x"></i>
                    </button>
                </div>
            </div>
        `;
    });
    
    container.innerHTML = html;
}

// Remove exchange item
function removeExchangeItem(index) {
    exchangeItems.splice(index, 1);
    updateExchangeTotal();
    updateExchangeBalance();
    updateSelectedExchangeList();
}

// Clear all exchange selections
function clearExchangeSelection() {
    exchangeItems = [];
    updateExchangeTotal();
    updateExchangeBalance();
    updateSelectedExchangeList();
}

// Update exchange balance
function updateExchangeBalance() {
    const cartTotal = getCartTotal();
    const exchangeTotal = exchangeItems.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    const balance = cartTotal - exchangeTotal;
    
    const balanceElement = document.getElementById('exchange-balance');
    
    if (balance > 0) {
        balanceElement.innerHTML = `<span class="text-success">Customer Pays: ${balance.toFixed(2)}</span>`;
    } else if (balance === 0) {
        balanceElement.innerHTML = `<span class="text-info">Even Exchange</span>`;
    } else {
        balanceElement.innerHTML = `<span class="text-danger">Exchange Exceeds Cart Value</span>`;
    }
}

// Process exchange
function processExchange() {
    if (cart.length === 0) {
        showModal('error', 'Empty Cart', 'Please add items to cart first');
        return;
    }
    
    if (exchangeItems.length === 0) {
        showModal('error', 'No Exchange Items', 'Please select items to exchange');
        return;
    }
    
    const cartTotal = getCartTotal();
    const exchangeTotal = exchangeItems.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    const payableAmount = cartTotal - exchangeTotal;
    
    if (payableAmount < 0) {
        showModal('error', 'Invalid Exchange', 'Exchange total cannot exceed cart total');
        return;
    }
    
    // Add only exchange discount (negative amount) with the first exchange product's ID
    const firstExchangeProduct = exchangeItems[0];
    
    fetch('cart_api.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `action=add_exchange&product_id=${firstExchangeProduct.product_id}&quantity=1&price=-${exchangeTotal}&name=Exchange Discount`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            finishExchange(payableAmount);
        } else {
            showModal('error', 'Error', 'Failed to process exchange: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showModal('error', 'Error', 'Failed to process exchange');
    });
}

// Finish exchange process
function finishExchange(payableAmount) {
    // Close modal
    const exchangeModal = bootstrap.Modal.getInstance(document.getElementById('exchange-modal'));
    exchangeModal.hide();
    
    // Reload cart and wait for completion
    setTimeout(() => {
        loadCart();
        
        // Show success message after cart is loaded
        setTimeout(() => {
            let message = 'Cart updated with exchange items.';
            if (payableAmount > 0) {
                message += ` Customer pays: ${payableAmount.toFixed(2)}`;
            } else {
                message += ' Even exchange.';
            }
            message += ' Please proceed with payment.';
            
            showModal('success', 'Exchange Ready', message);
        }, 500);
    }, 200);
}



// Show schemes modal
function showSchemesModal() {
    const modal = new bootstrap.Modal(document.getElementById('schemes-modal'));
    modal.show();
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    const customerDetails = document.getElementById('customerDetails');
    if (customerDetails) {
        customerDetails.style.display = 'none';
    }
    
    // Add event listeners for order tabs
    const onholdTab = document.getElementById('onhold-tab');
    if (onholdTab) {
        onholdTab.addEventListener('click', () => loadOrders('hold'));
    }
    
    const unpaidTab = document.getElementById('unpaid-tab');
    if (unpaidTab) {
        unpaidTab.addEventListener('click', () => loadOrders('unpaid'));
    }
    
    const paidTab = document.getElementById('paid-tab');
    if (paidTab) {
        paidTab.addEventListener('click', () => loadOrders('paid'));
    }
    
    // Load orders when modal is shown
    const ordersModal = document.getElementById('orders');
    if (ordersModal) {
        ordersModal.addEventListener('show.bs.modal', function() {
            loadOrders('hold'); // Load hold orders by default
        });
    }
    
    // Add search functionality for exchange products
    const exchangeSearch = document.getElementById('exchange-search');
    if (exchangeSearch) {
        exchangeSearch.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const productCards = document.querySelectorAll('#exchange-products-grid .card');
            
            productCards.forEach(card => {
                const productName = card.querySelector('h6').textContent.toLowerCase();
                if (productName.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    }
});
    </script>
    <style>
        /* Modal Styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            animation: fadeIn 0.3s ease;
        }

        .custom-modal {
            background: white;
            border-radius: 12px;
            padding: 24px;
            max-width: 400px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            animation: slideIn 0.3s ease;
            margin: auto;
        }

        .modal-header {
            display: flex;
            align-items: center;
            margin-bottom: 16px;
        }

        .modal-icon {
            width: 24px;
            height: 24px;
            margin-right: 12px;
        }

        .modal-icon.success {
            color: #10b981;
        }

        .modal-icon.error {
            color: #ef4444;
        }

        .modal-icon.warning {
            color: #f59e0b;
        }

        .btn-danger {
            background: #ef4444;
            color: white;
        }

        .btn-danger:hover {
            background: #dc2626;
        }

        .modal-title {
            font-size: 18px;
            font-weight: 600;
            margin: 0;
        }

        .modal-message {
            color: #6b7280;
            margin-bottom: 20px;
            line-height: 1.5;
        }

        .modal-buttons {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
        }

        .btn {
            padding: 8px 16px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.2s;
        }

        .btn-primary {
            background: #3b82f6;
            color: white;
        }

        .btn-primary:hover {
            background: #2563eb;
        }

        .btn-secondary {
            background: #f3f4f6;
            color: #374151;
        }

        .btn-secondary:hover {
            background: #e5e7eb;
        }

        /* Toast Notification Styles */
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
        }

        .toast {
            background: white;
            border-radius: 8px;
            padding: 16px;
            margin-bottom: 12px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            min-width: 300px;
            animation: slideInRight 0.3s ease;
            border-left: 4px solid #10b981;
        }

        .toast.error {
            border-left-color: #ef4444;
        }

        .toast-icon {
            width: 20px;
            height: 20px;
            margin-right: 12px;
            flex-shrink: 0;
        }

        .toast-content {
            flex: 1;
        }

        .toast-title {
            font-weight: 600;
            margin-bottom: 4px;
        }

        .toast-message {
            color: #6b7280;
            font-size: 14px;
        }

        .toast-close {
            background: none;
            border: none;
            cursor: pointer;
            padding: 4px;
            margin-left: 12px;
            color: #9ca3af;
        }

        .toast-close:hover {
            color: #374151;
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-20px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(100%);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideOutRight {
            from {
                opacity: 1;
                transform: translateX(0);
            }
            to {
                opacity: 0;
                transform: translateX(100%);
            }
        }

        /* Demo styles */
        .demo-section {
            padding: 20px;
            margin: 20px 0;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
        }

        .demo-buttons {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        h2 {
            margin-top: 0;
            color: #374151;
        }
        
        .btn-purple {
            background-color: #8b5cf6 !important;
            border-color: #8b5cf6 !important;
            color: white !important;
        }
        
        .btn-purple:hover {
            background-color: #7c3aed !important;
            border-color: #7c3aed !important;
        }
        
        /* Schemes Modal Styles */
        .bg-gradient-purple {
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        }
        
        .scheme-icon-wrapper {
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .empty-state .empty-icon {
            width: 80px;
            height: 80px;
            background: #f8fafc;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
        }
        
        .empty-state .empty-icon i {
            font-size: 32px;
            color: #cbd5e1;
        }
        
        .schemes-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 20px;
        }
        
        .scheme-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.3s ease;
            position: relative;
        }
        
        .scheme-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            border-color: #8b5cf6;
        }
        
        .scheme-header {
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
            padding: 12px 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .discount-badge {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            padding: 8px 12px;
            text-align: center;
            backdrop-filter: blur(10px);
        }
        
        .discount-value {
            display: inline;
            font-size: 16px;
            font-weight: 700;
            color: white;
            line-height: 1;
        }
        
        .discount-text {
            display: inline;
            font-size: 16px;
            font-weight: 700;
            color: white;
            margin-left: 2px;
        }
        
        .status-badge {
            background: rgba(16, 185, 129, 0.2);
            color: #10b981;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 4px;
            backdrop-filter: blur(10px);
        }
        
        .scheme-body {
            padding: 24px;
        }
        
        .scheme-title {
            font-size: 18px;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 8px;
        }
        
        .scheme-description {
            color: #64748b;
            font-size: 14px;
            line-height: 1.5;
            margin-bottom: 20px;
        }
        
        .scheme-details {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        
        .detail-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: #475569;
        }
        
        .detail-item i {
            width: 16px;
            height: 16px;
            color: #8b5cf6;
            flex-shrink: 0;
        }
        
        .scheme-footer {
            padding: 16px 24px;
            background: #f8fafc;
            border-top: 1px solid #e2e8f0;
        }
        
        .auto-apply-text {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            color: #10b981;
            font-weight: 500;
        }
        
        .auto-apply-text i {
            font-size: 14px;
        }
        
        /* Close button styling */
        #schemes-modal .btn-close {
            background: rgba(255, 255, 255, 0.3) !important;
            border-radius: 50% !important;
            width: 32px !important;
            height: 32px !important;
            opacity: 1 !important;
        }
        
        #schemes-modal .btn-close:hover {
            background: rgba(255, 255, 255, 0.5) !important;
        }
        
        @media (max-width: 768px) {
            .schemes-grid {
                grid-template-columns: 1fr;
            }
            
            .scheme-header {
                padding: 16px;
            }
            
            .scheme-body {
                padding: 20px;
            }
        }

    </style>

<?php
$content = ob_get_clean();

require_once __DIR__ . '/../partials/main.php'; ?> 