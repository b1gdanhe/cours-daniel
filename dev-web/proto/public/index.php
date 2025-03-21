<?php

use WpOrg\Requests\Autoload;

const BASE_PATH = __DIR__ . '/../';
const APP_PATH = __DIR__ . '/../app/';
require APP_PATH . 'core/helpers.php';
require app_path('core/Autoloader.php');

$autoloader  = new Autoloader();
$autoloader->register();

$router  = new Router();

$router->get('/', 'LivreController', 'index');
$router->route();
