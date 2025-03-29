<?php

use Core\Database;
use Controllers\ImageController;

$db = new Database();
$imageController = new ImageController($db);
$method = $_SERVER['REQUEST_METHOD'];
$path = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
echo(json_encode($path));

switch ($method) {
    case 'GET':
        echo(json_encode($path));
        if (isset($path[1]) && is_numeric($path[1])) {
            echo json_encode($imageController->getImageById((int)$path[1]));
        } else {
            echo json_encode($imageController->getAllImages());
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        echo json_encode(['success' => $imageController->createImage($data)]);
        break;

    case 'PUT':
        if (isset($path[2]) && is_numeric($path[2])) {
            $data = json_decode(file_get_contents("php://input"), true);
            echo json_encode(['success' => $imageController->updateImage((int)$path[2], $data)]);
        }
        break;

    case 'DELETE':
        if (isset($path[2]) && is_numeric($path[2])) {
            echo json_encode(['success' => $imageController->deleteImage((int)$path[2])]);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(['error' => 'Method Not Allowed']);
        break;
}
