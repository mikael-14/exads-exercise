<?php

namespace ExadsExercises\Infrastructure\Database;

use Exception;

class DB
{
    /**
     * @var ?self $instance Singleton instance
     */
    private static ?self $instance = null;
    /**
     * @var array connection string configuration
     */
    private array $connectionString = [];
    /**
     * @var \PDO|null PDO instance
     */
    private ?\PDO $pdo = null;
    /**
     * Get singleton instance
     *
     * @return static
     */
    public function __construct()
    {
        $this->connectionString = [
            "mysql:host={$_SERVER['DB_HOST']};dbname={$_SERVER['DB_DATABASE']}",
            $_SERVER['DB_USER'],
            $_SERVER['DB_PASSWORD']
        ];
    }
    public static function instance(): self
    {
        if (self::$instance === null) {
            return self::$instance = new self();
        }
        return self::$instance;
    }
    public function insert(string $table, array $data)
    {
        $this->connect();
        //remove empty values
        $data = array_filter($data);
        // Prepare the SQL query
        $columns = implode(", ", array_keys($data));
        $values = ":" . implode(", :", array_keys($data));
        $sql = "INSERT INTO $table ($columns) VALUES ($values)";

        // Execute the prepared statement
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($data);
            return true;
        } catch (\PDOException $e) {
            throw new Exception($e->getMessage());
        }
        // Close the connection
        $this->disconnect();
    }
    public function select($table, $columns = "*", $where = [], $type = "AND")
    {
        $this->connect();

        // Prepare the SQL query
        $whereClause = "";
        if (!empty($where)) {
            $whereClause = " WHERE ";
            $conditions = [];
            foreach ($where as $key => $value) {
                $conditions[] = "$key = :$key";
            }
            $whereClause .= implode(" {$type} ", $conditions);
        }

        $sql = "SELECT $columns FROM $table $whereClause";

        // Execute the prepared statement
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($where);

            // Fetch the results as an associative array
            $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            // You can do something with the $results array, e.g., return it or process it further
            return $results;
        } catch (\PDOException $e) {
            throw new Exception('An error occurred ' . $e->getMessage());
        }
        // Close the connection
        $this->disconnect();
        return true;
    }
    public function selectInnerJoin($table1, $table2, $joinCondition, $columns = "*",  $where = [], $order = null)
    {
        $this->connect();
        // Prepare the SQL query
          //remove empty values
          $where = array_filter($where);
        $whereClause = "";
        if (!empty($where)) {
            $whereClause = " WHERE ";
            $conditions = [];
            foreach ($where as $key => $value) {
                $conditions[] = "$key = :$key";
            }
            $whereClause .= implode(" AND ", $conditions);
        }
        $sql = "SELECT $columns FROM $table1 
                Inner JOIN $table2 ON $joinCondition
                $whereClause";
        if (!$order)
            $sql .= " ORDER BY {$order}";

        // Execute the prepared statement
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($where);

            // Fetch the results as an associative array
            $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            // You can do something with the $results array, e.g., return it or process it further
            return $results;
        } catch (\PDOException $e) {
            throw new Exception('An error occurred ' . $e->getMessage());
        }
        $this->disconnect();
    }

    private function connect()
    {
        //no need to connect
        if ($this->pdo !== null)
            return;
        try {
            $this->pdo = new \PDO($this->connectionString[0], $this->connectionString[1], $this->connectionString[2]);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            throw new Exception("Connection failed: " . $e->getMessage());
        }
    }
    private function disconnect()
    {
        $this->pdo = null;
    }
}
