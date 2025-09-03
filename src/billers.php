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
                        <h4 class="fw-bold">Billers</h4>
                        <h6>Manage your billers</h6>
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
                    <a href="#" class="btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#add-biller"><i class="ti ti-circle-plus me-1"></i>Add Biller</a>
                </div>
            </div>
            <!-- /product list -->
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
                    <div class="search-set">
                        <div class="search-input">
                            <span class="btn-searchset"><i class="ti ti-search fs-14 feather-search"></i></span>
                        </div>
                    </div>
                    <div class="d-flex table-dropdown my-xl-auto right-content align-items-center flex-wrap row-gap-3">
                                
                        <div class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle btn btn-white btn-md d-inline-flex align-items-center" data-bs-toggle="dropdown">
                                Status
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
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead class="thead-light">
                                <tr>
                                    <th class="no-sort">
                                        <label class="checkboxs">
                                            <input type="checkbox" id="select-all">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </th>
                                    <th>Code</th>
                                    <th>Biller</th>
                                    <th>Company Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Phone</th>
                                    <th>Country</th>
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
                                    <td>BI001</td>										
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="javascript:void(0);" class="avatar avatar-md me-2">
                                                <img src="assets/img/users/user-42.png" alt="product">
                                            </a>
                                            <a href="javascript:void(0);">Shaun Farley</a>
                                        </div>
                                    </td>
                                    <td>GreenTech Industries</td>
                                    <td>shaun@example.com</td>
                                    <td>+18647961254</td>
                                    <td>USA</td>
                                    <td><span class="d-inline-flex align-items-center p-1 pe-2 rounded-1 text-white bg-success fs-10"><i class="ti ti-point-filled me-1 fs-11"></i>Active</span></td>
                                    <td class="d-flex">
                                        <div class="edit-delete-action d-flex align-items-center">
                                            <a class="me-2 p-2 d-flex align-items-center border rounded" href="#">
                                                <i data-feather="eye" class="feather-eye"></i>
                                            </a>
                                            <a class="me-2 p-2 d-flex align-items-center border rounded" href="#" data-bs-toggle="modal" data-bs-target="#edit-biller">
                                                <i data-feather="edit" class="feather-edit"></i>
                                            </a>
                                            <a data-bs-toggle="modal" data-bs-target="#delete-modal" class="p-2 d-flex align-items-center border rounded" href="javascript:void(0);">
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
                                    <td>BI002</td>										
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="javascript:void(0);" class="avatar avatar-md me-2">
                                                <img src="assets/img/users/user-02.jpg" alt="product">
                                            </a>
                                            <a href="javascript:void(0);">Jenny Ellis</a>
                                        </div>
                                    </td>
                                    <td>BlueSky Logistics</td>
                                    <td>jenny@example.com</td>
                                    <td>+13197521863</td>
                                    <td>Germany</td>
                                    <td><span class="d-inline-flex align-items-center p-1 pe-2 rounded-1 text-white bg-success fs-10"><i class="ti ti-point-filled me-1 fs-11"></i>Active</span></td>
                                    <td class="d-flex">
                                        <div class="edit-delete-action d-flex align-items-center">
                                            <a class="me-2 p-2 d-flex align-items-center border rounded" href="#">
                                                <i data-feather="eye" class="feather-eye"></i>
                                            </a>
                                            <a class="me-2 p-2 d-flex align-items-center border rounded" href="#" data-bs-toggle="modal" data-bs-target="#edit-biller">
                                                <i data-feather="edit" class="feather-edit"></i>
                                            </a>
                                            <a data-bs-toggle="modal" data-bs-target="#delete-modal" class="p-2 d-flex align-items-center border rounded" href="javascript:void(0);">
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
                                    <td>BI003</td>										
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="javascript:void(0);" class="avatar avatar-md me-2">
                                                <img src="assets/img/users/user-43.png" alt="product">
                                            </a>
                                            <a href="javascript:void(0);">Leon Baxter</a>
                                        </div>
                                    </td>
                                    <td>EcoFarm Organics</td>
                                    <td>leon@example.com</td>
                                    <td>+18496275831</td>
                                    <td>Japan</td>
                                    <td><span class="d-inline-flex align-items-center p-1 pe-2 rounded-1 text-white bg-success fs-10"><i class="ti ti-point-filled me-1 fs-11"></i>Active</span></td>
                                    <td class="d-flex">
                                        <div class="edit-delete-action d-flex align-items-center">
                                            <a class="me-2 p-2 d-flex align-items-center border rounded" href="#">
                                                <i data-feather="eye" class="feather-eye"></i>
                                            </a>
                                            <a class="me-2 p-2 d-flex align-items-center border rounded" href="#" data-bs-toggle="modal" data-bs-target="#edit-biller">
                                                <i data-feather="edit" class="feather-edit"></i>
                                            </a>
                                            <a data-bs-toggle="modal" data-bs-target="#delete-modal" class="p-2 d-flex align-items-center border rounded" href="javascript:void(0);">
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
                                    <td>BI004</td>										
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="javascript:void(0);" class="avatar avatar-md me-2">
                                                <img src="assets/img/users/user-35.jpg" alt="product">
                                            </a>
                                            <a href="javascript:void(0);">Karen Flores</a>
                                        </div>
                                    </td>
                                    <td>SmartTech Solutions</td>
                                    <td>karen@example.com</td>
                                    <td>+18731498524</td>
                                    <td>Austria</td>
                                    <td><span class="d-inline-flex align-items-center p-1 pe-2 rounded-1 text-white bg-success fs-10"><i class="ti ti-point-filled me-1 fs-11"></i>Active</span></td>
                                    <td class="d-flex">
                                        <div class="edit-delete-action d-flex align-items-center">
                                            <a class="me-2 p-2 d-flex align-items-center border rounded" href="#">
                                                <i data-feather="eye" class="feather-eye"></i>
                                            </a>
                                            <a class="me-2 p-2 d-flex align-items-center border rounded" href="#" data-bs-toggle="modal" data-bs-target="#edit-biller">
                                                <i data-feather="edit" class="feather-edit"></i>
                                            </a>
                                            <a data-bs-toggle="modal" data-bs-target="#delete-modal" class="p-2 d-flex align-items-center border rounded" href="javascript:void(0);">
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
                                    <td>BI005</td>										
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="javascript:void(0);" class="avatar avatar-md me-2">
                                                <img src="assets/img/users/user-44.png" alt="product">
                                            </a>
                                            <a href="javascript:void(0);">Michael Dawson</a>
                                        </div>
                                    </td>
                                    <td>Fresh Supplies</td>
                                    <td>michael@example.com</td>
                                    <td>+12876928738</td>
                                    <td>Turkey</td>
                                    <td><span class="d-inline-flex align-items-center p-1 pe-2 rounded-1 text-white bg-success fs-10"><i class="ti ti-point-filled me-1 fs-11"></i>Active</span></td>
                                    <td class="d-flex">
                                        <div class="edit-delete-action d-flex align-items-center">
                                            <a class="me-2 p-2 d-flex align-items-center border rounded" href="#">
                                                <i data-feather="eye" class="feather-eye"></i>
                                            </a>
                                            <a class="me-2 p-2 d-flex align-items-center border rounded" href="#" data-bs-toggle="modal" data-bs-target="#edit-biller">
                                                <i data-feather="edit" class="feather-edit"></i>
                                            </a>
                                            <a data-bs-toggle="modal" data-bs-target="#delete-modal" class="p-2 d-flex align-items-center border rounded" href="javascript:void(0);">
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
                                    <td>BI006</td>										
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="javascript:void(0);" class="avatar avatar-md me-2">
                                                <img src="assets/img/users/user-37.jpg" alt="product">
                                            </a>
                                            <a href="javascript:void(0);">Karen Galvan</a>
                                        </div>
                                    </td>
                                    <td>BrightSource Lighting</td>
                                    <td>karen@example.com</td>
                                    <td>+17534896148</td>
                                    <td>Mexico</td>
                                    <td><span class="d-inline-flex align-items-center p-1 pe-2 rounded-1 text-white bg-success fs-10"><i class="ti ti-point-filled me-1 fs-11"></i>Active</span></td>
                                    <td class="d-flex">
                                        <div class="edit-delete-action d-flex align-items-center">
                                            <a class="me-2 p-2 d-flex align-items-center border rounded" href="#">
                                                <i data-feather="eye" class="feather-eye"></i>
                                            </a>
                                            <a class="me-2 p-2 d-flex align-items-center border rounded" href="#" data-bs-toggle="modal" data-bs-target="#edit-biller">
                                                <i data-feather="edit" class="feather-edit"></i>
                                            </a>
                                            <a data-bs-toggle="modal" data-bs-target="#delete-modal" class="p-2 d-flex align-items-center border rounded" href="javascript:void(0);">
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
                                    <td>BI007</td>										
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="javascript:void(0);" class="avatar avatar-md me-2">
                                                <img src="assets/img/users/user-44.png" alt="product">
                                            </a>
                                            <a href="javascript:void(0);">Thomas Ward</a>
                                        </div>
                                    </td>
                                    <td>GlobalTech Industries</td>
                                    <td>thomas@example.com</td>
                                    <td>+16482479624</td>
                                    <td>France</td>
                                    <td><span class="d-inline-flex align-items-center p-1 pe-2 rounded-1 text-white bg-success fs-10"><i class="ti ti-point-filled me-1 fs-11"></i>Active</span></td>
                                    <td class="d-flex">
                                        <div class="edit-delete-action d-flex align-items-center">
                                            <a class="me-2 p-2 d-flex align-items-center border rounded" href="#">
                                                <i data-feather="eye" class="feather-eye"></i>
                                            </a>
                                            <a class="me-2 p-2 d-flex align-items-center border rounded" href="#" data-bs-toggle="modal" data-bs-target="#edit-biller">
                                                <i data-feather="edit" class="feather-edit"></i>
                                            </a>
                                            <a data-bs-toggle="modal" data-bs-target="#delete-modal" class="p-2 d-flex align-items-center border rounded" href="javascript:void(0);">
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
                                    <td>BI008</td>										
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="javascript:void(0);" class="avatar avatar-md me-2">
                                                <img src="assets/img/users/user-38.jpg" alt="product">
                                            </a>
                                            <a href="javascript:void(0);">Aliza Duncan</a>
                                        </div>
                                    </td>
                                    <td>HealthWell Pharma</td>
                                    <td>aliza@example.com</td>
                                    <td>+13175964827</td>
                                    <td>Greece</td>
                                    <td><span class="d-inline-flex align-items-center p-1 pe-2 rounded-1 text-white bg-success fs-10"><i class="ti ti-point-filled me-1 fs-11"></i>Active</span></td>
                                    <td class="d-flex">
                                        <div class="edit-delete-action d-flex align-items-center">
                                            <a class="me-2 p-2 d-flex align-items-center border rounded" href="#">
                                                <i data-feather="eye" class="feather-eye"></i>
                                            </a>
                                            <a class="me-2 p-2 d-flex align-items-center border rounded" href="#" data-bs-toggle="modal" data-bs-target="#edit-biller">
                                                <i data-feather="edit" class="feather-edit"></i>
                                            </a>
                                            <a data-bs-toggle="modal" data-bs-target="#delete-modal" class="p-2 d-flex align-items-center border rounded" href="javascript:void(0);">
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
                                    <td>BI009</td>										
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="javascript:void(0);" class="avatar avatar-md me-2">
                                                <img src="assets/img/users/user-45.png" alt="product">
                                            </a>
                                            <a href="javascript:void(0);">James Higham</a>
                                        </div>
                                    </td>
                                    <td>HomeStyle Furnishings</td>
                                    <td>james@example.com</td>
                                    <td>+13875196482</td>
                                    <td>Italy</td>
                                    <td><span class="d-inline-flex align-items-center p-1 pe-2 rounded-1 text-white bg-success fs-10"><i class="ti ti-point-filled me-1 fs-11"></i>Active</span></td>
                                    <td class="d-flex">
                                        <div class="edit-delete-action d-flex align-items-center">
                                            <a class="me-2 p-2 d-flex align-items-center border rounded" href="#">
                                                <i data-feather="eye" class="feather-eye"></i>
                                            </a>
                                            <a class="me-2 p-2 d-flex align-items-center border rounded" href="#" data-bs-toggle="modal" data-bs-target="#edit-biller">
                                                <i data-feather="edit" class="feather-edit"></i>
                                            </a>
                                            <a data-bs-toggle="modal" data-bs-target="#delete-modal" class="p-2 d-flex align-items-center border rounded" href="javascript:void(0);">
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
                                    <td>BI010</td>										
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="javascript:void(0);" class="avatar avatar-md me-2">
                                                <img src="assets/img/users/user-40.jpg" alt="product">
                                            </a>
                                            <a href="javascript:void(0);">Jada Robinson</a>
                                        </div>
                                    </td>
                                    <td>EcoLogistics Partners</td>
                                    <td>robinson@example.com</td>
                                    <td>+17586143284</td>
                                    <td>China</td>
                                    <td><span class="d-inline-flex align-items-center p-1 pe-2 rounded-1 text-white bg-success fs-10"><i class="ti ti-point-filled me-1 fs-11"></i>Active</span></td>
                                    <td class="d-flex">
                                        <div class="edit-delete-action d-flex align-items-center">
                                            <a class="me-2 p-2 d-flex align-items-center border rounded" href="#">
                                                <i data-feather="eye" class="feather-eye"></i>
                                            </a>
                                            <a class="me-2 p-2 d-flex align-items-center border rounded" href="#" data-bs-toggle="modal" data-bs-target="#edit-biller">
                                                <i data-feather="edit" class="feather-edit"></i>
                                            </a>
                                            <a data-bs-toggle="modal" data-bs-target="#delete-modal" class="p-2 d-flex align-items-center border rounded" href="javascript:void(0);">
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