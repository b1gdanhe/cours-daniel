<?php

const BASE_PATH = __DIR__ . '/../';

function base_path($path): string
{
    return  BASE_PATH . $path;
}

function public_path($path): string
{
    return  $_SERVER['HTTP_HOST'] . '/' .   $path;
}


require base_path('includes/functions.php');
require base_path('includes/database.php');
require base_path('includes/validation.php');
require base_path('includes/router.php');
