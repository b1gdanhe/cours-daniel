<?php

$routes = [
    '/' => 'controllers/clients/index.php',
    '/clients/create' => 'controllers/clients/create.php',
    '/clients/edit' => 'controllers/clients/edit.php',
    '/clients/show' => 'controllers/clients/show.php',

    '/garages' => 'controllers/garages/index.php',
    '/garages/create' => 'controllers/garages/create.php',
    '/garages/edit' => 'controllers/garages/edit.php',
    '/garages/show' => 'controllers/garages/show.php',

    '/cars' => 'controllers/cars/index.php',
    '/cars/create' => 'controllers/cars/create.php',
    '/cars/edit' => 'controllers/cars/edit.php',
    '/cars/show' => 'controllers/cars/show.php',
];

$uri  = parse_url($_SERVER['REQUEST_URI'])['path'];
if (array_key_exists($uri, $routes)) {
    require $routes[$uri];
} else {
    require 'controllers/404.php';
}


function isCurrentUrl($currentUrl, $menuUrl)
{
    return $currentUrl === $menuUrl;
}
