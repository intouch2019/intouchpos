<?php
$link = $_SERVER[ 'PHP_SELF' ];
$link_array = explode( '/', $link );
$page = end( $link_array );
?>

	<!-- Favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

	<!-- Apple Touch Icon -->
	<link rel="apple-touch-icon" sizes="180x180" href="assets/img/apple-touch-icon.png">

<?php  if ($page !== 'signin.php' && $page !== 'signin-2.php' && $page !== 'signin-3.php' && $page !== 'register.php' && $page !== 'register-2.php' && $page !== 'register-3.php' && $page !== 'forgot-password.php' && $page !== 'forgot-password-2.php' && $page !== 'forgot-password-3.php'  && $page !== 'reset-password.php' && $page !== 'reset-password-2.php' && $page !== 'reset-password-3.php' && $page !== 'email-verification.php' && $page !== 'email-verification-2.php' && $page !== 'email-verification-3.php'
 && $page !== 'two-step-verification.php' && $page !== 'two-step-verification-2.php' && $page !== 'two-step-verification-3.php' && $page !== 'lock-screen.php' && $page !== 'error-404.php' && $page !== 'error-500.php' && $page !=='coming-soon.php' && $page !=='under-maintenance.php' && $page !=='layout-horizontal.php' && $page !=='layout-detached.php' && $page !=='layout-modern.php' && $page !=='layout-two-column.php' && $page !=='layout-hovered.php' && $page !=='layout-boxed.php' && $page !=='layout-dark.php' && $page !=='layout-rtl.php' && $page !== 'success.php' && $page !== 'success-2.php' && $page !== 'success-3.php') {   ?>
    <!-- Theme Script JS -->
    <script src="assets/js/theme-script.js"></script>
<?php }?>

<?php if ($page !== 'layout-rtl.php'){?>
    <!-- Bootstrap CSS -->
    <link rel = 'stylesheet' href ='assets/css/bootstrap.min.css'>
<?php }?> 

<?php if ($page === 'layout-rtl.php'){?>
    <!-- Bootstrap RTL CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.rtl.min.css">
<?php }?>  

<?php if($page !== 'signin.php' && $page !== 'signin-2.php' && $page !== 'signin-3.php' && $page !== 'register.php' && $page !== 'register-2.php' && $page !== 'register-3.php' && $page !== 'forgot-password.php' && $page !== 'forgot-password-2.php' && $page !== 'forgot-password-3.php'  && $page !== 'reset-password.php' && $page !== 'reset-password-2.php' && $page !== 'reset-password-3.php' && $page !== 'email-verification.php' && $page !== 'email-verification-2.php' && $page !== 'email-verification-3.php'
 && $page !== 'two-step-verification.php' && $page !== 'two-step-verification-2.php' && $page !== 'two-step-verification-3.php' && $page !== 'lock-screen.php' && $page !== 'error-404.php' && $page !== 'error-500.php' && $page !=='coming-soon.php' && $page !=='under-maintenance.php' && $page !== 'success.php' && $page !== 'success-2.php' && $page !== 'success-3.php' ) {?> 
    <!-- animation CSS -->
    <link rel = 'stylesheet' href='assets/css/animate.css'>
<?php }?> 

    <!-- Fontawesome CSS -->
    <link rel = 'stylesheet' href = 'assets/plugins/fontawesome/css/fontawesome.min.css'>
    <link rel = 'stylesheet' href = 'assets/plugins/fontawesome/css/all.min.css'>

<?php  if ($page === 'add-product.php' || $page === 'audio-call.php' || $page === 'edit-product.php' || $page === 'domain.php' || $page === 'form-vertical.php' || $page === 'packages.php' || $page === 'product-list.php' || $page === 'purchase-transaction.php' || $page === 'reviews.php' || $page === 'subscription.php' || $page === 'tables-basic.php' || $page === 'ui-alerts.php' || $page === 'ui-nav-tabs.php' || $page === 'video-call.php'){?>
    <!-- Feathericon CSS -->
    <link rel="stylesheet" href="assets/css/feather.css">
<?php }?>  

<?php  if ($page === 'icon-feather.php' || $page === 'icon-ionic.php'){?>
<!-- Feathericon CSS -->
    <link rel="stylesheet" href="assets/plugins/icons/feather/feather.css">
<?php }?>

