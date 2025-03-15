<?php


const DB_SYSTEM = "mysql";
const DB_CONFIG = [
    'host' => 'localhost',
    'dbname' => 'gest_voyage',
    'port' => '3306',
    'username' => 'big',
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

function all(
    string $table,
    array $params = [],
    string|null $searchValue = null,
    array $searchColumns = [],
    array $joins = [],
    array $select = ['*'],
    array $orderBy = [],
    array $pagination = []
): array {
    global $db;
    // Build SELECT clause
    $selectClause = implode(', ', $select);

    // Start building the query
    $query = "SELECT {$selectClause} FROM {$table}";
    // Add JOIN clauses if any
    if (!empty($joins)) {
        foreach ($joins as $join) {
            $joinType = $join['type'] ?? 'INNER';
            $joinTable = $join['table'] ?? '';
            $joinCondition = $join['on'] ?? '';

            if ($joinTable && $joinCondition) {
                $query .= " {$joinType} JOIN {$joinTable} ON {$joinCondition}";
            }
        }
    }

    // Handle WHERE conditions from params
    $whereConditions = [];
    $queryParams = [];

    foreach ($params as $column => $value) {
        if (is_array($value)) {
            // Handle special operators like >, <, >=, <=, LIKE, IN
            $operator = $value['operator'] ?? '=';
            $paramValue = $value['value'] ?? null;

            if ($operator === 'IN' && is_array($paramValue)) {
                $placeholders = [];
                foreach ($paramValue as $index => $val) {
                    $placeholderKey = "{$column}_in_{$index}";
                    $placeholders[] = ":{$placeholderKey}";
                    $queryParams[$placeholderKey] = $val;
                }
                $whereConditions[] = "{$column} IN (" . implode(', ', $placeholders) . ")";
            } else {
                $whereConditions[] = "{$column} {$operator} :{$column}";
                $queryParams[$column] = $paramValue;
            }
        } else {
            // Simple equality condition
            $cc = str_replace('.', '_', $column);
            $whereConditions[] = "{$column} = :{$cc}";
            $queryParams[$cc] = $value;
        }
    }

    // Add WHERE clause if conditions exist
    if (!empty($whereConditions)) {
        $query .= " WHERE " . implode(' AND ', $whereConditions);
    }

    // Add search condition if needed
    if ($searchValue !== null && !empty($searchColumns)) {
        $searchQuery = formatBaseSearchRequest($searchColumns);
        if (!empty($whereConditions)) {
            $query .= " AND ({$searchQuery})";
        } else {
            $query .= " WHERE {$searchQuery}";
        }
        $queryParams['searchValue'] = "%" . $searchValue . "%";
    }

    // Add ORDER BY if specified
    if (!empty($orderBy)) {
        $orderClauses = [];
        foreach ($orderBy as $column => $direction) {
            $direction = strtoupper($direction) === 'DESC' ? 'DESC' : 'ASC';
            $orderClauses[] = "{$column} {$direction}";
        }
        if (!empty($orderClauses)) {
            $query .= " ORDER BY " . implode(', ', $orderClauses);
        }
    }

    // Add pagination if specified
    if (!empty($pagination)) {
        $limit = $pagination['limit'] ?? null;
        $offset = $pagination['offset'] ?? null;

        if ($limit !== null) {
            $query .= " LIMIT {$limit}";
            if ($offset !== null) {
                $query .= " OFFSET {$offset}";
            }
        }
    }

    // Prepare and execute the query
    // dd([$queryParams, $query], false);

    $statement = $db->prepare($query);
    $statement->execute($queryParams);

    return $statement->fetchAll();
}


function formatBaseSearchRequest(array $searchColumns): string
{
    $searchConditions = array_map(function ($column) {
        return $column . " LIKE :searchValue";
    }, $searchColumns);

    return implode(" OR ", $searchConditions);
}


function one(
    string $tablee,
    $id,
    string $idColumn = 'id',
    array $joins = [],
    array $select = ['*']
): ?array {
    $qualifiedIdColumn = strpos($idColumn, '.') === false ? "{$tablee}.{$idColumn}" : $idColumn;

    $results = all(
        $tablee,
        [$qualifiedIdColumn => $id],
        null,
        [],
        $joins,
        $select
    );

    return !empty($results) ? $results[0] : null;
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

function delete(string $table, string $column, $value)
{
    global $db;
    //dd([$table, $column, $value]);
    $statment = $db->prepare("DELETE FROM {$table} WHERE {$column} = :{$column}");
    return $statment->execute([$column => $value]);
}
