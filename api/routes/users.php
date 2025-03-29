<?php


require_once __DIR__ . '/../Core/Database.php';
require_once __DIR__.'/../Controllers/UserController.php';

use Core\Database;
use Controllers\UserController;

$db = new Database();
$controller = new UserController($db);

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $controller->getAllUsers();
        break;
    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        $controller->createUser($data);
        break;
    default:
        http_response_code(405);
        echo json_encode(["error" => "Method not allowed"]);
}
