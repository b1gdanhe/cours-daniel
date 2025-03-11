<?php


const DB_SYSTEM = "mysql";
const DB_CONFIG = [
    'host' => 'localhost',
    'dbname' => 'garage_mg',
    'port' => '3306',
    'username' => 'root',
    'password' => 'Big@big1'
];

const PDO_OPTIONS =  [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
];

function connectToDb(
    $db_system = DB_SYSTEM,
    array $config = DB_CONFIG,
    string $username = DB_CONFIG['username'],
    string $password = DB_CONFIG['password']
) {
    $db_config_format =  http_build_query($config, "", ";");
    $dns = "$db_system:$db_config_format";
    return new PDO($dns, $username, $password, PDO_OPTIONS);
}

$db  = connectToDb();

function all($query, array $params = [])
{
    global $db;
    $statment = $db->prepare($query);
    $statment->execute($params);
    return $statment->fetchAll();
}

function one(string $table, string $column, $value)
{
    global $db;
    $statment = $db->prepare("SELECT * FROM  {$table} WHERE {$column} = :{$column}");
    $statment->execute([$column => $value]);
    return $statment->fetch();
}

function storeNew($query, array $params = [])
{
    global $db;
    $statment = $db->prepare($query);
    return $statment->execute($params);
}

function store($table, $queryDatas)
{
    global $db;
    $datas = $queryDatas;
    $columnArray = array_keys($datas);
    $columns = implode(", ", $columnArray);
    $valueMarkArray = [];
    $valueMark = "";

    foreach ($columnArray as $column) {
        $valueMarkArray[] = ":$column";
    };

    $valueMark =  implode(", ", $valueMarkArray);
    $statment = $db->prepare("INSERT INTO {$table} ({$columns}) VALUES ($valueMark)");

    return $statment->execute($datas);
}


function update($table, $queryDatas, $searchColumn, $searchValue)
{
    global $db;
    $datas = $queryDatas;
    $columnArray = array_keys($datas);
    $setColumAndMarkArray = [];
    $setColumAndMark = "";

    foreach ($columnArray as $column) {
        $setColumAndMarkArray[] = "$column = :$column";
    };

    $setColumAndMark =  implode(", ", $setColumAndMarkArray);
    $datas = array_merge($datas, [
        $searchColumn => $searchValue
    ]);
    $statment = $db->prepare("UPDATE {$table} SET {$setColumAndMark} WHERE $searchColumn = :{$searchColumn}");

    return $statment->execute($datas);
}
