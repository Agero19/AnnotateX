<?php

namespace routes;

class Route
{
    protected static $routes = [];
    protected static $pathNotFound = null;
    protected static $methodNotAllowed = null;

    public static function get($uri, $action)
    {
        self::addRoute('GET', $uri, $action);
    }


    public static function post($uri, $action)
    {
        self::addRoute('POST', $uri, $action);
    }

    //TODO: Add other HTTP methods (patch, delete)

    protected static function addRoute($method, $uri, $action) {
        self::$routes[] = [
            'method' => $method,
            'uri' => $uri,
            'action' => $action
        ];
    }

    public static function run()
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        // Handle base path
        $scriptName = dirname($_SERVER['SCRIPT_NAME']);
        $requestUri = substr($requestUri, strlen($scriptName));
        $requestUri = $requestUri ?: '/';

        foreach (self::$routes as $route) {
            // Convert route URI to regex pattern
            $pattern = '#^'.preg_replace('/\{(\w+)}/', '(?<$1>[^/]+)', $route['uri']).'$#';

            if ($route['method'] === $requestMethod && preg_match($pattern, $requestUri, $matches)) {
                // Extract named parameters
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);

                // Execute the action
                echo call_user_func_array($route['action'], $params);
                return;
            }
        }
    }

}

// View helper function
if (!function_exists('view')) {
    function view($name, $data = [])
    {
        extract($data);
        ob_start();
        include "views/{$name}.php";
        return ob_get_clean();
    }
}