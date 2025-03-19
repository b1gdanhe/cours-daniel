<?php

use Database\Connection;
use PDO;

class DB
{
    public PDO $db;

    public function __construct(Connection $connetion) {}
    public static function table(string $table) { }

    public function query() {}
}
