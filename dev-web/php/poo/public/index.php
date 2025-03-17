<?php

const BASE_PATH = __DIR__ . "/../";

function base_path($path): string
{
    return BASE_PATH . $path;
}

require base_path('includes/helpers.php');
require base_path('class/Database.php');
controller('index.php');
