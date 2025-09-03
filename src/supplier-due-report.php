<?php ob_start();?>

    <!-- ========================
        Start Page Content
    ========================= -->

    <div class="page-wrapper">

        <!-- Start Content -->
        <div class="content">
            <div class="mb-4">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link" href="supplier-report.php">Supplier Report</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="supplier-due-report.php">Supplier Due</a>
                    </li>
                </ul>
            </div>
            <div>
                <div class="page-header">
                    <div class="add-item d-flex">
                        <div class="page-title">
                            <h4>Supplier Due</h4>
                            <h6>View Reports of Supplier Due</h6>
                        </div>
                    </div>
                    <ul class="table-top-head">
                        <li class="me-2">
                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh"><i class="ti ti-refresh"></i></a>
                        </li>
                        <li>
                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i class="ti ti-chevron-up"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="card">
                    <div class="card-body pb-1">
                        <form action="supplier-report.php">
                            <div class="row align-items-end">
                                <div class="col-lg-10">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label class="form-label">Choose Date</label>
                                                <div class="input-icon-start position-relative">
                                                    <input type="text" class="form-control date-range bookingrange" placeholder="dd/mm/yyyy - dd/mm/yyyy">
                                                    <span class="input-icon-left">
                                                        <i class="ti ti-calendar"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label class="form-label">Supplier</label>
                                                <select class="select">
                                                    <option>All</option>
                                                    <option>Apex Computers</option>
                                                    <option>Beats Headphones</option>
                                                    <option>Dazzle Shoes</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label class="form-label">Payment Status</label>
                                                <select class="select">
                                                    <option>All</option>
                                                    <option>Paid</option>
                                                    <option>Unpaid</option>
                                                    <option>Overdue</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label class="form-label">Reference</label>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="mb-3">
                                        <button class="btn btn-primary w-100" type="submit">Generate Report</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
                <div class="card no-search">
                    <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
                        <div>
                            <h4>Supplier Due Report</h4>
                        </div>
                        <ul class="table-top-head">
                            <li class="me-2">
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="Pdf"><img src="assets/img/icons/pdf.svg" alt="img"></a>
                            </li>
                            <li class="me-2">
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="Excel"><img src="assets/img/icons/excel.svg" alt="img"></a>
                            </li>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="Print"><i class="ti ti-printer"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table datatable">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Reference</th>
                                        <th>ID</th>
                                        <th>Supplier</th>
                                        <th>Total Amount</th>
                                        <th>Paid</th>
                                        <th>Due</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><a href="#">INV/PO2025</a></td>
                                        <td>SU001</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="#" class="avatar avatar-md me-2">
                                                    <img src="assets/img/supplier/supplier-01.png" alt="Img">
                                                </a>
                                                <h6 class="fw-medium"><a href="#">Apex Computers</a></h6>
                                            </div>
                                        </td>
                                        <td>$1000</td>
                                        <td>$1000</td>
                                        <td>$0.0</td>
                                        <td>
                                            <span class="badge badge-success d-inline-flex align-items-center badge-xs">
                                                <i class="ti ti-point-filled me-1"></i>Paid
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">INV/PO2042</a></td>
                                        <td>SU003</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="#" class="avatar avatar-md me-2">
                                                    <img src="assets/img/supplier/supplier-03.png" alt="Img">
                                                </a>
                                                <h6 class="fw-medium"><a href="#">Dazzle Shoes</a></h6>
                                            </div>
                                        </td>
                                        <td>$1500</td>
                                        <td>$1500</td>
                                        <td>$0.0</td>
                                        <td>
                                            <span class="badge badge-success d-inline-flex align-items-center badge-xs">
                                                <i class="ti ti-point-filled me-1"></i>Paid
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">INV/PO2033</a></td>
                                        <td>SU004</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="#" class="avatar avatar-md me-2">
                                                    <img src="assets/img/supplier/supplier-04.png" alt="Img">
                                                </a>
                                                <h6 class="fw-medium"><a href="#">Best Accessories</a></h6>
                                            </div>
                                        </td>
                                        <td>$2000</td>
                                        <td>$2000</td>
                                        <td>$0.0</td>
                                        <td>
                                            <span class="badge badge-success d-inline-flex align-items-center badge-xs">
                                                <i class="ti ti-point-filled me-1"></i>Paid
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">INV/PO2042</a></td>
                                        <td>SU005</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="#" class="avatar avatar-md me-2">
                                                    <img src="assets/img/supplier/supplier-05.png" alt="Img">
                                                </a>
                                                <h6 class="fw-medium"><a href="#">A-Z Store</a></h6>
                                            </div>
                                        </td>
                                        <td>$800</td>
                                        <td>$800</td>
                                        <td>$0.0</td>
                                        <td>
                                            <span class="badge badge-success d-inline-flex align-items-center badge-xs">
                                                <i class="ti ti-point-filled me-1"></i>Paid
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">INV/PO2011</a></td>
                                        <td>SU006</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="#" class="avatar avatar-md me-2">
                                                    <img src="assets/img/supplier/supplier-06.png" alt="Img">
                                                </a>
                                                <h6 class="fw-medium"><a href="#">Hatimi Hardwares</a></h6>
                                            </div>
                                        </td>
                                        <td>$750</td>
                                        <td>$750</td>
                                        <td>$0.0</td>
                                        <td>
                                            <span class="badge badge-success d-inline-flex align-items-center badge-xs">
                                                <i class="ti ti-point-filled me-1"></i>Paid
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">INV/PO2014</a></td>
                                        <td>SU007</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="#" class="avatar avatar-md me-2">
                                                    <img src="assets/img/supplier/supplier-07.png" alt="Img">
                                                </a>
                                                <h6 class="fw-medium"><a href="#">Aesthetic Bags</a></h6>
                                            </div>
                                        </td>
                                        <td>$1300</td>
                                        <td>$1300</td>
                                        <td>$0.0</td>
                                        <td>
                                            <span class="badge badge-purple d-inline-flex align-items-center badge-xs">
                                                <i class="ti ti-point-filled me-1"></i>Overdue
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">INV/PO2056</a></td>
                                        <td>SU008</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="#" class="avatar avatar-md me-2">
                                                    <img src="assets/img/supplier/supplier-08.png" alt="Img">
                                                </a>
                                                <h6 class="fw-medium"><a href="#">Alpha Mobiles</a></h6>
                                            </div>
                                        </td>
                                        <td>$1100</td>
                                        <td>$1100</td>
                                        <td>$0.0</td>
                                        <td>
                                            <span class="badge badge-success d-inline-flex align-items-center badge-xs">
                                                <i class="ti ti-point-filled me-1"></i>Paid
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">INV/PO2047</a></td>
                                        <td>SU009</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="#" class="avatar avatar-md me-2">
                                                    <img src="assets/img/supplier/supplier-09.png" alt="Img">
                                                </a>
                                                <h6 class="fw-medium"><a href="#">Sigma Chairs</a></h6>
                                            </div>
                                        </td>
                                        <td>$2300</td>
                                        <td>$2300</td>
                                        <td>$0.0</td>
                                        <td>
                                            <span class="badge badge-success d-inline-flex align-items-center badge-xs">
                                                <i class="ti ti-point-filled me-1"></i>Paid
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">INV/PO2017</a></td>
                                        <td>SU010</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="#" class="avatar avatar-md me-2">
                                                    <img src="assets/img/supplier/supplier-10.png" alt="Img">
                                                </a>
                                                <a href="#">Zenith Bags</a>
                                            </div>
                                        </td>
                                        <td>$1700</td>
                                        <td>$1700</td>
                                        <td>$0.0</td>
                                        <td>
                                            <span class="badge badge-danger d-inline-flex align-items-center badge-xs">
                                                <i class="ti ti-point-filled me-1"></i>Unpaid
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <td class="bg-light fw-bold p-3 fs-16" colspan="3">Total</td>
                                        <td class="bg-light fw-bold p-3 fs-16">33268</td>
                                        <td class="bg-light fw-bold p-3 fs-16">$33268.53</td>
                                        <td class="bg-light fw-bold p-3 fs-16" colspan="2">$0.0</td>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /product list -->
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