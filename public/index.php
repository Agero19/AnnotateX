<?php
// Define performance start time (if needed elsewhere)
use routes\Route;

define('APP_START', microtime(true));

// Register the Composer autoloader (check if it exists)
$composerAutoloader = __DIR__.'/../vendor/autoload.php';
if (!file_exists($composerAutoloader)) {
    die('Error: Composer autoloader not found. Run "composer install".');
}
require $composerAutoloader;

// Require route files (ensure they exist)
$routeFile = __DIR__.'/../routes/Route.php';
$webFile = __DIR__.'/../routes/web.php';

if (!file_exists($routeFile) || !file_exists($webFile)) {
    die('Error: Required route files are missing.');
}

require_once $routeFile;
require_once $webFile;

// Run the application routes (with exception handling)
try {
    Route::run();
} catch (Exception $e) {
    die('Error during route run: '.$e->getMessage());
}