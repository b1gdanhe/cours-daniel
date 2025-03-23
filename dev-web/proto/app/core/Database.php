<?php

class Database
{
    private static $instance = null;
    private static $connection;
    private static $table;
    private static $primaryKey = 'id';

    private function __construct($config)
    {
        $dsn = "mysql:host={$config['host']};dbname={$config['database']};charset={$config['charset']}";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        try {
            self::$connection = new PDO($dsn, $config['username'], $config['password'], $options);
        } catch (PDOException $e) {
            throw new Exception("Erreur de connexion à la base de données: " . $e->getMessage());
        }
    }

    public static function getInstance(array $config = [])
    {
        if (self::$instance === null) {
            if (count($config) === 0) {
                throw new Exception("Configuration de la base de données requise");
            }
            self::$instance = new self($config);
        }

        return self::$instance;
    }

    public static function getConnection()
    {
        return self::$connection;
    }

    public static function table($table)
    {
        self::$table = $table;
        return self::$instance; // Pour le chaînage des méthodes
    }

    public static function primaryKey($key)
    {
        self::$primaryKey = $key;
        return self::$instance; // Pour le chaînage des méthodes
    }

    public static function query($sql, $params = [])
    {
        $stmt = self::$connection->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    public static function findAll()
    {
        self::checkTableSet();
        
        $sql = "SELECT * FROM " . self::$table;
        $stmt = self::$connection->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function findById($id)
    {
        self::checkTableSet();
        
        $sql = "SELECT * FROM " . self::$table . " WHERE " . self::$primaryKey . " = :id";
        $stmt = self::$connection->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function find($conditions = [], $orderBy = null, $limit = null, $offset = null)
    {
        self::checkTableSet();
        
        $sql = "SELECT * FROM " . self::$table;
        
        // Construire la clause WHERE
        $whereClause = '';
        $params = [];
        
        if (!empty($conditions)) {
            $whereConditions = [];
            foreach ($conditions as $key => $value) {
                $whereConditions[] = "$key = :$key";
                $params[":$key"] = $value;
            }
            $whereClause = " WHERE " . implode(' AND ', $whereConditions);
        }
        
        $sql .= $whereClause;
        
        // Ajouter ORDER BY si spécifié
        if ($orderBy) {
            $sql .= " ORDER BY $orderBy";
        }
        
        // Ajouter LIMIT si spécifié
        if ($limit) {
            $sql .= " LIMIT $limit";
            
            // Ajouter OFFSET si spécifié
            if ($offset) {
                $sql .= " OFFSET $offset";
            }
        }
        
        $stmt = self::$connection->prepare($sql);
        $stmt->execute($params);
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function join($table, $on, $type = 'INNER') {
        self::checkTableSet();
        
        $sql = "SELECT * FROM " . self::$table . " " . strtoupper($type) . " JOIN " . $table . " ON " . $on;
        
        $stmt = self::$connection->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public static function findOne($conditions = [])
    {
        self::checkTableSet();
        
        $result = self::find($conditions, null, 1);
        return isset($result[0]) ? $result[0] : null;
    }

    public static function insert($data)
    {
        self::checkTableSet();
        
        $columns = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));

        $sql = "INSERT INTO " . self::$table . " ({$columns}) VALUES ({$placeholders})";

        $stmt = self::$connection->prepare($sql);
        
        foreach ($data as $key => $value) {
            $stmt->bindValue(":{$key}", $value);
        }
        
        $stmt->execute();

        return self::$connection->lastInsertId();
    }

    public static function update($id, $data)
    {
        self::checkTableSet();
        
        $set = [];
        foreach (array_keys($data) as $column) {
            $set[] = "{$column} = :{$column}";
        }

        $sql = "UPDATE " . self::$table . " SET " . implode(', ', $set) . " WHERE " . self::$primaryKey . " = :id";

        $data['id'] = $id;
        
        $stmt = self::$connection->prepare($sql);
        
        foreach ($data as $key => $value) {
            $stmt->bindValue(":{$key}", $value);
        }

        return $stmt->execute();
    }

    public static function updateWhere($data, $conditions)
    {
        self::checkTableSet();
        
        $set = [];
        foreach (array_keys($data) as $column) {
            $set[] = "{$column} = :{$column}";
        }
        
        $where = [];
        foreach (array_keys($conditions) as $column) {
            $where[] = "{$column} = :where_{$column}";
        }
        
        $sql = "UPDATE " . self::$table . " SET " . implode(', ', $set) . " WHERE " . implode(' AND ', $where);
        
        $params = [];
        foreach ($data as $key => $value) {
            $params[":{$key}"] = $value;
        }
        
        foreach ($conditions as $key => $value) {
            $params[":where_{$key}"] = $value;
        }
        
        $stmt = self::$connection->prepare($sql);
        $stmt->execute($params);
        
        return $stmt->rowCount();
    }

    public static function delete($id)
    {
        self::checkTableSet();
        
        $sql = "DELETE FROM " . self::$table . " WHERE " . self::$primaryKey . " = :id";
        $stmt = self::$connection->prepare($sql);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

    public static function deleteWhere($conditions)
    {
        self::checkTableSet();
        
        $where = [];
        $params = [];
        
        foreach ($conditions as $key => $value) {
            $where[] = "{$key} = :{$key}";
            $params[":{$key}"] = $value;
        }
        
        $sql = "DELETE FROM " . self::$table . " WHERE " . implode(' AND ', $where);
        
        $stmt = self::$connection->prepare($sql);
        $stmt->execute($params);
        
        return $stmt->rowCount();
    }

    public static function count($conditions = [])
    {
        self::checkTableSet();
        
        $sql = "SELECT COUNT(*) as count FROM " . self::$table;
        
        if (!empty($conditions)) {
            $whereConditions = [];
            $params = [];
            
            foreach ($conditions as $key => $value) {
                $whereConditions[] = "$key = :$key";
                $params[":$key"] = $value;
            }
            
            $sql .= " WHERE " . implode(' AND ', $whereConditions);
            
            $stmt = self::$connection->prepare($sql);
            $stmt->execute($params);
        } else {
            $stmt = self::$connection->prepare($sql);
            $stmt->execute();
        }
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'];
    }

    public static function raw($sql, $params = [])
    {
        $stmt = self::$connection->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    private static function checkTableSet()
    {
        if (!self::$table) {
            throw new Exception("Table non définie. Utilisez Database::table('nom_table') avant d'exécuter des opérations.");
        }
    }
}