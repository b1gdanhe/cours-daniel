<?php

use WpOrg\Requests\Autoload;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$_SESSION['flash'];

const BASE_PATH = __DIR__ . '/../';
const APP_PATH = __DIR__ . '/../app/';
require APP_PATH . 'core/helpers.php';
require app_path('core/Autoloader.php');

$autoloader  = new Autoloader();
$autoloader->register();

require app_path('core/routes.php');
