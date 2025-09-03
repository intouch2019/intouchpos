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
                        <h4>Blog Categories</h4>
                        <h6>Manage your blogs</h6>
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
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_blog-category"><i class="ti ti-circle-plus me-1"></i>Add Categories</a>
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
                                Sort By : Recently Added
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
                                    <th>Category</th>
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
                                    <td class="text-dark">Evlovution</td>
                                    <td>12 Sep 2024</td>
                                    
                                    <td><span class="badge badge-success"><i class="ti ti-point-filled"></i>Active</span></td>
                                    <td>
                                        <div class="action-icon d-inline-flex">
                                        <a href="#" class="p-2 d-flex align-items-center border rounded me-2" data-bs-toggle="modal" data-bs-target="#edit_blog-category"><i class="ti ti-edit"></i></a>
                                            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete_modal" class="p-2 d-flex align-items-center border rounded"><i class="ti ti-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-md">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td class="text-dark">Guide</td>
                                    <td>24 Oct 2024</td>
                                    
                                    <td><span class="badge badge-success"><i class="ti ti-point-filled"></i>Active</span></td>
                                    <td>
                                        <div class="action-icon d-inline-flex">
                                        <a href="#" class="p-2 d-flex align-items-center border rounded me-2" data-bs-toggle="modal" data-bs-target="#edit_blog-category"><i class="ti ti-edit"></i></a>
                                            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete_modal" class="p-2 d-flex align-items-center border rounded"><i class="ti ti-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-md">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td class="text-dark">Security</td>
                                    <td>18 Feb 2024</td>
                                    
                                    <td><span class="badge badge-success"><i class="ti ti-point-filled"></i>Active</span></td>
                                    <td>
                                        <div class="action-icon d-inline-flex">
                                        <a href="#" class="p-2 d-flex align-items-center border rounded me-2" data-bs-toggle="modal" data-bs-target="#edit_blog-category"><i class="ti ti-edit"></i></a>
                                            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete_modal" class="p-2 d-flex align-items-center border rounded"><i class="ti ti-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-md">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td class="text-dark">Recruitment</td>
                                    <td>17 Oct 2024</td>
                                    
                                    <td><span class="badge badge-success"><i class="ti ti-point-filled"></i>Active</span></td>
                                    <td>
                                        <div class="action-icon d-inline-flex">
                                        <a href="#" class="p-2 d-flex align-items-center border rounded me-2" data-bs-toggle="modal" data-bs-target="#edit_blog-category"><i class="ti ti-edit"></i></a>
                                            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete_modal" class="p-2 d-flex align-items-center border rounded"><i class="ti ti-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-md">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td class="text-dark">Payroll</td>
                                    <td>20 Jul 2024</td>
                                    
                                    <td><span class="badge badge-success"><i class="ti ti-point-filled"></i>Active</span></td>
                                    <td>
                                        <div class="action-icon d-inline-flex">
                                        <a href="#" class="p-2 d-flex align-items-center border rounded me-2" data-bs-toggle="modal" data-bs-target="#edit_blog-category"><i class="ti ti-edit"></i></a>
                                            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete_modal" class="p-2 d-flex align-items-center border rounded"><i class="ti ti-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-md">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td class="text-dark">Benefits</td>
                                    <td>10 Apr 2024</td>
                                    
                                    <td><span class="badge badge-success"><i class="ti ti-point-filled"></i>Active</span></td>
                                    <td>
                                        <div class="action-icon d-inline-flex">
                                        <a href="#" class="p-2 d-flex align-items-center border rounded me-2" data-bs-toggle="modal" data-bs-target="#edit_blog-category"><i class="ti ti-edit"></i></a>
                                            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete_modal" class="p-2 d-flex align-items-center border rounded"><i class="ti ti-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-md">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td class="text-dark">Employee</td>
                                    <td>29 Aug 2024</td>
                                    
                                    <td><span class="badge badge-success"><i class="ti ti-point-filled"></i>Active</span></td>
                                    <td>
                                        <div class="action-icon d-inline-flex">
                                        <a href="#" class="p-2 d-flex align-items-center border rounded me-2" data-bs-toggle="modal" data-bs-target="#edit_blog-category"><i class="ti ti-edit"></i></a>
                                            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete_modal" class="p-2 d-flex align-items-center border rounded"><i class="ti ti-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-md">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td class="text-dark">Onboarding</td>
                                    <td>22 Feb 2024</td>
                                    
                                    <td><span class="badge badge-success"><i class="ti ti-point-filled"></i>Active</span></td>
                                    <td>
                                        <div class="action-icon d-inline-flex">
                                        <a href="#" class="p-2 d-flex align-items-center border rounded me-2" data-bs-toggle="modal" data-bs-target="#edit_blog-category"><i class="ti ti-edit"></i></a>
                                            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete_modal" class="p-2 d-flex align-items-center border rounded"><i class="ti ti-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-md">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td class="text-dark">Implementation</td>
                                    <td>03 Nov 2024</td>
                                    
                                    <td><span class="badge badge-success"><i class="ti ti-point-filled"></i>Active</span></td>
                                    <td>
                                        <div class="action-icon d-inline-flex">
                                        <a href="#" class="p-2 d-flex align-items-center border rounded me-2" data-bs-toggle="modal" data-bs-target="#edit_blog-category"><i class="ti ti-edit"></i></a>
                                            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete_modal" class="p-2 d-flex align-items-center border rounded"><i class="ti ti-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-md">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td class="text-dark">Management</td>
                                    <td>17 Dec 2024</td>
                                    
                                    <td><span class="badge badge-success"><i class="ti ti-point-filled"></i>Active</span></td>
                                    <td>
                                        <div class="action-icon d-inline-flex">
                                        <a href="#" class="p-2 d-flex align-items-center border rounded me-2" data-bs-toggle="modal" data-bs-target="#edit_blog-category"><i class="ti ti-edit"></i></a>
                                            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete_modal" class="p-2 d-flex align-items-center border rounded"><i class="ti ti-trash"></i></a>
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