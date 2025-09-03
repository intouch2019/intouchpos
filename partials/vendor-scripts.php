<?php
$link = $_SERVER[ 'PHP_SELF' ];
$link_array = explode( '/', $link );
$page = end( $link_array );
?>
    <!-- jQuery -->
    <script src = 'assets/js/jquery-3.7.1.min.js'></script>

    <!-- Feather Icon JS -->
    <script src = 'assets/js/feather.min.js'></script>

    <!-- Slimscroll JS -->
    <script src = 'assets/js/jquery.slimscroll.min.js'></script>

<?php if($page === 'chat.php') {?>    
    <!-- Slimscroll JS -->
    <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<?php }?>

<?php if($page !== 'signin.php' && $page !== 'signin-2.php' && $page !== 'signin-3.php' && $page !== 'register.php' && $page !== 'register-2.php' && $page !== 'register-3.php' && $page !== 'forgot-password.php' && $page !== 'forgot-password-2.php' && $page !== 'forgot-password-3.php'  && $page !== 'reset-password.php' && $page !== 'reset-password-2.php' && $page !== 'reset-password-3.php' && $page !== 'email-verification.php' && $page !== 'email-verification-2.php' && $page !== 'email-verification-3.php'
 && $page !== 'two-step-verification.php' && $page !== 'two-step-verification-2.php' && $page !== 'two-step-verification-3.php' && $page !== 'lock-screen.php' && $page !== 'error-404.php' && $page !== 'error-500.php' && $page !=='coming-soon.php' && $page !=='under-maintenance.php' && $page !== 'success.php' && $page !== 'success-2.php' && $page !== 'success-3.php' ) {?>   
    <!-- Datatable JS -->
    <script src = 'assets/js/jquery.dataTables.min.js'></script>
    <script src = 'assets/js/dataTables.bootstrap5.min.js'></script>

    <!-- Datetimepicker JS -->
    <script src = 'assets/js/moment.min.js'></script>
    <script src = 'assets/js/bootstrap-datetimepicker.min.js'></script>
<?php }?>

    <!-- Bootstrap Core JS -->
    <script src = 'assets/js/bootstrap.bundle.min.js'></script>

<?php if($page !== 'signin.php' && $page !== 'signin-2.php' && $page !== 'signin-3.php' && $page !== 'register.php' && $page !== 'register-2.php' && $page !== 'register-3.php' && $page !== 'forgot-password.php' && $page !== 'forgot-password-2.php' && $page !== 'forgot-password-3.php'  && $page !== 'reset-password.php' && $page !== 'reset-password-2.php' && $page !== 'reset-password-3.php' && $page !== 'email-verification.php' && $page !== 'email-verification-2.php' && $page !== 'email-verification-3.php'
 && $page !== 'two-step-verification.php' && $page !== 'two-step-verification-2.php' && $page !== 'two-step-verification-3.php' && $page !== 'lock-screen.php' && $page !== 'error-404.php' && $page !== 'error-500.php' && $page !=='coming-soon.php' && $page !=='under-maintenance.php' && $page !== 'success.php' && $page !== 'success-2.php' && $page !== 'success-3.php' ) {?>     
    <!-- Quill JS -->
    <script src="assets/plugins/quill/quill.min.js"></script>
<?php }?>   

<?php if($page === 'chart-c3.php') {?>
    <!-- Chart c3 JS -->
    <script src="assets/plugins/c3-chart/d3.v5.min.js"></script>
    <script src="assets/plugins/c3-chart/c3.min.js"></script>
    <script src="assets/plugins/c3-chart/chart-data.js"></script>
<?php }?>

<?php if($page === 'form-fileupload.php') {?>
    <!-- Fileupload JS -->
    <script src="assets/plugins/fileupload/fileupload.min.js"></script>
<?php }?>

<?php if($page === 'form-mask.php') {?>
    <!-- Mask JS -->
    <script src="assets/js/jquery.maskedinput.min.js"></script>
    <script src="assets/js/mask.js"></script>
<?php }?>

<?php if($page === 'chart-flot.php') {?>
    <!-- Chart flot JS -->
    <script src="assets/plugins/flot/jquery.flot.js"></script>
    <script src="assets/plugins/flot/jquery.flot.pie.js"></script>
    <script src="assets/plugins/flot/chart-data.js"></script>
<?php }?>

