<?php

class Router
{
    private array $routes  = [
        'GET' => [],
        'POST' => [],
    ];

    public function __construct() {}

    public function get($url, $controller, $action)
    {

        if (isset($this->routes['GET'][$url]) && !empty(($this->routes['GET'][$url]))) {
            dd('Routes already exists');
        }
        $this->routes['GET'][$url] = [
            'controller' => $controller,
            'action' => $action,
        ];
    }

    public function post($url, $controller, $action)
    {

        if (isset($this->routes['POST'][$url]) && !empty(($this->routes['POST'][$url]))) {
            dd('Routes already exists');
        }
        $this->routes['POST'][$url] = [
            'controller' => $controller,
            'action' => $action,
        ];
    }

    public function route()
    {
        $uri = $_SERVER['REQUEST_URI'];

        // Retirer les paramètres de l'URL
        if (strpos($uri, '?') !== false) {
            $uri = substr($uri, 0, strpos($uri, '?'));
        }

        // Retirer les slashes en début et fin d'URL
        $uri = trim($uri, '/');

        // Si l'URI est vide, utiliser '/'
        if (empty($uri)) {
            $uri = '/';
        } else {
            $uri = '/' . $uri;
        }

        $method = $_SERVER['REQUEST_METHOD'];

        if (isset($this->routes[$method][$uri])) {
            $route = $this->routes[$method][$uri];
            $controllerName = $route['controller'];
            $action = $route['action'];

            // Instancier le contrôleur
            $controller = new $controllerName();

            // Appeler l'action
            if (method_exists($controller, $action)) {
                $controller->$action();
            } else {
                $this->showError(404, "Action not found: $action");
            }
        } else {
            $this->showError(404, "Route not found: $uri");
        }
    }

    private function showError($code, $message)
    {
        http_response_code($code);
        controller("$code.php");
        exit;
    }
}
