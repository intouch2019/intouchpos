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
                                                    <a href="javascript:void(0);" class="active subdrop">
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
                                                        <li class="submenu submenu-two"><a href="javascript:void(0);" class="active subdrop">SMS<span class="menu-arrow inside-submenu"></span></a>
                                                            <ul>
                                                                <li><a href="sms-settings.php">SMS Settings</a></li>
                                                                <li><a href="sms-templates.php" class="active">SMS Templates</a></li>
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
                        <div class="card flex-fill mb-0">
                            <div class="card-header">
                                <h4>SMS Templates</h4>
                            </div>
                            <div class="card-body pb-0">
                                <div class="accordion-card-one accordion" id="accordionExample">
                                    <div class="accordion-item pb-3">
                                        <div class="accordion-header" id="headingOne">
                                            <div class="accordion-button p-3 pb-0" data-bs-toggle="collapse" data-bs-target="#collapseOne"  aria-controls="collapseOne">
                                                <div class="addproduct-icon d-flex align-items-center justify-content-between w-100">
                                                    <div class="d-flex align-items-center">
                                                        <div class="status-toggle modal-status d-flex justify-content-between align-items-center me-2">
                                                            <input type="checkbox" id="user1" class="check" checked>
                                                            <label for="user1" class="checktoggle">	</label>
                                                        </div>
                                                        <h5><span>Order Confirmation</span></h5>
                                                    </div>
                                                    <a href="javascript:void(0);" class="ms-auto"><i data-feather="chevron-down" class="chevron-down-add"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body border-0 pb-0">
                                            <div class="row gy-4">
                                                <div class="col-xl-7">
                                                    <div class="card mb-3">
                                                        <div class="card-body">
                                                            <textarea class="form-control" cols="5" style="height: 300px">

Hi <span class="text-orange">{Customer Name}</span>,<br> Welcome to <span class="text-orange">{Company Name}</span>!

We’re thrilled to have you as part of our community and are eager to support you in optimizing your operations. Thank you for choosing us – we appreciate your trust and confidence.

At <span class="text-orange">{Company Name}</span>, our mission is to make your experience seamless and efficient. From managing day-to-day tasks to improving workflows, we’re here to help you get the most out of our solutions.

If you have any questions or need assistance, our dedicated support team is always ready to assist you. Feel free to reach out anytime – we’re committed to ensuring your success.

Thank you again for trusting <span class="text-orange">{Company Name}</span>. We’re excited to be part of your journey and look forward to supporting you every step of the way.

Best, The <span class="text-orange">{Company Name}</span> Team
                                                            </textarea>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center flex-wrap row-gap-3">
                                                        <a href="#" class="btn bg-cyan me-2">Save Template</a>
                                                        <a href="#" class="btn btn-secondary me-2">Default Template</a>
                                                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#email-detail">Preview Template</a>
                                                    </div>
                                                </div>
                                                <div class="col-xl-5">
                                                    <div class="card mb-0">
                                                        <div class="card-body">
                                                            <h5 class="mb-2">Tags</h5>
                                                            <div>
                                                                <p class="fs-12 text-orange mb-1">{Customer Name}</p>
                                                                <p class="fs-12 text-orange mb-1">{Company Name}</p>
                                                                <p class="fs-12 text-orange mb-1">{Order ID}</p>
                                                                <p class="fs-12 text-orange mb-1">{Invoice ID}</p>
                                                                <p class="fs-12 text-orange mb-1">{Receipt ID}</p>
                                                                <p class="fs-12 text-orange mb-1">{Login Link}</p>
                                                                <p class="fs-12 text-orange mb-1">{Support Email}</p>
                                                                <p class="fs-12 text-orange mb-1">{Password Reset Link}</p>
                                                                <p class="fs-12 text-orange mb-1">{Product Name}</p>
                                                                <p class="fs-12 text-orange mb-1">{Order Total}</p>
                                                                <p class="fs-12 text-orange mb-1">{Order Date}</p>
                                                                <p class="fs-12 text-orange mb-1">{Delivery Date}</p>
                                                                <p class="fs-12 text-orange">{Discount Code}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-card-one accordion" id="accordionExample2">
                                    <div class="accordion-item pb-3">
                                        <div class="accordion-header" id="heading2">
                                            <div class="accordion-button p-3 pb-0" data-bs-toggle="collapse" data-bs-target="#collapse2"  aria-controls="collapse2">
                                                <div class="addproduct-icon d-flex align-items-center justify-content-between w-100">
                                                    <div class="d-flex align-items-center">
                                                        <div class="status-toggle modal-status d-flex justify-content-between align-items-center me-2">
                                                            <input type="checkbox" id="user2" class="check" checked>
                                                            <label for="user2" class="checktoggle">	</label>
                                                        </div>
                                                        <h5><span>Order Confirmation</span></h5>
                                                    </div>
                                                    <a href="javascript:void(0);" class="ms-auto"><i data-feather="chevron-down" class="chevron-down-add"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="heading2" data-bs-parent="#accordionExample2">
                                        <div class="accordion-body border-0 pb-0">
                                            <div class="row gy-4">
                                                <div class="col-xl-7">
                                                    <div class="card mb-3">
                                                        <div class="card-body">
                                                            <textarea class="form-control" cols="5" style="height: 300px">

