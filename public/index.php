<?php

$name = 'Home';
$baseUrl = dirname($_SERVER['SCRIPT_NAME']) === '/' ? '/' : dirname($_SERVER['SCRIPT_NAME']) . '/';


// Fetch images JSON from API endpoint 
$apiUrl = "http://localhost/Annotatex/api/images";
$json = file_get_contents($apiUrl);

// Check for errors and decode JSON
if ($json === false) {
    $images = [];
} else {
    $images = json_decode($json, true);
}


require_once __DIR__ . '/views/index.view.php';