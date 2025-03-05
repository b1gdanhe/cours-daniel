<?php

$routes = [
    '/' => 'controllers/create.php',
    '/list' => 'controllers/list.php',
    '/detail' => 'controllers/detail.php',
    '/edit' => 'controllers/edit.php',
];

$uri  = parse_url($_SERVER['REQUEST_URI'])['path'];
if (array_key_exists($uri, $routes)) {
    require $routes[$uri];
} else {
    require 'controllers/404.php';
}
