<?php

namespace Core;

class Router
{
    private array $routes = [];

    public function get(string $route, string $file)
    {
        $this->routes['GET'][$route] = $file;
    }

    public function post(string $route, string $file)
    {
        $this->routes['POST'][$route] = $file;
    }

    public function put(string $route, string $file)
    {
        $this->routes['PUT'][$route] = $file;
    }

    public function delete(string $route, string $file)
    {
        $this->routes['DELETE'][$route] = $file;
    }

    private function cleanUri(string $uri): string
    {
        // Remove `/api` prefix
        return preg_replace('#^/api#', '', $uri);
    }


    //TODO: fix the issue with request uri getting != on /route because compare literal
    public function run()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = $this->cleanUri($uri); // Remove `/api` prefix

        if (isset($this->routes[$method][$uri])) {
            require __DIR__ . '/../' . $this->routes[$method][$uri];
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Route not found']);
        }
    }
}
