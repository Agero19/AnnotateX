<?php

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__ . '/../config/app.php';

$config = require __DIR__ . '/../config/app.php';
$dbConfig = $config['db'];

try {
    // Connect to MySQL
    $pdo = new PDO("mysql:host={$dbConfig['host']}", $dbConfig['user'], $dbConfig['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create database if not exists
    $dbName = $dbConfig['database'];
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbName` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");
    $pdo->exec("USE `$dbName`;");

    // Create tables
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(50) NOT NULL UNIQUE,
            email VARCHAR(100) NOT NULL UNIQUE,
            password_hash VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );
        
        CREATE TABLE IF NOT EXISTS images (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT NOT NULL,
            file_path VARCHAR(255) NOT NULL,
            visibility BOOLEAN DEFAULT FALSE,
            title VARCHAR(255) NOT NULL,
            description TEXT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
        );
        
        CREATE TABLE IF NOT EXISTS annotations (
            id INT AUTO_INCREMENT PRIMARY KEY,
            image_id INT NOT NULL,
            user_id INT NOT NULL,
            x INT NOT NULL,
            y INT NOT NULL,
            width INT NOT NULL,
            height INT NOT NULL,
            comment TEXT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (image_id) REFERENCES images(id) ON DELETE CASCADE,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
        );
    ");

    echo "✅ Database & Tables Created Successfully\n";

    // Insert test data
    $pdo->exec("
        INSERT INTO users (username, email, password_hash) VALUES 
        ('testuser', 'test@example.com', '" . password_hash('password123', PASSWORD_DEFAULT) . "');

        INSERT INTO images (user_id, file_path, visibility, title, description) VALUES 
        (1, 'sample_image.jpg', TRUE, 'test_title', 'test_description');

        INSERT INTO annotations (image_id, user_id, x, y, width, height, comment) VALUES 
        (1, 1, 100, 100, 50, 50, 'Example Label');
    ");

    echo "✅ Test Data Inserted\n";
} catch (PDOException $e) {
    die("❌ Database Error: " . $e->getMessage() . "\n");
}
