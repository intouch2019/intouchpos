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
                        <a class="nav-link" href="inventory-report.php">Inventory Report</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="stock-history.php">Stock History</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="sold-stock.php">Sold Stock</a>
                    </li>
                </ul>
            </div>
            <div>
                <div class="page-header">
                    <div class="add-item d-flex">
                        <div class="page-title">
                            <h4>Sold Stock</h4>
                            <h6>View Reports of Sold Stock</h6>
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
                                        <div class="col-md-4">
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
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Category</label>
                                                <select class="select">
                                                    <option>All</option>
                                                    <option>Carl Evans</option>
                                                    <option>Minerva Rameriz</option>
                                                    <option>Robert Lamon</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Products</label>
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
                            <h4>Customer Report</h4>
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
                                        <th>Product Name</th>
                                        <th>Unit</th>
                                        <th>Quantity</th>
                                        <th>Tax Value</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <a>PT001</a>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a  class="avatar avatar-md"><img src="assets/img/products/stock-img-01.png" class="img-fluid" alt="img"></a>
                                                <div class="ms-2">
                                                    <p class="text-dark mb-0"><a>Lenovo IdeaPad 3</a></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            6000
                                        </td>
                                        <td>
                                            100					
                                        </td>
                                        <td>$300</td>
                                        <td>$300</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a>PT002</a>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a  class="avatar avatar-md"><img src="assets/img/products/stock-img-06.png" class="img-fluid" alt="img"></a>
                                                <div class="ms-2">
                                                    <p class="text-dark mb-0"><a>Beats Pro </a></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            10
                                        </td>
                                        <td>
                                            140				
                                        </td>
                                        <td>$10</td>
                                        <td>$1600</td>
                                    </tr>
                
                                    <tr>
                                        <td>
                                            <a>PT003</a>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a  class="avatar avatar-md"><img src="assets/img/products/stock-img-02.png" class="img-fluid" alt="img"></a>
                                                <div class="ms-2">
                                                    <p class="text-dark mb-0"><a>Nike Jordan </a></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            08
                                        </td>
                                        <td>
                                            300			
                                        </td>
                                        <td>$80</td>
                                        <td>$880</td>
                                    </tr>
                
                                    <tr>
                                        <td>
                                            <a>PT004</a>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a  class="avatar avatar-md"><img src="assets/img/products/stock-img-03.png" class="img-fluid" alt="img"></a>
                                                <div class="ms-2">
                                                    <p class="text-dark mb-0"><a>Apple Series 5 Watch</a></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            10
                                        </td>
                                        <td>
                                            450		
                                        </td>
                                        <td>$100</td>
                                        <td>$1200</td>
                                    </tr>
                
                                    <tr>
                                        <td>
                                            <a>PT005</a>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a  class="avatar avatar-md"><img src="assets/img/products/stock-img-04.png" class="img-fluid" alt="img"></a>
                                                <div class="ms-2">
                                                    <p class="text-dark mb-0"><a>Amazon Echo Dot</a></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            05
                                        </td>
                                        <td>
                                            320		
                                        </td>
                                        <td>$400</td>
                                        <td>$400</td>
                                    </tr>
                                    
                                    <tr>
                                        <td>
                                            <a>PT006</a>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a  class="avatar avatar-md"><img src="assets/img/products/stock-img-05.png" class="img-fluid" alt="img"></a>
                                                <div class="ms-2">
                                                    <p class="text-dark mb-0"><a>Sanford Chair Sofa</a></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            07
                                        </td>
                                        <td>
                                            650	
                                        </td>
                                        <td>$220</td>
                                        <td>$2240</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a>PT007</a>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a  class="avatar avatar-md"><img src="assets/img/products/expire-product-01.png" class="img-fluid" alt="img"></a>
                                                <div class="ms-2">
                                                    <p class="text-dark mb-0"><a>Red Premium Satchel</a></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            15
                                        </td>
                                        <td>
                                            700
                                        </td>
                                        <td>$90</td>
                                        <td>$900</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a>PT008</a>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a  class="avatar avatar-md"><img src="assets/img/products/expire-product-02.png" class="img-fluid" alt="img"></a>
                                                <div class="ms-2">
                                                    <p class="text-dark mb-0"><a>Iphone 14 Pro</a></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            12
                                        </td>
                                        <td>
                                            630
                                        </td>
                                        <td>$680</td>
                                        <td>$6480</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a>PT009</a>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a  class="avatar avatar-md"><img src="assets/img/products/expire-product-03.png" class="img-fluid" alt="img"></a>
                                                <div class="ms-2">
                                                    <p class="text-dark mb-0"><a>Gaming Chair</a></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            10
                                        </td>
                                        <td>
                                            410
                                        </td>
                                        <td>$200</td>
                                        <td>$2000</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a>PT010</a>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a  class="avatar avatar-md"><img src="assets/img/products/expire-product-04.png" class="img-fluid" alt="img"></a>
                                                <div class="ms-2">
                                                    <p class="text-dark mb-0"><a>Borealis Backpack</a></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            20
                                        </td>
                                        <td>
                                            550
                                        </td>
                                        <td>$400</td>
                                        <td>$900</td>
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