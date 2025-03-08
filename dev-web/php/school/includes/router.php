<?php

$routes = [
    '/' => 'controllers/students/index.php',
    '/students/create' => 'controllers/students/create.php',
    '/students/edit' => 'controllers/students/edit.php',
    '/students/show' => 'controllers/students/show.php',
    '/filiers' => 'controllers/filiers/index.php',
    '/filiers/create' => 'controllers/filiers/create.php',
    '/filiers/edit' => 'controllers/filiers/edit.php',
    '/filiers/show' => 'controllers/filiers/show.php',
];

$uri  = parse_url($_SERVER['REQUEST_URI'])['path'];
if (array_key_exists($uri, $routes)) {
    require $routes[$uri];
} else {
    require 'controllers/404.php';
}
