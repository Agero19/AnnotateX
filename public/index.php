<?php
// public/index.php

use Core\Router;

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';

//  load .env variables

$config = require_once __DIR__ . '/../config/app.php';


$router = new Router($config);

$router->get('/', 'HomeController@index');

$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
