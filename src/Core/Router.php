<?php /** @noinspection SpellCheckingInspection */

// src/Core/Router.php

namespace Core;

class Router {
    // Хранит список зарегистрированных маршрутов
    protected $routes = [];
    protected $config = [];

    public function __construct(array $config = []) {
        $this->config = $config;
    }

    public function get($uri, $action) {
        $this->addRoute('GET', $uri, $action);
    }

    public function post($uri, $action) {
        $this->addRoute('POST', $uri, $action);
    }

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

    public function dispatch($requestedUri, $requestedMethod) {
        $uri = parse_url($requestedUri, PHP_URL_PATH);
        $uri = rtrim($uri);
        if ($uri === '') {
            $uri = '/';
        }
        //TODO: Rewrite concatenation of index page path as a static or some other way
        foreach ($this->routes as $route) {
            if ($route['method'] === $requestedMethod && $route['uri'] === $uri) {
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

    protected function callAction($action) {
        // Ожидается формат "Controller@method"
        list($controllerName, $method) = explode('@', $action);
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