Hi <span class="text-orange">{Customer Name}</span>,<br> Welcome to <span class="text-orange">{Company Name}</span>!

We’re thrilled to have you as part of our community and are eager to support you in optimizing your operations. Thank you for choosing us – we appreciate your trust and confidence.

At <span class="text-orange">{Company Name}</span>, our mission is to make your experience seamless and efficient. From managing day-to-day tasks to improving workflows, we’re here to help you get the most out of our solutions.

If you have any questions or need assistance, our dedicated support team is always ready to assist you. Feel free to reach out anytime – we’re committed to ensuring your success.

Thank you again for trusting <span class="text-orange">{Company Name}</span>. We’re excited to be part of your journey and look forward to supporting you every step of the way.

Best, The <span class="text-orange">{Company Name}</span> Team
                                                            </textarea>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center flex-wrap row-gap-3">
                                                        <a href="#" class="btn bg-cyan me-2">Save Template</a>
                                                        <a href="#" class="btn btn-secondary me-2">Default Template</a>
                                                        <a href="#" class="btn btn-primary">Preview Template</a>
                                                    </div>
                                                </div>
                                                <div class="col-xl-5">
                                                    <div class="card mb-0">
                                                        <div class="card-body">
                                                            <h5 class="mb-2">Tags</h5>
                                                            <div>
                                                                <p class="fs-12 text-orange mb-1">{Customer Name}</p>
                                                                <p class="fs-12 text-orange mb-1">{Company Name}</p>
                                                                <p class="fs-12 text-orange mb-1">{Order ID}</p>
                                                                <p class="fs-12 text-orange mb-1">{Invoice ID}</p>
                                                                <p class="fs-12 text-orange mb-1">{Receipt ID}</p>
                                                                <p class="fs-12 text-orange mb-1">{Login Link}</p>
                                                                <p class="fs-12 text-orange mb-1">{Support Email}</p>
                                                                <p class="fs-12 text-orange mb-1">{Password Reset Link}</p>
                                                                <p class="fs-12 text-orange mb-1">{Product Name}</p>
                                                                <p class="fs-12 text-orange mb-1">{Order Total}</p>
                                                                <p class="fs-12 text-orange mb-1">{Order Date}</p>
                                                                <p class="fs-12 text-orange mb-1">{Delivery Date}</p>
                                                                <p class="fs-12 text-orange">{Discount Code}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-card-one accordion" id="accordionExample3">
                                    <div class="accordion-item pb-3">
                                        <div class="accordion-header" id="heading3">
                                            <div class="accordion-button p-3 pb-0" data-bs-toggle="collapse" data-bs-target="#collapse3"  aria-controls="collapse3">
                                                <div class="addproduct-icon d-flex align-items-center justify-content-between w-100">
                                                    <div class="d-flex align-items-center">
                                                        <div class="status-toggle modal-status d-flex justify-content-between align-items-center me-2">
                                                            <input type="checkbox" id="user3" class="check" checked>
                                                            <label for="user3" class="checktoggle">	</label>
                                                        </div>
                                                        <h5><span>Invoice Receipt</span></h5>
                                                    </div>
                                                    <a href="javascript:void(0);" class="ms-auto"><i data-feather="chevron-down" class="chevron-down-add"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="heading3" data-bs-parent="#accordionExample3">
                                        <div class="accordion-body border-0 pb-0">
                                            <div class="row gy-4">
                                                <div class="col-xl-7">
                                                    <div class="card mb-3">
                                                        <div class="card-body">
                                                            <textarea class="form-control" cols="5" style="height: 300px">

