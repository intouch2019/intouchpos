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
                        <a class="nav-link" href="customer-report.php">Customer Report</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="customer-due-report.php">Customer Due</a>
                    </li>
                </ul>
            </div>
            <div>
                <div class="page-header">
                    <div class="add-item d-flex">
                        <div class="page-title">
                            <h4>Customer Due Report</h4>
                            <h6>View Reports of Customer</h6>
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
                        <form action="customer-report.php">
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
                                                <label class="form-label">Customer</label>
                                                <select class="select">
                                                    <option>All</option>
                                                    <option>Carl Evans</option>
                                                    <option>Minerva Rameriz</option>
                                                    <option>Robert Lamon</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label class="form-label">Payment Method</label>
                                                <select class="select">
                                                    <option>All</option>
                                                    <option>Cash</option>
                                                    <option>Paypal</option>
                                                    <option>Stripe</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label class="form-label">Payment Status</label>
                                                <select class="select">
                                                    <option>All</option>
                                                    <option>Completed</option>
                                                    <option>Unpaid</option>
                                                    <option>Paid</option>
                                                </select>
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
                            <h4>Customer Due Report</h4>
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
                                        <th>Code</th>
                                        <th>Customer</th>
                                        <th>Total Amount</th>
                                        <th>Paid</th>
                                        <th>Due</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><a href="#">INV2025</a></td>
                                        <td>CU001</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="#" class="avatar avatar-md"><img src="assets/img/users/user-32.jpg" class="img-fluid" alt="img"></a>
                                                <div class="ms-2">
                                                    <p class="text-dark mb-0"><a href="#">Carl Evans</a></p>
                                                </div>
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
                                        <td><a href="#">INV2031</a></td>
                                        <td>CU002</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="#" class="avatar avatar-md"><img src="assets/img/users/user-02.jpg" class="img-fluid" alt="img"></a>
                                                <div class="ms-2">
                                                    <p class="text-dark mb-0"><a href="#">Minerva Rameriz</a></p>
                                                </div>
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
                                        <td><a href="#">INV2042</a></td>
                                        <td>CU003</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="#" class="avatar avatar-md"><img src="assets/img/users/user-01.jpg" class="img-fluid" alt="img"></a>
                                                <div class="ms-2">
                                                    <p class="text-dark mb-0"><a href="#">Robert Lamon</a></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>$1600</td>
                                        <td>$1600</td>
                                        <td>$0.0</td>
                                        <td>
                                            <span class="badge badge-success d-inline-flex align-items-center badge-xs">
                                                <i class="ti ti-point-filled me-1"></i>Paid
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">INV2033</a></td>
                                        <td>CU004</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="#" class="avatar avatar-md"><img src="assets/img/users/user-04.jpg" class="img-fluid" alt="img"></a>
                                                <div class="ms-2">
                                                    <p class="text-dark mb-0"><a href="#">Patricia Lewis</a></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>$700</td>
                                        <td>$700</td>
                                        <td>$0.0</td>
                                        <td>
                                            <span class="badge badge-success d-inline-flex align-items-center badge-xs">
                                                <i class="ti ti-point-filled me-1"></i>Paid
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">INV2042</a></td>
                                        <td>CU005</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="#" class="avatar avatar-md"><img src="assets/img/users/user-08.jpg" class="img-fluid" alt="img"></a>
                                                <div class="ms-2">
                                                    <p class="text-dark mb-0"><a href="#">Mark Joslyn</a></p>
                                                </div>
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
                                        <td><a href="#">INV2011</a></td>
                                        <td>CU006</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="#" class="avatar avatar-md"><img src="assets/img/users/user-10.jpg" class="img-fluid" alt="img"></a>
                                                <div class="ms-2">
                                                    <p class="text-dark mb-0"><a href="#">Marsha Betts</a></p>
                                                </div>
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
                                        <td><a href="#">INV2014</a></td>
                                        <td>CU007</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="#" class="avatar avatar-md"><img src="assets/img/users/user-28.jpg" class="img-fluid" alt="img"></a>
                                                <div class="ms-2">
                                                    <p class="text-dark mb-0"><a href="#">Daniel Jude</a></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>$600</td>
                                        <td>$600</td>
                                        <td>$0.0</td>
                                        <td>
                                            <span class="badge badge-purple d-inline-flex align-items-center badge-xs">
                                                <i class="ti ti-point-filled me-1"></i>Overdue
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">INV2056</a></td>
                                        <td>CU008</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="#" class="avatar avatar-md"><img src="assets/img/users/user-17.jpg" class="img-fluid" alt="img"></a>
                                                <div class="ms-2">
                                                    <p class="text-dark mb-0"><a href="#">Emma Bates</a></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>$1000</td>
                                        <td>$1000</td>
                                        <td>$0.0</td>
                                        <td>
                                            <span class="badge badge-danger d-inline-flex align-items-center badge-xs">
                                                <i class="ti ti-point-filled me-1"></i>Unpaid
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">INV2047</a></td>
                                        <td>CU009</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="#" class="avatar avatar-md"><img src="assets/img/users/user-20.jpg" class="img-fluid" alt="img"></a>
                                                <div class="ms-2">
                                                    <p class="text-dark mb-0"><a href="#">Richard Fralick</a></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>$500</td>
                                        <td>$500</td>
                                        <td>$0.0</td>
                                        <td>
                                            <span class="badge badge-success d-inline-flex align-items-center badge-xs">
                                                Completed
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <td class="bg-light fw-bold p-3 fs-16" colspan="3">Total</td>
                                    <td class="bg-light fw-bold p-3 fs-16">33268</td>
                                    <td class="bg-light fw-bold p-3 fs-16">$33268.53</td>
                                    <td class="bg-light fw-bold p-3 fs-16">$0.0</td>
                                    <td class="bg-light"></td>
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