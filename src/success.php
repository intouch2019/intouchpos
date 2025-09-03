<?php ob_start();?>

    <!-- ========================
        Start Page Content
    ========================= -->

    <div class="account-content">
        <div class="login-wrapper register-wrap bg-img">
            <div class="login-content authent-content">
                <div class="login-userset">
                    <div class="login-userset">
                        <div class="login-logo logo-normal">
                            <img src="assets/img/logo.svg" alt="img">
                        </div>
                    </div>    
                    <a href="index.php" class="login-logo logo-white">
                        <img src="assets/img/logo-white.svg"  alt="Img">
                    </a>
                    <div class="login-userheading text-center">
                        <img src="assets/img/icons/check-icon.svg" alt="Icon">
                        <h3 class="text-center">Success</h3>
                        <h4 class="verfy-mail-content text-center">Your Passwrod Reset Successfully!</h4>
                    </div>
                    <div class="form-login">
                        <a class="btn btn-login mt-0" href="signin.php">Back to Login</a>
                    </div>
                    <div class="my-4 d-flex justify-content-center align-items-center copyright-text">
                        <p>Copyright &copy; 2025 DreamsPOS</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ========================
        End Page Content
    ========================= -->

<?php
$content = ob_get_clean();

require_once '../partials/main.php'; ?>      