<?php ob_start();?>

    <!-- ========================
        Start Page Content
    ========================= -->

    <div class="error-box">
        <div class="error-img">
            <img src="assets/img/authentication/error-404.png" class="img-fluid" alt="Img">
        </div>
        <h3 class="h2 mb-3">Oops, something went wrong</h3>
        <p>Error 404 Page not found. Sorry the page you looking for
            doesn’t exist or has been moved</p>
        <a href="index.php" class="btn btn-primary">Back to Dashboard</a>
    </div>

    <!-- ========================
        End Page Content
    ========================= -->

<?php
$content = ob_get_clean();

require_once '../partials/main.php'; ?>      