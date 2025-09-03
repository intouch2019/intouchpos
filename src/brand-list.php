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
						<h4 class="fw-bold">Brand</h4>
						<h6>Manage your brands</h6>
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
					<a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-brand"><i class="ti ti-circle-plus me-1"></i>Add Brand</a>
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
						<div class="dropdown">
							<a href="javascript:void(0);" class="dropdown-toggle btn btn-white btn-md d-inline-flex align-items-center" data-bs-toggle="dropdown">
								Sort By : Latest
							</a>
							<ul class="dropdown-menu  dropdown-menu-end p-3">
								<li>
									<a href="javascript:void(0);" class="dropdown-item rounded-1">Latest</a>
								</li>
								<li>
									<a href="javascript:void(0);" class="dropdown-item rounded-1">Ascending</a>
								</li>
								<li>
									<a href="javascript:void(0);" class="dropdown-item rounded-1">Desending</a>
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
									<th>Brand</th>
									<th>Created Date</th>
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
									<td>
										<div class="d-flex align-items-center">
											<a href="javascript:void(0);" class="avatar avatar-md bg-light-900 p-1 me-2">
												<img class="object-fit-contain" src="./assets/img/brand/lenova.png" alt="img">
											</a>
											<a href="javascript:void(0);">Lenovo</a>
										</div>
									</td>
									<td>24 Dec 2024</td>
									<td><span class="badge table-badge bg-success fw-medium fs-10">Active</span></td>
									<td class="action-table-data">
										<div class="edit-delete-action">
											<a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-brand">
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
									<td>
										<div class="d-flex align-items-center">
											<a href="javascript:void(0);" class="avatar avatar-md bg-light-900 p-1 me-2">
												<img class="object-fit-contain" src="./assets/img/brand/beats.png" alt="img">
											</a>
											<a href="javascript:void(0);">Beats</a>
										</div>
									</td>
									<td>10 Dec 2024</td>
									<td><span class="badge table-badge bg-success fw-medium fs-10">Active</span></td>
									<td class="action-table-data">
										<div class="edit-delete-action">
											<a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-brand">
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
									<td>
										<div class="d-flex align-items-center">
											<a href="javascript:void(0);" class="avatar avatar-md bg-light-900 p-1 me-2">
												<img class="object-fit-contain" src="./assets/img/brand/nike.png" alt="img">
											</a>
											<a href="javascript:void(0);">Nike</a>
										</div>
									</td>
									<td>27 Nov 2024</td>
									<td><span class="badge table-badge bg-success fw-medium fs-10">Active</span></td>
									<td class="action-table-data">
										<div class="edit-delete-action">
											<a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-brand">
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
									<td>
										<div class="d-flex align-items-center">
											<a href="javascript:void(0);" class="avatar avatar-md bg-light-900 p-1 me-2">
												<img class="object-fit-contain" src="./assets/img/brand/apple.png" alt="img">
											</a>
											<a href="javascript:void(0);">Apple</a>
										</div>
									</td>
									<td>18 Nov 2024</td>
									<td><span class="badge table-badge bg-success fw-medium fs-10">Active</span></td>
									<td class="action-table-data">
										<div class="edit-delete-action">
											<a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-brand">
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
									<td>
										<div class="d-flex align-items-center">
											<a href="javascript:void(0);" class="avatar avatar-md bg-light-900 p-1 me-2">
												<img class="object-fit-contain" src="./assets/img/brand/amazon.png" alt="img">
											</a>
											<a href="javascript:void(0);">Amazon</a>
										</div>
									</td>
									<td>06 Nov 2024</td>
									<td><span class="badge table-badge bg-success fw-medium fs-10">Active</span></td>
									<td class="action-table-data">
										<div class="edit-delete-action">
											<a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-brand">
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
									<td>
										<div class="d-flex align-items-center">
											<a href="javascript:void(0);" class="avatar avatar-md bg-light-900 p-1 me-2">
												<img class="object-fit-contain" src="./assets/img/brand/woodmart.png" alt="img">
											</a>
											<a href="javascript:void(0);">Woodmart</a>
										</div>
									</td>
									<td>25 Oct 2024</td>
									<td><span class="badge table-badge bg-success fw-medium fs-10">Active</span></td>
									<td class="action-table-data">
										<div class="edit-delete-action">
											<a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-brand">
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
									<td>
										<div class="d-flex align-items-center">
											<a href="javascript:void(0);" class="avatar avatar-md bg-light-900 p-1 me-2">
												<img class="object-fit-contain" src="./assets/img/brand/dior.png" alt="img">
											</a>
											<a href="javascript:void(0);">Dior</a>
										</div>
									</td>
									<td>14 Oct 2024</td>
									<td><span class="badge table-badge bg-success fw-medium fs-10">Active</span></td>
									<td class="action-table-data">
										<div class="edit-delete-action">
											<a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-brand">
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
									<td>
										<div class="d-flex align-items-center">
											<a href="javascript:void(0);" class="avatar avatar-md bg-light-900 p-1 me-2">
												<img class="object-fit-contain" src="./assets/img/brand/lava.png" alt="img">
											</a>
											<a href="javascript:void(0);">Lava</a>
										</div>
									</td>
									<td>03 Oct 2024</td>
									<td><span class="badge table-badge bg-success fw-medium fs-10">Active</span></td>
									<td class="action-table-data">
										<div class="edit-delete-action">
											<a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-brand">
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
									<td>
										<div class="d-flex align-items-center">
											<a href="javascript:void(0);" class="avatar avatar-md bg-light-900 p-1 me-2">
												<img class="object-fit-contain" src="./assets/img/brand/nilkamal.png" alt="img">
											</a>
											<a href="javascript:void(0);">Nilkamal</a>
										</div>
									</td>
									<td>20 Sep 2024</td>
									<td><span class="badge table-badge bg-success fw-medium fs-10">Active</span></td>
									<td class="action-table-data">
										<div class="edit-delete-action">
											<a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-brand">
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
									<td>
										<div class="d-flex align-items-center">
											<a href="javascript:void(0);" class="avatar avatar-md bg-light-900 p-1 me-2">
												<img class="object-fit-contain" src="./assets/img/brand/the-north-force.png" alt="img">
											</a>
											<a href="javascript:void(0);">The North Face</a>
										</div>
									</td>
									<td>10 Sep 2024</td>
									<td><span class="badge table-badge bg-success fw-medium fs-10">Active</span></td>
									<td class="action-table-data">
										<div class="edit-delete-action">
											<a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-brand">
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