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
														<li><a href="appearance.php" class="active">Appearance</a></li>
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
								<h4 class="fs-18 fw-bold">Appearance</h4>
							</div>
							<div class="card-body">
								<form action="appearance.php">
									<div class="appearance-settings">
										<div class="row">
											<div class="col-xl-4 col-lg-12 col-md-4">
												<div class="setting-info mb-4">
													<h6 class="mb-1">Select Theme</h6>
													<p>Choose accent colour of website</p>
												</div>
											</div>
											<div class="col-xl-8 col-lg-12 col-md-8">
												<div class="theme-type-images d-flex align-items-center mb-4">
													<div class="theme-image border">
														<div class="theme-image-set">
															<img src="assets/img/theme/theme-img-08.jpg" alt="Img">
														</div>
														<h6>Light</h6>
													</div>
													<div class="theme-image border">
														<div class="theme-image-set">
															<img src="assets/img/theme/theme-img-09.jpg" alt="Img">
														</div>
														<h6>Dark</h6>
													</div>
													<div class="theme-image border">
														<div class="theme-image-set">
															<img src="assets/img/theme/theme-img-10.jpg" alt="Img">
														</div>
														<h6>Automatic</h6>
													</div>
												</div>
												
											</div>
										</div>
										<div class="row">
											<div class="col-xl-4 col-lg-12 col-md-4">
												<div class="setting-info mb-4">
													<h6 class="mb-1">Accent Color</h6>
													<p>Choose accent colour of website</p>
												</div>
											</div>
											<div class="col-xl-4 col-lg-12 col-md-4">
												<div class="theme-colors mb-4">
													<ul>
														<li>
														<span class="themecolorset defaultcolor active"></span>
														</li>
														<li>
														<span class="themecolorset theme-violet"></span>
														</li>
														<li>
														<span class="themecolorset theme-blue"></span>
														</li>
														<li>
														<span class="themecolorset theme-brown"></span>
														</li>
														</ul>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-xl-4 col-lg-12 col-md-4">
												<div class="setting-info mb-4">
													<h6 class="mb-1">Expand Sidebar</h6>
													<p>Choose accent colour of website</p>
												</div>
											</div>
											<div class="col-xl-4 col-lg-12 col-md-4">
												<div class="status-toggle modal-status d-flex justify-content-between align-items-center ms-2">
													<input type="checkbox" id="user1" class="check" checked>
													<label for="user1" class="checktoggle">	</label>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-xl-4 col-lg-12 col-md-4">
												<div class="setting-info mb-4">
													<h6 class="mb-1">Sidebar Size</h6>
													<p>Select size of the sidebar to display</p>
												</div>
											</div>
											<div class="col-xl-4 col-lg-12 col-md-4">
												<div class="localization-select">
													<select class="select">
														<option>Small - 85px</option>
														<option>Large - 250px</option>
													</select>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-xl-4 col-lg-12 col-md-4">
												<div class="setting-info mb-4">
													<h6 class="mb-1">Font Family</h6>
													<p>Select font family of website</p>
												</div>
											</div>
											<div class="col-xl-4 col-lg-12 col-md-4">
												<div class="localization-select">
													<select class="select">
														<option>Nunito</option>
														<option>Poppins</option>
													</select>
												</div>
											</div>
										</div>
									</div>
									<div class="text-end settings-bottom-btn mt-0">
										<button type="button" class="btn btn-secondary me-2">Cancel</button>
										<button type="submit" class="btn btn-primary">Save Changes</button>
									</div>
								</form>
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