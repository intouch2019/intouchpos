<?php require_once __DIR__ . '/session.php';?>

<!DOCTYPE html>
<?php require_once __DIR__ . '/theme-settings.php';?>

<head>

    <?php require_once __DIR__ . '/title-meta.php';?>

    <?php require_once __DIR__ . '/head-css.php';?>

</head>

<?php require_once __DIR__ . '/body.php';?>

    <?php require_once __DIR__ . '/loader.php';?>

    <!-- Start Main Wrapper -->
    <?php require_once __DIR__ . '/main-wrapper.php';?>

        <?php require_once __DIR__ . '/menu.php';?>
        
        <?= $content ?>

        <?php include_once __DIR__ . '/modal-popup.php'; ?>

    </div>
    <!-- End Main Wrapper -->

    <?php require_once __DIR__ . '/vendor-scripts.php'; ?>

</body>
</html>
