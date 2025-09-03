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
                        <h4>Companies</h4>
                        <h6>Manage your companies</h6>
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
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_company"><i class="ti ti-circle-plus me-1"></i>Add Company</a>
                </div>
            </div>

            <div class="row">

                <!-- Total Companies -->
                <div class="col-lg-3 col-md-6 d-flex">
                    <div class="card flex-fill">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center overflow-hidden">
                                <span class="avatar avatar-lg bg-primary flex-shrink-0">
                                    <i class="ti ti-building fs-16"></i>
                                </span>
                                <div class="ms-2 overflow-hidden">
                                    <p class="fs-12 fw-medium mb-1 text-truncate">Total Companies</p>
                                    <h4>950</h4>
                                </div>
                            </div>
                            <div id="total-chart"></div>
                        </div>
                    </div>
                </div>
                <!-- /Total Companies -->

                <!-- Total Companies -->
                <div class="col-lg-3 col-md-6 d-flex">
                    <div class="card flex-fill">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center overflow-hidden">
                                <span class="avatar avatar-lg bg-success flex-shrink-0">
                                    <i class="ti ti-building fs-16"></i>
                                </span>
                                <div class="ms-2 overflow-hidden">
                                    <p class="fs-12 fw-medium mb-1 text-truncate">Active Companies</p>
                                    <h4>920</h4>
                                </div>
                            </div>
                            <div id="active-chart"></div>
                        </div>
                    </div>
                </div>
                <!-- /Total Companies -->

                <!-- Inactive Companies -->
                <div class="col-lg-3 col-md-6 d-flex">
                    <div class="card flex-fill">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center overflow-hidden">
                                <span class="avatar avatar-lg bg-danger flex-shrink-0">
                                    <i class="ti ti-building fs-16"></i>
                                </span>
                                <div class="ms-2 overflow-hidden">
                                    <p class="fs-12 fw-medium mb-1 text-truncate">Inactive Companies</p>
                                    <h4>30</h4>
                                </div>
                            </div>
                            <div id="inactive-chart"></div>
                        </div>
                    </div>
                </div>
                <!-- /Inactive Companies -->

                <!-- Company Location -->
                <div class="col-lg-3 col-md-6 d-flex">
                    <div class="card flex-fill">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center overflow-hidden">
                                <span class="avatar avatar-lg bg-skyblue flex-shrink-0">
                                    <i class="ti ti-map-pin-check fs-16"></i>
                                </span>
                                <div class="ms-2 overflow-hidden">
                                    <p class="fs-12 fw-medium mb-1 text-truncate">Company Location</p>
                                    <h4>180</h4>
                                </div>
                            </div>
                            <div id="location-chart"></div>
                        </div>
                    </div>
                </div>
                <!-- /Company Location -->

            </div>

            <!-- /product list -->
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
                    <div class="search-set">
                        <div class="search-input">
                            <span class="btn-searchset"><i class="ti ti-search fs-14 feather-search"></i></span>
                        </div>
                    </div>
                    <div class="d-flex my-xl-auto right-content align-items-center flex-wrap row-gap-3">
                        <div class="dropdown me-2">
                            <a href="javascript:void(0);" class="dropdown-toggle btn btn-white btn-md d-inline-flex align-items-center" data-bs-toggle="dropdown">
                                Select Plan
                            </a>
                            <ul class="dropdown-menu  dropdown-menu-end p-3">
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">Advance</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">Basic</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">Enterprise</a>
                                </li>
                            </ul>
                        </div>
                        <div class="dropdown me-2">
                            <a href="javascript:void(0);" class="dropdown-toggle btn btn-white btn-md d-inline-flex align-items-center" data-bs-toggle="dropdown">
                                Select Status
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
                                Sort By : Last 7 Days
                            </a>
                            <ul class="dropdown-menu  dropdown-menu-end p-3">
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">Recently Added</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">Ascending</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">Desending</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">Last Month</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">Last 7 Days</a>
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
                                        <div class="form-check form-check-md">
                                            <input class="form-check-input" type="checkbox" id="select-all">
                                        </div>
                                    </th>
                                    <th>Company Name</th>
                                    <th>Email</th>
                                    <th>Account URL</th>
                                    <th>Plan</th>
                                    <th>Created Date</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-md">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center file-name-icon">
                                            <a href="#" class="avatar avatar-md border rounded-circle">
                                                <img src="assets/img/company/company-01.svg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium"><a href="#">BrightWave Innovations</a></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>michael@example.com</td>
                                    <td>bwi.example.com</td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <p class="mb-0 me-2">Advanced (Monthly)</p>
                                            <a href="#" data-bs-toggle="modal" class="badge badge-purple badge-xs" data-bs-target="#upgrade_info">Upgrade</a>
                                        </div>
                                    </td>
                                    <td>12 Sep 2024</td>
                                    <td>
                                        <span class="badge badge-success d-inline-flex align-items-center badge-xs">
                                            <i class="ti ti-point-filled me-1"></i>Active
                                        </span>
                                    </td>
                                    <td>
                                        <div class="action-icon d-inline-flex align-items-center">
                                            <a href="#" class="p-2 d-flex align-items-center border rounded me-2"  data-bs-toggle="modal" data-bs-target="#company_detail"><i class="ti ti-eye"></i></a>
                                            <a href="#" class="p-2 d-flex align-items-center border rounded me-2" data-bs-toggle="modal" data-bs-target="#edit_company"><i class="ti ti-edit"></i></a>
                                            <a href="javascript:void(0);" class="p-2 d-flex align-items-center border rounded" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-md">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center file-name-icon">
                                            <a href="#" class="avatar avatar-md border rounded-circle">
                                                <img src="assets/img/company/company-02.svg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium"><a href="#">Stellar Dynamics</a></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>sophie@example.com</td>
                                    <td>sd.example.com</td>
                                    <td>											
                                        <div class="d-flex align-items-center justify-content-between">
                                            <p class="mb-0 me-2">Basic (Yearly)</p>
                                            <a href="#" data-bs-toggle="modal" class="badge badge-purple badge-xs" data-bs-target="#upgrade_info">Upgrade</a>
                                        </div>
                                    </td>
                                    <td>24 Oct 2024</td>
                                    <td>
                                        <span class="badge badge-success d-inline-flex align-items-center badge-xs">
                                            <i class="ti ti-point-filled me-1"></i>Active
                                        </span>
                                    </td>
                                    <td>
                                        <div class="action-icon d-inline-flex">
                                            <a href="#" class="p-2 d-flex align-items-center border rounded me-2" data-bs-toggle="modal" data-bs-target="#company_detail"><i class="ti ti-eye"></i></a>
                                            <a href="#" class="p-2 d-flex align-items-center border rounded me-2" data-bs-toggle="modal" data-bs-target="#edit_company"><i class="ti ti-edit"></i></a>
                                            <a href="javascript:void(0);" class="p-2 d-flex align-items-center border rounded" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-md">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center file-name-icon">
                                            <a href="#" class="avatar avatar-md border rounded-circle">
                                                <img src="assets/img/company/company-03.svg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium"><a href="#">Quantum Nexus</a></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>cameron@example.com</td>
                                    <td>qn.example.com</td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <p class="mb-0 me-2">Advanced (Monthly)</p>
                                            <a href="#" data-bs-toggle="modal" class="badge badge-purple badge-xs" data-bs-target="#upgrade_info">Upgrade</a>
                                        </div>
                                    </td>
                                    <td>18 Feb 2024</td>
                                    <td>
                                        <span class="badge badge-success d-inline-flex align-items-center badge-xs">
                                            <i class="ti ti-point-filled me-1"></i>Active
                                        </span>
                                    </td>
                                    <td>
                                        <div class="action-icon d-inline-flex">
                                            <a href="#" class="p-2 d-flex align-items-center border rounded me-2" data-bs-toggle="modal" data-bs-target="#company_detail"><i class="ti ti-eye"></i></a>
                                            <a href="#" class="p-2 d-flex align-items-center border rounded me-2" data-bs-toggle="modal" data-bs-target="#edit_company"><i class="ti ti-edit"></i></a>
                                            <a href="javascript:void(0);" class="p-2 d-flex align-items-center border rounded" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-md">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center file-name-icon">
                                            <a href="#" class="avatar avatar-md border rounded-circle">
                                                <img src="assets/img/company/company-04.svg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium"><a href="#">EcoVision Enterprises</a></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>doris@example.com</td>
                                    <td>eve.example.com</td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <p class="mb-0 me-2">Advanced (Monthly)</p> 
                                            <a href="#" data-bs-toggle="modal" class="badge badge-purple badge-xs" data-bs-target="#upgrade_info">Upgrade</a>
                                        </div>
                                    </td>
                                    <td>17 Oct 2024</td>
                                    <td>
                                        <span class="badge badge-success d-inline-flex align-items-center badge-xs">
                                            <i class="ti ti-point-filled me-1"></i>Active
                                        </span>
                                    </td>
                                    <td>
                                        <div class="action-icon d-inline-flex align-items-center">
                                            <a href="#" class="p-2 d-flex align-items-center border rounded me-2"  data-bs-toggle="modal" data-bs-target="#company_detail"><i class="ti ti-eye"></i></a>
                                            <a href="#" class="p-2 d-flex align-items-center border rounded me-2" data-bs-toggle="modal" data-bs-target="#edit_company"><i class="ti ti-edit"></i></a>
                                            <a href="javascript:void(0);" class="p-2 d-flex align-items-center border rounded" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-md">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center file-name-icon">
                                            <a href="#" class="avatar avatar-md border rounded-circle">
                                                <img src="assets/img/company/company-05.svg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium"><a href="#">Aurora Technologies</a></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>thomas@example.com</td>
                                    <td>at.example.com</td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <p class="mb-0 me-2">Enterprise (Monthly)</p>
                                            <a href="#" data-bs-toggle="modal" class="badge badge-purple badge-xs" data-bs-target="#upgrade_info">Upgrade</a>
                                        </div>
                                    </td>
                                    <td>20 Jul 2024</td>
                                    <td>
                                        <span class="badge badge-success d-inline-flex align-items-center badge-xs">
                                            <i class="ti ti-point-filled me-1"></i>Active
                                        </span>
                                    </td>
                                    <td>
                                        <div class="action-icon d-inline-flex">
                                            <a href="#" class="p-2 d-flex align-items-center border rounded me-2" data-bs-toggle="modal" data-bs-target="#company_detail"><i class="ti ti-eye"></i></a>
                                            <a href="#" class="p-2 d-flex align-items-center border rounded me-2" data-bs-toggle="modal" data-bs-target="#edit_company"><i class="ti ti-edit"></i></a>
                                            <a href="javascript:void(0);" class="p-2 d-flex align-items-center border rounded" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-md">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center file-name-icon">
                                            <a href="#" class="avatar avatar-md border rounded-circle">
                                                <img src="assets/img/company/company-06.svg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium"><a href="#">BlueSky Ventures</a></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>kathleen@example.com</td>
                                    <td>bsv.example.com</td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <p class="mb-0 me-2">Advanced (Monthly)</p> 
                                            <a href="#" data-bs-toggle="modal" class="badge badge-purple badge-xs" data-bs-target="#upgrade_info">Upgrade</a>
                                        </div>
                                    </td>
                                    <td>10 Apr 2024</td>
                                    <td>
                                        <span class="badge badge-success d-inline-flex align-items-center badge-xs">
                                            <i class="ti ti-point-filled me-1"></i>Active
                                        </span>
                                    </td>
                                    <td>
                                        <div class="action-icon d-inline-flex">
                                            <a href="#" class="p-2 d-flex align-items-center border rounded me-2" data-bs-toggle="modal" data-bs-target="#company_detail"><i class="ti ti-eye"></i></a>
                                            <a href="#" class="p-2 d-flex align-items-center border rounded me-2" data-bs-toggle="modal" data-bs-target="#edit_company"><i class="ti ti-edit"></i></a>
                                            <a href="javascript:void(0);" class="p-2 d-flex align-items-center border rounded" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-md">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center file-name-icon">
                                            <a href="#" class="avatar avatar-md border rounded-circle">
                                                <img src="assets/img/company/company-07.svg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium"><a href="#">TerraFusion Energy</a></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>bruce@example.com</td>
                                    <td>tfe.example.com</td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <p class="mb-0 me-2">Enterprise (Yearly)</p>
                                            <a href="#" data-bs-toggle="modal" class="badge badge-purple badge-xs" data-bs-target="#upgrade_info">Upgrade</a>
                                        </div>
                                    </td>
                                    <td>29 Aug 2024</td>
                                    <td>
                                        <span class="badge badge-success d-inline-flex align-items-center badge-xs">
                                            <i class="ti ti-point-filled me-1"></i>Active
                                        </span>
                                    </td>
                                    <td>
                                        <div class="action-icon d-inline-flex">
                                            <a href="#" class="p-2 d-flex align-items-center border rounded me-2" data-bs-toggle="modal" data-bs-target="#company_detail"><i class="ti ti-eye"></i></a>
                                            <a href="#" class="p-2 d-flex align-items-center border rounded me-2" data-bs-toggle="modal" data-bs-target="#edit_company"><i class="ti ti-edit"></i></a>
                                            <a href="javascript:void(0);" class="p-2 d-flex align-items-center border rounded" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-md">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center file-name-icon">
                                            <a href="#" class="avatar avatar-md border rounded-circle">
                                                <img src="assets/img/company/company-08.svg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium"><a href="#">UrbanPulse Design</a></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>estelle@example.com</td>
                                    <td>upd.example.com</td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <p class="mb-0 me-2">Basic (Monthly)</p>
                                            <a href="#" data-bs-toggle="modal" class="badge badge-purple badge-xs" data-bs-target="#upgrade_info">Upgrade</a>
                                        </div>
                                    </td>
                                    <td>22 Feb 2024</td>
                                    <td>
                                        <span class="badge badge-danger d-inline-flex align-items-center badge-xs">
                                            <i class="ti ti-point-filled me-1"></i>Inactive
                                        </span>
                                    </td>
                                    <td>
                                        <div class="action-icon d-inline-flex align-items-center">
                                            <a href="#" class="p-2 d-flex align-items-center border rounded me-2"  data-bs-toggle="modal" data-bs-target="#company_detail"><i class="ti ti-eye"></i></a>
                                            <a href="#" class="p-2 d-flex align-items-center border rounded me-2" data-bs-toggle="modal" data-bs-target="#edit_company"><i class="ti ti-edit"></i></a>
                                            <a href="javascript:void(0);" class="p-2 d-flex align-items-center border rounded" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-md">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center file-name-icon">
                                            <a href="#" class="avatar avatar-md border rounded-circle">
                                                <img src="assets/img/company/company-09.svg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium"><a href="#">Nimbus Networks</a></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>stephen@example.com</td>
                                    <td>nn.example.com</td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <p class="mb-0 me-2">Basic (Yearly)</p>
                                            <a href="#" data-bs-toggle="modal" class="badge badge-purple badge-xs" data-bs-target="#upgrade_info">Upgrade</a>
                                        </div>
                                    </td>
                                    <td>03 Nov 2024</td>
                                    <td>
                                        <span class="badge badge-success d-inline-flex align-items-center badge-xs">
                                            <i class="ti ti-point-filled me-1"></i>Active
                                        </span>
                                    </td>
                                    <td>
                                        <div class="action-icon d-inline-flex">
                                            <a href="#" class="p-2 d-flex align-items-center border rounded me-2" data-bs-toggle="modal" data-bs-target="#company_detail"><i class="ti ti-eye"></i></a>
                                            <a href="#" class="p-2 d-flex align-items-center border rounded me-2" data-bs-toggle="modal" data-bs-target="#edit_company"><i class="ti ti-edit"></i></a>
                                            <a href="javascript:void(0);" class="p-2 d-flex align-items-center border rounded" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-md">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center file-name-icon">
                                            <a href="#" class="avatar avatar-md border rounded-circle">
                                                <img src="assets/img/company/company-10.svg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium"><a href="#">Epicurean Delights</a></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>angela@example.com</td>
                                    <td>ed.example.com</td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-between">
                                            `<p class="mb-0 me-2">Advanced (Monthly)</p>
                                            <a href="#" data-bs-toggle="modal" class="badge badge-purple badge-xs" data-bs-target="#upgrade_info">Upgrade</a>
                                        </div>
                                    </td>
                                    <td>17 Dec 2024</td>
                                    <td>
                                        <span class="badge badge-success d-inline-flex align-items-center badge-xs">
                                            <i class="ti ti-point-filled me-1"></i>Active
                                        </span>
                                    </td>
                                    <td>
                                        <div class="action-icon d-inline-flex">
                                            <a href="#" class="p-2 d-flex align-items-center border rounded me-2" data-bs-toggle="modal" data-bs-target="#company_detail"><i class="ti ti-eye"></i></a>
                                            <a href="#" class="p-2 d-flex align-items-center border rounded me-2" data-bs-toggle="modal" data-bs-target="#edit_company"><i class="ti ti-edit"></i></a>
                                            <a href="javascript:void(0);" class="p-2 d-flex align-items-center border rounded" data-bs-target="#delete_modal" data-bs-toggle="modal"><i class="ti ti-trash"></i></a>
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