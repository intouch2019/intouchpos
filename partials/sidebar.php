<?php
    $link = $_SERVER['PHP_SELF'];
    $link_array = explode('/',$link);
    $page = end($link_array);
?>

<?php if($page !== 'pos.php' && $page !== 'pos-2.php' && $page !== 'pos-3.php' && $page !== 'pos-4.php' && $page !== 'pos-5.php') {?>
	<!-- Sidebar -->
	<div class="sidebar" id="sidebar">
<?php }?>	
<?php if($page === 'pos.php' || $page === 'pos-2.php' || $page === 'pos-3.php' || $page === 'pos-4.php' || $page === 'pos-5.php') {?>
	<!-- Sidebar -->
	<div class="sidebar d-none" id="sidebar">
<?php }?>
		<!-- Logo -->
		<div class="sidebar-logo">
			<a href="index.php" class="logo logo-normal">
				<img src="assets/img/logo.svg" alt="Img">
			</a>
			<a href="index.php" class="logo logo-white">
				<img src="assets/img/logo-white.svg" alt="Img">
			</a>
			<a href="index.php" class="logo-small">
				<img src="assets/img/logo-small.png" alt="Img">
			</a>
			<a id="toggle_btn" href="javascript:void(0);">
				<i data-feather="chevrons-left" class="feather-16"></i>
			</a>
		</div>
		<!-- /Logo -->
		<div class="modern-profile p-3 pb-0">
			<div class="text-center rounded bg-light p-3 mb-4 user-profile">
				<div class="avatar avatar-lg online mb-3">
					<img src="assets/img/customer/customer15.jpg" alt="Img" class="img-fluid rounded-circle">
				</div>
				<h6 class="fs-14 fw-bold mb-1">Adrian Herman</h6>
				<p class="fs-12 mb-0">System Admin</p>
			</div>
			<div class="sidebar-nav mb-3">
				<ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded nav-justified bg-transparent" role="tablist">
					<li class="nav-item"><a class="nav-link active border-0" href="#">Menu</a></li>
					<li class="nav-item"><a class="nav-link border-0" href="chat.php">Chats</a></li>
					<li class="nav-item"><a class="nav-link border-0" href="email.php">Inbox</a></li>
				</ul>
			</div>
		</div>
		<div class="sidebar-header p-3 pb-0 pt-2">
			<div class="text-center rounded bg-light p-2 mb-4 sidebar-profile d-flex align-items-center">
				<div class="avatar avatar-md onlin">
					<img src="assets/img/customer/customer15.jpg" alt="Img" class="img-fluid rounded-circle">
				</div>
				<div class="text-start sidebar-profile-info ms-2">
					<h6 class="fs-14 fw-bold mb-1">Adrian Herman</h6>
					<p class="fs-12">System Admin</p>
				</div>
			</div>
			<div class="d-flex align-items-center justify-content-between menu-item mb-3">
				<div>
					<a href="index.php" class="btn btn-sm btn-icon bg-light">
						<i class="ti ti-layout-grid-remove"></i>
					</a>
				</div>
				<div>
					<a href="chat.php" class="btn btn-sm btn-icon bg-light">
						<i class="ti ti-brand-hipchat"></i>
					</a>
				</div>
				<div>
					<a href="email.php" class="btn btn-sm btn-icon bg-light position-relative">
						<i class="ti ti-message"></i>
					</a>
				</div>
				<div class="notification-item">
					<a href="activities.php" class="btn btn-sm btn-icon bg-light position-relative">
						<i class="ti ti-bell"></i>
						<span class="notification-status-dot"></span>
					</a>
				</div>
				<div class="me-0">
					<a href="general-settings.php" class="btn btn-sm btn-icon bg-light">
						<i class="ti ti-settings"></i>
					</a>
				</div>
			</div>
		</div>
		<div class="sidebar-inner slimscroll">
			<div id="sidebar-menu" class="sidebar-menu">
				<ul>
					<li class="submenu-open">
						<h6 class="submenu-hdr">Main</h6>
						<ul>
							<li class="submenu">
								<a href="javascript:void(0);" class="<?php echo ($page =='index.php' || $page == '/' || $page == 'admin-dashboard.php'|| $page == 'sales-dashboard.php') ? 'active subdrop' : '' ;?>"><i class="ti ti-layout-grid fs-16 me-2"></i><span>Dashboard</span><span class="menu-arrow"></span></a>
								<ul>
									<li><a href="index.php" class="<?php echo ($page =='index.php'||$page == '/') ? 'active' : '' ;?>">Admin Dashboard</a></li>
									<li><a href="admin-dashboard.php" class="<?php echo ($page =='admin-dashboard.php') ? 'active' : '' ;?>">Admin Dashboard 2</a></li>
									<li><a href="sales-dashboard.php" class="<?php echo ($page =='sales-dashboard.php') ? 'active' : '' ;?>">Sales Dashboard</a></li>
								</ul>
							</li>
							<li class="submenu">
								<a href="javascript:void(0);" class="<?php echo ($page =='dashboard.php' ||$page == 'companies.php' ||$page == 'subscription.php' ||$page =='packages.php' ||$page =='domain.php' ||$page =='purchase-transaction.php') ? 'active subdrop' : '' ;?> "><i class="ti ti-user-edit fs-16 me-2"></i><span>Super Admin</span><span class="menu-arrow"></span></a>
								<ul>
									<li><a href="dashboard.php" class="<?php echo ($page =='dashboard.php') ? 'active' : '' ;?>">Dashboard</a></li>
									<li><a href="companies.php" class="<?php echo ($page =='companies.php') ? 'active' : '' ;?>">Companies</a></li>
									<li><a href="subscription.php" class="<?php echo ($page =='subscription.php') ? 'active' : '' ;?>">Subscriptions</a></li>
									<li><a href="packages.php" class="<?php echo ($page =='packages.php') ? 'active' : '' ;?>">Packages</a></li>
									<li><a href="domain.php" class="<?php echo ($page =='domain.php') ? 'active' : '' ;?>">Domain</a></li>
									<li><a href="purchase-transaction.php" class="<?php echo ($page =='purchase-transaction.php') ? 'active' : '' ;?>">Purchase Transaction</a></li>
								</ul>
							</li>
							<li class="submenu">
								<a href="javascript:void(0);" class="<?php echo ($page =='chat.php'||$page == 'audio-call.php'||$page == 'call-history.php'||$page =='video-call.php'||$page =='calendar.php'||$page =='contacts.php'||$page =='email.php' || $page =='email-reply.php'||$page =='todo.php' || $page =='todo-list.php' ||$page =='notes.php'||$page == 'file-manager.php'||$page == 'projects.php'||$page == 'products.php'||$page == 'orders.php'||$page == 'customers.php'||$page == 'cart.php'||$page =='checkout.php'||$page =='wishlist.php'||$page =='reviews.php'||$page =='social-feed.php'||$page =='search-list.php') ? 'active subdrop' : '' ;?> "><i class="ti ti-brand-apple-arcade fs-16 me-2"></i><span>Application</span><span class="menu-arrow"></span></a>
								<ul>
									<li><a href="chat.php" class="<?php echo ($page =='chat.php') ? 'active' : '' ;?>">Chat</a></li>
									<li class="submenu submenu-two"><a href="javascript:void(0);" class="<?php echo ($page =='video-call.php' || $page == 'call-history.php' || $page == 'audio-call.php') ? 'active subdrop' : '' ;?>">Call<span class="menu-arrow inside-submenu"></span></a>
										<ul>
											<li><a href="video-call.php" class="<?php echo ($page =='video-call.php') ? 'active' : '' ;?>">Video Call</a></li>
											<li><a href="audio-call.php" class="<?php echo ($page =='audio-call.php') ? 'active' : '' ;?>">Audio Call</a></li>
											<li><a href="call-history.php" class="<?php echo ($page =='call-history.php') ? 'active' : '' ;?>">Call History</a></li>
										</ul>
									</li>
									<li><a href="calendar.php" class="<?php echo ($page =='calendar.php') ? 'active' : '' ;?>">Calendar</a></li>
									<li><a href="contacts.php" class="<?php echo ($page =='contacts.php') ? 'active' : '' ;?>">Contacts</a></li>
									<li><a href="email.php" class="<?php echo ($page =='email.php' || $page =='email-reply.php') ? 'active' : '' ;?>">Email</a></li>
									<li><a href="todo.php" class="<?php echo ($page =='todo.php' || $page =='todo-list.php') ? 'active' : '' ;?>">To Do</a></li>
									<li><a href="notes.php" class="<?php echo ($page =='notes.php') ? 'active' : '' ;?>">Notes</a></li>
									<li><a href="file-manager.php" class="<?php echo ($page =='file-manager.php') ? 'active' : '' ;?>">File Manager</a></li>
									<li><a href="projects.php" class="<?php echo ($page =='projects.php') ? 'active' : '' ;?>">Projects</a></li>
									<li class="submenu submenu-two"><a href="javascript:void(0);" class="<?php echo ($page =='products.php' || $page == 'orders.php' || $page == 'customers.php' || $page == 'cart.php' || $page == 'checkout.php' || $page == 'wishlist.php' || $page == 'reviews.php') ? 'active subdrop' : '' ;?>">Ecommerce<span class="menu-arrow inside-submenu"></span></a>
										<ul>
											<li><a href="products.php" class="<?php echo ($page =='products.php') ? 'active' : '' ;?>">Products</a></li>
											<li><a href="orders.php" class="<?php echo ($page =='orders.php') ? 'active' : '' ;?>">Orders</a></li>
											<li><a href="customers.php" class="<?php echo ($page =='customers.php') ? 'active' : '' ;?>">Customers</a></li>
											<li><a href="cart.php" class="<?php echo ($page =='cart.php') ? 'active' : '' ;?>">Cart</a></li>
											<li><a href="checkout.php" class="<?php echo ($page =='checkout.php') ? 'active' : '' ;?>">Checkout</a></li>
											<li><a href="wishlist.php" class="<?php echo ($page =='wishlist.php') ? 'active' : '' ;?>">Wishlist</a></li>
											<li><a href="reviews.php" class="<?php echo ($page =='reviews.php') ? 'active' : '' ;?>">Reviews</a></li>
										</ul>
									</li>
									<li><a href="social-feed.php" class="<?php echo ($page =='social-feed.php') ? 'active' : '' ;?>">Social Feed</a></li>
									<li><a href="search-list.php" class="<?php echo ($page =='search-list.php') ? 'active' : '' ;?>">Search List</a></li>
								</ul>
							</li>
							<li class="submenu">
								<a href="javascript:void(0);" class="<?php echo ($page =='layout-horizontal.php' || $page == 'layout-detached.php'|| $page == 'layout-two-column.php' || $page == 'layout-hovered.php' || $page == 'layout-boxed.php' || $page == 'layout-rtl.php' || $page == 'layout-dark.php') ? 'active subdrop' : '' ;?>"><i class="ti ti-layout-sidebar-right-collapse fs-16 me-2"></i><span>Layouts</span><span class="menu-arrow"></span></a>
								<ul>
									<li><a href="layout-horizontal.php" class="<?php echo ($page =='layout-horizontal.php') ? 'active' : '' ;?>">Horizontal</a></li>
									<li><a href="layout-detached.php" class="<?php echo ($page =='layout-detached.php') ? 'active' : '' ;?>">Detached</a></li>
									<li><a href="layout-two-column.php" class="<?php echo ($page =='layout-two-column.php') ? 'active' : '' ;?>">Two Column</a></li>
									<li><a href="layout-hovered.php" class="<?php echo ($page =='layout-hovered.php') ? 'active' : '' ;?>">Hovered</a></li>
									<li><a href="layout-boxed.php" class="<?php echo ($page =='layout-boxed.php') ? 'active' : '' ;?>">Boxed</a></li>
									<li><a href="layout-rtl.php" class="<?php echo ($page =='layout-rtl.php') ? 'active' : '' ;?>">RTL</a></li>
									<li><a href="layout-dark.php" class="<?php echo ($page =='layout-dark.php') ? 'active' : '' ;?>">Dark</a></li>
								</ul>
							</li>
						</ul>
					</li>
					<li class="submenu-open">
						<h6 class="submenu-hdr">Inventory</h6>
						<ul>
							<li class="<?php echo ($page =='product-list.php' || $page =='product-details.php' || $page =='edit-product.php') ? 'active' : '' ;?>"><a href="product-list.php"><i data-feather="box"></i><span>Products</span></a></li>
							<li class="<?php echo ($page =='add-product.php') ? 'active' : '' ;?>"><a href="add-product.php"><i class="ti ti-table-plus fs-16 me-2"></i><span>Create Product</span></a></li>
							<li class="<?php echo ($page =='expired-products.php') ? 'active' : '' ;?>"><a href="expired-products.php"><i class="ti ti-progress-alert fs-16 me-2"></i><span>Expired Products</span></a></li>
							<li class="<?php echo ($page =='low-stocks.php') ? 'active' : '' ;?>"><a href="low-stocks.php"><i class="ti ti-trending-up-2 fs-16 me-2"></i><span>Low Stocks</span></a></li>
							<li class="<?php echo ($page =='category-list.php') ? 'active' : '' ;?>"><a href="category-list.php"><i class="ti ti-list-details fs-16 me-2"></i><span>Category</span></a></li>
							<li class="<?php echo ($page =='sub-categories.php') ? 'active' : '' ;?>"><a href="sub-categories.php"><i class="ti ti-carousel-vertical fs-16 me-2"></i><span>Sub Category</span></a></li>
							<li class="<?php echo ($page =='brand-list.php') ? 'active' : '' ;?>"><a href="brand-list.php"><i class="ti ti-triangles fs-16 me-2"></i><span>Brands</span></a></li>
							<li class="<?php echo ($page =='units.php') ? 'active' : '' ;?>"><a href="units.php"><i class="ti ti-brand-unity fs-16 me-2"></i><span>Units</span></a></li>
							<li class="<?php echo ($page =='varriant-attributes.php') ? 'active' : '' ;?>"><a href="varriant-attributes.php"><i class="ti ti-checklist fs-16 me-2"></i><span>Variant Attributes</span></a></li>
							<li class="<?php echo ($page =='warranty.php') ? 'active' : '' ;?>"><a href="warranty.php"><i class="ti ti-certificate fs-16 me-2"></i><span>Warranties</span></a></li>
							<li class="<?php echo ($page =='barcode.php') ? 'active' : '' ;?>"><a href="barcode.php"><i class="ti ti-barcode fs-16 me-2"></i><span>Print Barcode</span></a></li>
							<li class="<?php echo ($page =='qrcode.php') ? 'active' : '' ;?>"><a href="qrcode.php"><i class="ti ti-qrcode fs-16 me-2"></i><span>Print QR Code</span></a></li>
						</ul>
					</li>
					<li class="submenu-open">
						<h6 class="submenu-hdr">Stock</h6>
						<ul>
							<li class="<?php echo ($page =='manage-stocks.php') ? 'active' : '' ;?>"><a href="manage-stocks.php"><i class="ti ti-stack-3 fs-16 me-2"></i><span>Manage Stock</span></a></li>
							<li class="<?php echo ($page =='stock-adjustment.php') ? 'active' : '' ;?>"><a href="stock-adjustment.php"><i class="ti ti-stairs-up fs-16 me-2"></i><span>Stock Adjustment</span></a></li>
							<li class="<?php echo ($page =='stock-transfer.php') ? 'active' : '' ;?>"><a href="stock-transfer.php"><i class="ti ti-stack-pop fs-16 me-2"></i><span>Stock Transfer</span></a></li>
						</ul>
					</li>
					<li class="submenu-open">
						<h6 class="submenu-hdr">Sales</h6>
						<ul>
							<li class="submenu">
								<a href="javascript:void(0);" class="<?php echo ($page =='online-orders.php' || $page == 'pos-orders.php') ? 'active subdrop' : '' ;?>"><i class="ti ti-layout-grid fs-16 me-2"></i><span>Sales</span><span class="menu-arrow"></span></a>
								<ul>
									<li><a href="online-orders.php" class="<?php echo ($page =='online-orders.php') ? 'active' : '' ;?>">Online Orders</a></li>
									<li><a href="pos-orders.php" class="<?php echo ($page =='pos-orders.php') ? 'active' : '' ;?>">POS Orders</a></li>
								</ul>
							</li>
							<li class="<?php echo ($page =='invoice.php' || $page =='invoice-details.php') ? 'active' : '' ;?>"><a href="invoice.php"><i class="ti ti-file-invoice fs-16 me-2"></i><span>Invoices</span></a></li>
							<li class="<?php echo ($page =='sales-returns.php') ? 'active' : '' ;?>"><a href="sales-returns.php"><i class="ti ti-receipt-refund fs-16 me-2"></i><span>Sales Return</span></a></li>
							<li class="<?php echo ($page =='quotation-list.php') ? 'active' : '' ;?>"><a href="quotation-list.php"><i class="ti ti-files fs-16 me-2"></i><span>Quotation</span></a></li>
							<li class="submenu">
								<a href="javascript:void(0);" class="<?php echo ($page =='pos.php' || $page == 'pos-2.php' || $page == 'pos-3.php' || $page == 'pos-4.php' || $page == 'pos-5.php') ? 'active subdrop' : '' ;?>"><i class="ti ti-device-laptop fs-16 me-2"></i><span>POS</span><span class="menu-arrow"></span></a>
								<ul>
									<li><a href="pos.php" class="<?php echo ($page =='pos.php') ? 'active' : '' ;?>">POS 1</a></li>
									<li><a href="pos-2.php" class="<?php echo ($page =='pos-2.php') ? 'active' : '' ;?>">POS 2</a></li>
									<li><a href="pos-3.php" class="<?php echo ($page =='pos-3.php') ? 'active' : '' ;?>">POS 3</a></li>
									<li><a href="pos-4.php" class="<?php echo ($page =='pos-4.php') ? 'active' : '' ;?>">POS 4</a></li>
									<li><a href="pos-5.php" class="<?php echo ($page =='pos-5.php') ? 'active' : '' ;?>">POS 5</a></li>
								</ul>
							</li>
						</ul>
					</li>
					<li class="submenu-open">
						<h6 class="submenu-hdr">Promo</h6>
						<ul>
							<li class="<?php echo ($page =='coupons.php') ? 'active' : '' ;?>"><a href="coupons.php"><i class="ti ti-ticket fs-16 me-2"></i><span>Coupons</span></a></li>
							<li class="<?php echo ($page =='gift-cards.php') ? 'active' : '' ;?>"><a href="gift-cards.php"><i class="ti ti-cards fs-16 me-2"></i><span>Gift Cards</span></a></li>
							<li class="submenu">
								<a href="javascript:void(0);" class="<?php echo ($page =='discount-plan.php' || $page == 'discount.php') ? 'active subdrop' : '' ;?>"><i class="ti ti-file-percent fs-16 me-2"></i><span>Discount</span><span class="menu-arrow"></span></a>
								<ul>
									<li><a href="discount-plan.php" class="<?php echo ($page =='discount-plan.php') ? 'active' : '' ;?>">Discount Plan</a></li>
									<li><a href="discount.php" class="<?php echo ($page =='discount.php') ? 'active' : '' ;?>">Discount</a></li>
								</ul>
							</li>
						</ul>
					</li>
					<li class="submenu-open">
						<h6 class="submenu-hdr">Purchases</h6>
						<ul>
							<li class="<?php echo ($page =='purchase-list.php') ? 'active' : '' ;?>"><a href="purchase-list.php"><i class="ti ti-shopping-bag fs-16 me-2"></i><span>Purchases</span></a></li>
							<li class="<?php echo ($page =='purchase-order-report.php') ? 'active' : '' ;?>"><a href="purchase-order-report.php"><i class="ti ti-file-unknown fs-16 me-2"></i><span>Purchase Order</span></a></li>
							<li class="<?php echo ($page =='purchase-returns.php') ? 'active' : '' ;?>"><a href="purchase-returns.php"><i class="ti ti-file-upload fs-16 me-2"></i><span>Purchase Return</span></a></li>
						</ul>
					</li>
					<li class="submenu-open">
						<h6 class="submenu-hdr">Finance & Accounts</h6>
						<ul>
							<li class="submenu">
								<a href="javascript:void(0);" class="<?php echo ($page =='expense-list.php' || $page == 'expense-category.php') ? 'active subdrop' : '' ;?>"><i class="ti ti-file-stack fs-16 me-2"></i><span>Expenses</span><span class="menu-arrow"></span></a>
								<ul>
									<li><a href="expense-list.php" class="<?php echo ($page =='expense-list.php') ? 'active' : '' ;?>">Expenses</a></li>
									<li><a href="expense-category.php" class="<?php echo ($page =='expense-category.php') ? 'active' : '' ;?>">Expense Category</a></li>
								</ul>
							</li>
							<li class="submenu">
								<a href="javascript:void(0);" class="<?php echo ($page =='income.php' || $page == 'income-category.php') ? 'active subdrop' : '' ;?>"><i class="ti ti-file-pencil fs-16 me-2"></i><span>Income</span><span class="menu-arrow"></span></a>
								<ul>
									<li><a href="income.php" class="<?php echo ($page =='income.php') ? 'active' : '' ;?>">Income</a></li>
									<li><a href="income-category.php" class="<?php echo ($page =='income-category.php') ? 'active' : '' ;?>">Income Category</a></li>
								</ul>
							</li>
							<li class="<?php echo ($page =='account-list.php') ? 'active' : '' ;?>"><a href="account-list.php"><i class="ti ti-building-bank fs-16 me-2"></i><span>Bank Accounts</span></a></li>
							<li class="<?php echo ($page =='money-transfer.php') ? 'active' : '' ;?>"><a href="money-transfer.php"><i class="ti ti-moneybag fs-16 me-2"></i><span>Money Transfer</span></a></li>
							<li class="<?php echo ($page =='balance-sheet.php' || $page =='balance-sheet-v2.php') ? 'active' : '' ;?>"><a href="balance-sheet.php"><i class="ti ti-report-money fs-16 me-2"></i><span>Balance Sheet</span></a></li>
							<li class="<?php echo ($page =='trial-balance.php') ? 'active' : '' ;?>"><a href="trial-balance.php"><i class="ti ti-alert-circle fs-16 me-2"></i><span>Trial Balance</span></a></li>
							<li class="<?php echo ($page =='cash-flow.php' || $page =='cash-flow-v2.php') ? 'active' : '' ;?>"><a href="cash-flow.php"><i class="ti ti-zoom-money fs-16 me-2"></i><span>Cash Flow</span></a></li>
							<li class="<?php echo ($page =='account-statement.php') ? 'active' : '' ;?>"><a href="account-statement.php"><i class="ti ti-file-infinity fs-16 me-2"></i><span>Account Statement</span></a></li>

						</ul>
					</li>
					<li class="submenu-open">
						<h6 class="submenu-hdr">Peoples</h6>
						<ul>
							<li class="<?php echo ($page =='customers.php') ? 'active' : '' ;?>"><a href="customers.php"><i class="ti ti-users-group fs-16 me-2"></i><span>Customers</span></a></li>
							<li class="<?php echo ($page =='billers.php') ? 'active' : '' ;?>"><a href="billers.php"><i class="ti ti-user-up fs-16 me-2"></i><span>Billers</span></a></li>
							<li class="<?php echo ($page =='suppliers.php') ? 'active' : '' ;?>"><a href="suppliers.php"><i class="ti ti-user-dollar fs-16 me-2"></i><span>Suppliers</span></a></li>
							<li class="<?php echo ($page =='store-list.php') ? 'active' : '' ;?>"><a href="store-list.php"><i class="ti ti-home-bolt fs-16 me-2"></i><span>Stores</span></a></li>
							<li class="<?php echo ($page =='warehouse.php') ? 'active' : '' ;?>"><a href="warehouse.php"><i class="ti ti-archive fs-16 me-2"></i><span>Warehouses</span></a>
							</li>
						</ul>
					</li>
					<li class="submenu-open">
						<h6 class="submenu-hdr">HRM</h6>
						<ul>
							<li class="<?php echo ($page =='employees-grid.php' || $page =='add-employee.php' || $page =='edit-employee.php' || $page =='employee-details.php' || $page =='employees-list.php') ? 'active' : '' ;?>"><a href="employees-grid.php"><i class="ti ti-user fs-16 me-2"></i><span>Employees</span></a></li>
							<li class="<?php echo ($page =='department-grid.php' || $page =='department-list.php') ? 'active' : '' ;?>"><a href="department-grid.php"><i class="ti ti-compass fs-16 me-2"></i><span>Departments</span></a></li>
							<li class="<?php echo ($page =='designation.php') ? 'active' : '' ;?>"><a href="designation.php"><i class="ti ti-git-merge fs-16 me-2"></i><span>Designation</span></a></li>
							<li class="<?php echo ($page =='shift.php') ? 'active' : '' ;?>"><a href="shift.php"><i class="ti ti-arrows-shuffle fs-16 me-2"></i><span>Shifts</span></a></li>
							<li class="submenu">
								<a href="javascript:void(0);" class="<?php echo ($page =='attendance-employee.php' || $page == 'attendance-admin.php') ? 'active subdrop' : '' ;?>"><i class="ti ti-user-cog fs-16 me-2"></i><span>Attendence</span><span class="menu-arrow"></span></a>
								<ul>
									<li><a href="attendance-employee.php" class="<?php echo ($page =='attendance-employee.php') ? 'active' : '' ;?>">Employee</a></li>
									<li><a href="attendance-admin.php" class="<?php echo ($page =='attendance-admin.php') ? 'active' : '' ;?>">Admin</a></li>
								</ul>
							</li>
							<li class="submenu">
								<a href="javascript:void(0);" class="<?php echo ($page =='leaves-admin.php' || $page == 'leaves-employee.php' || $page == 'leave-types.php') ? 'active subdrop' : '' ;?>"><i class="ti ti-calendar fs-16 me-2"></i><span>Leaves</span><span class="menu-arrow"></span></a>
								<ul>
									<li><a href="leaves-admin.php" class="<?php echo ($page =='leaves-admin.php') ? 'active' : '' ;?>">Admin Leaves</a></li>
									<li><a href="leaves-employee.php" class="<?php echo ($page =='leaves-employee.php') ? 'active' : '' ;?>">Employee Leaves</a></li>
									<li><a href="leave-types.php" class="<?php echo ($page =='leave-types.php') ? 'active' : '' ;?>">Leave Types</a></li>
								</ul>
							</li>
							<li class="<?php echo ($page =='holidays.php') ? 'active' : '' ;?>"><a href="holidays.php"><i class="ti ti-calendar-share fs-16 me-2"></i><span>Holidays</span></a>
							</li>
							<li class="submenu">
								<a href="employee-salary.php" class="<?php echo ($page =='employee-salary.php' || $page == 'payslip.php') ? 'active subdrop' : '' ;?>"><i class="ti ti-file-dollar fs-16 me-2"></i><span>Payroll</span><span class="menu-arrow"></span></a>
								<ul>
									<li><a href="employee-salary.php" class="<?php echo ($page =='employee-salary.php') ? 'active' : '' ;?>">Employee Salary</a></li>
									<li><a href="payslip.php" class="<?php echo ($page =='payslip.php') ? 'active' : '' ;?>">Payslip</a></li>
								</ul>
							</li>
						</ul>
					</li>
					<li class="submenu-open">
						<h6 class="submenu-hdr">Reports</h6>
						<ul>
							<li class="submenu">
								<a href="javascript:void(0);" class="<?php echo ($page =='sales-report.php' || $page == 'best-seller.php') ? 'active subdrop' : '' ;?>"><i class="ti ti-chart-bar fs-16 me-2"></i><span>Sales Report</span><span class="menu-arrow"></span></a>
								<ul>
									<li><a href="sales-report.php" class="<?php echo ($page =='sales-report.php') ? 'active' : '' ;?>">Sales Report</a></li>
									<li><a href="best-seller.php" class="<?php echo ($page =='best-seller.php') ? 'active' : '' ;?>">Best Seller</a></li>
								</ul>
							</li>
							<li class="<?php echo ($page =='purchase-report.php') ? 'active' : '' ;?>"><a href="purchase-report.php"><i class="ti ti-chart-pie-2 fs-16 me-2"></i><span>Purchase report</span></a></li>
							<li class="submenu">
								<a href="javascript:void(0);" class="<?php echo ($page =='inventory-report.php' || $page == 'stock-history.php' || $page == 'sold-stock.php') ? 'active subdrop' : '' ;?>"><i class="ti ti-triangle-inverted fs-16 me-2"></i><span>Inventory Report</span><span class="menu-arrow"></span></a>
								<ul>
									<li><a href="inventory-report.php" class="<?php echo ($page =='inventory-report.php') ? 'active' : '' ;?>">Inventory Report</a></li>
									<li><a href="stock-history.php" class="<?php echo ($page =='stock-history.php') ? 'active' : '' ;?>">Stock History</a></li>
									<li><a href="sold-stock.php" class="<?php echo ($page =='sold-stock.php') ? 'active' : '' ;?>">Sold Stock</a></li>
								</ul>
							</li>
							<li class="<?php echo ($page =='invoice-report.php') ? 'active' : '' ;?>"><a href="invoice-report.php"><i class="ti ti-businessplan fs-16 me-2"></i><span>Invoice Report</span></a></li>
							<li class="submenu">
								<a href="javascript:void(0);" class="<?php echo ($page =='supplier-report.php' || $page == 'supplier-due-report.php') ? 'active subdrop' : '' ;?>"><i class="ti ti-user-star fs-16 me-2"></i><span>Supplier Report</span><span class="menu-arrow"></span></a>
								<ul>
									<li><a href="supplier-report.php" class="<?php echo ($page =='supplier-report.php') ? 'active' : '' ;?>">Supplier Report</a></li>
									<li><a href="supplier-due-report.php" class="<?php echo ($page =='supplier-due-report.php') ? 'active' : '' ;?>">Supplier Due Report</a></li>
								</ul>
							</li>
							<li class="submenu">
								<a href="javascript:void(0);" class="<?php echo ($page =='customer-report.php' || $page == 'customer-due-report.php') ? 'active subdrop' : '' ;?>"><i class="ti ti-report fs-16 me-2"></i><span>Customer Report</span><span class="menu-arrow"></span></a>
								<ul>
									<li><a href="customer-report.php" class="<?php echo ($page =='customer-report.php') ? 'active' : '' ;?>">Customer Report</a></li>
									<li><a href="customer-due-report.php" class="<?php echo ($page =='customer-due-report.php') ? 'active' : '' ;?>">Customer Due Report</a></li>
								</ul>
							</li>
							<li class="submenu">
								<a href="javascript:void(0);" class="<?php echo ($page =='product-report.php' || $page == 'product-expiry-report.php' || $page == 'product-quantity-alert.php') ? 'active subdrop' : '' ;?>"><i class="ti ti-report-analytics fs-16 me-2"></i><span>Product Report</span><span class="menu-arrow"></span></a>
								<ul>
									<li><a href="product-report.php" class="<?php echo ($page =='product-report.php') ? 'active' : '' ;?>">Product Report</a></li>
									<li><a href="product-expiry-report.php" class="<?php echo ($page =='product-expiry-report.php') ? 'active' : '' ;?>">Product Expiry Report</a></li>
									<li><a href="product-quantity-alert.php" class="<?php echo ($page =='product-quantity-alert.php') ? 'active' : '' ;?>">Product Quantity Alert</a></li>
								</ul>
							</li>
							<li class="<?php echo ($page =='expense-report.php') ? 'active' : '' ;?>"><a href="expense-report.php"><i class="ti ti-file-vector fs-16 me-2"></i><span>Expense Report</span></a></li>
							<li class="<?php echo ($page =='income-report.php') ? 'active' : '' ;?>"><a href="income-report.php"><i class="ti ti-chart-ppf fs-16 me-2"></i><span>Income Report</span></a></li>
							<li class="<?php echo ($page =='tax-reports.php' || $page =='sales-tax.php') ? 'active' : '' ;?>"><a href="tax-reports.php"><i class="ti ti-chart-dots-2 fs-16 me-2"></i><span>Tax Report</span></a></li>
							<li class="<?php echo ($page =='profit-and-loss.php') ? 'active' : '' ;?>"><a href="profit-and-loss.php"><i class="ti ti-chart-donut fs-16 me-2"></i><span>Profit & Loss</span></a></li>
							<li class="<?php echo ($page =='annual-report.php') ? 'active' : '' ;?>"><a href="annual-report.php"><i class="ti ti-report-search fs-16 me-2"></i><span>Annual Report</span></a></li>
						</ul>
					</li>
					<li class="submenu-open">
						<h6 class="submenu-hdr">Content (CMS)</h6>
						<ul>
							<li class="submenu">
								<a href="javascript:void(0);" class="<?php echo ($page =='pages.php') ? 'active subdrop' : '' ;?>"><i class="ti ti-page-break fs-16 me-2"></i><span>Pages</span><span class="menu-arrow"></span></a>
								<ul>
									<li><a href="pages.php" class="<?php echo ($page =='pages.php') ? 'active' : '' ;?>">Pages</a></li>
								</ul>
							</li>
							<li class="submenu">
								<a href="javascript:void(0);" class="<?php echo ($page =='all-blog.php' || $page == 'blog-details.php' || $page == 'blog-tag.php' || $page == 'blog-categories.php' || $page == 'blog-comments.php') ? 'active subdrop' : '' ;?>"><i class="ti ti-wallpaper fs-16 me-2"></i><span>Blog</span><span class="menu-arrow"></span></a>
								<ul>
									<li><a href="all-blog.php" class="<?php echo ($page =='all-blog.php' || $page == 'blog-details.php') ? 'active' : '' ;?>">All Blog</a></li>
									<li><a href="blog-tag.php" class="<?php echo ($page =='blog-tag.php') ? 'active' : '' ;?>">Blog Tags</a></li>
									<li><a href="blog-categories.php" class="<?php echo ($page =='blog-categories.php') ? 'active' : '' ;?>">Categories</a></li>
									<li><a href="blog-comments.php" class="<?php echo ($page =='blog-comments.php') ? 'active' : '' ;?>">Blog Comments</a></li>
								</ul>
							</li>
							<li class="submenu">
								<a href="javascript:void(0);" class="<?php echo ($page =='countries.php' || $page == 'states.php' || $page == 'cities.php') ? 'active subdrop' : '' ;?>"><i class="ti ti-map-pin fs-16 me-2"></i><span>Location</span><span class="menu-arrow"></span></a>
								<ul>
									<li><a href="countries.php" class="<?php echo ($page =='countries.php') ? 'active' : '' ;?>">Countries</a></li>
									<li><a href="states.php" class="<?php echo ($page =='states.php') ? 'active' : '' ;?>">States</a></li>
									<li><a href="cities.php" class="<?php echo ($page =='cities.php') ? 'active' : '' ;?>">Cities</a></li>
								</ul>
							</li>
							<li class="<?php echo ($page =='testimonials.php') ? 'active' : '' ;?>"><a href="testimonials.php"><i class="ti ti-star fs-16 me-2"></i><span>Testimonials</span></a></li>
							<li class="<?php echo ($page =='faq.php') ? 'active' : '' ;?>"><a href="faq.php"><i class="ti ti-help-circle fs-16 me-2"></i><span>FAQ</span></a></li>

						</ul>
					</li>
					<li class="submenu-open">
						<h6 class="submenu-hdr">User Management</h6>
						<ul>
							<li class="<?php echo ($page =='users.php') ? 'active' : '' ;?>"><a href="users.php"><i class="ti ti-shield-up fs-16 me-2"></i><span>Users</span></a></li>
							<li class="<?php echo ($page =='roles-permissions.php' || $page =='permissions.php') ? 'active' : '' ;?>"><a href="roles-permissions.php"><i class="ti ti-jump-rope fs-16 me-2"></i><span>Roles & Permissions</span></a></li>
							<li class="<?php echo ($page =='delete-account.php') ? 'active' : '' ;?>"><a href="delete-account.php"><i class="ti ti-trash-x fs-16 me-2"></i><span>Delete Account Request</span></a></li>
						</ul>
					</li>
					<li class="submenu-open">
						<h6 class="submenu-hdr">Pages</h6>
						<ul>
							<li class="<?php echo ($page =='profile.php') ? 'active' : '' ;?>"><a href="profile.php"><i class="ti ti-user-circle fs-16 me-2"></i><span>Profile</span></a></li>
							<li class="submenu">
								<a href="javascript:void(0);" class="<?php echo ($page =='signin.php' || $page == 'signin-2.php' || $page == 'signin-3.php' || $page =='register.php' || $page == 'register-2.php' || $page == 'register-3.php' || $page =='forgot-password.php' || $page == 'forgot-password-2.php' || $page == 'forgot-password-3.php'|| $page =='reset-password.php' || $page == 'reset-password-2.php' || $page == 'reset-password-3.php' 
								|| $page =='email-verification.php' || $page == 'email-verification-2.php' || $page == 'email-verification-3.php' || $page =='two-step-verification.php' || $page == 'two-step-verification-2.php' || $page == 'two-step-verification-3.php' ) ? 'active subdrop' : '' ;?>"><i class="ti ti-shield fs-16 me-2"></i><span>Authentication</span><span class="menu-arrow"></span></a>
								<ul>
									<li class="submenu submenu-two"><a href="javascript:void(0);" class="<?php echo ($page =='signin.php' || $page == 'signin-2.php' || $page == 'signin-3.php') ? 'active subdrop' : '' ;?>">Login<span class="menu-arrow inside-submenu"></span></a>
										<ul>
											<li><a href="signin.php" class="<?php echo ($page =='signin.php') ? 'active' : '' ;?>">Cover</a></li>
											<li><a href="signin-2.php" class="<?php echo ($page =='signin-2.php') ? 'active' : '' ;?>">Illustration</a></li>
											<li><a href="signin-3.php" class="<?php echo ($page =='signin-3.php') ? 'active' : '' ;?>">Basic</a></li>
										</ul>
									</li>
									<li class="submenu submenu-two"><a href="javascript:void(0);" class="<?php echo ($page =='register.php' || $page == 'register-2.php' || $page == 'register-3.php') ? 'active subdrop' : '' ;?>">Register<span class="menu-arrow inside-submenu"></span></a>
										<ul>
											<li><a href="register.php" class="<?php echo ($page =='register.php') ? 'active' : '' ;?>">Cover</a></li>
											<li><a href="register-2.php" class="<?php echo ($page =='register-2.php') ? 'active' : '' ;?>">Illustration</a></li>
											<li><a href="register-3.php" class="<?php echo ($page =='register-3.php') ? 'active' : '' ;?>">Basic</a></li>
										</ul>
									</li>
									<li class="submenu submenu-two"><a href="javascript:void(0);" class="<?php echo ($page =='forgot-password.php' || $page == 'forgot-password-2.php' || $page == 'forgot-password-3.php') ? 'active subdrop' : '' ;?>">Forgot Password<span class="menu-arrow inside-submenu"></span></a>
										<ul>
											<li><a href="forgot-password.php" class="<?php echo ($page =='forgot-password.php') ? 'active' : '' ;?>">Cover</a></li>
											<li><a href="forgot-password-2.php" class="<?php echo ($page =='forgot-password-2.php') ? 'active' : '' ;?>">Illustration</a></li>
											<li><a href="forgot-password-3.php" class="<?php echo ($page =='forgot-password-3.php') ? 'active' : '' ;?>">Basic</a></li>
										</ul>
									</li>
									<li class="submenu submenu-two"><a href="javascript:void(0);" class="<?php echo ($page =='reset-password.php' || $page == 'reset-password-2.php' || $page == 'reset-password-3.php') ? 'active subdrop' : '' ;?>">Reset Password<span class="menu-arrow inside-submenu"></span></a>
										<ul>
											<li><a href="reset-password.php" class="<?php echo ($page =='reset-password.php') ? 'active' : '' ;?>">Cover</a></li>
											<li><a href="reset-password-2.php" class="<?php echo ($page =='reset-password-2.php') ? 'active' : '' ;?>">Illustration</a></li>
											<li><a href="reset-password-3.php" class="<?php echo ($page =='reset-password-3.php') ? 'active' : '' ;?>">Basic</a></li>
										</ul>
									</li>
									<li class="submenu submenu-two"><a href="javascript:void(0);" class="<?php echo ($page =='email-verification.php' || $page == 'email-verification-2.php' || $page == 'email-verification-3.php') ? 'active subdrop' : '' ;?>">Email Verification<span class="menu-arrow inside-submenu"></span></a>
										<ul>
											<li><a href="email-verification.php" class="<?php echo ($page =='email-verification.php') ? 'active' : '' ;?>">Cover</a></li>
											<li><a href="email-verification-2.php" class="<?php echo ($page =='email-verification-2.php') ? 'active' : '' ;?>">Illustration</a></li>
											<li><a href="email-verification-3.php" class="<?php echo ($page =='email-verification-3.php') ? 'active' : '' ;?>">Basic</a></li>
										</ul>
									</li>
									<li class="submenu submenu-two"><a href="javascript:void(0);" class="<?php echo ($page =='two-step-verification.php' || $page == 'two-step-verification-2.php' || $page == 'two-step-verification-3.php') ? 'active subdrop' : '' ;?>">2 Step Verification<span class="menu-arrow inside-submenu"></span></a>
										<ul>
											<li><a href="two-step-verification.php" class="<?php echo ($page =='two-step-verification.php') ? 'active' : '' ;?>">Cover</a></li>
											<li><a href="two-step-verification-2.php" class="<?php echo ($page =='two-step-verification-2.php') ? 'active' : '' ;?>">Illustration</a></li>
											<li><a href="two-step-verification-3.php" class="<?php echo ($page =='two-step-verification-3.php') ? 'active' : '' ;?>">Basic</a></li>
										</ul>
									</li>
									<li><a href="lock-screen.php" class="<?php echo ($page =='lock-screen.php') ? 'active' : '' ;?>">Lock Screen</a></li>
								</ul>
							</li>
							<li class="submenu">
								<a href="javascript:void(0);" class="<?php echo ($page =='error-404.php' || $page == 'error-500.php') ? 'active subdrop' : '' ;?>"><i class="ti ti-file-x fs-16 me-2"></i><span>Error Pages</span><span class="menu-arrow"></span></a>
								<ul>
									<li><a href="error-404.php" class="<?php echo ($page =='error-404.php') ? 'active' : '' ;?>">404 Error </a></li>
									<li><a href="error-500.php" class="<?php echo ($page =='error-500.php') ? 'active' : '' ;?>">500 Error </a></li>
								</ul>
							</li>
							<li class="<?php echo ($page =='blank-page.php') ? 'active' : '' ;?>">
								<a href="blank-page.php"><i class="ti ti-file fs-16 me-2"></i><span>Blank Page</span> </a>
							</li>
							<li class="<?php echo ($page =='pricing.php') ? 'active' : '' ;?>">
								<a href="pricing.php"><i class="ti ti-currency-dollar fs-16 me-2"></i><span>Pricing</span> </a>
							</li>
							<li class="<?php echo ($page =='coming-soon.php') ? 'active' : '' ;?>">
								<a href="coming-soon.php"><i class="ti ti-send fs-16 me-2"></i><span>Coming Soon</span> </a>
							</li>
							<li class="<?php echo ($page =='under-maintenance.php') ? 'active' : '' ;?>">
								<a href="under-maintenance.php"><i class="ti ti-alert-triangle fs-16 me-2"></i><span>Under Maintenance</span> </a>
							</li>
						</ul>
					</li>
					<li class="submenu-open">
						<h6 class="submenu-hdr">Settings</h6>
						<ul>
							<li class="submenu">
								<a href="javascript:void(0);" class="<?php echo ($page =='general-settings.php' || $page == 'security-settings.php' || $page == 'notification.php' || $page =='activities.php' || $page == 'connected-apps.php') ? 'active subdrop' : '' ;?>"><i class="ti ti-settings fs-16 me-2"></i><span>General Settings</span><span class="menu-arrow"></span></a>
								<ul>
									<li><a href="general-settings.php" class="<?php echo ($page =='general-settings.php') ? 'active' : '' ;?>">Profile</a></li>
									<li><a href="security-settings.php" class="<?php echo ($page =='security-settings.php') ? 'active' : '' ;?>">Security</a></li>
									<li><a href="notification.php" class="<?php echo ($page =='notification.php' || $page =='activities.php') ? 'active' : '' ;?>">Notifications</a></li>
									<li><a href="connected-apps.php" class="<?php echo ($page =='connected-apps.php') ? 'active' : '' ;?>">Connected Apps</a></li>
								</ul>
							</li>
							<li class="submenu">
								<a href="javascript:void(0);" class="<?php echo ($page =='system-settings.php' || $page == 'company-settings.php' || $page == 'localization-settings.php' || $page == 'prefixes.php' || $page == 'preference.php' || $page == 'appearance.php' || $page == 'social-authentication.php' || $page == 'language-settings.php' || $page =='language-settings-web.php') ? 'active subdrop' : '' ;?>"><i class="ti ti-world fs-16 me-2"></i><span>Website Settings</span><span class="menu-arrow"></span></a>
								<ul>
									<li><a href="system-settings.php" class="<?php echo ($page =='system-settings.php') ? 'active' : '' ;?>">System Settings</a></li>
									<li><a href="company-settings.php" class="<?php echo ($page =='company-settings.php') ? 'active' : '' ;?>">Company Settings </a></li>
									<li><a href="localization-settings.php" class="<?php echo ($page =='localization-settings.php') ? 'active' : '' ;?>">Localization</a></li>
									<li><a href="prefixes.php" class="<?php echo ($page =='prefixes.php') ? 'active' : '' ;?>">Prefixes</a></li>
									<li><a href="preference.php" class="<?php echo ($page =='preference.php') ? 'active' : '' ;?>">Preference</a></li>
									<li><a href="appearance.php" class="<?php echo ($page =='appearance.php') ? 'active' : '' ;?>">Appearance</a></li>
									<li><a href="social-authentication.php" class="<?php echo ($page =='social-authentication.php') ? 'active' : '' ;?>">Social Authentication</a></li>
									<li><a href="language-settings.php" class="<?php echo ($page =='language-settings.php' || $page =='language-settings-web.php') ? 'active' : '' ;?>">Language</a></li>
								</ul>
							</li>
							<li class="submenu">
								<a href="javascript:void(0);" class="<?php echo ($page =='invoice-settings.php' || $page == 'invoice-templates.php' || $page == 'printer-settings.php' || $page == 'pos-settings.php' || $page == 'signatures.php' || $page == 'custom-fields.php') ? 'active subdrop' : '' ;?>"><i class="ti ti-device-mobile fs-16 me-2"></i>
									<span>App Settings</span><span class="menu-arrow"></span>
								</a>
								<ul>
									<li class="submenu submenu-two"><a href="javascript:void(0);" class="<?php echo ($page =='invoice-settings.php' || $page == 'invoice-templates.php') ? 'active subdrop' : '' ;?>">Invoice<span class="menu-arrow inside-submenu"></span></a>
										<ul>
											<li><a href="invoice-settings.php" class="<?php echo ($page =='invoice-settings.php') ? 'active' : '' ;?>">Invoice Settings</a></li>
											<li><a href="invoice-templates.php" class="<?php echo ($page =='invoice-templates.php') ? 'active' : '' ;?>">Invoice Template</a></li>
										</ul>
									</li>
									<li><a href="printer-settings.php" class="<?php echo ($page =='printer-settings.php') ? 'active' : '' ;?>">Printer</a></li>
									<li><a href="pos-settings.php" class="<?php echo ($page =='pos-settings.php') ? 'active' : '' ;?>">POS</a></li>
									<li><a href="signatures.php" class="<?php echo ($page =='signatures.php') ? 'active' : '' ;?>">Signatures</a></li>
									<li><a href="custom-fields.php" class="<?php echo ($page =='custom-fields.php') ? 'active' : '' ;?>">Custom Fields</a></li>
								</ul>
							</li>
							<li class="submenu">
								<a href="javascript:void(0);" class="<?php echo ($page =='email-settings.php' || $page == 'email-templates.php' || $page =='sms-settings.php' || $page == 'sms-templates.php' || $page == 'otp-settings.php'  || $page == 'gdpr-settings.php'  ) ? 'active subdrop' : '' ;?>"><i class="ti ti-device-desktop fs-16 me-2"></i>
									<span>System Settings</span><span class="menu-arrow"></span>
								</a>
								<ul>
									<li class="submenu submenu-two"><a href="javascript:void(0);" class="<?php echo ($page =='email-settings.php' || $page == 'email-templates.php') ? 'active subdrop' : '' ;?>">Email<span class="menu-arrow inside-submenu"></span></a>
										<ul>
											<li><a href="email-settings.php" class="<?php echo ($page =='email-settings.php') ? 'active' : '' ;?>">Email Settings</a></li>
											<li><a href="email-templates.php" class="<?php echo ($page =='email-templates.php') ? 'active' : '' ;?>">Email Template</a></li>
										</ul>
									</li>
									<li class="submenu submenu-two"><a href="javascript:void(0);" class="<?php echo ($page =='sms-settings.php' || $page == 'sms-templates.php') ? 'active subdrop' : '' ;?>">SMS<span class="menu-arrow inside-submenu"></span></a>
										<ul>
											<li><a href="sms-settings.php" class="<?php echo ($page =='sms-settings.php') ? 'active' : '' ;?>">SMS Settings</a></li>
											<li><a href="sms-templates.php" class="<?php echo ($page =='sms-templates.php') ? 'active' : '' ;?>">SMS Template</a></li>
										</ul>
									</li>
									<li><a href="otp-settings.php" class="<?php echo ($page =='otp-settings.php') ? 'active' : '' ;?>">OTP</a></li>
									<li><a href="gdpr-settings.php" class="<?php echo ($page =='gdpr-settings.php') ? 'active' : '' ;?>">GDPR Cookies</a></li>
								</ul>
							</li>
							<li class="submenu">
								<a href="javascript:void(0);" class="<?php echo ($page =='payment-gateway-settings.php' || $page == 'bank-settings-grid.php' || $page =='bank-settings-list.php' || $page == 'tax-rates.php' || $page == 'currency-settings.php') ? 'active subdrop' : '' ;?>"><i class="ti ti-settings-dollar fs-16 me-2"></i>
									<span>Financial Settings</span><span class="menu-arrow"></span>
								</a>
								<ul>
									<li><a href="payment-gateway-settings.php" class="<?php echo ($page =='payment-gateway-settings.php') ? 'active' : '' ;?>">Payment Gateway</a></li>
									<li><a href="bank-settings-grid.php" class="<?php echo ($page =='bank-settings-grid.php' || $page =='bank-settings-list.php') ? 'active' : '' ;?>">Bank Accounts</a></li>
									<li><a href="tax-rates.php" class="<?php echo ($page =='tax-rates.php') ? 'active' : '' ;?>">Tax Rates</a></li>
									<li><a href="currency-settings.php" class="<?php echo ($page =='currency-settings.php') ? 'active' : '' ;?>">Currencies</a></li>
								</ul>
							</li>
							<li class="submenu">
								<a href="javascript:void(0);" class="<?php echo ($page =='storage-settings.php' || $page == 'ban-ip-address.php') ? 'active subdrop' : '' ;?>"><i class="ti ti-settings-2 fs-16 me-2"></i>
									<span>Other Settings</span><span class="menu-arrow"></span>
								</a>
								<ul>
									<li><a href="storage-settings.php" class="<?php echo ($page =='storage-settings.php') ? 'active' : '' ;?>">Storage</a></li>
									<li><a href="ban-ip-address.php" class="<?php echo ($page =='ban-ip-address.php') ? 'active' : '' ;?>">Ban IP Address</a></li>
								</ul>
							</li>
							<li class="<?php echo ($page =='signin.php') ? 'active' : '' ;?>">
								<a href="../auth/logout.php"><i class="ti ti-logout fs-16 me-2"></i><span>Logout</span> </a>
							</li>
						</ul>
					</li>
					<li class="submenu-open">
						<h6 class="submenu-hdr">UI Interface</h6>
						<ul>
							<li class="submenu">
								<a href="javascript:void(0);" class="<?php echo ($page =='ui-alerts.php' || $page == 'ui-accordion.php' || $page == 'ui-avatar.php' || $page == 'ui-badges.php' || $page == 'ui-borders.php' || $page == 'ui-buttons.php' || $page == 'ui-buttons-group.php' || $page == 'ui-breadcrumb.php' || $page == 'ui-cards.php' || $page == 'ui-carousel.php' || $page == 'ui-colors.php' || $page == 'ui-dropdowns.php' || $page == 'ui-grid.php' || $page == 'ui-images.php' || $page == 'ui-lightbox.php' || $page == 'ui-media.php' || $page == 'ui-modals.php'
								|| $page == 'ui-offcanvas.php' || $page == 'ui-pagination.php' || $page == 'ui-popovers.php' || $page == 'ui-progress.php' || $page == 'ui-placeholders.php' || $page == 'ui-rangeslider.php' || $page == 'ui-spinner.php' || $page == 'ui-sweetalerts.php' || $page == 'ui-nav-tabs.php' || $page == 'ui-toasts.php' || $page == 'ui-tooltips.php' || $page == 'ui-typography.php' || $page == 'ui-video.php' || $page == 'ui-sortable.php' || $page == 'ui-swiperjs.php') ? 'active subdrop' : '' ;?>">
									<i class="ti ti-vector-bezier fs-16 me-2"></i><span>Base UI</span><span class="menu-arrow"></span>
								</a>
								<ul>
									<li><a href="ui-alerts.php" class="<?php echo ($page =='ui-alerts.php') ? 'active' : '' ;?>">Alerts</a></li>
									<li><a href="ui-accordion.php" class="<?php echo ($page =='ui-accordion.php') ? 'active' : '' ;?>">Accordion</a></li>
									<li><a href="ui-avatar.php" class="<?php echo ($page =='ui-avatar.php') ? 'active' : '' ;?>">Avatar</a></li>
									<li><a href="ui-badges.php" class="<?php echo ($page =='ui-badges.php') ? 'active' : '' ;?>">Badges</a></li>
									<li><a href="ui-borders.php" class="<?php echo ($page =='ui-borders.php') ? 'active' : '' ;?>">Border</a></li>
									<li><a href="ui-buttons.php" class="<?php echo ($page =='ui-buttons.php') ? 'active' : '' ;?>">Buttons</a></li>
									<li><a href="ui-buttons-group.php" class="<?php echo ($page =='ui-buttons-group.php') ? 'active' : '' ;?>">Button Group</a></li>
									<li><a href="ui-breadcrumb.php" class="<?php echo ($page =='ui-breadcrumb.php') ? 'active' : '' ;?>">Breadcrumb</a></li>
									<li><a href="ui-cards.php" class="<?php echo ($page =='ui-cards.php') ? 'active' : '' ;?>">Card</a></li>
									<li><a href="ui-carousel.php" class="<?php echo ($page =='ui-carousel.php') ? 'active' : '' ;?>">Carousel</a></li>
									<li><a href="ui-colors.php" class="<?php echo ($page =='ui-colors.php') ? 'active' : '' ;?>">Colors</a></li>
									<li><a href="ui-dropdowns.php" class="<?php echo ($page =='ui-dropdowns.php') ? 'active' : '' ;?>">Dropdowns</a></li>
									<li><a href="ui-grid.php" class="<?php echo ($page =='ui-grid.php') ? 'active' : '' ;?>">Grid</a></li>
									<li><a href="ui-images.php" class="<?php echo ($page =='ui-images.php') ? 'active' : '' ;?>">Images</a></li>
									<li><a href="ui-lightbox.php" class="<?php echo ($page =='ui-lightbox.php') ? 'active' : '' ;?>">Lightbox</a></li>
									<li><a href="ui-media.php" class="<?php echo ($page =='ui-media.php') ? 'active' : '' ;?>">Media</a></li>
									<li><a href="ui-modals.php" class="<?php echo ($page =='ui-modals.php') ? 'active' : '' ;?>">Modals</a></li>
									<li><a href="ui-offcanvas.php" class="<?php echo ($page =='ui-offcanvas.php') ? 'active' : '' ;?>">Offcanvas</a></li>
									<li><a href="ui-pagination.php" class="<?php echo ($page =='ui-pagination.php') ? 'active' : '' ;?>">Pagination</a></li>
									<li><a href="ui-popovers.php" class="<?php echo ($page =='ui-popovers.php') ? 'active' : '' ;?>">Popovers</a></li>
									<li><a href="ui-progress.php" class="<?php echo ($page =='ui-progress.php') ? 'active' : '' ;?>">Progress</a></li>
									<li><a href="ui-placeholders.php" class="<?php echo ($page =='ui-placeholders.php') ? 'active' : '' ;?>">Placeholders</a></li>
									<li><a href="ui-rangeslider.php" class="<?php echo ($page =='ui-rangeslider.php') ? 'active' : '' ;?>">Range Slider</a></li>
									<li><a href="ui-spinner.php" class="<?php echo ($page =='ui-spinner.php') ? 'active' : '' ;?>">Spinner</a></li>
									<li><a href="ui-sweetalerts.php" class="<?php echo ($page =='ui-sweetalerts.php') ? 'active' : '' ;?>">Sweet Alerts</a></li>
									<li><a href="ui-nav-tabs.php" class="<?php echo ($page =='ui-nav-tabs.php') ? 'active' : '' ;?>">Tabs</a></li>
									<li><a href="ui-toasts.php" class="<?php echo ($page =='ui-toasts.php') ? 'active' : '' ;?>">Toasts</a></li>
									<li><a href="ui-tooltips.php" class="<?php echo ($page =='ui-tooltips.php') ? 'active' : '' ;?>">Tooltips</a></li>
									<li><a href="ui-typography.php" class="<?php echo ($page =='ui-typography.php') ? 'active' : '' ;?>">Typography</a></li>
									<li><a href="ui-video.php" class="<?php echo ($page =='ui-video.php') ? 'active' : '' ;?>">Video</a></li>
									<li><a href="ui-sortable.php" class="<?php echo ($page =='ui-sortable.php') ? 'active' : '' ;?>">Sortable</a></li>
									<li><a href="ui-swiperjs.php" class="<?php echo ($page =='ui-swiperjs.php') ? 'active' : '' ;?>">Swiperjs</a></li>
								</ul>
							</li>
							<li class="submenu">
								<a href="javascript:void(0);" class="<?php echo ($page =='ui-ribbon.php' || $page == 'ui-clipboard.php' || $page == 'ui-drag-drop.php' || $page == 'ui-rangeslider.php' || $page == 'ui-rating.php' || $page == 'ui-text-editor.php' || $page == 'ui-counter.php' || $page == 'ui-scrollbar.php' || $page == 'ui-stickynote.php' || $page == 'ui-timeline.php') ? 'active subdrop' : '' ;?>">
									<i data-feather="layers"></i><span>Advanced UI</span><span class="menu-arrow"></span>
								</a>
								<ul>
									<li><a href="ui-ribbon.php" class="<?php echo ($page =='ui-ribbon.php') ? 'active' : '' ;?>">Ribbon</a></li>
									<li><a href="ui-clipboard.php" class="<?php echo ($page =='ui-clipboard.php') ? 'active' : '' ;?>">Clipboard</a></li>
									<li><a href="ui-drag-drop.php" class="<?php echo ($page =='ui-drag-drop.php') ? 'active' : '' ;?>">Drag & Drop</a></li>
									<li><a href="ui-rangeslider.php" class="<?php echo ($page =='ui-rangeslider.php') ? 'active' : '' ;?>">Range Slider</a></li>
									<li><a href="ui-rating.php" class="<?php echo ($page =='ui-rating.php') ? 'active' : '' ;?>">Rating</a></li>
									<li><a href="ui-text-editor.php" class="<?php echo ($page =='ui-text-editor.php') ? 'active' : '' ;?>">Text Editor</a></li>
									<li><a href="ui-counter.php" class="<?php echo ($page =='ui-counter.php') ? 'active' : '' ;?>">Counter</a></li>
									<li><a href="ui-scrollbar.php" class="<?php echo ($page =='ui-scrollbar.php') ? 'active' : '' ;?>">Scrollbar</a></li>
									<li><a href="ui-stickynote.php" class="<?php echo ($page =='ui-stickynote.php') ? 'active' : '' ;?>">Sticky Note</a></li>
									<li><a href="ui-timeline.php" class="<?php echo ($page =='ui-timeline.php') ? 'active' : '' ;?>">Timeline</a></li>
								</ul>
							</li>
							<li class="submenu">
								<a href="javascript:void(0);" class="<?php echo ($page =='chart-apex.php' || $page == 'chart-c3.php' || $page == 'chart-js.php' || $page == 'chart-morris.php' || $page == 'chart-flot.php' || $page == 'chart-peity.php') ? 'active subdrop' : '' ;?>"><i class="ti ti-chart-infographic fs-16 me-2"></i>
									<span>Charts</span><span class="menu-arrow"></span>
								</a>
								<ul>
									<li><a href="chart-apex.php" class="<?php echo ($page =='chart-apex.php') ? 'active' : '' ;?>">Apex Charts</a></li>
									<li><a href="chart-c3.php" class="<?php echo ($page =='chart-c3.php') ? 'active' : '' ;?>">Chart C3</a></li>
									<li><a href="chart-js.php" class="<?php echo ($page =='chart-js.php') ? 'active' : '' ;?>">Chart Js</a></li>
									<li><a href="chart-morris.php" class="<?php echo ($page =='chart-morris.php') ? 'active' : '' ;?>">Morris Charts</a></li>
									<li><a href="chart-flot.php" class="<?php echo ($page =='chart-flot.php') ? 'active' : '' ;?>">Flot Charts</a></li>
									<li><a href="chart-peity.php" class="<?php echo ($page =='chart-peity.php') ? 'active' : '' ;?>">Peity Charts</a></li>
								</ul>
							</li>
							<li class="submenu">
								<a href="javascript:void(0);" class="<?php echo ($page =='icon-fontawesome.php' || $page == 'icon-feather.php' || $page == 'icon-ionic.php' || $page == 'icon-material.php' || $page == 'icon-pe7.php' || $page == 'icon-simpleline.php' || $page == 'icon-themify.php' || $page == 'icon-weather.php' || $page == 'icon-typicon.php' || $page == 'icon-flag.php' || $page == 'icon-tabler.php' || $page == 'icon-bootstrap.php' || $page == 'icon-remix.php') ? 'active subdrop' : '' ;?>"><i class="ti ti-icons fs-16 me-2"></i>
									<span>Icons</span><span class="menu-arrow"></span>
								</a>
								<ul>
									<li><a href="icon-fontawesome.php" class="<?php echo ($page =='icon-fontawesome.php') ? 'active' : '' ;?>">Fontawesome Icons</a></li>
									<li><a href="icon-feather.php" class="<?php echo ($page =='icon-feather.php') ? 'active' : '' ;?>">Feather Icons</a></li>
									<li><a href="icon-ionic.php" class="<?php echo ($page =='icon-ionic.php') ? 'active' : '' ;?>">Ionic Icons</a></li>
									<li><a href="icon-material.php" class="<?php echo ($page =='icon-material.php') ? 'active' : '' ;?>">Material Icons</a></li>
									<li><a href="icon-pe7.php" class="<?php echo ($page =='icon-pe7.php') ? 'active' : '' ;?>">Pe7 Icons</a></li>
									<li><a href="icon-simpleline.php" class="<?php echo ($page =='icon-simpleline.php') ? 'active' : '' ;?>">Simpleline Icons</a></li>
									<li><a href="icon-themify.php" class="<?php echo ($page =='icon-themify.php') ? 'active' : '' ;?>">Themify Icons</a></li>
									<li><a href="icon-weather.php" class="<?php echo ($page =='icon-weather.php') ? 'active' : '' ;?>">Weather Icons</a></li>
									<li><a href="icon-typicon.php" class="<?php echo ($page =='icon-typicon.php') ? 'active' : '' ;?>">Typicon Icons</a></li>
									<li><a href="icon-flag.php" class="<?php echo ($page =='icon-flag.php') ? 'active' : '' ;?>">Flag Icons</a></li>
									<li><a href="icon-tabler.php" class="<?php echo ($page =='icon-tabler.php') ? 'active' : '' ;?>">Tabler Icons</a></li>
									<li><a href="icon-bootstrap.php" class="<?php echo ($page =='icon-bootstrap.php') ? 'active' : '' ;?>">Bootstrap Icons</a></li>
									<li><a href="icon-remix.php" class="<?php echo ($page =='icon-remix.php') ? 'active' : '' ;?>">Remix Icons</a></li>
								</ul>
							</li>
							<li class="submenu">
								<a href="javascript:void(0);" class="<?php echo ($page =='form-basic-inputs.php' || $page == 'form-checkbox-radios.php' || $page == 'form-input-groups.php' || $page == 'form-grid-gutters.php' || $page == 'form-select.php' || $page == 'form-fileupload.php' || $page == 'form-mask.php' || $page =='form-horizontal.php' || $page == 'form-vertical.php' || $page == 'form-floating-labels.php' || $page == 'form-mask.php' || $page == 'form-validation.php' || $page == 'form-select2.php' || $page == 'form-wizard.php' || $page == 'form-pickers.php') ? 'active subdrop' : '' ;?>">
									<i class="ti ti-input-search fs-16 me-2"></i><span>Forms</span><span class="menu-arrow"></span>
								</a>
								<ul>
									<li class="submenu submenu-two">
										<a href="javascript:void(0);" class="<?php echo ($page =='form-basic-inputs.php' || $page == 'form-checkbox-radios.php' || $page == 'form-input-groups.php' || $page == 'form-grid-gutters.php' || $page == 'form-select.php' || $page == 'form-fileupload.php' || $page == 'form-mask.php') ? 'active subdrop' : '' ;?>">Form Elements<span class="menu-arrow inside-submenu"></span></a>
										<ul>
											<li><a href="form-basic-inputs.php" class="<?php echo ($page =='form-basic-inputs.php') ? 'active' : '' ;?>">Basic Inputs</a></li>
											<li><a href="form-checkbox-radios.php" class="<?php echo ($page =='form-checkbox-radios.php') ? 'active' : '' ;?>">Checkbox & Radios</a></li>
											<li><a href="form-input-groups.php" class="<?php echo ($page =='form-input-groups.php') ? 'active' : '' ;?>">Input Groups</a></li>
											<li><a href="form-grid-gutters.php" class="<?php echo ($page =='form-grid-gutters.php') ? 'active' : '' ;?>">Grid & Gutters</a></li>
											<li><a href="form-select.php" class="<?php echo ($page =='form-select.php') ? 'active' : '' ;?>">Form Select</a></li>
											<li><a href="form-mask.php" class="<?php echo ($page =='form-mask.php') ? 'active' : '' ;?>">Input Masks</a></li>
											<li><a href="form-fileupload.php" class="<?php echo ($page =='form-fileupload.php') ? 'active' : '' ;?>">File Uploads</a></li>
										</ul>
									</li>
									<li class="submenu submenu-two">
										<a href="javascript:void(0);" class="<?php echo ($page =='form-horizontal.php' || $page == 'form-vertical.php' || $page == 'form-floating-labels.php') ? 'active subdrop' : '' ;?>">Layouts<span class="menu-arrow inside-submenu"></span></a>
										<ul>
											<li><a href="form-horizontal.php" class="<?php echo ($page =='form-horizontal.php') ? 'active' : '' ;?>">Horizontal Form</a></li>
											<li><a href="form-vertical.php" class="<?php echo ($page =='form-vertical.php') ? 'active' : '' ;?>">Vertical Form</a></li>
											<li><a href="form-floating-labels.php" class="<?php echo ($page =='form-floating-labels.php') ? 'active' : '' ;?>">Floating Labels</a></li>
										</ul>
									</li>
									<li><a href="form-validation.php" class="<?php echo ($page =='form-validation.php') ? 'active' : '' ;?>">Form Validation</a></li>
									<li><a href="form-select2.php" class="<?php echo ($page =='form-select2.php') ? 'active' : '' ;?>">Select2</a></li>
									<li><a href="form-wizard.php" class="<?php echo ($page =='form-wizard.php') ? 'active' : '' ;?>">Form Wizard</a></li>
									<li><a href="form-pickers.php" class="<?php echo ($page =='form-pickers.php') ? 'active' : '' ;?>">Form Picker</a></li>
								</ul>
							</li>
							<li class="submenu">
								<a href="javascript:void(0);" class="<?php echo ($page =='tables-basic.php' || $page == 'data-tables.php') ? 'active subdrop' : '' ;?>"><i class="ti ti-table fs-16 me-2"></i><span>Tables</span><span class="menu-arrow"></span></a>
								<ul>
									<li><a href="tables-basic.php" class="<?php echo ($page =='tables-basic.php') ? 'active' : '' ;?>">Basic Tables </a></li>
									<li><a href="data-tables.php" class="<?php echo ($page =='data-tables.php') ? 'active' : '' ;?>">Data Table </a></li>
								</ul>
							</li>
							<li class="submenu">
								<a href="javascript:void(0);" class="<?php echo ($page =='maps-vector.php' || $page == 'maps-leaflet.php') ? 'active subdrop' : '' ;?>"><i class="ti ti-map-pin-pin fs-16 me-2"></i><span>Maps</span><span class="menu-arrow"></span></a>
								<ul>
									<li><a href="maps-vector.php" class="<?php echo ($page =='maps-vector.php') ? 'active' : '' ;?>">Vector</a></li>
									<li><a href="maps-leaflet.php" class="<?php echo ($page =='maps-leaflet.php') ? 'active' : '' ;?>">Leaflet</a></li>
								</ul>
							</li>
						</ul>
					</li>
					<li class="submenu-open">
						<h6 class="submenu-hdr">Help</h6>
						<ul>
							<li><a href="javascript:void(0);"><i class="ti ti-file-text fs-16 me-2"></i><span>Documentation</span></a></li>
							<li><a href="javascript:void(0);"><i class="ti ti-exchange fs-16 me-2"></i><span>Changelog </span><span class="badge bg-primary badge-xs text-white fs-10 ms-2">v2.1.3</span></a></li>
							<li class="submenu">
								<a href="javascript:void(0);"><i class="ti ti-menu-2 fs-16 me-2"></i><span>Multi Level</span><span class="menu-arrow"></span></a>
								<ul>
									<li><a href="javascript:void(0);">Level 1.1</a></li>
									<li class="submenu submenu-two"><a href="javascript:void(0);">Level 1.2<span class="menu-arrow inside-submenu"></span></a>
										<ul>
											<li><a href="javascript:void(0);">Level 2.1</a></li>
											<li class="submenu submenu-two submenu-three"><a href="javascript:void(0);">Level 2.2<span class="menu-arrow inside-submenu inside-submenu-two"></span></a>
												<ul>
													<li><a href="javascript:void(0);">Level 3.1</a></li>
													<li><a href="javascript:void(0);">Level 3.2</a></li>
												</ul>
											</li>
										</ul>
									</li>
								</ul>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- /Sidebar -->