Hi <span class="text-orange">{Customer Name}</span>,<br> Welcome to <span class="text-orange">{Company Name}</span>!

We’re thrilled to have you as part of our community and are eager to support you in optimizing your operations. Thank you for choosing us – we appreciate your trust and confidence.

At <span class="text-orange">{Company Name}</span>, our mission is to make your experience seamless and efficient. From managing day-to-day tasks to improving workflows, we’re here to help you get the most out of our solutions.

If you have any questions or need assistance, our dedicated support team is always ready to assist you. Feel free to reach out anytime – we’re committed to ensuring your success.

Thank you again for trusting <span class="text-orange">{Company Name}</span>. We’re excited to be part of your journey and look forward to supporting you every step of the way.

Best, The <span class="text-orange">{Company Name}</span> Team
                                                            </textarea>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center flex-wrap row-gap-3">
                                                        <a href="#" class="btn bg-cyan me-2">Save Template</a>
                                                        <a href="#" class="btn btn-secondary me-2">Default Template</a>
                                                        <a href="#" class="btn btn-primary">Preview Template</a>
                                                    </div>
                                                </div>
                                                <div class="col-xl-5">
                                                    <div class="card mb-0">
                                                        <div class="card-body">
                                                            <h5 class="mb-2">Tags</h5>
                                                            <div>
                                                                <p class="fs-12 text-orange mb-1">{Customer Name}</p>
                                                                <p class="fs-12 text-orange mb-1">{Company Name}</p>
                                                                <p class="fs-12 text-orange mb-1">{Order ID}</p>
                                                                <p class="fs-12 text-orange mb-1">{Invoice ID}</p>
                                                                <p class="fs-12 text-orange mb-1">{Receipt ID}</p>
                                                                <p class="fs-12 text-orange mb-1">{Login Link}</p>
                                                                <p class="fs-12 text-orange mb-1">{Support Email}</p>
                                                                <p class="fs-12 text-orange mb-1">{Password Reset Link}</p>
                                                                <p class="fs-12 text-orange mb-1">{Product Name}</p>
                                                                <p class="fs-12 text-orange mb-1">{Order Total}</p>
                                                                <p class="fs-12 text-orange mb-1">{Order Date}</p>
                                                                <p class="fs-12 text-orange mb-1">{Delivery Date}</p>
                                                                <p class="fs-12 text-orange">{Discount Code}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-card-one accordion" id="accordionExample4">
                                    <div class="accordion-item pb-3">
                                        <div class="accordion-header" id="heading4">
                                            <div class="accordion-button p-3 pb-0" data-bs-toggle="collapse" data-bs-target="#collapse4"  aria-controls="collapse4">
                                                <div class="addproduct-icon d-flex align-items-center justify-content-between w-100">
                                                    <div class="d-flex align-items-center">
                                                        <div class="status-toggle modal-status d-flex justify-content-between align-items-center me-2">
                                                            <input type="checkbox" id="user4" class="check" checked>
                                                            <label for="user4" class="checktoggle">	</label>
                                                        </div>
                                                        <h5><span>Subscription Renewal Reminder</span></h5>
                                                    </div>
                                                    <a href="javascript:void(0);" class="ms-auto"><i data-feather="chevron-down" class="chevron-down-add"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="heading4" data-bs-parent="#accordionExample4">
                                        <div class="accordion-body border-0 pb-0">
                                            <div class="row gy-4">
                                                <div class="col-xl-7">
                                                    <div class="card mb-3">
                                                        <div class="card-body">

Hi <span class="text-orange">{Customer Name}</span>,<br> Welcome to <span class="text-orange">{Company Name}</span>!

We’re thrilled to have you as part of our community and are eager to support you in optimizing your operations. Thank you for choosing us – we appreciate your trust and confidence.

At <span class="text-orange">{Company Name}</span>, our mission is to make your experience seamless and efficient. From managing day-to-day tasks to improving workflows, we’re here to help you get the most out of our solutions.

If you have any questions or need assistance, our dedicated support team is always ready to assist you. Feel free to reach out anytime – we’re committed to ensuring your success.

Thank you again for trusting <span class="text-orange">{Company Name}</span>. We’re excited to be part of your journey and look forward to supporting you every step of the way.

