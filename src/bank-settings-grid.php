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
													<a href="javascript:void(0);">
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
														<li><a href="language-settings.php">Language</a></li>
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
													<a href="javascript:void(0);" class="active subdrop">
														<i class="ti ti-settings-dollar fs-18"></i>
														<span class="fs-14 fw-medium ms-2">Financial Settings</span>
														<span class="menu-arrow"></span>
													</a>
													<ul>
														<li><a href="payment-gateway-settings.php">Payment Gateway</a></li>
														<li><a href="bank-settings-grid.php" class="active">Bank Accounts </a></li>
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
							<div class="card-header d-flex align-items-center justify-content-between">
								<h4>Bank Account</h4>
								<div class="page-btn">
									<a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-account"><i class="ti ti-circle-plus me-1"></i>Add New Account</a>
								</div>
							</div>
							<div class="card-body pb-0">
								<div class="row">
									<div class="col-xxl-4 col-xl-6 col-lg-12 col-sm-6">
										<div class="card bank-box active">
											<div class="card-body">
												<div class="mb-4">
													<h5 class="mb-1">Karur vysya bank</h5>
													<p>**** **** 1982</p>
												</div>
												<div class="d-flex align-items-center justify-content-between">
													<div>
														<span class="fs-13">Holder Name</span>
														<h6>John Smith</h6>
													</div>
													<div class="hstack gap-2 fs-15">
														<a href="#" class="btn btn-icon btn-sm btn-info-light" data-bs-toggle="modal" data-bs-target="#edit-account"><i data-feather="edit" class="feather-edit"></i></a>
														<a href="#" class="btn btn-icon btn-sm btn-danger-light" data-bs-toggle="modal" data-bs-target="#delete-modal"><i data-feather="trash-2" class="feather-trash-2"></i></a>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xxl-4 col-xl-6 col-lg-12 col-sm-6">
										<div class="card bank-box">
											<div class="card-body">
												<div class="mb-4">
													<h5 class="mb-1">Swiss Bank</h5>
													<p>**** **** 1796</p>
												</div>
												<div class="d-flex align-items-center justify-content-between">
													<div>
														<span>Holder Name</span>
														<h6>Andrew</h6>
													</div>
													<div class="hstack gap-2 fs-15">
														<a href="#" class="btn btn-icon btn-sm btn-info-light" data-bs-toggle="modal" data-bs-target="#edit-account"><i data-feather="edit" class="feather-edit"></i></a>
														<a href="#" class="btn btn-icon btn-sm btn-danger-light" data-bs-toggle="modal" data-bs-target="#delete-modal"><i data-feather="trash-2" class="feather-trash-2"></i></a>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xxl-4 col-xl-6 col-lg-12 col-sm-6">
										<div class="card bank-box">
											<div class="card-body">
												<div class="mb-4">
													<h5 class="mb-1">HDFC</h5>
													<p>**** **** 1832</p>
												</div>
												<div class="d-flex align-items-center justify-content-between">
													<div>
														<span>Holder Name</span>
														<h6>Mathew</h6>
													</div>
													<div class="hstack gap-2 fs-15">
														<a href="#" class="btn btn-icon btn-sm btn-info-light" data-bs-toggle="modal" data-bs-target="#edit-account"><i data-feather="edit" class="feather-edit"></i></a>
														<a href="#" class="btn btn-icon btn-sm btn-danger-light" data-bs-toggle="modal" data-bs-target="#delete-modal"><i data-feather="trash-2" class="feather-trash-2"></i></a>
													</div>
												</div>
											</div>
										</div>
									</div>
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