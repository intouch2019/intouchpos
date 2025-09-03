<?php ob_start();?>

    <!-- ========================
        Start Page Content
    ========================= -->

    <div class="account-content">
        <div class="login-wrapper login-new">
            <div class="row w-100">
                <div class="col-lg-5 mx-auto">
                    <div class="login-content user-login">
                        <div class="login-logo">
                            <img src="assets/img/logo.svg" alt="img">
                            <a href="index.php" class="login-logo logo-white">
                                <img src="assets/img/logo-white.svg"  alt="Img">
                            </a>
                        </div>
                        <form action="success-3.php">
                            <div class="card">
                                <div class="card-body p-5">
                                    <div class="login-userheading">
                                        <h3>Reset password?</h3>
                                        <h4>Enter New Password & Confirm Password to get inside</h4>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Old Password <span class="text-danger"> *</span></label>
                                        <div class="pass-group">
                                            <input type="password" class="pass-input form-control">
                                            <span class="ti toggle-password ti-eye-off text-gray-9"></span>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">New Password <span class="text-danger"> *</span></label>
                                        <div class="pass-group">
                                            <input type="password" class="pass-inputs form-control">
                                            <span class="ti toggle-passwords ti-eye-off text-gray-9"></span>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Confirm Password <span class="text-danger"> *</span></label>
                                        <div class="pass-group">
                                            <input type="password" class="pass-inputa form-control">
                                            <span class="ti toggle-passworda ti-eye-off text-gray-9"></span>
                                        </div>
                                    </div>
                                    <div class="form-login">
                                        <button type="submit" class="btn btn-login">Change Password</button>
                                    </div>
                                    <div class="signinform text-center mb-0">
                                        <h4>Return to <a href="signin-3.php" class="hover-a"> login </a></h4>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="my-4 d-flex justify-content-center align-items-center copyright-text">
                <p>Copyright &copy; 2025 DreamsPOS</p>
            </div>
        </div>
    </div>

    <!-- ========================
        End Page Content
    ========================= -->

<?php
$content = ob_get_clean();

require_once '../partials/main.php'; ?>      