Best, The <span class="text-orange">{Company Name}</span> Team
                                                            </textarea>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center flex-wrap row-gap-3">
                                                        <a href="#" class="btn bg-cyan me-2">Save Template</a>
                                                        <a href="#" class="btn btn-secondary me-2">Default Template</a>
                                                        <a href="#" class="btn btn-primary">Preview Template</a>
                                                    </div>
                                                </div>
                                                <div class="col-xl-5">
                                                    <div class="card mb-0">
                                                        <div class="card-body">
                                                            <h5 class="mb-2">Tags</h5>
                                                            <div>
                                                                <p class="fs-12 text-orange mb-1">{Customer Name}</p>
                                                                <p class="fs-12 text-orange mb-1">{Company Name}</p>
                                                                <p class="fs-12 text-orange mb-1">{Order ID}</p>
                                                                <p class="fs-12 text-orange mb-1">{Invoice ID}</p>
                                                                <p class="fs-12 text-orange mb-1">{Receipt ID}</p>
                                                                <p class="fs-12 text-orange mb-1">{Login Link}</p>
                                                                <p class="fs-12 text-orange mb-1">{Support Email}</p>
                                                                <p class="fs-12 text-orange mb-1">{Password Reset Link}</p>
                                                                <p class="fs-12 text-orange mb-1">{Product Name}</p>
                                                                <p class="fs-12 text-orange mb-1">{Order Total}</p>
                                                                <p class="fs-12 text-orange mb-1">{Order Date}</p>
                                                                <p class="fs-12 text-orange mb-1">{Delivery Date}</p>
                                                                <p class="fs-12 text-orange">{Discount Code}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-card-one accordion" id="accordionExample5">
                                    <div class="accordion-item pb-3">
                                        <div class="accordion-header" id="heading5">
                                            <div class="accordion-button p-3 pb-0" data-bs-toggle="collapse" data-bs-target="#collapse5"  aria-controls="collapse5">
                                                <div class="addproduct-icon d-flex align-items-center justify-content-between w-100">
                                                    <div class="d-flex align-items-center">
                                                        <div class="status-toggle modal-status d-flex justify-content-between align-items-center me-2">
                                                            <input type="checkbox" id="user5" class="check" checked>
                                                            <label for="user5" class="checktoggle">	</label>
                                                        </div>
                                                        <h5><span>Seasonal Promotion</span></h5>
                                                    </div>
                                                    <a href="javascript:void(0);" class="ms-auto"><i data-feather="chevron-down" class="chevron-down-add"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="collapse5" class="accordion-collapse collapse" aria-labelledby="heading5" data-bs-parent="#accordionExample5">
                                        <div class="accordion-body border-0 pb-0">
                                            <div class="row gy-4">
                                                <div class="col-xl-7">
                                                    <div class="card mb-3">
                                                        <div class="card-body">
                                                            <textarea class="form-control" cols="5" style="height: 300px">

Hi <span class="text-orange">{Customer Name}</span>,<br> Welcome to <span class="text-orange">{Company Name}</span>!

We’re thrilled to have you as part of our community and are eager to support you in optimizing your operations. Thank you for choosing us – we appreciate your trust and confidence.

At <span class="text-orange">{Company Name}</span>, our mission is to make your experience seamless and efficient. From managing day-to-day tasks to improving workflows, we’re here to help you get the most out of our solutions.

If you have any questions or need assistance, our dedicated support team is always ready to assist you. Feel free to reach out anytime – we’re committed to ensuring your success.

Thank you again for trusting <span class="text-orange">{Company Name}</span>. We’re excited to be part of your journey and look forward to supporting you every step of the way.

