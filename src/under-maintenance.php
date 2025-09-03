<?php ob_start();?>

    <!-- ========================
        Start Page Content
    ========================= -->

    <div class="error-box">
        <div class="error-img">
            <img src="assets/img/authentication/under-maintenance.png" class="img-fluid" alt="Img">
        </div>
        <h3 class="h2 mb-3">We are Under Maintenance</h3>
        <p>Sorry for any inconvenience caused, we have almost done 
            Will get back soon!</p>
        <a href="index.php" class="btn btn-primary">Back to Dashboard</a>
    </div>

    <!-- ========================
        End Page Content
    ========================= -->

<?php
$content = ob_get_clean();

require_once '../partials/main.php'; ?>      