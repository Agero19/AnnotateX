<?php

use Controllers\AnnotationController;
use Core\Database;

header('Content-Type: application/json');

$db = new Database();
$annotationsController = new AnnotationController($db);
$method = $_SERVER['REQUEST_METHOD'];
$path = explode('/', trim($_SERVER['REQUEST_URI'], '/'));

switch ($method) {
    case 'GET':
        if (isset($path[2]) && is_numeric($path[2])) {
            echo json_encode($annotationsController->getAnnotationById((int)$path[2]));
        } elseif (isset($_GET['image_id']) && is_numeric($_GET['image_id'])) {
            echo json_encode($annotationsController->getAnnotationsByImageId((int)$_GET['image_id']));
        } else {
            echo json_encode($annotationsController->getAllAnnotations());
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        echo json_encode(['success' => $annotationsController->createAnnotation($data)]);
        break;

    case 'PUT':
        if (isset($path[2]) && is_numeric($path[2])) {
            $data = json_decode(file_get_contents("php://input"), true);
            echo json_encode(['success' => $annotationsController->updateAnnotation((int)$path[2], $data)]);
        }
        break;

    case 'DELETE':
        if (isset($path[2]) && is_numeric($path[2])) {
            echo json_encode(['success' => $annotationsController->deleteAnnotation((int)$path[2])]);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(['error' => 'Method Not Allowed']);
        break;
}
