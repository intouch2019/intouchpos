<?php
$link = $_SERVER['PHP_SELF'];
$link_array = explode('/', $link);
$page = end($link_array);
$pageName = basename($page, '.php');

if ($pageName == 'lock-screen') {
    echo '<div class="main-wrapper login-body">';
} elseif ($pageName == 'pos') {
    echo '<div class="main-wrapper pos-five">';
} elseif ($pageName == 'pos-3') {
    echo '<div class="main-wrapper pos-two">';
} elseif ($pageName == 'pos-4') {
    echo '<div class="main-wrapper pos-three">';
} elseif ($pageName == 'pos-5') {
    echo '<div class="main-wrapper pos-three pos-four">';
} else {
    echo '<div class="main-wrapper">';
}
?>