<?php if($page === 'chart-js.php' || $page === 'dashboard.php' || $page === 'index.php' || $page === 'layout-boxed.php' || $page === 'layout-dark.php' || $page === 'layout-detached.php' || $page === 'layout-horizontal.php' || $page === 'layout-hovered.php' || $page === 'layout-rtl.php' || $page === 'layout-two-column.php' || $page === 'subscription.php') {?>
    <!-- Chart JS -->
    <script src="assets/plugins/chartjs/chart.min.js"></script>
    <script src="assets/plugins/chartjs/chart-data.js"></script>
<?php }?>

<?php if($page === 'chart-morris.php') {?>
    <!-- Chart JS -->
    <script src="assets/plugins/morris/raphael-min.js"></script>
    <script src="assets/plugins/morris/morris.min.js"></script>
    <script src="assets/plugins/morris/chart-data.js"></script>
<?php }?>

<?php if($page === 'chart-peity.php' || $page === 'dashboard.php' || $page === 'subscription.php') {?>
    <!-- Chart JS -->
    <script src="assets/plugins/peity/jquery.peity.min.js"></script>
    <script src="assets/plugins/peity/chart-data.js"></script>
<?php }?>

<?php if($page === 'calendar.php') {?>
    <!-- Fullcalendar JS -->
    <script src="assets/plugins/fullcalendar/index.global.min.js"></script>
    <script src="assets/plugins/fullcalendar/calendar-data.js"></script>
<?php }?>

<?php  if ($page === 'add-product.php' ||$page === 'all-blog.php' ||$page === 'blog-tag.php' || $page === 'domain.php' || $page === 'edit-product.php' || $page === 'email-reply.php' || $page === 'localization-settings.php' || $page === 'otp-settings.php' || $page === 'packages.php' || $page === 'product-list.php' || $page === 'purchase-transaction.php' || $page === 'reviews.php' || $page === 'subscription.php' || $page === 'varriant-attributes.php') {?>
    <!-- Bootstrap Tagsinput JS -->
    <script src="assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
<?php }?>

<?php  if ($page === 'admin-dashboard.php' ||$page === 'barcode.php' ||$page === 'calendar.php' || $page === 'chart-apex.php' || $page === 'companies.php' || $page === 'email-reply.php' || $page === 'dashboard.php' || $page === 'email.php' || $page === 'file-manager.php' || $page === 'form-elements.php' || $page === 'icon-feather.php' || $page === 'icon-flag.php' || $page === 'icon-fontawesome.php' || $page === 'icon-ionic.php' || $page === 'icon-material.php' || $page === 'icon-pe7.php' || $page === 'icon-remix.php' || $page === 'icon-simpleline.php' || $page === 'icon-tabler.php' || $page === 'icon-themify.php' || $page === 'icon-typicon.php' || $page === 'icon-weather.php' || $page === 'index.php' || $page === 'layout-boxed.php' || $page === 'layout-dark.php' || $page === 'layout-detached.php' || $page === 'layout-horizontal.php' || $page === 'layout-hovered.php' || $page === 'layout-rtl.php' || $page === 'layout-two-column.php' || $page === 'notes.php' || $page === 'pos.php' || $page === 'pos-2.php' || $page === 'pos-3.php' || $page === 'pos-4.php' || $page === 'pos-5.php' || $page === 'qrcode.php' || $page === 'sales-dashboard.php' || $page === 'todo-list.php' || $page === 'todo.php') {?>
    <!-- Chart Apex JS -->
    <script src="assets/plugins/apexchart/apexcharts.min.js"></script>
    <script src="assets/plugins/apexchart/chart-data.js"></script>
<?php }?>

<?php if($page === 'sales-dashboard.php') {?>
    <!-- Map JS -->
    <script src="assets/plugins/jvectormap/jquery-jvectormap-2.0.5.min.js"></script>
    <script src="assets/plugins/jvectormap/jquery-jvectormap-world-mill.js"></script>
    <script src="assets/plugins/jvectormap/jquery-jvectormap-ru-mill.js"></script>
    <script src="assets/plugins/jvectormap/jquery-jvectormap-us-aea.js"></script>
    <script src="assets/plugins/jvectormap/jquery-jvectormap-uk_countries-mill.js"></script>        
    <script src="assets/plugins/jvectormap/jquery-jvectormap-in-mill.js"></script>
    <script src="assets/js/jvectormap.js"></script>
<?php }?>

