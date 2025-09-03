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
$categories[] = ['id' => 'all', 'name' => 'All', 'image' => 'pos-product-01.png'];

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
                <img src="assets/img/products/<?php echo $category['image'] ? $category['image'] : 'pos-product-01.png'; ?>" alt="<?php echo htmlspecialchars($category['name']); ?>" onerror="this.src='assets/img/products/pos-product-01.png'">
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
										<a href="pos-settings.php" class="btn btn-sm btn-primary mb-2"><i class="ti ti-settings me-1"></i>POS Settings</a>
									</div>
								</div>
								<div class="pos-products">
									<div class="tabs_container">
										<div class="tab_content active" data-tab="all">
											<div class="row g-3" id="productsContainer">
												<?php foreach ($products as $product): ?>
												<div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-3 product-item" data-category="<?php echo $product['category_id']; ?>" style="display: block;">
													<div class="product-info card mb-0">
														<a href="javascript:void(0);" class="pro-img" onclick="addToCart(<?php echo $product['id']; ?>, '<?php echo htmlspecialchars($product['name']); ?>', <?php echo $product['price']; ?>)">
															<img src="assets/img/products/<?php echo $product['image'] ? $product['image'] : 'images(1).jpg'; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" onerror="this.src='assets/img/products/images(1).png'">
															<span><i class="ti ti-circle-check-filled"></i></span>
														</a>
														<h6 class="product-name"><a href="javascript:void(0);"><?php echo htmlspecialchars($product['name']); ?></a></h6>
														<div class="d-flex align-items-center justify-content-between price">
															<p class="text-gray-9 mb-0"><?php echo number_format($product['price'], 2); ?></p>
															<div class="qty-item m-0">
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
											<select class="select" id="customerSelect" required>
												<option value="">Select Customer</option>
												<option value="walkin">Walk in Customer</option>
												<?php foreach ($customers as $customer): ?>
												<option value="<?php echo $customer['id']; ?>"><?php echo htmlspecialchars($customer['name']); ?> - <?php echo htmlspecialchars($customer['phone']); ?></option>
												<?php endforeach; ?>
											</select>
										</div>
										<a href="#" class="btn btn-teal btn-icon fs-20" data-bs-toggle="modal" data-bs-target="#create"><i class="ti ti-user-plus"></i></a>
										<a href="#" class="btn btn-info btn-icon fs-20" data-bs-toggle="modal" data-bs-target="#barcode"><i class="ti ti-scan"></i></a>
									</div>
								</div>
								<div class="product-added block-section">
									<div class="head-text d-flex align-items-center justify-content-between mb-3">
										<div class="d-flex align-items-center">
											<h5 class="me-2">Order Details</h5>
											<div class="badge bg-light text-gray-9 fs-12 fw-semibold py-2 border rounded">Items : <span class="text-teal" id="cartItemCount">0</span></div>
										</div>
										<a href="javascript:void(0);" onclick="clearCart()" class="d-flex align-items-center clear-icon fs-10 fw-medium">Clear all</a>
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
										<a href="javascript:void(0);" class="payment-item d-flex align-items-center justify-content-center p-2 flex-fill" data-bs-toggle="modal" data-bs-target="#payment-points">
											<img src="assets/img/icons/points.svg" class="me-2" alt="img">
											<p class="fs-14 fw-medium">Points</p>
										</a>
									</div>
									<div class="col-sm-6 col-md-4 d-flex">
										<a href="javascript:void(0);" class="payment-item d-flex align-items-center justify-content-center p-2 flex-fill" data-bs-toggle="modal" data-bs-target="#payment-deposit">
											<img src="assets/img/icons/deposit.svg" class="me-2" alt="img">
											<p class="fs-14 fw-medium">Deposit</p>
										</a>
									</div>
									<div class="col-sm-6 col-md-4 d-flex">
										<a href="javascript:void(0);" class="payment-item d-flex align-items-center justify-content-center p-2 flex-fill" data-bs-toggle="modal" data-bs-target="#payment-cheque">
											<img src="assets/img/icons/cheque.svg" class="me-2" alt="img">
											<p class="fs-14 fw-medium">Cheque</p>
										</a>
									</div>
									<div class="col-sm-6 col-md-4 d-flex">
										<a href="javascript:void(0);" class="payment-item d-flex align-items-center justify-content-center p-2 flex-fill" data-bs-toggle="modal" data-bs-target="#gift-payment">
											<img src="assets/img/icons/giftcard.svg" class="me-2" alt="img">
											<p class="fs-14 fw-medium">Gift Card</p>
										</a>
									</div>
									<div class="col-sm-6 col-md-4 d-flex">
										<a href="javascript:void(0);" class="payment-item d-flex align-items-center justify-content-center p-2 flex-fill" data-bs-toggle="modal" data-bs-target="#scan-payment">
											<img src="assets/img/icons/scan-icon.svg" class="me-2" alt="img">
											<p class="fs-14 fw-medium">Scan</p>
										</a>
									</div>
									<div class="col-sm-6 col-md-4 d-flex">
										<a href="javascript:void(0);" class="payment-item d-flex align-items-center justify-content-center p-2 flex-fill" onclick="selectPaymentMethod('mobile_money')">
											<img src="assets/img/icons/paylater.svg" class="me-2" alt="img">
											<p class="fs-14 fw-medium">Pay Later</p>
										</a>
									</div>
									<div class="col-sm-6 col-md-4 d-flex">
										<a href="javascript:void(0);" class="payment-item d-flex align-items-center justify-content-center p-2 flex-fill" onclick="selectPaymentMethod('mobile_money')">
											<img src="assets/img/icons/external.svg" class="me-2" alt="img">
											<p class="fs-14 fw-medium">External</p>
										</a>
									</div>
									<div class="col-sm-6 col-md-4 d-flex">
										<a href="javascript:void(0);" class="payment-item d-flex align-items-center justify-content-center p-2 flex-fill" data-bs-toggle="modal" data-bs-target="#split-payment">
											<img src="assets/img/icons/split-bill.svg" class="me-2" alt="img">
											<p class="fs-14 fw-medium">Split Bill</p>
										</a>
									</div>
								</div>
							</div>
						</div>
						<div class="btn-row d-flex align-items-center justify-content-between gap-3">
