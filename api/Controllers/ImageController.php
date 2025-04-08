<?php

namespace Controllers;

use Core\Database;
use PDO;
use PDOException;

class ImageController
{
    private PDO $db;

    public function __construct(Database $db)
    {
        $this->db = $db->getConnection();
    }

    public function getAllImages(): array
    {
        $stmt = $this->db->query("SELECT * FROM images WHERE visibility = 1");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getImageById(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM images WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function createImage(array $data): bool
    {
        try {
            $stmt = $this->db->prepare("
                INSERT INTO images (user_id, file_path, visibility, title, description) 
                VALUES (:user_id, :file_path, :visibility, :title, :description)
            ");
            return $stmt->execute([
                'user_id' => $data['user_id'],
                'file_path' => $data['file_path'],
                'visibility' => $data['visibility'],
                'title' => $data['title'],
                'description' => $data['description']
            ]);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function updateImage(int $id, array $data): bool
    {
        try {
            $stmt = $this->db->prepare("
                UPDATE images 
                SET file_path = :file_path, visibility = :visibility, title = :title, description = :description
                WHERE id = :id
            ");
            return $stmt->execute([
                'id' => $id,
                'file_path' => $data['file_path'],
                'visibility' => $data['visibility'],
                'title' => $data['title'],
                'description' => $data['description']
            ]);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function deleteImage(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM images WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
