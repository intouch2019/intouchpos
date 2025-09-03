<?php
// Set system-local timezone if not already defined
if (function_exists('ini_get') && ini_get('date.timezone') === '') {
    date_default_timezone_set(@date_default_timezone_get());
}

require_once __DIR__ . '/../vendor/autoload.php';

use ScssPhp\ScssPhp\Compiler;
use ScssPhp\ScssPhp\Exception\SassException;

$scssDir = realpath(__DIR__ . '/../assets/scss');
$outputFile = realpath(__DIR__ . '/../assets/css') . '/style.css';
$mainScss = $scssDir . '/main.scss';

// Get relative output path for display (e.g., ../css/style.css)
$relativeOutputPath = str_replace(realpath(__DIR__ . '/..'), '..', $outputFile);

function compileScss($input, $output, $relativeOutput)
{
    $compiler = new Compiler();
    $compiler->setImportPaths(dirname($input));

    try {
        $scss = file_get_contents($input);
        $css = $compiler->compileString($scss)->getCss();
        file_put_contents($output, $css);

        echo "[" . date("Y-m-d H:i") . "] Compiled " . basename($input) . " to $relativeOutput." . PHP_EOL;
    } catch (SassException $e) {
        echo "\n Compile error:\n" . $e->getMessage() . PHP_EOL;
        echo str_repeat('-', 50) . PHP_EOL;
    }
}

function watch($watchDir, $input, $output, $relativeOutput)
{
    echo " Sass is watching for changes. (Press Ctrl+C to stop)" . PHP_EOL;

    $lastModified = [];

    while (true) {
        $changed = false;

        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($watchDir)
        );

        foreach ($iterator as $file) {
            if ($file->isFile() && $file->getExtension() === 'scss') {
                $path = $file->getRealPath();
                $modified = $file->getMTime();

                if (!isset($lastModified[$path]) || $lastModified[$path] !== $modified) {
                    $lastModified[$path] = $modified;
                    $changed = true;
                }
            }
        }

        if ($changed) {
            compileScss($input, $output, $relativeOutput);
        }

        sleep(1);
    }
}

watch($scssDir, $mainScss, $outputFile, $relativeOutputPath);
