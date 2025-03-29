<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/Core/Router.php';

use Core\Router;

header("Content-Type: application/json");

$router = new Router();

// Users
$router->get('/users', 'routes/users.php');
$router->post('/users', 'routes/users.php');

// Images
$router->get('/images', 'routes/images.php');
$router->post('/images', 'routes/images.php');
$router->put('/images', 'routes/images.php');
$router->delete('/images', 'routes/images.php');

// Annotations
$router->get('/annotations', 'routes/annotations.php');
$router->post('/annotations', 'routes/annotations.php');
$router->put('/annotations', 'routes/annotations.php');
$router->delete('/annotations', 'routes/annotations.php');

$router->run();
