<?php

namespace Controllers;

use Core\Database;
use PDO;
use PDOException;

class AnnotationController
{
    private PDO $db;

    public function __construct(Database $db)
    {
        $this->db = $db->getConnection();
    }

    public function getAllAnnotations(): array
    {
        $stmt = $this->db->query("SELECT * FROM annotations");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAnnotationById(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM annotations WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function getAnnotationsByImageId(int $imageId): array
    {
        $stmt = $this->db->prepare("SELECT * FROM annotations WHERE image_id = :image_id");
        $stmt->execute(['image_id' => $imageId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createAnnotation(array $data): bool
    {
        try {
            $stmt = $this->db->prepare("
                INSERT INTO annotations (image_id, user_id, x, y, width, height, comment) 
                VALUES (:image_id, :user_id, :x, :y, :width, :height, :comment)
            ");
            return $stmt->execute([
                'image_id' => $data['image_id'],
                'user_id' => $data['user_id'],
                'x' => $data['x'],
                'y' => $data['y'],
                'width' => $data['width'],
                'height' => $data['height'],
                'comment' => $data['comment']
            ]);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function updateAnnotation(int $id, array $data): bool
    {
        try {
            $stmt = $this->db->prepare("
                UPDATE annotations 
                SET x = :x, y = :y, width = :width, height = :height, comment = :comment
                WHERE id = :id
            ");
            return $stmt->execute([
                'id' => $id,
                'x' => $data['x'],
                'y' => $data['y'],
                'width' => $data['width'],
                'height' => $data['height'],
                'comment' => $data['comment']
            ]);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function deleteAnnotation(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM annotations WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
