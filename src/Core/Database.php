<?php
// src/Core/Database.php

namespace Core;

use PDO,PDOException;

class Database {
    private static $instance = null;
    private $pdo;

    /**
     * Приватный конструктор для реализации синглтона.
     */
    private function __construct(array $dbConfig) {
        $driver   = $dbConfig['driver'];
        $host     = $dbConfig['host'];
        $dbname   = $dbConfig['database'];
        $user     = $dbConfig['user'];
        $password = $dbConfig['password'];

        // Формируем DSN, например для MySQL:
        $dsn = "$driver:host=$host;dbname=$dbname;charset=utf8";

        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $this->pdo = new PDO($dsn, $user, $password, $options);
        } catch (PDOException $e) {
            die("Ошибка подключения к базе данных: " . $e->getMessage());
        }
    }

    /**
     * Получение единственного экземпляра подключения к базе данных.
     */
    public static function getInstance(array $dbConfig) {
        if (self::$instance === null) {
            self::$instance = new self($dbConfig);
        }
        return self::$instance;
    }

    /**
     * Возвращает объект PDO.
     */
    public function getConnection(): PDO
    {
        return $this->pdo;
    }
}
