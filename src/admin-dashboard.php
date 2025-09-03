<?php ob_start();?>

    <!-- ========================
        Start Page Content
    ========================= -->

    <div class="page-wrapper">

        <!-- Start Content -->
		<div class="content">
			<div class="row">
				<div class="col-xl-3 col-sm-6 col-12 d-flex">
					<div class="card dash-widget w-100">
						<div class="card-body d-flex align-items-center">
							<div class="dash-widgetimg">
								<span><img src="assets/img/icons/dash1.svg" alt="img"></span>
							</div>
							<div class="dash-widgetcontent">
								<h5 class="mb-1">$<span class="counters" data-count="307144.00">$307,144.00</span></h5>
								<p class="mb-0">Total Purchase Due</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-sm-6 col-12 d-flex">
					<div class="card dash-widget dash1 w-100">
						<div class="card-body d-flex align-items-center">
							<div class="dash-widgetimg">
								<span><img src="assets/img/icons/dash2.svg" alt="img"></span>
							</div>
							<div class="dash-widgetcontent">
								<h5 class="mb-1">$<span class="counters" data-count="4385.00">$4,385.00</span></h5>
								<p class="mb-0">Total Sales Due</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-sm-6 col-12 d-flex">
					<div class="card dash-widget dash2 w-100">
						<div class="card-body d-flex align-items-center">
							<div class="dash-widgetimg">
								<span><img src="assets/img/icons/dash3.svg" alt="img"></span>
							</div>
							<div class="dash-widgetcontent">
								<h5 class="mb-1">$<span class="counters" data-count="385656.50">$385,656.50</span></h5>
								<p class="mb-0">Total Sale Amount</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-sm-6 col-12 d-flex">
					<div class="card dash-widget dash3 w-100">
						<div class="card-body d-flex align-items-center">
							<div class="dash-widgetimg">
								<span><img src="assets/img/icons/dash4.svg" alt="img"></span>
							</div>
							<div class="dash-widgetcontent">
								<h5 class="mb-1">$<span class="counters" data-count="40000.00">$400.00</span></h5>
								<p class="mb-0">Total Expense Amount</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-sm-6 col-12 d-flex">
					<div class="dash-count bg-primary">
						<div class="dash-counts">
							<h4 class="mb-1">100</h4>
							<p class="text-white mb-0">Customers</p>
						</div>
						<div class="dash-imgs">
							<i data-feather="user"></i>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-sm-6 col-12 d-flex">
					<div class="dash-count das1 bg-cyan-900">
						<div class="dash-counts">
							<h4 class="mb-1">110</h4>
							<p class="text-white mb-0">Suppliers</p>
						</div>
						<div class="dash-imgs">
							<i data-feather="user-check"></i>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-sm-6 col-12 d-flex">
					<div class="dash-count das2 bg-dark">
						<div class="dash-counts">
							<h4 class="mb-1">150</h4>
							<p class="text-white mb-0">Purchase Invoice</p>
						</div>
						<div class="dash-imgs">
							<img src="assets/img/icons/file-text-icon-01.svg" class="img-fluid" alt="icon">
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-sm-6 col-12 d-flex">
					<div class="dash-count das3 bg-success">
						<div class="dash-counts">
							<h4 class="mb-1">170</h4>
							<p class="text-white mb-0">Sales Invoice</p>
						</div>
						<div class="dash-imgs">
							<i data-feather="file"></i>
						</div>
					</div>
				</div>
			</div>
			<!-- Button trigger modal -->

			<div class="row">
				<div class="col-xl-7 col-sm-12 col-12 d-flex">
					<div class="card flex-fill">
						<div class="card-header d-flex justify-content-between align-items-center">
							<h5 class="card-title mb-0">Purchase & Sales</h5>
							<div class="graph-sets">
								<ul class="mb-0">
									<li>
										<span>Sales</span>
									</li>
									<li>
										<span>Purchase</span>
									</li>
								</ul>
								<div class="dropdown">
									<a href="javascript:void(0);" class="dropdown-toggle btn btn-sm btn-white"  data-bs-toggle="dropdown" aria-expanded="false">
										2025
									</a>
									<ul class="dropdown-menu p-3">
										<li>
											<a href="javascript:void(0);" class="dropdown-item">2025</a>
										</li>
										<li>
											<a href="javascript:void(0);" class="dropdown-item">2022</a>
										</li>
										<li>
											<a href="javascript:void(0);" class="dropdown-item">2021</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="card-body pb-0">
							<div id="sales_charts"></div>
						</div>
					</div>
				</div>

				<!-- Recent Products -->
				<div class="col-xl-5 col-sm-12 col-12 d-flex">
					<div class="card flex-fill default-cover mb-4">
						<div class="card-header d-flex justify-content-between align-items-center">
							<h4 class="card-title mb-0">Recently Added Products</h4>
							<a href="product-list.php" class="fs-13 fw-medium text-decoration-underline">View All</a>
						</div>
						<div class="card-body p-0">
							<div class="table-responsive dataview">
								<table class="table dashboard-recent-products">
									<thead class="thead-light">
										<tr>
											<th>#</th>
											<th>Products</th>
											<th>Price</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>1</td>
											<td>
												<div class="d-flex align-items-center">
													<a href="product-list.php" class="avatar avatar-lg me-3">
														<img src="assets/img/products/stock-img-01.png" alt="img">
													</a>
													<div>
														<h6><a href="product-list.php" class="fw-bold">Lenevo 3rd Generation</a></h6>
													</div>
												</div>
											</td>
											<td>$12500</td>
										</tr>
										<tr>
											<td>2</td>
											<td>
												<div class="d-flex align-items-center">
													<a href="product-list.php" class="avatar avatar-lg me-3">
														<img src="assets/img/products/stock-img-06.png" alt="img">
													</a>
													<div>
														<h6><a href="product-list.php" class="fw-bold">Bold V3.2</a></h6>
													</div>
												</div>
											</td>
											<td>$1600</td>
										</tr>
										<tr>
											<td>3</td>
											<td>
												<div class="d-flex align-items-center">
													<a href="product-list.php" class="avatar avatar-lg me-3">
														<img src="assets/img/products/stock-img-02.png" alt="img">
													</a>
													<div>
														<h6><a href="product-list.php" class="fw-bold">Nike Jordan</a></h6>
													</div>
												</div>
											</td>
											<td>$2000</td>
										</tr>
										<tr>
											<td>4</td>
											<td>
												<div class="d-flex align-items-center">
													<a href="product-list.php" class="avatar avatar-lg me-3">
														<img src="assets/img/products/stock-img-03.png" alt="img">
													</a>
													<div>
														<h6><a href="product-list.php" class="fw-bold">Apple Series 5 Watch</a></h6>
													</div>
												</div>
											</td>
											<td>$800</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<!-- /Recent Products -->

			</div>

			<!-- Expired Products -->
			<div class="card">
				<div class="card-header d-flex justify-content-between align-items-center">
					<h4 class="card-title">Expired Products</h4>
					<div class="view-all-link">
						<a href="expired-products.php" class="fs-13 fw-medium text-decoration-underline">View All</a>
					</div>
				</div>
				<div class="card-body p-0">
					<div class="table-responsive dataview">
						<table class="table dashboard-expired-products">
							<thead class="thead-light">
								<tr>
									<th class="no-sort">
										<label class="checkboxs">
											<input type="checkbox" id="select-all">
											<span class="checkmarks"></span>
										</label>
									</th>
									<th>Product</th>
									<th>SKU</th>
									<th>Manufactured Date</th>
									<th>Expired Date</th>
									<th class="no-sort">Action</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										<label class="checkboxs">
											<input type="checkbox">
											<span class="checkmarks"></span>
										</label>
									</td>
									<td>
										<div class="d-flex align-items-center">
											<a href="javascript:void(0);" class="avatar avatar-lg me-2">
												<img src="assets/img/products/expire-product-01.png" alt="img">
											</a>
											<div>
												<h6><a href="javascript:void(0);" class="fw-bold">Red Premium Handy</a></h6>
											</div>
										</div>
									</td>
									<td>PT006</td>
									<td>17 Jan 2023</td>
									<td>29 Mar 2023</td>
									<td class="action-table-data">
										<div class="edit-delete-action">
											<a class="me-2 p-2" href="#">
												<i data-feather="edit" class="feather-edit"></i>
											</a>
											<a class="p-2" href="javascript:void(0);">
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
									<td>
										<div class="d-flex align-items-center">
											<a href="javascript:void(0);" class="avatar avatar-lg me-2">
												<img src="assets/img/products/expire-product-02.png" alt="img">
											</a>
											<div>
												<h6><a href="javascript:void(0);" class="fw-bold">Iphone 14 Pro</a></h6>
											</div>
										</div>
									</td>
									<td>PT007</td>
									<td>22 Feb 2023</td>
									<td>04 Apr 2023</td>
									<td class="action-table-data">
										<div class="edit-delete-action">
											<a class="me-2 p-2" href="#">
												<i data-feather="edit" class="feather-edit"></i>
											</a>
											<a class="p-2" href="javascript:void(0);">
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
									<td>
										<div class="d-flex align-items-center">
											<a href="javascript:void(0);" class="avatar avatar-lg me-2">
												<img src="assets/img/products/expire-product-03.png" alt="img">
											</a>
											<div>
												<h6><a href="javascript:void(0);" class="fw-bold">Black Slim 200</a></h6>
											</div>
										</div>
									</td>
									<td>PT008</td>
									<td>18 Mar 2023</td>
									<td>13 May 2023</td>
									<td class="action-table-data">
										<div class="edit-delete-action">
											<a class="me-2 p-2" href="#">
												<i data-feather="edit" class="feather-edit"></i>
											</a>
											<a class="p-2" href="javascript:void(0);">
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
									<td>
										<div class="d-flex align-items-center">
											<a href="javascript:void(0);" class="avatar avatar-lg me-2">
												<img src="assets/img/products/expire-product-04.png" alt="img">
											</a>
											<div>
												<h6><a href="javascript:void(0);" class="fw-bold">Woodcraft Sandal</a></h6>
											</div>
										</div>
									</td>
									<td>PT009</td>
									<td>29 Mar 2023</td>
									<td>27 May 2023</td>
									<td class="action-table-data">
										<div class="edit-delete-action">
											<a class="me-2 p-2" href="#">
												<i data-feather="edit" class="feather-edit"></i>
											</a>
											<a class="p-2" href="javascript:void(0);">
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
									<td>
										<div class="d-flex align-items-center">
											<a href="javascript:void(0);" class="avatar avatar-lg me-2">
												<img src="assets/img/products/stock-img-03.png" alt="img">
											</a>
											<div>
												<h6><a href="javascript:void(0);" class="fw-bold">Apple Series 5 Watch</a></h6>
											</div>
										</div>
									</td>
									<td>PT010</td>
									<td>24 Mar 2023</td>
									<td>26 May 2023</td>
									<td class="action-table-data">
										<div class="edit-delete-action">
											<a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-units">
												<i data-feather="edit" class="feather-edit"></i>
											</a>
											<a class="p-2" href="javascript:void(0);">
												<i data-feather="trash-2" class="feather-trash-2"></i>
											</a>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- /Expired Products -->

		</div>
        <!-- End Content -->
    
        <?php require_once '../partials/footer.php'; ?>

    </div>

    <!-- ========================
        End Page Content
    ========================= -->

<?php
$content = ob_get_clean();

require_once '../partials/main.php'; ?>      