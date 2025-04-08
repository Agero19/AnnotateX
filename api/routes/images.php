<?php

use Core\Database;
use Controllers\ImageController;

$db = new Database();
$imageController = new ImageController($db);
$method = $_SERVER['REQUEST_METHOD'];
$path = explode('/', trim($_SERVER['REQUEST_URI'], '/'));

switch ($method) {
    case 'GET':
        if (isset($path[2]) && is_numeric($path[2])) {
            echo json_encode($imageController->getImageById((int) $path[2]));
        } else {
            echo json_encode($imageController->getAllImages());
        }
        break;

    case 'POST':
        // Validate the uploaded file
        if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
            echo json_encode(['error' => 'Image upload failed']);
            exit;
        }

        $uploadDir = __DIR__ . '/../../uploads/images/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $imageTmpPath = $_FILES['image']['tmp_name'];
        $imageName = basename($_FILES['image']['name']);
        $destinationPath = $uploadDir . $imageName;

        if (!move_uploaded_file($imageTmpPath, $destinationPath)) {
            echo json_encode(['error' => 'Error saving file']);
            exit;
        }

        // Prepare data for the controller
        $filePath = '../../uploads/images/' . $imageName;  // You can adjust to store the relative
        $title = $_POST['title'] ?? '';
        $description = $_POST['description'] ?? '';
        $user_id = $_POST['user_id'] ?? 1; // Temporary user ID
        $visibility = !isset($_POST['visibility']) || (bool) $_POST['visibility'];

        $imageData = [
            'user_id' => $user_id,
            'file_path' => $filePath,
            'visibility' => $visibility,
            'title' => $title,
            'description' => $description
        ];

        // Call the controller method to create the image record
        if ($imageController->createImage($imageData)) {
            echo json_encode(['message' => 'Image uploaded successfully', 'path' => $filePath]);
        } else {
            echo json_encode(['error' => 'Database insert failed']);
        }
        break;

    case 'PUT':
        if (isset($path[2]) && is_numeric($path[2])) {
            $data = json_decode(file_get_contents("php://input"), true);
            echo json_encode(['success' => $imageController->updateImage((int) $path[2], $data)]);
        }
        break;

    case 'DELETE':
        if (isset($path[2]) && is_numeric($path[2])) {
            echo json_encode(['success' => $imageController->deleteImage((int) $path[2])]);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(['error' => 'Method Not Allowed']);
        break;
}
