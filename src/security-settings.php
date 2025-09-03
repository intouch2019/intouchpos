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
													<a href="javascript:void(0);" class="active subdrop">
														<i class="ti ti-settings fs-18"></i>
														<span class="fs-14 fw-medium ms-2">General Settings</span>
														<span class="menu-arrow"></span>
													</a>
													<ul>
														<li><a href="general-settings.php">Profile</a></li>
														<li><a href="security-settings.php" class="active">Security</a></li>
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
														<li><a href="sms-settings.php">SMS Gateways</a></li>
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
						<div class="card flex-fill mb-0">
							<div class="card-header">
								<h4 class="fs-18 fw-bold">Security</h4>
							</div>
							<div class="card-body">
								<div>
									<div class="d-flex align-items-center justify-content-between flex-wrap row-gap-3 border-bottom mb-3 pb-3">
										<div class="d-flex align-items-center">
											<span class="avatar avatar-lg border bg-light fs-24 me-2">
												<i class="ti ti-eye-off text-gray-900 fs-18"></i>
											</span>
											<div>
												<h5 class="fs-16 fw-medium mb-1">Password</h5>
												<p class="fs-16">Last Changed 22 Dec 2024, 10:30 AM</p>
											</div>
										</div>
										<a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#change-password">Change Password</a>
									</div>
									<div class="d-flex align-items-center justify-content-between flex-wrap row-gap-3 border-bottom mb-3 pb-3">
										<div class="d-flex align-items-center">
											<span class="avatar avatar-lg border bg-light fs-24 me-2">
												<i class="ti ti-shield text-gray-900 fs-18"></i>
											</span>
											<div>
												<h5 class="fs-16 fw-medium mb-1">Two Factor Authentication</h5>
												<p class="fs-16">Receive codes via SMS or email every time you login</p>
											</div>
										</div>
										<div class="status-toggle modal-status d-flex justify-content-between align-items-center ms-2">
											<input type="checkbox" id="user3" class="check" checked>
											<label for="user3" class="checktoggle">	</label>
										</div>
									</div>
									<div class="d-flex align-items-center justify-content-between flex-wrap row-gap-3 border-bottom mb-3 pb-3">
										<div class="d-flex align-items-center">
											<span class="avatar avatar-lg border bg-light fs-24 me-2">
												<i class="ti ti-brand-google text-gray-900 fs-18"></i>
											</span>
											<div>
												<h5 class="fs-16 fw-medium mb-1">Google Authentication</h5>
												<p class="fs-16">Connect to Google</p>
											</div>
										</div>
										<div class="d-flex align-items-center">
											<span class="badge bg-outline-success">Connected</span>
											<div class="status-toggle modal-status d-flex justify-content-between align-items-center ms-3">
												<input type="checkbox" id="user4" class="check" checked>
												<label for="user4" class="checktoggle">	</label>
											</div>
										</div>
									</div>
									<div class="d-flex align-items-center justify-content-between flex-wrap row-gap-3 border-bottom mb-3 pb-3">
										<div class="d-flex align-items-center">
											<span class="avatar avatar-lg border bg-light fs-24 me-2">
												<i class="ti ti-phone text-gray-900 fs-18"></i>
											</span>
											<div>
												<h5 class="fs-16 fw-medium mb-1">Phone Number Verification</h5>
												<p class="fs-16">Verified Mobile Number : +81699799974</p>
											</div>
										</div>
										<div class="d-flex align-items-center">
											<span class="fs-20 text-success me-3">
												<i class="ti ti-circle-check-filled"></i>
											</span>
											<a href="javascript:void(0);" class="btn btn-primary mt-0" data-bs-toggle="modal" data-bs-target="#phone-verification">Change</a>
											<a href="javascript:void(0);" class="btn btn-secondary ms-3">Remove</a>
										</div>
									</div>
									<div class="d-flex align-items-center justify-content-between flex-wrap row-gap-3 border-bottom mb-3 pb-3">
										<div class="d-flex align-items-center">
											<span class="avatar avatar-lg border bg-light fs-24 me-2">
												<i class="ti ti-mail text-gray-900 fs-18"></i>
											</span>
											<div>
												<h5 class="fs-16 fw-medium mb-1">Email Verification</h5>
												<p class="fs-16">Verified Email : info@example.com</p>
											</div>
										</div>
										<div class="d-flex align-items-center">
											<span class="fs-20 text-success me-3">
												<i class="ti ti-circle-check-filled"></i>
											</span>
											<a href="javascript:void(0);" class="btn btn-primary mt-0" data-bs-toggle="modal" data-bs-target="#email-verification">Change</a>
											<a href="javascript:void(0);" class="btn btn-secondary ms-3">Remove</a>
										</div>
									</div>
									<div class="d-flex align-items-center justify-content-between flex-wrap row-gap-3 border-bottom mb-3 pb-3">
										<div class="d-flex align-items-center">
											<span class="avatar avatar-lg border bg-light fs-24 me-2">
												<i class="ti ti-tool text-gray-900 fs-18"></i>
											</span>
											<div>
												<h5 class="fs-16 fw-medium mb-1">Device Management</h5>
												<p class="fs-16">Manage devices associated with the account</p>
											</div>
										</div>
										<a href="javascript:void(0);" class="btn btn-primary mt-0" data-bs-toggle="modal" data-bs-target="#device-management">Manage</a>
									</div>
									<div class="d-flex align-items-center justify-content-between flex-wrap row-gap-3 border-bottom mb-3 pb-3">
										<div class="d-flex align-items-center">
											<span class="avatar avatar-lg border bg-light fs-24 me-2">
												<i class="ti ti-activity text-gray-900 fs-18"></i>
											</span>
											<div>
												<h5 class="fs-16 fw-medium mb-1">Account Activity</h5>
												<p class="fs-16">Manage activities associated with the account</p>
											</div>
										</div>
										<a href="javascript:void(0);" class="btn btn-primary mt-0" data-bs-toggle="modal" data-bs-target="#account-activity">View</a>
									</div>
									<div class="d-flex align-items-center justify-content-between flex-wrap row-gap-3 border-bottom mb-3 pb-3">
										<div class="d-flex align-items-center">
											<span class="avatar avatar-lg border bg-light fs-24 me-2">
												<i class="ti ti-ban text-gray-900 fs-18"></i>
											</span>
											<div>
												<h5 class="fs-16 fw-medium mb-1">Deactivate Account</h5>
												<p class="fs-16">This will shutdown your account. Your account will be reactive when you sign in again</p>
											</div>
										</div>
										<a href="javascript:void(0);" class="btn btn-primary mt-0">Deactivate</a>
									</div>
									<div class="d-flex align-items-center justify-content-between flex-wrap row-gap-3">
										<div class="d-flex align-items-center">
											<span class="avatar avatar-lg border bg-light fs-24 me-2">
												<i class="ti ti-trash text-gray-900 fs-18"></i>
											</span>
											<div>
												<h5 class="fs-16 fw-medium mb-1">Delete Account</h5>
												<p class="fs-16">Your account will be permanently deleted</p>
											</div>
										</div>
										<a href="javascript:void(0);" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete-account">Delete</a>
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