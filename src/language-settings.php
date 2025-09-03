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
									<div class="search-path">
										<div class="d-flex align-items-center">
											<a class="btn btn-secondary" href="javascript:void(0);">
												<i data-feather="filter" class="filter-icon"></i>
												Import Sample
											</a>
										</div>
									</div>
								</div>
								<div class="table-responsive no-pagination">
									<table class="table datatable border">
										<thead class="thead-light">
											<tr>
												<th class="no-sort">
													<label class="checkboxs">
														<input type="checkbox" id="select-all">
														<span class="checkmarks"></span>
													</label>
												</th>
												<th>Language</th>
												<th>Code</th>
												<th>RTL</th>
												<th>Default</th>
												<th>Total</th>
												<th>Done</th>
												<th>Progress</th>
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
													<div class="language-name d-flex align-items-center">
														<img src="assets/img/icons/flag-01.svg" class="me-2" alt="Img">
														English
													</div>
												</td>
												<td>
													en
												</td>
												<td>
													<div class="status-toggle modal-status d-flex justify-content-between align-items-center">
														<input type="checkbox" id="user1" class="check" checked="">
														<label for="user1" class="checktoggle"></label>
													</div>						
												</td>
												<td>
													<div class="status-toggle modal-status d-flex justify-content-between align-items-center">
														<input type="checkbox" id="users1" class="check" checked="">
														<label for="users1" class="checktoggle"></label>
													</div>						
												</td>
												<td>2145</td>
												<td>1815</td>
												<td>
													<div class="d-flex align-items-center">
														<div class="circle-progress" data-value="80">
															<span class="progress-left">
																<span class="progress-bar border-warning"></span>
															</span>
															<span class="progress-right">
																<span class="progress-bar border-warning"></span>
															</span>
															
														</div>
														<div class="progress-value ms-2">80%</div>
													</div>
												</td>
												<td>
													<div class="status-toggle modal-status d-flex justify-content-between align-items-center">
														<input type="checkbox" id="status1" class="check" checked="">
														<label for="status1" class="checktoggle"></label>
													</div>	
												</td>
												<td class="action-table-data">
													<div class="edit-delete-action">
														<a href="language-settings-web.php" class="btn border text-dark bg-white me-2">Web</a>
														<a href="javascript:void(0);" class="btn border text-dark bg-white me-2">App</a>
														<a href="javascript:void(0);" class="btn border text-dark bg-white me-2">Admin</a>
														<a href="javascript:void(0);" class="me-2 language-import">
															<i data-feather="download" class="feather-download"></i>
														</a>
														<a href="javascript:void(0);">
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
													<div class="language-name d-flex align-items-center">
														<img src="assets/img/icons/flag-02.svg" class="me-2" alt="Img">
														German
													</div>
												</td>
												<td>
													Ar
												</td>
												<td>
													<div class="status-toggle modal-status d-flex justify-content-between align-items-center">
														<input type="checkbox" id="user2" class="check" checked="">
														<label for="user2" class="checktoggle"></label>
													</div>						
												</td>
												<td>
													<div class="status-toggle modal-status d-flex justify-content-between align-items-center">
														<input type="checkbox" id="users2" class="check" checked="">
														<label for="users2" class="checktoggle"></label>
													</div>						
												</td>
												<td>2045</td>
												<td>2045</td>
												<td>
													<div class="d-flex align-items-center">
														<div class="circle-progress" data-value="70">
															<span class="progress-left">
																<span class="progress-bar border-cyan"></span>
															</span>
															<span class="progress-right">
																<span class="progress-bar border-cyan"></span>
															</span>
															
														</div>
														<div class="progress-value ms-2">70%</div>
													</div>																
												</td>
												<td>
													<div class="status-toggle modal-status d-flex justify-content-between align-items-center">
														<input type="checkbox" id="status2" class="check" checked="">
														<label for="status2" class="checktoggle"></label>
													</div>	
												</td>
												<td class="action-table-data">
													<div class="edit-delete-action">
														<a href="language-settings-web.php" class="btn border text-dark bg-white me-2">Web</a>
														<a href="javascript:void(0);" class="btn border text-dark bg-white me-2">App</a>
														<a href="javascript:void(0);" class="btn border text-dark bg-white me-2">Admin</a>
														<a href="javascript:void(0);" class="me-2 language-import">
															<i data-feather="download" class="feather-download"></i>
														</a>
														<a href="javascript:void(0);">
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
													<div class="language-name d-flex align-items-center">
														<img src="assets/img/icons/flag-03.svg" class="me-2" alt="Img">
														Arabic
													</div>
												</td>
												<td>
													zh
												</td>
												<td>
													<div class="status-toggle modal-status d-flex justify-content-between align-items-center">
														<input type="checkbox" id="user3" class="check" checked="">
														<label for="user3" class="checktoggle"></label>
													</div>						
												</td>
												<td>
													<div class="status-toggle modal-status d-flex justify-content-between align-items-center">
														<input type="checkbox" id="users3" class="check" checked="">
														<label for="users3" class="checktoggle"></label>
													</div>						
												</td>
												<td>2245</td>
												<td>295</td>
												<td>
													<div class="d-flex align-items-center">
														<div class="circle-progress" data-value="50">
															<span class="progress-left">
																<span class="progress-bar border-purple"></span>
															</span>
															<span class="progress-right">
																<span class="progress-bar border-purple"></span>
															</span>
															
														</div>
														<div class="progress-value ms-2">50%</div>
													</div>
												</td>
												<td>
													<div class="status-toggle modal-status d-flex justify-content-between align-items-center">
														<input type="checkbox" id="status3" class="check" checked="">
														<label for="status3" class="checktoggle"></label>
													</div>	
												</td>
												<td class="action-table-data">
													<div class="edit-delete-action">
														<a href="language-settings-web.php" class="btn border text-dark bg-white me-2">Web</a>
														<a href="javascript:void(0);" class="btn border text-dark bg-white me-2">App</a>
														<a href="javascript:void(0);" class="btn border text-dark bg-white me-2">Admin</a>
														<a href="javascript:void(0);" class="me-2 language-import">
															<i data-feather="download" class="feather-download"></i>
														</a>
														<a href="javascript:void(0);">
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
													<div class="language-name d-flex align-items-center">
														<img src="assets/img/icons/flag-04.svg" class="me-2" alt="Img">
														French
													</div>
												</td>
												<td>
													hi
												</td>
												<td>
													<div class="status-toggle modal-status d-flex justify-content-between align-items-center">
														<input type="checkbox" id="user4" class="check" checked="">
														<label for="user4" class="checktoggle"></label>
													</div>						
												</td>
												<td>
													<div class="status-toggle modal-status d-flex justify-content-between align-items-center">
														<input type="checkbox" id="users4" class="check" checked="">
														<label for="users4" class="checktoggle"></label>
													</div>						
												</td>
												<td>2535</td>
												<td>1145</td>
												<td>
													<div class="d-flex align-items-center">
														<div class="circle-progress" data-value="30">
															<span class="progress-left">
																<span class="progress-bar border-danger"></span>
															</span>
															<span class="progress-right">
																<span class="progress-bar border-danger"></span>
															</span>
															
														</div>
														<div class="progress-value ms-2">30%</div>
													</div>
												</td>
												<td>
													<div class="status-toggle modal-status d-flex justify-content-between align-items-center">
														<input type="checkbox" id="status4" class="check" checked="">
														<label for="status4" class="checktoggle"></label>
													</div>	
												</td>
												<td class="action-table-data">
													<div class="edit-delete-action">
														<a href="language-settings-web.php" class="btn border text-dark bg-white me-2">Web</a>
														<a href="javascript:void(0);" class="btn border text-dark bg-white me-2">App</a>
														<a href="javascript:void(0);" class="btn border text-dark bg-white me-2">Admin</a>
														<a href="javascript:void(0);" class="me-2 language-import">
															<i data-feather="download" class="feather-download"></i>
														</a>
														<a href="javascript:void(0);">
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