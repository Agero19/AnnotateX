<?php
// public/index.php

// Для разработки включаем вывод ошибок
use Core\Router;

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Подключаем автозагрузчик Composer (если используется)
require_once __DIR__ . '/../vendor/autoload.php';

// Загружаем конфигурацию
$config = require_once __DIR__ . '/../config/app.php';

// Инициализируем роутер и передаём конфигурацию (на случай, если понадобится использовать настройки)
$router = new Router($config);

// Регистрируем маршруты
// Пример: для главной страницы вызывается метод index контроллера HomeController
$router->get('/', 'HomeController@index');

// Здесь можно добавить и другие маршруты, например:
// $router->post('/login', 'AuthController@login');

// Обрабатываем запрос: передаём текущий URI и HTTP-метод
$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