<?php if($page !== 'signin.php' && $page !== 'signin-2.php' && $page !== 'signin-3.php' && $page !== 'register.php' && $page !== 'register-2.php' && $page !== 'register-3.php' && $page !== 'forgot-password.php' && $page !== 'forgot-password-2.php' && $page !== 'forgot-password-3.php'  && $page !== 'reset-password.php' && $page !== 'reset-password-2.php' && $page !== 'reset-password-3.php' && $page !== 'email-verification.php' && $page !== 'email-verification-2.php' && $page !== 'email-verification-3.php'
 && $page !== 'two-step-verification.php' && $page !== 'two-step-verification-2.php' && $page !== 'two-step-verification-3.php' && $page !== 'lock-screen.php' && $page !== 'error-404.php' && $page !== 'error-500.php' && $page !=='coming-soon.php' && $page !=='under-maintenance.php' && $page !== 'success.php' && $page !== 'success-2.php' && $page !== 'success-3.php' ) {?> 
    <!-- Select2 JS -->
    <script src = "assets/plugins/select2/js/select2.min.js"></script>
<?php }?>

<?php  if ($page === 'billers.php' ||$page === 'blog-comments.php' || $page === 'chat.php' || $page === 'contacts.php' || $page === 'customers.php' || $page === 'expired-products.php' || $page === 'security-settings.php' || $page === 'warehouse.php') {?>
    <!-- Mobile Input -->
    <script src="assets/plugins/intltelinput/js/intlTelInput.js"></script>
<?php }?>

<?php if($page === 'ui-swiperjs.php' || $page === 'chat.php' || $page === 'video-call.php' ) {?>
    <!-- Swiper JS -->
    <script src="assets/plugins/swiper/swiper-bundle.min.js"></script>
<?php }?>

<?php if($page === 'ui-swiperjs.php') {?>
    <!-- Internal Swiper JS -->
    <script src="assets/js/swiper.js"></script>
<?php }?>

<?php  if ( $page === 'chat.php' || $page === 'email-reply.php' || $page === 'social-feed.php' || $page === 'search-list.php') {?>
    <!-- FancyBox JS -->
    <script src="assets/plugins/fancybox/jquery.fancybox.min.js"></script>
<?php }?>

<?php if($page === 'file-manager.php') {?>
    <!-- Player JS -->
    <script src="assets/js/plyr-js.js"></script>
<?php }?>

<?php  if ( $page === 'ui-drag-drop.php' || $page === 'ui-clipboard.php' || $page === 'ui-stickynote.php' || $page === 'projects.php' || $page === 'search-list.php') {?>
    <!-- Drag Card -->
    <script src="assets/js/jquery-ui.min.js"></script>
    <script src="assets/js/jquery.ui.touch-punch.min.js"></script>
<?php }?>

<?php  if ( $page === 'pos.php' || $page === 'pos-2.php' || $page === 'pos-3.php' || $page === 'pos-4.php' || $page === 'pos-5.php') {?>
    <!-- Calculator JS -->
    <script src="assets/js/calculator.js"></script>
<?php }?>

<?php  if ( $page === 'ui-modals.php') {?>
    <!-- Modal JS -->
    <script src="assets/js/modal.js"></script>
<?php }?>

<?php  if ( $page === 'ui-rangeslider.php') {?>
    <!-- Rangeslider JS -->
    <script src="assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js"></script>
    <script src="assets/plugins/ion-rangeslider/js/custom-rangeslider.js"></script>
<?php }?>

<?php  if ( $page === 'calendar.php' || $page === 'form-pickers.php' || $page === 'projects.php' || $page === 'search-list.php' || $page === 'todo-list.php' || $page === 'todo.php') {?>
    <script src="assets/plugins/moment/moment.min.js"></script>
<?php }?>

<?php  if ($page === 'all-blog.php' || $page === 'blog-categories.php' || $page === 'blog-tag.php' ||$page === 'best-seller.php' || $page === 'calendar.php' || $page === 'companies.php' ||$page === 'customer-due-report.php' || $page === 'customer-report.php' || $page === 'dashboard.php' || $page === 'expense-report.php' || $page === 'form-pickers.php' || $page === 'income-report.php' || $page === 'index.php' || $page === 'inventory-report.php' || $page === 'invoice-report.php' || $page === 'layout-boxed.php' || $page === 'layout-dark.php' || $page === 'layout-detached.php' || $page === 'layout-rtl.php' || $page === 'layout-horizontal.php' || $page === 'layout-two-column.php' || $page === 'layout-hovered.php' || $page === 'notes.php' || $page === 'pos.php' || $page === 'pos-2.php' || $page === 'pos-3.php' || $page === 'pos-4.php' || $page === 'pos-5.php' || $page === 'product-expiry-report.php' || $page === 'product-quantity-alert.php' || $page === 'product-report.php' || $page === 'profit-and-loss.php' || $page === 'projects.php' || $page === 'purchase-report.php' || $page === 'sales-dashboard.php' || $page === 'sales-report.php' || $page === 'sales-tax.php' || $page === 'search-list.php' || $page === 'sold-stock.php' || $page === 'stock-history.php' || $page === 'supplier-due-report.php' || $page === 'supplier-report.php' || $page === 'tax-reports.php' || $page === 'todo-list.php' || $page === 'todo.php') {?>
    <!-- Daterangepicker JS -->
    <script src="assets/plugins/daterangepicker/daterangepicker.js"></script>
<?php }?>

