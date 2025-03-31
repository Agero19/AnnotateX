<?php

function view($page) {
    $file = __DIR__ . '/../templates/' . $page . 'View.php';

    if (file_exists($file)) {
        require_once $file;
    } else {
        die("Error: View file '$file' not found.");
    }
}
