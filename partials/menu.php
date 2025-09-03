<?php
$link = $_SERVER['PHP_SELF'];
$link_array = explode('/', $link);
$page = end($link_array);
$pageName = basename($page, '.php');

if ($pageName == 'under-maintenance' ||
    $pageName == 'coming-soon' ||
    $pageName == 'error-404' ||
    $pageName == 'error-500' ||
    $pageName == 'two-step-verification-3' ||
    $pageName == 'two-step-verification-2' ||
    $pageName == 'two-step-verification' ||
    $pageName == 'email-verification-3' ||
    $pageName == 'email-verification-2' ||
    $pageName == 'email-verification' ||
    $pageName == 'reset-password-3' ||
    $pageName == 'reset-password-2' ||
    $pageName == 'reset-password' ||
    $pageName == 'forgot-password-3' ||
    $pageName == 'forgot-password-2' ||
    $pageName == 'forgot-password' ||
    $pageName == 'register-3' ||
    $pageName == 'register-2' ||
    $pageName == 'register' ||
    $pageName == 'signin-3' ||
    $pageName == 'signin-2' ||
    $pageName == 'signin' ||
    $pageName == 'success' ||
    $pageName == 'success-2' ||
    $pageName == 'success-3' ||
    $pageName == 'lock-screen') {
} else {
    include 'topbar.php';
    include 'sidebar.php';
    include 'horizontal-sidebar.php';
    include 'twocolumn-sidebar.php';
}
?>