<?php if($page !== 'signin.php' && $page !== 'signin-2.php' && $page !== 'signin-3.php' && $page !== 'register.php' && $page !== 'register-2.php' && $page !== 'register-3.php' && $page !== 'forgot-password.php' && $page !== 'forgot-password-2.php' && $page !== 'forgot-password-3.php'  && $page !== 'reset-password.php' && $page !== 'reset-password-2.php' && $page !== 'reset-password-3.php' && $page !== 'email-verification.php' && $page !== 'email-verification-2.php' && $page !== 'email-verification-3.php'
 && $page !== 'two-step-verification.php' && $page !== 'two-step-verification-2.php' && $page !== 'two-step-verification-3.php' && $page !== 'lock-screen.php' && $page !== 'error-404.php' && $page !== 'error-500.php' && $page !=='coming-soon.php' && $page !=='under-maintenance.php' && $page !== 'success.php' && $page !== 'success-2.php' && $page !== 'success-3.php' ) {?> 
    <!-- Datatable CSS -->
    <link rel = 'stylesheet' href='assets/css/dataTables.bootstrap5.min.css'>

    <!-- Quill CSS -->
    <link rel="stylesheet" href="assets/plugins/quill/quill.snow.css">
<?php }?>

<?php  if ($page === 'icon-tabler.php' || $page === 'projects.php'){?>    
    <!-- Tabler Icon CSS -->
    <link rel="stylesheet" href="assets/plugins/icons/tabler-icons/tabler-icons.css">
<?php }?>

    <!-- Tabler Icon CSS -->
    <link rel="stylesheet" href="assets/plugins/tabler-icons/tabler-icons.min.css">
         
<?php if($page !== 'signin.php' && $page !== 'signin-2.php' && $page !== 'signin-3.php' && $page !== 'register.php' && $page !== 'register-2.php' && $page !== 'register-3.php' && $page !== 'forgot-password.php' && $page !== 'forgot-password-2.php' && $page !== 'forgot-password-3.php'  && $page !== 'reset-password.php' && $page !== 'reset-password-2.php' && $page !== 'reset-password-3.php' && $page !== 'email-verification.php' && $page !== 'email-verification-2.php' && $page !== 'email-verification-3.php'
 && $page !== 'two-step-verification.php' && $page !== 'two-step-verification-2.php' && $page !== 'two-step-verification-3.php' && $page !== 'lock-screen.php' && $page !== 'error-404.php' && $page !== 'error-500.php' && $page !=='coming-soon.php' && $page !=='under-maintenance.php' && $page !== 'success.php' && $page !== 'success-2.php' && $page !== 'success-3.php' ) {?> 
    <!-- Datetimepicker CSS -->
    <link rel = 'stylesheet' href = 'assets/css/bootstrap-datetimepicker.min.css'>
<?php }?>

<?php  if ( $page === 'audio-call.php' || $page === 'pos.php' || $page === 'pos-2.php' || $page === 'pos-3.php' || $page === 'pos-4.php' || $page === 'pos-5.php' || $page === 'product-details.php' || $page === 'video-call.php' ){?>
    <link rel = 'stylesheet' href = 'assets/plugins/owlcarousel/owl.carousel.min.css'>
    <link rel = 'stylesheet' href = 'assets/plugins/owlcarousel/owl.theme.default.min.css'>
<?php }?>  

<?php  if ($page === 'barcode.php' || $page === 'file-manager.php' || $page === 'notes.php' || $page === 'plugin.php' || $page === 'qrcode.php' || $page === 'social-feed.php' || $page === 'todo-list.php' || $page === 'todo.php'){?>
    <!-- Owl Carousel CSS -->
    <link rel = "stylesheet" href="assets/css/owl.carousel.min.css">
<?php }?>  

<?php  if ( $page === 'file-manager.php' ) {?>
    <!-- Player CSS -->
    <link rel="stylesheet" href="assets/css/plyr.css">
<?php }?>

<?php if($page !== 'signin.php' && $page !== 'signin-2.php' && $page !== 'signin-3.php' && $page !== 'register.php' && $page !== 'register-2.php' && $page !== 'register-3.php' && $page !== 'forgot-password.php' && $page !== 'forgot-password-2.php' && $page !== 'forgot-password-3.php'  && $page !== 'reset-password.php' && $page !== 'reset-password-2.php' && $page !== 'reset-password-3.php' && $page !== 'email-verification.php' && $page !== 'email-verification-2.php' && $page !== 'email-verification-3.php'
 && $page !== 'two-step-verification.php' && $page !== 'two-step-verification-2.php' && $page !== 'two-step-verification-3.php' && $page !== 'lock-screen.php' && $page !== 'error-404.php' && $page !== 'error-500.php' && $page !=='coming-soon.php' && $page !=='under-maintenance.php' && $page !== 'success.php' && $page !== 'success-2.php' && $page !== 'success-3.php' ) {?> 
    <!-- Select2 CSS -->
    <link rel = 'stylesheet' href='assets/plugins/select2/css/select2.min.css'>
<?php }?>