<?php  if ( $page === 'ui-rating.php') {?>
    <!-- Rater JS -->
    <script src="assets/plugins/rater-js/index.js"></script>

    <!-- Internal Ratings JS -->
    <script src="assets/js/ratings.js"></script>
<?php }?>

<?php  if ( $page === 'ui-sortable.php') {?>
    <!-- Sortable JS -->
    <script src="assets/plugins/sortablejs/Sortable.min.js"></script>

    <!-- Internal Sortable JS -->
    <script src="assets/js/sortable.js"></script>
<?php }?>
	
<?php  if ( $page === 'ui-clipboard.php') {?>
    <!-- Clipboard JS -->
    <script src="assets/plugins/clipboard/clipboard.min.js"></script>
<?php }?>
   
<?php  if ( $page === 'ui-drag-drop.php') {?>
    <!-- Dragula JS -->
    <script src="assets/plugins/dragula/js/dragula.min.js"></script>
    <script src="assets/plugins/dragula/js/drag-drop.min.js"></script>
    <script src="assets/plugins/dragula/js/draggable-cards.js"></script>
<?php }?>

<?php  if ( $page === 'ui-counter.php') {?>
    <!-- Counter JS -->
    <script src="assets/plugins/countup/jquery.counterup.min.js"></script>
    <script src="assets/plugins/countup/jquery.waypoints.min.js"></script>
    <script src="assets/plugins/countup/jquery.missofis-countdown.js"></script>
<?php }?>

<?php  if ( $page === 'ui-scrollbar.php') {?>
    <!-- Scrollbar JS -->
    <script src="assets/plugins/scrollbar/scrollbar.min.js"></script>
    <script src="assets/plugins/scrollbar/custom-scroll.js"></script>
<?php }?>

<?php  if ( $page === 'ui-stickynote.php' || $page === 'search-list.php') {?>
    <!-- Stickynote JS -->
    <script src="assets/js/jquery-ui.min.js"></script>
    <script src="assets/plugins/stickynote/sticky.js"></script>
<?php }?>

<?php  if ( $page === 'ui-sweetalerts.php') {?>
    <!-- Sweetalerts JS -->
    <script src="assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
    <script src="assets/plugins/sweetalert/sweetalerts.min.js"></script>
<?php }?>

<?php if($page === 'form-select.php' || $page === 'form-select2.php' || $page === 'form-pickers.php') {?>
    <!-- Custom Select JS -->
    <script src="assets/js/custom-select2.js"></script>
<?php }?>

<?php  if ( $page === 'form-wizard.php') {?>
    <!-- Wizard JS -->
    <script src="assets/plugins/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
    <script src="assets/plugins/twitter-bootstrap-wizard/prettify.js"></script>
    <script src="assets/plugins/twitter-bootstrap-wizard/form-wizard.js"></script>
<?php }?>

<?php  if ( $page === 'form-pickers.php') {?>
    <!-- Form Date PIckers JS -->
    <script src="assets/plugins/flatpickr/flatpickr.js"></script>
    <script src="assets/plugins/bootstrap-datepicker/bootstrap-datepicker.js"></script>
    <script src="assets/plugins/jquery-timepicker/jquery-timepicker.js"></script>
    <script src="assets/plugins/pickr/pickr.js"></script>
    <script src="assets/plugins/@simonwep/pickr/pickr.min.js"></script>
    <script src="assets/js/forms-pickers.js"></script>
<?php }?>

<?php  if ( $page === 'maps-vector.php') {?>
    <!-- JSVector Maps MapsJS -->
    <script src="assets/plugins/jsvectormap/js/jsvectormap.min.js"></script>
    <script src="assets/plugins/jsvectormap/maps/world-merc.js"></script>
    <script src="assets/js/us-merc-en.js"></script>
    <script src="assets/js/russia.js"></script>
    <script src="assets/js/spain.js"></script>
    <script src="assets/js/canada.js"></script>
    <script src="assets/js/jsvectormap.js"></script>
<?php }?>