<!--							<a href="javascript:void(0);" class="btn btn-white d-flex align-items-center justify-content-center flex-fill m-0" data-bs-toggle="modal" data-bs-target="#hold-order"><i  class="ti ti-printer me-2"></i>Print Order</a>
							<a href="javascript:void(0);" class="btn btn-secondary d-flex align-items-center justify-content-center flex-fill m-0" onclick="showPaymentOptions()"><i  class="ti ti-shopping-cart me-2"></i>Place Order</a>-->
						</div>
					</aside>
				</div>
				<!-- /Order Details -->

			</div>

			<div class="pos-footer bg-white p-3 border-top">
				<div class="d-flex align-items-center justify-content-center flex-wrap gap-2">
					<!--<a href="javascript:void(0);" class="btn btn-orange d-inline-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#hold-order"><i  class="ti ti-player-pause me-2"></i>Hold</a>-->
					<!--<a href="javascript:void(0);" class="btn btn-info d-inline-flex align-items-center justify-content-center"><i  class="ti ti-trash me-2"></i>Void</a>-->
					<!--<a href="javascript:void(0);" class="btn btn-cyan d-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#payment-completed"><i  class="ti ti-cash-banknote me-2"></i>Payment</a>-->
					<!--<a href="javascript:void(0);" class="btn btn-secondary d-inline-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#orders"><i class="ti ti-shopping-cart me-2"></i>View Orders</a>-->
					<a href="orders.php" class="btn btn-secondary d-inline-flex align-items-center justify-content-center" ><i class="ti ti-shopping-cart me-2"></i>View Orders</a>
					<a href="javascript:void(0);" class="btn btn-indigo d-inline-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#reset"><i class="ti ti-reload me-2"></i>Reset</a>
					<!--<a href="javascript:void(0);" class="btn btn-danger d-inline-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#recents"><i class="ti ti-refresh-dot me-2"></i>Transaction</a>-->
				</div>
			</div>
		</div>
        <!-- End Content -->
    
        <?php require_once __DIR__ . '/../partials/footer.php'; ?>
        <?php require_once __DIR__ . '/../partials/modal-popup.php'; ?>
        <?php require_once __DIR__ . '/../partials/pos-modals.php'; ?>


    </div>

    <!-- ========================
        End Page Content
    ========================= -->

    <script>
        // Global cart variable
        let cart = [];
        
        // Function to add product to cart
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
                    loadCart(); // Reload cart from database
                    // Reset quantity input
                    quantityInput.value = 1;
                } else {
                    alert(data.message);
                    // Ensure cart display is clean when product cannot be added
                    loadCart();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to add item to cart');
                // Ensure cart display is clean on error
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
            
            let total = 0;
            
            cart.forEach((item, index) => {
                const itemTotal = item.price * item.quantity;
                total += itemTotal;
                
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
            
            // Update subtotal
            document.getElementById('cartSubtotal').textContent =  total.toFixed(2);
            
            // Calculate and update final total
            const finalTotal = getCartTotal();
            document.getElementById('cartTotal').textContent =  finalTotal.toFixed(2);
            
            // Update payment modal totals
            updatePaymentModalTotals();
        }
        
        // Function to remove item from cart
        function removeFromCart(productId) {
            fetch('cart_api.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `action=remove&product_id=${productId}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    loadCart();
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to remove item from cart');
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
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to update cart');
            });
        }
        
        // Function to clear cart
        function clearCart() {
            if (confirm('Are you sure you want to clear the cart?')) {
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
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Failed to clear cart');
                });
            }
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
        if (productNameElement) {
            const productName = productNameElement.textContent.toLowerCase();
            if (productName.includes(searchTerm)) {
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
                alert('Cart is empty. Please add items before placing order.');
                return;
            }
            
            // Check if customer is selected
            const customerSelect = document.getElementById('customerSelect');
            if (!customerSelect || !customerSelect.value) {
                alert('Please select a customer before placing order.');
                // Focus on customer dropdown
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
            
            document.getElementById('quick-total-amount').textContent = total.toFixed(2);
            document.getElementById('quick-item-count').textContent = itemCount + ' item(s)';
            
            // Update customer name
            const customerSelect = document.getElementById('customerSelect');
            const customerNameElement = document.getElementById('quick-customer-name');
            if (customerSelect && customerNameElement) {
                const selectedOption = customerSelect.options[customerSelect.selectedIndex];
                customerNameElement.textContent = selectedOption ? selectedOption.text : 'Walk in Customer';
            }
        }
        
        // Global variable to store selected payment method
        let selectedPaymentMethod = null;
        
        // Function to select payment method directly
        function selectPaymentMethod(paymentMethod) {
            if (cart.length === 0) {
                alert('Cart is empty. Please add items before selecting payment method.');
                return;
            }
            
            // Check if customer is selected
            const customerSelect = document.getElementById('customerSelect');
            if (!customerSelect || !customerSelect.value) {
                alert('Please select a customer before selecting payment method.');
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
            } else {
                // For other simple methods, confirm and place order directly
                const total = getCartTotal();
                const customerName = customerSelect.options[customerSelect.selectedIndex].text;
                
                const confirmMessage = `Place order for ${customerName} using ${paymentMethod.replace('_', ' ').toUpperCase()} payment (${total.toFixed(2)})?`;
                
                if (confirm(confirmMessage)) {
                    placeOrder(paymentMethod);
                }
            }
        }
        
        // Function to place order
        function placeOrder(paymentMethod) {
            if (cart.length === 0) {
                alert('Cart is empty. Please add items before placing order.');
                return;
            }
            
            // Check if customer is selected
            const customerSelect = document.getElementById('customerSelect');
            if (!customerSelect || !customerSelect.value) {
                alert('Please select a customer before placing order.');
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
//                    alert(`Order placed successfully!\nOrder Number: ${data.order_number}\nTotal: ${data.total_amount.toFixed(2)}`);
                    
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
                    
                    // Redirect to orders page after a short delay
                    setTimeout(() => {
                        window.location.href = 'orders.php';
                    }, 3000);
                    
                } else {
                    alert('Error placing order: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error placing order. Please try again.');
            })
            .finally(() => {
                // Restore button state
                if (placeOrderBtn) {
                    placeOrderBtn.innerHTML = '<i class="ti ti-shopping-cart me-2"></i>Place Order';
                    placeOrderBtn.disabled = false;
                }
            });
        }
        
        // Function to get cart subtotal
        function getCartSubtotal() {
            return cart.reduce((total, item) => total + (item.price * item.quantity), 0);
        }
        
        // Function to get cart total
        function getCartTotal() {
            const subtotal = getCartSubtotal();
            const shipping = parseFloat(document.getElementById('shippingCost').textContent.replace('$', '')) || 0;
            const tax = parseFloat(document.getElementById('taxAmount').textContent.replace('$', '')) || 0;
            const coupon = parseFloat(document.getElementById('couponAmount').textContent.replace('$', '')) || 0;
            const discount = parseFloat(document.getElementById('discountAmount').textContent.replace('$', '')) || 0;
            const roundoff = parseFloat(document.getElementById('roundoffAmount').textContent.replace('$', '')) || 0;
            
            let total = subtotal + shipping + tax - coupon - discount + roundoff;
            
            // Apply roundoff if enabled
            const roundoffCheckbox = document.getElementById('round');
            if (roundoffCheckbox && roundoffCheckbox.checked) {
                const rounded = Math.round(total);
                const roundoffValue = rounded - total;
                document.getElementById('roundoffAmount').textContent = roundoffValue.toFixed(2);
                total = rounded;
            }
            
            return Math.max(0, total);
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
            const totalFormatted = total.toFixed(2);

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
            document.getElementById('completed-total-amount').textContent = orderData.total_amount.toFixed(2);
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
        
        // Initialize cart display on page load
        document.addEventListener('DOMContentLoaded', function() {
    loadCart(); // Your existing code
    
    // Debug function to see what we're working with
    setTimeout(() => {
        debugProducts();
    }, 1000);
    
    // Initialize category filtering
    initializeCategoryFiltering();
    
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
    </script>

<?php
$content = ob_get_clean();

require_once __DIR__ . '/../partials/main.php'; ?> 