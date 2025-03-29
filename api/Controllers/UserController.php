<?php

namespace Controllers;

use Core\Database;
use PDO;

class UserController
{
    private PDO $pdo;

    public function __construct(Database $db)
    {
        $this->pdo = $db->getConnection();
    }

    public function getAllUsers()
    {
        $stmt = $this->pdo->query("SELECT id, username, email, created_at FROM users");
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($users);
    }

    public function createUser($data)
    {
        if (!isset($data['username'], $data['email'], $data['password'])) {
            http_response_code(400);
            echo json_encode(["error" => "Missing required fields"]);
            return;
        }

        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("INSERT INTO users (username, email, password_hash) VALUES (:username, :email, :password_hash)");
        $stmt->execute([
            'username' => $data['username'],
            'email' => $data['email'],
            'password_hash' => $hashedPassword
        ]);

        echo json_encode(["message" => "User created successfully"]);
    }
}
