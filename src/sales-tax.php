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
                        <a class="nav-link" href="tax-reports.php">Purchase tax</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="sales-tax.php">Sales Tax</a>
                    </li>
                </ul>
            </div>
            <div>
                <div class="page-header">
                    <div class="add-item d-flex">
                        <div class="page-title">
                            <h4>Sales tax</h4>
                            <h6>View Reports of Sales tax</h6>
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
                        <form action="sales-tax.php">
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
                                                <label class="form-label">Store</label>
                                                <select class="select">
                                                    <option>All</option>
                                                    <option>Electro Mart</option>
                                                    <option>Quantum Gadgets</option>
                                                    <option>Prime Bazaar</option>
                                                </select>
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
                                                    <option>Stripe</option>
                                                    <option>Paypal</option>
                                                    <option>Cash</option>
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
                            <h4>Sales Tax Report</h4>
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
                                        <th>Customer</th>
                                        <th>Date</th>
                                        <th>Store</th>
                                        <th>Amount</th>
                                        <th>Payment Method</th>
                                        <th>Discount</th>
                                        <th>Tax Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><a href="#">#4237300</a></td>
                                        <td>Carl Evans</td>
                                        <td>24 Dec 2024</td>
                                        <td>Electro Mart</td>
                                        <td>$200</td>
                                        <td>Stripe</td>
                                        <td>$200</td>
                                        <td>$200</td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">#7590325</a></td>
                                        <td>Minerva Rameriz</td>
                                        <td>10 Dec 2024</td>
                                        <td>Quantum Gadgets</td>
                                        <td>$50</td>
                                        <td>Paypal</td>
                                        <td>$50</td>
                                        <td>$50</td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">#9814521</a></td>
                                        <td>Robert Lamon</td>
                                        <td>27 Nov 2024</td>
                                        <td>Prime Bazaar</td>
                                        <td>$800</td>
                                        <td>Cash</td>
                                        <td>$800</td>
                                        <td>$800</td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">#8745225</a></td>
                                        <td>Patricia Lewis</td>
                                        <td>18 Nov 2024</td>
                                        <td>Gadget World</td>
                                        <td>$100</td>
                                        <td>Paypal</td>
                                        <td>$100</td>
                                        <td>$100</td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">#4237022</a></td>
                                        <td>Mark Joslyn</td>
                                        <td>06 Nov 2024</td>
                                        <td>Volt Vault</td>
                                        <td>$700</td>
                                        <td>Cash</td>
                                        <td>$700</td>
                                        <td>$700</td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">#8744439</a></td>
                                        <td>Marsha Betts</td>
                                        <td>25 Oct 2024</td>
                                        <td>Elite Retail</td>
                                        <td>$1000</td>
                                        <td>Cash</td>
                                        <td>$1000</td>
                                        <td>$1000</td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">#7590365</a></td>
                                        <td>Daniel Jude</td>
                                        <td>14 Oct 2024</td>
                                        <td>Prime Mart</td>
                                        <td>$1200</td>
                                        <td>Paypal</td>
                                        <td>$1200</td>
                                        <td>$1200</td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">#8745478</a></td>
                                        <td>Emma Bates</td>
                                        <td>03 Oct 2024</td>
                                        <td>NeoTech Store</td>
                                        <td>$750</td>
                                        <td>Stripe</td>
                                        <td>$750</td>
                                        <td>$750</td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">#7590321</a></td>
                                        <td>Richard Fralick</td>
                                        <td>20 Sep 2024</td>
                                        <td>Urban Mart</td>
                                        <td>$450</td>
                                        <td>Stripe</td>
                                        <td>$450</td>
                                        <td>$450</td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">#8745245</a></td>
                                        <td>Michelle Robison</td>
                                        <td>10 Sep 2024</td>
                                        <td>Travel Mart</td>
                                        <td>$300</td>
                                        <td>Cash</td>
                                        <td>$300</td>
                                        <td>$300</td>
                                    </tr>
                                </tbody>
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