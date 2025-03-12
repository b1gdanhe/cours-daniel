<?php

$routes =  require_once base_path('includes/routes.php');

$uri  = parse_url($_SERVER['REQUEST_URI'])['path'];
if (array_key_exists($uri, $routes)) {
    require $routes[$uri];
} else {
    abort();
}

function abort($code = '404')
{
    require controller("{$code}.php");
}

function isCurrentUrl($currentUrl, $menuUrl)
{
    return $currentUrl === $menuUrl;
}
