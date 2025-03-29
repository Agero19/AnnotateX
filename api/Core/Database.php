<?php

namespace Core;

use PDO;
use PDOException;

class Database
{
    private static ?PDO $pdo = null;

    public function __construct()
    {
        if (self::$pdo === null) {
            $config = require __DIR__ . '/../../config/app.php';
            $dbConfig = $config['db'];

            try {
                self::$pdo = new PDO(
                    "{$dbConfig['driver']}:host={$dbConfig['host']};dbname={$dbConfig['database']};charset=utf8mb4",
                    $dbConfig['user'],
                    $dbConfig['password']
                );
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die(json_encode(["error" => "Database connection failed: " . $e->getMessage()]));
            }
        }
    }

    public static function getInstance()
    {
    }

    public function getConnection(): PDO
    {
        return self::$pdo;
    }
}
