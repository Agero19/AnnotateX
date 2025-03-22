<?php

// config/app.php

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

return [
    'base_url' => 'https://AnnotateX.com',

    'app_env' => 'development',

    // Настройки подключения к базе данных
    'db' => [
        'driver' => $_ENV['DB_TYPE'],
        'host' => $_ENV['DB_HOST'],
        'database' => $_ENV['DB_NAME'],
        'user' => $_ENV['DB_USERNAME'],
        'password' => $_ENV['DB_PWD'],
    ],
];