Best, The <span class="text-orange">{Company Name}</span> Team
                                                            </textarea>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center flex-wrap row-gap-3">
                                                        <a href="#" class="btn bg-cyan me-2">Save Template</a>
                                                        <a href="#" class="btn btn-secondary me-2">Default Template</a>
                                                        <a href="#" class="btn btn-primary">Preview Template</a>
                                                    </div>
                                                </div>
                                                <div class="col-xl-5">
                                                    <div class="card mb-0">
                                                        <div class="card-body">
                                                            <h5 class="mb-2">Tags</h5>
                                                            <div>
                                                                <p class="fs-12 text-orange mb-1">{Customer Name}</p>
                                                                <p class="fs-12 text-orange mb-1">{Company Name}</p>
                                                                <p class="fs-12 text-orange mb-1">{Order ID}</p>
                                                                <p class="fs-12 text-orange mb-1">{Invoice ID}</p>
                                                                <p class="fs-12 text-orange mb-1">{Receipt ID}</p>
                                                                <p class="fs-12 text-orange mb-1">{Login Link}</p>
                                                                <p class="fs-12 text-orange mb-1">{Support Email}</p>
                                                                <p class="fs-12 text-orange mb-1">{Password Reset Link}</p>
                                                                <p class="fs-12 text-orange mb-1">{Product Name}</p>
                                                                <p class="fs-12 text-orange mb-1">{Order Total}</p>
                                                                <p class="fs-12 text-orange mb-1">{Order Date}</p>
                                                                <p class="fs-12 text-orange mb-1">{Delivery Date}</p>
                                                                <p class="fs-12 text-orange">{Discount Code}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-card-one accordion" id="accordionExample6">
                                    <div class="accordion-item pb-3">
                                        <div class="accordion-header" id="heading6">
                                            <div class="accordion-button p-3 pb-0" data-bs-toggle="collapse" data-bs-target="#collapse6"  aria-controls="collapse6">
                                                <div class="addproduct-icon d-flex align-items-center justify-content-between w-100">
                                                    <div class="d-flex align-items-center">
                                                        <div class="status-toggle modal-status d-flex justify-content-between align-items-center me-2">
                                                            <input type="checkbox" id="user6" class="check" checked>
                                                            <label for="user6" class="checktoggle">	</label>
                                                        </div>
                                                        <h5><span>System Update</span></h5>
                                                    </div>
                                                    <a href="javascript:void(0);" class="ms-auto"><i data-feather="chevron-down" class="chevron-down-add"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="collapse6" class="accordion-collapse collapse" aria-labelledby="heading6" data-bs-parent="#accordionExample6">
                                        <div class="accordion-body border-0 pb-0">
                                            <div class="row gy-4">
                                                <div class="col-xl-7">
                                                    <div class="card mb-3">
                                                        <div class="card-body">
                                                            <textarea class="form-control" cols="5" style="height: 300px">

Hi <span class="text-orange">{Customer Name}</span>,<br> Welcome to <span class="text-orange">{Company Name}</span>!

We’re thrilled to have you as part of our community and are eager to support you in optimizing your operations. Thank you for choosing us – we appreciate your trust and confidence.

At <span class="text-orange">{Company Name}</span>, our mission is to make your experience seamless and efficient. From managing day-to-day tasks to improving workflows, we’re here to help you get the most out of our solutions.

If you have any questions or need assistance, our dedicated support team is always ready to assist you. Feel free to reach out anytime – we’re committed to ensuring your success.

Thank you again for trusting <span class="text-orange">{Company Name}</span>. We’re excited to be part of your journey and look forward to supporting you every step of the way.

Best, The <span class="text-orange">{Company Name}</span> Team
                                                            </textarea>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center flex-wrap row-gap-3">
                                                        <a href="#" class="btn bg-cyan me-2">Save Template</a>
                                                        <a href="#" class="btn btn-secondary me-2">Default Template</a>
                                                        <a href="#" class="btn btn-primary">Preview Template</a>
                                                    </div>
                                                </div>
                                                <div class="col-xl-5">
                                                    <div class="card mb-0">
                                                        <div class="card-body">
                                                            <h5 class="mb-2">Tags</h5>
                                                            <div>
                                                                <p class="fs-12 text-orange mb-1">{Customer Name}</p>
                                                                <p class="fs-12 text-orange mb-1">{Company Name}</p>
                                                                <p class="fs-12 text-orange mb-1">{Order ID}</p>
                                                                <p class="fs-12 text-orange mb-1">{Invoice ID}</p>
                                                                <p class="fs-12 text-orange mb-1">{Receipt ID}</p>
                                                                <p class="fs-12 text-orange mb-1">{Login Link}</p>
                                                                <p class="fs-12 text-orange mb-1">{Support Email}</p>
                                                                <p class="fs-12 text-orange mb-1">{Password Reset Link}</p>
                                                                <p class="fs-12 text-orange mb-1">{Product Name}</p>
                                                                <p class="fs-12 text-orange mb-1">{Order Total}</p>
                                                                <p class="fs-12 text-orange mb-1">{Order Date}</p>
                                                                <p class="fs-12 text-orange mb-1">{Delivery Date}</p>
                                                                <p class="fs-12 text-orange">{Discount Code}</p>
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