<?php  if ( $page === 'maps-leaflet.php') {?>
    <!-- Leaflet Maps JS -->
    <script src="assets/plugins/leaflet/leaflet.js"></script>
    <script src="assets/js/leaflet.js"></script>
<?php }?>

<?php  if ($page === 'appearance.php' || $page === 'audio-call.php' || $page === 'ban-ip-address.php' ||$page === 'bank-settings-grid.php' || $page === 'barcode.php' || $page === 'blog-details.php' ||$page === 'company-settings.php' || $page === 'connected-apps.php' || $page === 'currency-settings.php' || $page === 'custom-fields.php' || $page === 'email-settings.php' || $page === 'email-templates.php' || $page === 'employee-details.php' || $page === 'file-manager.php' || $page === 'gdpr-settings.php' || $page === 'general-settings.php' || $page === 'invoice-settings.php' || $page === 'invoice-templates.php' || $page === 'language-settings-web.php' || $page === 'language-settings.php' || $page === 'localization-settings.php' || $page === 'notes.php' || $page === 'notification.php' || $page === 'otp-settings.php' || $page === 'payment-gateway-settings.php' || $page === 'pos.php' || $page === 'pos-2.php' || $page === 'pos-3.php' || $page === 'pos-4.php' || $page === 'pos-5.php' || $page === 'pos-settings.php' || $page === 'preference.php' || $page === 'prefixes.php' || $page === 'qrcode.php' || $page === 'security-settings.php' || $page === 'signatures.php' || $page === 'sms-templates.php' || $page === 'sms-settings.php' || $page === 'social-feed.php' || $page === 'social-authentication.php' || $page === 'storage-settings.php' || $page === 'system-settings.php'|| $page === 'tax-rates.php' || $page === 'todo-list.php' || $page === 'todo.php' || $page === 'video-call.php') {?>
    <!-- Sticky-sidebar -->
    <script src="assets/plugins/theia-sticky-sidebar/ResizeSensor.js"></script>
    <script src="assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js"></script>
<?php }?>

<?php  if ( $page === 'calendar.php' || $page === 'file-manager') {?>
    <!-- Theiastickysidebar JS -->
    <script src="assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.min.js"></script>
    <script src="assets/plugins/theia-sticky-sidebar/ResizeSensor.min.js"></script>
<?php }?>

<?php  if ($page === 'audio-call.php' || $page === 'pos.php' || $page === 'pos-2.php' || $page === 'pos-3.php' || $page === 'pos-4.php' || $page === 'pos-5.php' || $page === 'product-details.php' || $page === 'video-call.php'){?>
    <!-- Owl JS -->
    <script src = 'assets/plugins/owlcarousel/owl.carousel.min.js'></script>
<?php }?>

<?php  if ($page === 'barcode.php' || $page === 'file-manager.php' || $page === 'notes.php' || $page === 'qrcode.php' || $page === 'social-feed.php' || $page === 'todo-list.php' || $page === 'todo.php'){?>
    <!-- Owl JS -->
    <script src="assets/js/owl.carousel.min.js"></script>
<?php }?>

<?php if($page !== 'signin.php' && $page !== 'signin-2.php' && $page !== 'signin-3.php' && $page !== 'register.php' && $page !== 'register-2.php' && $page !== 'register-3.php' && $page !== 'forgot-password.php' && $page !== 'forgot-password-2.php' && $page !== 'forgot-password-3.php'  && $page !== 'reset-password.php' && $page !== 'reset-password-2.php' && $page !== 'reset-password-3.php' && $page !== 'email-verification.php' && $page !== 'email-verification-2.php' && $page !== 'email-verification-3.php'
 && $page !== 'two-step-verification.php' && $page !== 'two-step-verification-2.php' && $page !== 'two-step-verification-3.php' && $page !== 'lock-screen.php' && $page !== 'error-404.php' && $page !== 'error-500.php' && $page !=='coming-soon.php' && $page !=='under-maintenance.php' && $page !== 'success.php' && $page !== 'success-2.php' && $page !== 'success-3.php' ) {?> 
    <!-- Color Picker JS -->
    <script src="assets/plugins/@simonwep/pickr/pickr.es5.min.js"></script>

    <script src="assets/js/theme-colorpicker.js"></script>
<?php }?>    

    <script src = "assets/js/script.js"></script>
