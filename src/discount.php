<?php ob_start();?>

    <!-- ========================
        Start Page Content
    ========================= -->

    <div class="page-wrapper">

        <!-- Start Content -->
		<div class="content">
			<div class="page-header">
				<div class="add-item d-flex">
					<div class="page-title">
						<h4 class="fw-bold">Discount</h4>
						<h6>Manage your discount</h6>
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
					<a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-discount"><i class="ti ti-circle-plus me-1"></i>Add Discount</a>
				</div>
			</div>
			<!-- /product list -->
			<div class="card">
				<div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
					<div class="search-set">
						<div class="search-input">
							<span class="btn-searchset"><i class="ti ti-search fs-14 feather-search"></i></span>
						</div>
					</div>
					<div class="d-flex table-dropdown my-xl-auto right-content align-items-center flex-wrap row-gap-3">
						<div class="dropdown me-2">
							<a href="javascript:void(0);" class="dropdown-toggle btn btn-white btn-md d-inline-flex align-items-center" data-bs-toggle="dropdown">
								Customer
							</a>
							<ul class="dropdown-menu  dropdown-menu-end p-3">
								<li>
									<a href="javascript:void(0);" class="dropdown-item rounded-1">All Customers</a>
								</li>
								<li>
									<a href="javascript:void(0);" class="dropdown-item rounded-1">Members Only</a>
								</li>
								<li>
									<a href="javascript:void(0);" class="dropdown-item rounded-1">High-Spending Customers</a>
								</li>
								<li>
									<a href="javascript:void(0);" class="dropdown-item rounded-1">Online Customers</a>
								</li>
							</ul>
						</div>	
						<div class="dropdown">
							<a href="javascript:void(0);" class="dropdown-toggle btn btn-white btn-md d-inline-flex align-items-center" data-bs-toggle="dropdown">
								Status
							</a>
							<ul class="dropdown-menu  dropdown-menu-end p-3">
								<li>
									<a href="javascript:void(0);" class="dropdown-item rounded-1">Active</a>
								</li>
								<li>
									<a href="javascript:void(0);" class="dropdown-item rounded-1">Inactive</a>
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
									<th>Name</th>
									<th>Value</th>
									<th>Discount Plan</th>
									<th>Valitidy</th>
									<th>Days</th>
									<th>Products</th>
									<th>Status</th>
									<th class="no-sort"></th>
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
									<td class="text-gray-9">Weekend Deal</td>											
									<td>70 (Percentage)</td>								
									<td>Standard</td>								
									<td>22 May 2025 - 24 Jun 2025</td>								
									<td>Sat, Sun</td>								
									<td>All Products</td>								
									<td><span class="badge table-badge bg-success fw-medium fs-10">Active</span></td>
									<td class="action-table-data">
										<div class="edit-delete-action">										
											<a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-discount">
												<i data-feather="edit" class="feather-edit"></i>
											</a>
											<a data-bs-toggle="modal" data-bs-target="#delete-modal" class="p-2" href="javascript:void(0);">
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
									<td class="text-gray-9">Loyalty Reward</td>											
									<td>40 (Flat)</td>								
									<td>Membership</td>								
									<td>16 Apr 2025 - 16 May 2025</td>								
									<td>Mon, Tue, Thu, Fri</td>								
									<td>Specific Products</td>								
									<td><span class="badge table-badge bg-success fw-medium fs-10">Active</span></td>
									<td class="action-table-data">
										<div class="edit-delete-action">										
											<a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-discount">
												<i data-feather="edit" class="feather-edit"></i>
											</a>
											<a data-bs-toggle="modal" data-bs-target="#delete-modal" class="p-2" href="javascript:void(0);">
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
									<td class="text-gray-9">Flash Sale</td>											
									<td>60 (Percentage)</td>								
									<td>Standard</td>								
									<td>20 Mar 2025 - 20 Apr 2025</td>								
									<td>Thu, Fri, Sat, Sun</td>								
									<td>All Products</td>								
									<td><span class="badge table-badge bg-success fw-medium fs-10">Active</span></td>
									<td class="action-table-data">
										<div class="edit-delete-action">										
											<a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-discount">
												<i data-feather="edit" class="feather-edit"></i>
											</a>
											<a data-bs-toggle="modal" data-bs-target="#delete-modal" class="p-2" href="javascript:void(0);">
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
									<td class="text-gray-9">Super Saver</td>											
									<td>80 (Percentage)</td>								
									<td>Standard</td>								
									<td>15 Feb 2025 - 15 Apr 2025</td>								
									<td>Mon, Tue, Wed</td>								
									<td>All Products</td>								
									<td><span class="badge table-badge bg-success fw-medium fs-10">Active</span></td>
									<td class="action-table-data">
										<div class="edit-delete-action">										
											<a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-discount">
												<i data-feather="edit" class="feather-edit"></i>
											</a>
											<a data-bs-toggle="modal" data-bs-target="#delete-modal" class="p-2" href="javascript:void(0);">
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
									<td class="text-gray-9">Surprise Savings</td>											
									<td>50 (Flat)</td>								
									<td>Standard</td>								
									<td>24 Jan 2025 - 24 Mar 2025</td>								
									<td>Mon, Tue, Thu, Sat</td>								
									<td>Specific Products</td>								
									<td><span class="badge table-badge bg-success fw-medium fs-10">Active</span></td>
									<td class="action-table-data">
										<div class="edit-delete-action">										
											<a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-discount">
												<i data-feather="edit" class="feather-edit"></i>
											</a>
											<a data-bs-toggle="modal" data-bs-target="#delete-modal" class="p-2" href="javascript:void(0);">
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
			<!-- /product list -->
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