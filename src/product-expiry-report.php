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
                        <a class="nav-link" href="product-report.php">Product Report</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="product-expiry-report.php">Product Expiry Report</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="product-quantity-alert.php">Product Quantity Alert</a>
                    </li>
                </ul>
            </div>
            <div>
                <div class="page-header">
                    <div class="add-item d-flex">
                        <div class="page-title">
                            <h4>Product Expiry Report</h4>
                            <h6>View Reports of Products</h6>
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
                        <form action="product-expiry-report.php">
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
                                        <div class="col-lg-9">
                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 col-sm-6">
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
                                                <div class="col-lg-3 col-md-4 col-sm-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Category</label>
                                                        <select class="select">
                                                            <option>All</option>
                                                            <option>Computers</option>
                                                            <option>Electronics</option>
                                                            <option>Shoe</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-4 col-sm-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Brand</label>
                                                        <select class="select">
                                                            <option>All</option>
                                                            <option>Lenovo</option>
                                                            <option>Beats</option>
                                                            <option>Nike</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-4 col-sm-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Product</label>
                                                        <select class="select">
                                                            <option>All</option>
                                                            <option>Lenovo IdeaPad 3</option>
                                                            <option>Beats Pro</option>
                                                            <option>Nike Jordan</option>
                                                        </select>
                                                    </div>
                                                </div>
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
                <!-- /product list -->
                <div class="card no-search">
                    <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
                        <div>
                            <h4>Product Expiry Report</h4>
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
                                        <th>SKU</th>
                                        <th>Serial No</th>
                                        <th>Product Name</th>
                                        <th>Manufactured Date</th>
                                        <th>Expired Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><a href="#">PT001</a></td>
                                        <td>LNV-IP3-8GB-256SSD-BL</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="#" class="avatar avatar-md"><img src="assets/img/products/stock-img-01.png" class="img-fluid" alt="img"></a>
                                                <div class="ms-2">
                                                    <p class="text-dark mb-0"><a href="#">Lenovo IdeaPad 3</a></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>24 Dec 2024</td>
                                        <td>20 Dec 2026</td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">PT002</a></td>
                                        <td>LNV-IP3-8GB-256SSD-BL</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="#" class="avatar avatar-md"><img src="assets/img/products/stock-img-06.png" class="img-fluid" alt="img"></a>
                                                <div class="ms-2">
                                                    <p class="text-dark mb-0"><a href="#">Beats Pro </a></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>25 Dec 2024</td>
                                        <td>21 Dec 2026</td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">PT003</a></td>
                                        <td>LNV-IP3-8GB-256SSD-BL</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="#" class="avatar avatar-md"><img src="assets/img/products/stock-img-02.png" class="img-fluid" alt="img"></a>
                                                <div class="ms-2">
                                                    <p class="text-dark mb-0"><a href="#">Nike Jordan</a></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>26 Dec 2024</td>
                                        <td>22 Dec 2026</td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">PT004</a></td>
                                        <td>LNV-IP3-8GB-256SSD-BL</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="#" class="avatar avatar-md"><img src="assets/img/products/stock-img-03.png" class="img-fluid" alt="img"></a>
                                                <div class="ms-2">
                                                    <p class="text-dark mb-0"><a href="#">Apple Series 5 Watch</a></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>30 Dec 2024</td>
                                        <td>25 Dec 2026</td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">PT005</a></td>
                                        <td>LNV-IP3-8GB-256SSD-BL</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="#" class="avatar avatar-md"><img src="assets/img/products/stock-img-04.png" class="img-fluid" alt="img"></a>
                                                <div class="ms-2">
                                                    <p class="text-dark mb-0"><a href="#">Amazon Echo Dot</a></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>28 Dec 2024</td>
                                        <td>26 Dec 2026</td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">PT006</a></td>
                                        <td>LNV-IP3-8GB-256SSD-BL</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="#" class="avatar avatar-md"><img src="assets/img/products/stock-img-05.png" class="img-fluid" alt="img"></a>
                                                <div class="ms-2">
                                                    <p class="text-dark mb-0"><a href="#">Sanford Chair Sofa</a></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>24 Dec 2024</td>
                                        <td>29 Dec 2026</td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">PT007</a></td>
                                        <td>LNV-IP3-8GB-256SSD-BL</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="#" class="avatar avatar-md"><img src="assets/img/products/expire-product-01.png" class="img-fluid" alt="img"></a>
                                                <div class="ms-2">
                                                    <p class="text-dark mb-0"><a href="#">Red Premium Satchel</a></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>15 Dec 2024</td>
                                        <td>30 Dec 2026</td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">PT008</a></td>
                                        <td>LNV-IP3-8GB-256SSD-BL</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="#" class="avatar avatar-md"><img src="assets/img/products/expire-product-02.png" class="img-fluid" alt="img"></a>
                                                <div class="ms-2">
                                                    <p class="text-dark mb-0"><a href="#">Iphone 14 Pro</a></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>24 Dec 2024</td>
                                        <td>20 Dec 2026</td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">PT009</a></td>
                                        <td>LNV-IP3-8GB-256SSD-BL</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="#" class="avatar avatar-md"><img src="assets/img/products/expire-product-03.png" class="img-fluid" alt="img"></a>
                                                <div class="ms-2">
                                                    <p class="text-dark mb-0"><a href="#">Gaming Chair</a></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>30 Dec 2024</td>
                                        <td>20 Dec 2026</td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">PT010</a></td>
                                        <td>LNV-IP3-8GB-256SSD-BL</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="#" class="avatar avatar-md"><img src="assets/img/products/expire-product-04.png" class="img-fluid" alt="img"></a>
                                                <div class="ms-2">
                                                    <p class="text-dark mb-0"><a href="#">Borealis Backpack</a></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>24 Dec 2024</td>
                                        <td>20 Dec 2026</td>
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