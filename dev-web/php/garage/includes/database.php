<?php

const DB_SYSTEM = "mysql";
const DB_CONFIG = [
    'host' => 'localhost',
    'dbname' => 'garage',
    // 'port' => '3306',
];


function connectToDb($db_system = DB_SYSTEM, array $config = DB_CONFIG, string $username = 'big', string $password = 'Big@big1')
{
    $db_config_format =  http_build_query($config, "", ";");
    $dns = "$db_system:$db_config_format";
    //  dd($dns);
    return new PDO($dns, $username, $password, [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
}

function getAll($bdConnection, $query, array $params = [])
{
    $statment = $bdConnection->prepare($query);
    $statment->execute($params);
    return $statment->fetchAll();
}
function getOne($bdConnection, $query, array $params = [])
{
    $statment = $bdConnection->prepare($query);
    $statment->execute($params);
    dd($statment->fetch());
    return $statment->fetch();
}

function storeNew($bdConnection, $query, array $params = [])
{
    $statment = $bdConnection->prepare($query);
    return $statment->execute($params);
}