<?php  if ( $page === 'icon-flag.php' ) {?>
    <!-- Flag Icon CSS -->
    <link rel="stylesheet" href="assets/plugins/icons/flags/flags.css">
<?php }?>

<?php  if ( $page === 'icon-ionic.php' ) {?>
	<!-- Ionic CSS -->
    <link rel="stylesheet" href="assets/plugins/icons/ionic/ionicons.css">
<?php }?>    

<?php  if ( $page === 'icon-material.php' ) {?>
    <!-- Material CSS -->
    <link rel="stylesheet" href="assets/plugins/material/materialdesignicons.css">
<?php }?> 

<?php  if ( $page === 'icon-pe7.php' ) {?>
    <!-- Pe7 CSS -->
    <link rel="stylesheet" href="assets/plugins/icons/pe7/pe-icon-7.css">       
<?php }?> 

<?php  if ( $page === 'icon-simpleline.php' ) {?>
    <!-- Simpleline Icons CSS -->
    <link rel="stylesheet" href="assets/plugins/simpleline/simple-line-icons.css">
<?php }?>   

<?php  if ( $page === 'icon-themify.php' ) {?>
    <!-- Themify Icon CSS -->
    <link rel="stylesheet" href="assets/plugins/icons/themify/themify.css">
<?php }?> 

<?php  if ( $page === 'icon-typicon.php' ) {?>
    <!-- Typicon icons CSS -->
    <link rel="stylesheet" href="assets/plugins/icons/typicons/typicons.css">
<?php }?> 

<?php  if ( $page === 'icon-weather.php' ) {?>
    <!-- Weather CSS -->
    <link rel="stylesheet" href="assets/plugins/icons/weather/weathericons.css">
<?php }?>   

<?php  if ( $page === 'form-wizard.php' ) {?>
    <!-- Wizard CSS -->
    <link rel="stylesheet" href="assets/plugins/twitter-bootstrap-wizard/form-wizard.css">
<?php }?>

<?php  if ($page === 'audio-call.php' ||$page === 'call-history.php' || $page === 'chat.php' || $page === 'video-call.php') {?>
    <!-- Boxicons CSS -->
    <link rel = 'stylesheet' href='assets/plugins/boxicons/css/boxicons.min.css'>
<?php }?>

<?php  if ($page === 'billers.php' ||$page === 'blog-comments.php' || $page === 'chat.php' || $page === 'contacts.php' || $page === 'customers.php' || $page === 'expired-products.php' || $page === 'security-settings.php' || $page === 'warehouse.php') {?>
    <!-- Mobile CSS-->
    <link rel="stylesheet" href="assets/plugins/intltelinput/css/intlTelInput.css">
    <link rel="stylesheet" href="assets/plugins/intltelinput/css/demo.css">
<?php }?>

<?php  if ($page === 'add-product.php' ||$page === 'all-blog.php' ||$page === 'blog-tag.php' || $page === 'domain.php' || $page === 'edit-product.php' || $page === 'email-reply.php' || $page === 'localization-settings.php' || $page === 'otp-settings.php' || $page === 'packages.php' || $page === 'product-list.php' || $page === 'purchase-transaction.php' || $page === 'reviews.php' || $page === 'subscription.php' || $page === 'varriant-attributes.php') {?>
    <!-- Bootstrap Tagsinput CSS -->
    <link rel="stylesheet" href="assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css">
<?php }?>

<?php  if ( $page === 'dashboard.php' || $page === 'sales-dashboard.php') {?>
    <!-- Map CSS -->
    <link rel="stylesheet" href="assets/plugins/jvectormap/jquery-jvectormap-2.0.5.css">
<?php }?>

<?php  if ($page === 'all-blog.php' || $page === 'blog-categories.php' || $page === 'blog-tag.php' ||$page === 'best-seller.php' || $page === 'calendar.php' || $page === 'companies.php' ||$page === 'customer-due-report.php' || $page === 'customer-report.php' || $page === 'dashboard.php' || $page === 'expense-report.php' || $page === 'form-pickers.php' || $page === 'income-report.php' || $page === 'income.php' || $page === 'index.php' || $page === 'inventory-report.php' || $page === 'invoice-report.php' || $page === 'layout-boxed.php' || $page === 'layout-dark.php' || $page === 'layout-detached.php' || $page === 'layout-rtl.php' || $page === 'layout-horizontal.php' || $page === 'layout-two-column.php' || $page === 'layout-hovered.php' || $page === 'notes.php' || $page === 'pos.php' || $page === 'pos-2.php' || $page === 'pos-3.php' || $page === 'pos-4.php' || $page === 'pos-5.php' || $page === 'product-expiry-report.php' || $page === 'product-quantity-alert.php' || $page === 'product-report.php' || $page === 'profit-and-loss.php' || $page === 'projects.php' || $page === 'purchase-report.php' || $page === 'sales-dashboard.php' || $page === 'sales-report.php' || $page === 'sales-tax.php' || $page === 'search-list.php' || $page === 'sold-stock.php' || $page === 'stock-history.php' || $page === 'supplier-due-report.php' || $page === 'supplier-report.php' || $page === 'tax-reports.php' || $page === 'todo-list.php' || $page === 'todo.php') {?>
    <!-- Daterangepikcer CSS -->
    <link rel="stylesheet" href="assets/plugins/daterangepicker/daterangepicker.css">
<?php }?>

