<?php
$filename = basename($_SERVER['PHP_SELF'], '.php');

$acronyms = ['ui', 'ai', 'js', 'api', 'css', 'html', 'php', 'seo', 'ip', 'faq', 'pos', 'rtl'];

if ($filename === 'index') {
    $title = 'Admin Dashboard';
} else {
    $parts = explode('-', str_replace('ui-', '', strtolower($filename)));

    $hasIcon = false;
    $hasChart = false;
    $cleaned_parts = [];

    foreach ($parts as $part) {
        if (is_numeric($part)) {
            continue; // Skip numbers like "1", "2024", etc.
        }
        if ($part === 'icon') {
            $hasIcon = true;
            continue;
        }
        if ($part === 'chart') {
            $hasChart = true;
            continue;
        }
        if ($part === 'all') {
            continue;
        }
        $cleaned_parts[] = $part;
    }

    $formatted_parts = array_map(function ($word) use ($acronyms) {
        return in_array($word, $acronyms) ? strtoupper($word) : ucfirst($word);
    }, $cleaned_parts);

    if ($hasIcon) {
        $formatted_parts[] = 'Icons';
    }

    if ($hasChart) {
        $formatted_parts[] = 'Charts';
    }

    $title = implode(' ', $formatted_parts);
}
?>
		
	<!-- Meta Tags -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Dreams POS is a powerful Bootstrap based Inventory Management Admin Template designed for businesses, offering seamless invoicing, project tracking, and estimates.">
	<meta name="keywords" content="inventory management, admin dashboard, bootstrap template, invoicing, estimates, business management, responsive admin, POS system">
	<meta name="author" content="Dreams Technologies">
	<meta name="robots" content="index, follow">
	<title> <?= $title ?> | Dreams POS - Inventory Management & Admin Dashboard Template</title>

    