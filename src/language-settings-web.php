<?php ob_start();?>

    <!-- ========================
        Start Page Content
    ========================= -->

    <div class="page-wrapper">

        <!-- Start Content -->
		<div class="content settings-content">
			<div class="page-header settings-pg-header">
				<div class="add-item d-flex">
					<div class="page-title">
						<h4>Settings</h4>
						<h6>Manage your settings on portal</h6>
					</div>
				</div>
				<ul class="table-top-head">
					<li>
						<a data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh"><i class="ti ti-refresh"></i></a>
					</li>
					<li>
						<a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i class="ti ti-chevron-up"></i></a>
					</li>
				</ul>
			</div>
			<div class="row">
				<div class="col-xl-12">
						<div class="settings-wrapper d-flex">
						<div class="settings-sidebar" id="sidebar2">
							<div class="sidebar-inner slimscroll">
								<div id="sidebar-menu5" class="sidebar-menu">
									<h4 class="fw-bold fs-18 mb-2 pb-2">Settings</h4>
									<ul>
										<li class="submenu-open">
											<ul>
												<li class="submenu">
													<a href="javascript:void(0);">
														<i class="ti ti-settings fs-18"></i>
														<span class="fs-14 fw-medium ms-2">General Settings</span>
														<span class="menu-arrow"></span>
													</a>
													<ul>
														<li><a href="general-settings.php">Profile</a></li>
														<li><a href="security-settings.php">Security</a></li>
														<li><a href="notification.php">Notifications</a></li>
														<li><a href="connected-apps.php">Connected Apps</a></li>
													</ul>
												</li>
												<li class="submenu">
													<a href="javascript:void(0);" class="active subdrop">
														<i class="ti ti-world fs-18"></i>
														<span class="fs-14 fw-medium ms-2">Website Settings</span>
														<span class="menu-arrow"></span>
													</a>
													<ul>
														<li><a href="system-settings.php">System Settings</a></li>
														<li><a href="company-settings.php">Company Settings </a></li>
														<li><a href="localization-settings.php">Localization</a></li>
														<li><a href="prefixes.php">Prefixes</a></li>
														<li><a href="preference.php">Preference</a></li>
														<li><a href="appearance.php">Appearance</a></li>
														<li><a href="social-authentication.php">Social Authentication</a></li>
														<li><a href="language-settings.php" class="active">Language</a></li>
													</ul>
												</li>
												<li class="submenu">
													<a href="javascript:void(0);">
														<i class="ti ti-device-mobile fs-18"></i>
														<span class="fs-14 fw-medium ms-2">App Settings</span>
														<span class="menu-arrow"></span>
													</a>
													<ul>
														<li><a href="invoice-settings.php">Invoice Settings</a></li>
														<li><a href="invoice-templates.php">Invoice Templates</a></li>
														<li><a href="printer-settings.php">Printer </a></li>
														<li><a href="pos-settings.php">POS</a></li>
														<li><a href="signatures.php">Signatures</a></li>
														<li><a href="custom-fields.php">Custom Fields</a></li>
													</ul>
												</li>
												<li class="submenu">
													<a href="javascript:void(0);">
														<i class="ti ti-device-desktop fs-18"></i>
														<span class="fs-14 fw-medium ms-2">System Settings</span>
														<span class="menu-arrow"></span>
													</a>
													<ul>
														<li class="submenu submenu-two"><a href="javascript:void(0);">Email<span class="menu-arrow inside-submenu"></span></a>
															<ul>
																<li><a href="email-settings.php">Email Settings</a></li>
																<li><a href="email-templates.php">Email Templates</a></li>
															</ul>
														</li>
														<li class="submenu submenu-two"><a href="javascript:void(0);">SMS<span class="menu-arrow inside-submenu"></span></a>
															<ul>
																<li><a href="sms-settings.php">SMS Settings</a></li>
																<li><a href="sms-templates.php">SMS Templates</a></li>
															</ul>
														</li>
														<li><a href="otp-settings.php">OTP</a></li>
														<li><a href="gdpr-settings.php">GDPR Cookies</a></li>
													</ul>
												</li>
												<li class="submenu">
													<a href="javascript:void(0);">
														<i class="ti ti-settings-dollar fs-18"></i>
														<span class="fs-14 fw-medium ms-2">Financial Settings</span>
														<span class="menu-arrow"></span>
													</a>
													<ul>
														<li><a href="payment-gateway-settings.php">Payment Gateway</a></li>
														<li><a href="bank-settings-grid.php">Bank Accounts </a></li>
														<li><a href="tax-rates.php">Tax Rates</a></li>
														<li><a href="currency-settings.php">Currencies</a></li>
													</ul>
												</li>
												<li class="submenu">
													<a href="javascript:void(0);">
														<i class="ti ti-settings-2 fs-18"></i>
														<span class="fs-14 fw-medium ms-2">Other Settings</span>
														<span class="menu-arrow"></span>
													</a>
													<ul>
														<li><a href="storage-settings.php">Storage</a></li>
														<li><a href="ban-ip-address.php">Ban IP Address </a></li>
													</ul>
												</li>
											</ul>								
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="card flex-fill mb-0 w-50">
							<div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
								<h4>Language</h4>
								<div class="page-btn d-flex align-items-center ms-0">
									<div class="select-language">
										<select class="select">
											<option>Select Language</option>
											<option>English</option>
											<option>Arabic</option>
											<option>Chinese</option>
										</select>
									</div>
									<a href="javascript:void(0);" class="btn btn-primary ms-3" data-bs-toggle="modal" data-bs-target="#add-language">Add Translation</a>
								</div>
							</div>
							<div class="card-body">
								<div class="table-top">
									<div class="search-set">
										<div class="search-input">
											<span class="btn-searchset"><i class="ti ti-search fs-14 feather-search"></i></span>
										</div>
									</div>
									<div class="d-flex align-items-center">
										<div class="back-btn">
											<a href="language-settings.php" class="btn btn-secondary me-3"><i data-feather="arrow-left" class="filter-icon me-2"></i>Back to Translations </a>
										</div>
										<div class="page-btn">
											<a href="javascript:void(0);" class="d-flex align-items-center selected-language"><img src="assets/img/icons/flag-03.svg" class="me-2" alt="Img">Arabic</a>
										</div>
									</div>
								</div>
								<div class="table-responsive no-pagination">
									<table class="table border datatable">
										<thead class="thead-light">
											<tr>
												<th class="no-sort">
													<label class="checkboxs">
														<input type="checkbox" id="select-all">
														<span class="checkmarks"></span>
													</label>
												</th>
												<th>Module Name</th>
												<th>Total</th>
												<th>Done</th>
												<th>Progress</th>
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
													Inventory
												</td>
												<td>1620</td>
												<td>1296</td>
												<td>
													<div class="d-flex align-items-center">
														<div class="progress progress-xs" style="width: 120px;">
															<div class="progress-bar bg-success rounded" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
														</div>
														<span class="d-inline-flex fs-12 ms-2">100%</span>
													</div>
												</td>
												<td class="action-table-data">
													<div class="edit-delete-action">
														<a class="me-2 p-2" href="#">
															<i data-feather="download" class="feather-edit"></i>
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
													Expense
												</td>
												<td>1620</td>
												<td>972</td>
												<td>
													<div class="d-flex align-items-center">
														<div class="progress progress-xs" style="width: 120px;">
															<div class="progress-bar bg-pink rounded" role="progressbar" style="width: 70%;" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
														</div>
														<span class="d-inline-flex fs-12 ms-2">70%</span>
													</div>																
												</td>
												<td class="action-table-data">
													<div class="edit-delete-action">
														<a class="me-2 p-2" href="#">
															<i data-feather="download" class="feather-edit"></i>
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
													Product
												</td>
												<td>1620</td>
												<td>810</td>
												<td>
													<div class="d-flex align-items-center">
														<div class="progress progress-xs" style="width: 120px;">
															<div class="progress-bar bg-warning rounded" role="progressbar" style="width: 40%;" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
														</div>
														<span class="d-inline-flex fs-12 ms-2">40%</span>
													</div>	
												</td>
												<td class="action-table-data">
													<div class="edit-delete-action">
														<a class="me-2 p-2" href="#">
															<i data-feather="download" class="feather-edit"></i>
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
													Settings
												</td>
												<td>1620</td>
												<td>324</td>
												<td>
													<div class="d-flex align-items-center">
														<div class="progress progress-xs" style="width: 120px;">
															<div class="progress-bar bg-orange rounded" role="progressbar" style="width: 80%;" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
														</div>
														<span class="d-inline-flex fs-12 ms-2">80%</span>
													</div>	
												</td>
												<td class="action-table-data">
													<div class="edit-delete-action">
														<a class="me-2 p-2" href="#">
															<i data-feather="download" class="feather-edit"></i>
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
					</div>
				</div>
			</div>
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