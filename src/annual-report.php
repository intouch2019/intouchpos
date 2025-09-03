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
                        <h4>Annual Report</h4>
                        <h6>View Reports of Annual Report</h6>
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
                <div class="card-body">
                    <form action="sales-report.php">
                        <div class="row row-gap-2 align-items-end">
                            <div class="col-md-3">
                                <div>
                                    <label class="form-label">Date</label>
                                    <div class="input-icon position-relative">
                                        <span class="input-icon-addon">
                                            <i class="ti ti-calendar text-gray-9"></i>
                                        </span>
                                        <input type="text" class="form-control yearpicker" value="2025">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div>
                                    <label class="form-label">Store</label>
                                    <select class="select">
                                        <option>All Stores</option>
                                        <option>Electro Mart</option>
                                        <option>Quantum Gadgets</option>
                                        <option>Prime Bazaar</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-primary">Generate Report</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <h4>2025 Reports</h4>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-light">
                                <tr>
                                    <th>
                                    </th>
                                    <th>Jan 2025</th>
                                    <th>Feb 2025</th>
                                    <th>Mar 2025</th>
                                    <th>Apr 2025</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>January</td>
                                    <td>$50,000</td>
                                    <td>$50,000</td>
                                    <td>$50,000</td>
                                    <td>$50,000</td>
                                </tr>
                                <tr>
                                    <td>Febuary</td>
                                    <td>$30,000</td>
                                    <td>$50,000</td>
                                    <td>$50,000</td>
                                    <td>$50,000</td>
                                </tr>
                                <tr>
                                    <td>March</td>
                                    <td>$7,000</td>
                                    <td>$50,000</td>
                                    <td>$50,000</td>
                                    <td>$50,000</td>
                                </tr>
                                <tr>
                                    <td>April</td>
                                    <td>$7,000</td>
                                    <td>$50,000</td>
                                    <td>$50,000</td>
                                    <td>$50,000</td>
                                </tr>
                                <tr>
                                    <td>May</td>
                                    <td>$7,000</td>
                                    <td>$50,000</td>
                                    <td>$50,000</td>
                                    <td>$50,000</td>
                                </tr>
                                <tr>
                                    <td>June</td>
                                    <td>$7,000</td>
                                    <td>$30,000</td>
                                    <td>$30,000</td>
                                    <td>$30,000</td>
                                </tr>
                                <tr>
                                    <td>July</td>
                                    <td>$7,000</td>
                                    <td>$30,000</td>
                                    <td>$30,000</td>
                                    <td>$30,000</td>
                                </tr>
                                <tr>
                                    <td>August</td>
                                    <td>$7,000</td>
                                    <td>$30,000</td>
                                    <td>$30,000</td>
                                    <td>$30,000</td>
                                </tr>
                                <tr>
                                    <td>September</td>
                                    <td>$7,000</td>
                                    <td>$7,000</td>
                                    <td>$7,000</td>
                                    <td>$7,000</td>
                                </tr>
                                <tr>
                                    <td>October</td>
                                    <td>$7,000</td>
                                    <td>$7,000</td>
                                    <td>$7,000</td>
                                    <td>$7,000</td>
                                </tr>
                                <tr>
                                    <td>November</td>
                                    <td>$7,000</td>
                                    <td>$7,000</td>
                                    <td>$7,000</td>
                                    <td>$7,000</td>
                                </tr>
                                <tr>
                                    <td>December</td>
                                    <td>$7,000</td>
                                    <td>$7,000</td>
                                    <td>$7,000</td>
                                    <td>$7,000</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="bg-light fw-bold p-3 fs-16">Total</td>
                                    <td class="bg-light fw-bold p-3 fs-16">$8,000</td>
                                    <td class="bg-light fw-bold p-3 fs-16">$8,000</td>
                                    <td class="bg-light fw-bold p-3 fs-16">$8,000</td>
                                    <td class="bg-light fw-bold p-3 fs-16">$8,000</td>
                                </tr>
                            </tfoot>
                        </table>
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