<?php  if ( $page === 'ui-rangeslider.php' || $page === 'ui-ratings.php') {?>
    <!-- Rangeslider CSS -->
    <link rel="stylesheet" href="assets/plugins/ion-rangeslider/css/ion.rangeSlider.min.css">
<?php }?>

<?php  if ( $page === 'ui-drag-drop.php' || $page === 'ui-clipboard.php' || $page === 'ui-sortable.php') {?>
    <!-- Dragula CSS -->
    <link rel="stylesheet" href="assets/plugins/dragula/css/dragula.min.css">
<?php }?>

<?php if($page === 'ui-swiperjs.php' || $page === 'chat.php' || $page === 'video-call.php' ) {?>
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="assets/plugins/swiper/swiper-bundle.min.css">
<?php }?>

<?php  if ( $page === 'ui-stickynote.php' || $page === 'ui-timeline.php') {?>
    <!-- Sticky CSS -->
    <link rel="stylesheet" href="assets/plugins/stickynote/sticky.css">
<?php }?>

<?php  if ( $page === 'icon-bootstrap.php' ) {?>
    <!-- Bootstrap Icon CSS -->
    <link rel="stylesheet" href="assets/plugins/icons/bootstrap/bootstrap-icons.min.css">
<?php }?>

<?php  if ( $page === 'icon-remix.php' ) {?>
    <!-- Remix Icon CSS -->
    <link rel="stylesheet" href="assets/plugins/icons/remix/fonts/remixicon.css">
<?php }?>

<?php  if ( $page === 'form-pickers.php' ) {?>
    <!-- Form Date PIckers CSS -->
    <link rel="stylesheet" href="assets/plugins/flatpickr/flatpickr.css">
    <link rel="stylesheet" href="assets/plugins/bootstrap-datepicker/bootstrap-datepicker.css">
    <link rel="stylesheet" href="assets/plugins/jquery-timepicker/jquery-timepicker.css">
    <link rel="stylesheet" href="assets/plugins/pickr/pickr-themes.css">
<?php }?>

<?php  if ( $page === 'maps-vector.php' ) {?>
    <!-- Jsvector Maps -->
    <link rel="stylesheet" href="assets/plugins/jsvectormap/css/jsvectormap.min.css">
<?php }?>

<?php  if ( $page === 'maps-leaflet.php' ) {?>
    <!-- Leaflet Maps CSS -->
    <link rel="stylesheet" href="assets/plugins/leaflet/leaflet.css">
<?php }?>

<?php  if ( $page === 'chat.php' || $page === 'email-reply.php' || $page === 'social-feed.php' || $page === 'search-list.php') {?>
    <!-- Fancybox -->
    <link rel="stylesheet" href="assets/plugins/fancybox/jquery.fancybox.min.css">
<?php }?>

<?php if($page !== 'signin.php' && $page !== 'signin-2.php' && $page !== 'signin-3.php' && $page !== 'register.php' && $page !== 'register-2.php' && $page !== 'register-3.php' && $page !== 'forgot-password.php' && $page !== 'forgot-password-2.php' && $page !== 'forgot-password-3.php'  && $page !== 'reset-password.php' && $page !== 'reset-password-2.php' && $page !== 'reset-password-3.php' && $page !== 'email-verification.php' && $page !== 'email-verification-2.php' && $page !== 'email-verification-3.php'
 && $page !== 'two-step-verification.php' && $page !== 'two-step-verification-2.php' && $page !== 'two-step-verification-3.php' && $page !== 'lock-screen.php' && $page !== 'error-404.php' && $page !== 'error-500.php' && $page !=='coming-soon.php' && $page !=='under-maintenance.php' && $page !== 'success.php' && $page !== 'success-2.php' && $page !== 'success-3.php' ) {?>
    <!-- Color Picker Css -->
    <link rel="stylesheet" href="assets/plugins/@simonwep/pickr/themes/nano.min.css">
<?php }?>

    <!-- Main CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
	
