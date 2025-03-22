#!/usr/bin/env php
<?php
// bin/migrate.php

// Подключаем автозагрузчик Composer
require_once __DIR__ . '/../vendor/autoload.php';

// Загружаем конфигурацию приложения
$config = require __DIR__ . '/../config/app.php';

// Получаем PDO-соединение через наш Database-класс
use Core\Database;
$db = Database::getInstance($config['db'])->getConnection();

// Массив SQL-запросов для создания таблиц
$queries = [
    // Таблица пользователей
    "CREATE TABLE IF NOT EXISTS users (
         id INT AUTO_INCREMENT PRIMARY KEY,
         username VARCHAR(255) NOT NULL,
         email VARCHAR(255) NOT NULL,
         password_hash VARCHAR(255) NOT NULL,
         created_at DATETIME DEFAULT CURRENT_TIMESTAMP
     ) ENGINE=InnoDB DEFAULT CHARSET=utf8;",

    // Таблица изображений
    "CREATE TABLE IF NOT EXISTS images (
         id INT AUTO_INCREMENT PRIMARY KEY,
         user_id INT NOT NULL,
         file_path VARCHAR(255) NOT NULL,
         visibility ENUM('public', 'private') DEFAULT 'private',
         title VARCHAR(255),
         description TEXT,
         created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
         FOREIGN KEY (user_id) REFERENCES users(id)
     ) ENGINE=InnoDB DEFAULT CHARSET=utf8;",

    // Таблица аннотаций
    "CREATE TABLE IF NOT EXISTS annotations (
         id INT AUTO_INCREMENT PRIMARY KEY,
         image_id INT NOT NULL,
         user_id INT NOT NULL,
         x FLOAT NOT NULL,
         y FLOAT NOT NULL,
         width FLOAT,
         height FLOAT,
         comment TEXT,
         created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
         FOREIGN KEY (image_id) REFERENCES images(id),
         FOREIGN KEY (user_id) REFERENCES users(id)
     ) ENGINE=InnoDB DEFAULT CHARSET=utf8;"
];

foreach ($queries as $query) {
    try {
        $db->exec($query);
        echo "Выполнено: " . $query . "\n";
    } catch (PDOException $e) {
        echo "Ошибка при выполнении запроса: " . $e->getMessage() . "\n";
    }
}

echo "Миграция базы данных завершена.\n";
