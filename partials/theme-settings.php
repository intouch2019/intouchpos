<?php
$link = $_SERVER['PHP_SELF'];
$link_array = explode('/', $link);
$page = end($link_array);
$pageName = basename($page, '.php');

if ($pageName == 'layout-horizontal') {
    echo '<html lang="en" data-layout="horizontal">';
} elseif ($pageName == 'layout-detached') {
    echo '<html lang="en" data-layout="detached">';
} elseif ($pageName == 'layout-modern') {
    echo '<html lang="en" data-layout="modern">';
} elseif ($pageName == 'layout-two-column') {
    echo '<html lang="en" data-layout="twocolumn">';
} elseif ($pageName == 'layout-hovered') {
    echo '<html lang="en" data-layout="layout-hovered">';
} elseif ($pageName == 'layout-boxed') {
    echo '<html lang="en" data-layout="default" data-width="box">';
} elseif ($pageName == 'layout-rtl') {
    echo '<html lang="en" data-layout-mode="light_mode">';
} elseif ($pageName == 'layout-dark') {
    echo '<html lang="en" data-theme="dark">';
} else {
    echo '<html lang="en">';
}
?>
