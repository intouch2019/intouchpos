<?php
$link = $_SERVER['PHP_SELF'];
$link_array = explode('/', $link);
$page = end($link_array);
$route = basename($page, '.php');

if ($route !== 'under-maintenance' &&
    $route !== 'coming-soon' &&
    $route !== 'error-404' &&
    $route !== 'error-500' &&
    $route !== 'two-step-verification-3' &&
    $route !== 'two-step-verification-2' &&
    $route !== 'two-step-verification' &&
    $route !== 'email-verification-3' &&
    $route !== 'email-verification-2' &&
    $route !== 'email-verification' &&
    $route !== 'reset-password-3' &&
    $route !== 'reset-password-2' &&
    $route !== 'reset-password' &&
    $route !== 'forgot-password-3' &&
    $route !== 'forgot-password-2' &&
    $route !== 'forgot-password' &&
    $route !== 'register-3' &&
    $route !== 'register-2' &&
    $route !== 'register' &&
    $route !== 'signin-3' &&
    $route !== 'signin-2' &&
    $route !== 'signin' &&
    $route !== 'success' &&
    $route !== 'success-2' &&
    $route !== 'success-3' &&
    $route !== 'layout-horizontal' &&
    $route !== 'layout-hovered' &&
    $route !== 'layout-boxed' &&
    $route !== 'layout-rtl' &&
    $route !== 'pos' &&
    $route !== 'pos-2' &&
    $route !== 'pos-3' &&
    $route !== 'pos-4' &&
    $route !== 'pos-5') {
    echo "<body>";
}

if ($route === 'layout-horizontal') {
    echo '<body class="menu-horizontal">';
}
if ($route === 'layout-hovered') {
    echo '<body class="mini-sidebar expand-menu">';
}
if ($route === 'layout-boxed') {
    echo '<body class="mini-sidebar layout-box-mode">';
}
if ($route === 'layout-rtl') {
    echo '<body class="layout-mode-rtl">';
}

if ($route === 'under-maintenance' || $route === 'coming-soon' || $route === 'error-404' || $route === 'error-500') {
    echo '<body class="error-page">';
}
if ($route === 'two-step-verification' || $route === 'email-verification' || $route === 'reset-password' || $route === 'forgot-password' || $route === 'register-2' || $route === 'register' || $route === 'signin' || $route === 'success') {
    echo '<body class="account-page">';
}
if ($route === 'two-step-verification-3' || $route === 'two-step-verification-2' || $route === 'success-2' || $route === 'success-3' || $route === 'signin-3' || $route === 'signin-2' || $route === 'reset-password-3' || $route === 'reset-password-2' || $route === 'forgot-password-3' || $route === 'forgot-password-2' || $route === 'email-verification-3' || $route === 'email-verification-2' || $route === 'register-3') {
    echo '<body class="account-page bg-white">';
}
if ($route === 'lock-screen') {
    echo '<img src="assets/img/bg/lock-screen-bg.png" alt="bg" class="lock-screen-bg position-absolute img-fluid d-sm-none d-md-none d-lg-flex">';
}
if ($route === 'pos' || $route === 'pos-2' || $route === 'pos-3' || $route === 'pos-4' || $route === 'pos-5') {
    echo '<body class="pos-page">';
}
?>