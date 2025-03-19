<?php

namespace Database\Connection;

use PDO;

class Connection
{
    private function __construct() {}

    protected static function connectToDb(): PDO
    {
        $data = require_once base_path('includes/config.php')['db'];
        dd($data);
        return new PDO('', '', '');
    }
}
