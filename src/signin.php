<?php 
ob_start();
require_once __DIR__ . '/../auth/auth_middleware.php';
redirectIfLoggedIn();
?>

    <!-- ========================
        Start Page Content
    ========================= -->

    <div class="account-content">
        <div class="login-wrapper bg-img">
            <div class="login-content authent-content">
                <form action="../auth/login_handler.php" method="POST">
                    <div class="login-userset">
                        <div class="login-logo logo-normal">
                            <img src="assets/img/logo.svg" alt="img">
                        </div>
                        <a href="index.php" class="login-logo logo-white">
                            <img src="assets/img/logo-white.svg"  alt="Img">
                        </a>
                        <div class="login-userheading">
                            <h3>Sign In</h3>
                            <h4 class="fs-16">Access the Dreamspos panel using your email and passcode.</h4>
                        </div>
                        
                        <?php if (isset($_SESSION['login_error'])): ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $_SESSION['login_error']; ?>
                                <?php unset($_SESSION['login_error']); ?>
                            </div>
                        <?php endif; ?>
                        
                        <div class="mb-3">
                            <label class="form-label">Email <span class="text-danger"> *</span></label>
                            <div class="input-group">
                                <input type="email" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" class="form-control border-end-0" required>
                                <span class="input-group-text border-start-0">
                                    <i class="ti ti-mail"></i>
                                </span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password <span class="text-danger"> *</span></label>
                            <div class="pass-group">
                                <input type="password" name="password" class="pass-input form-control" required>
                                <span class="ti toggle-password ti-eye-off text-gray-9"></span>
                            </div>
                        </div>
                        <div class="form-login authentication-check">
                            <div class="row">
                                <div class="col-12 d-flex align-items-center justify-content-between">
                                    <div class="custom-control custom-checkbox">
                                        <label class="checkboxs ps-4 mb-0 pb-0 line-height-1 fs-16 text-gray-6">
                                            <input type="checkbox" name="remember" class="form-control">
                                            <span class="checkmarks"></span>Remember me
                                        </label>
                                    </div>
                                    <div class="text-end">
                                        <a class="text-orange fs-16 fw-medium" href="forgot-password.php">Forgot Password?</a>
                                    </div>
                                </div>                                    
                            </div>
                        </div>
                        <div class="form-login">
                            <button type="submit" class="btn btn-primary w-100">Sign In</button>
                        </div>
                        <div class="signinform">
                            <h4>New on our platform?<a href="register.php" class="hover-a"> Create an account</a></h4>
                        </div>
                        <div class="form-setlogin or-text">
                            <h4>OR</h4>
                        </div>
                        <div class="mt-2">
                            <div class="d-flex align-items-center justify-content-center flex-wrap">
                                <div class="text-center me-2 flex-fill">
                                    <a href="javascript:void(0);"
                                        class="br-10 p-2 btn btn-info d-flex align-items-center justify-content-center">
                                        <img class="img-fluid m-1" src="assets/img/icons/facebook-logo.svg" alt="Facebook">
                                    </a>
                                </div>
                                <div class="text-center me-2 flex-fill">
                                    <a href="javascript:void(0);"
                                        class="btn btn-white br-10 p-2  border d-flex align-items-center justify-content-center">
                                        <img class="img-fluid m-1" src="assets/img/icons/google-logo.svg" alt="Facebook">
                                    </a>
                                </div>
                                <div class="text-center flex-fill">
                                    <a href="javascript:void(0);"
                                        class="bg-dark br-10 p-2 btn btn-dark d-flex align-items-center justify-content-center">
                                        <img class="img-fluid m-1" src="assets/img/icons/apple-logo.svg" alt="Apple">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="my-4 d-flex justify-content-center align-items-center copyright-text">
                        <p>Copyright &copy; 2025 DreamsPOS</p>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ========================
        End Page Content
    ========================= -->

<?php
$content = ob_get_clean();

require_once '../partials/main.php'; ?>      