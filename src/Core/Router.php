<?php /** @noinspection SpellCheckingInspection */

// src/Core/Router.php

namespace Core;

class Router {
    // Хранит список зарегистрированных маршрутов
    protected $routes = [];
    // Конфигурация приложения (если понадобится)
    protected $config = [];

    public function __construct(array $config = []) {
        $this->config = $config;
    }

    // Регистрация маршрута для GET-запроса
    public function get($uri, $action) {
        $this->addRoute('GET', $uri, $action);
    }

    // Регистрация маршрута для POST-запроса
    public function post($uri, $action) {
        $this->addRoute('POST', $uri, $action);
    }

    // Добавление маршрута в список
    protected function addRoute($method, $uri, $action) {
        // Удаляем завершающий слэш для единообразия
//        $uri = rtrim($uri, '/');
//        if ($uri === '') {
//            $uri = '/';
//        }
        $this->routes[] = [
            'method' => $method,
            'uri'    => $uri,
            'action' => $action,
        ];
    }

    // Обработка (диспетчеризация) запроса
    public function dispatch($requestedUri, $requestedMethod) {
        // Извлекаем путь из URL (без GET-параметров)
        $uri = parse_url($requestedUri, PHP_URL_PATH);
        $uri = rtrim($uri);
        if ($uri === '') {
            $uri = '/';
        }
        // Поиск маршрута, соответствующего текущему URI и методу
        //TODO: Rewrite concatenation of index page path as a static or some other way
        foreach ($this->routes as $route) {
            if ($route['method'] === $requestedMethod && '/Annotatex/public/index.php'.$route['uri'] === $uri.'/') {
                try {
                    return $this->callAction($route['action']);
                } catch (\Exception $e) {
                    echo $e->getMessage();
                }
            }
        }

        // Если маршрут не найден – возвращаем 404
        http_response_code(404);
        echo "404 Not Found";
    }

    // Вызов действия контроллера
    protected function callAction($action) {
        // Ожидается формат "Controller@method"
        list($controllerName, $method) = explode('@', $action);
        // Формируем полное имя класса контроллера, например \Controller\HomeController
        $controllerClass = "Controller\\" . $controllerName;

        if (!class_exists($controllerClass)) {
            throw new \Exception("Контроллер $controllerClass не найден");
        }

        $controller = new $controllerClass;
        if (!method_exists($controller, $method)) {
            throw new \Exception("Метод $method не найден в контроллере $controllerClass");
        }

        return call_user_func([$controller, $method]);
    }
}
