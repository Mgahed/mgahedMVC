<?php

namespace MgahedMvc\Database\Managers;


use App\Models\Model;
use MgahedMvc\Database\Grammars\MySQLGrammer;
use MgahedMvc\Database\Managers\Contracts\DatabaseManager;

class MySQLManager implements DatabaseManager
{
    protected static $instance;

    public function connect(): \PDO
    {
        if (!self::$instance) {
            self::$instance = new \PDO(
                env('DB_DRIVER') . ':host=' . env('DB_HOST') . ';dbname=' . env('DB_DATABASE'),
                env('DB_USERNAME'),
                env('DB_PASSWORD')
            );
        }
        return self::$instance;
    }

    public function query(string $query, $values = [])
    {
        $stmt = self::$instance->prepare($query);
        foreach ($values as $key => $value) {
            $stmt->bindValue($key + 1, $value);
        }
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $query = MySQLGrammer::buildInsertQuery(array_keys($data));
        $stmt = self::$instance->prepare($query);
        for ($i = 1; $i <= count($values = array_values($data)); $i++) {
            $stmt->bindValue($i, $values[$i - 1]);
        }

        return $stmt->execute();
    }

    public function read($columns = '*', $filter = null)
    {
        $query = MySQLGrammer::buildSelectQuery($columns, $filter);
        $stmt = self::$instance->prepare($query);
        if ($filter) {
            $stmt->bindValue(1, $filter[2]);
        }
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function update($id, $data)
    {
        $query = MySQLGrammer::buildUpdateQuery(array_keys($data));
        $stmt = self::$instance->prepare($query);
        $values = array_values($data);
        for ($i = 1; $i <= count($values); $i++) {
            $stmt->bindValue($i, $values[$i - 1]);
        }
        $stmt->bindValue(count($values) + 1, $id);
        return $stmt->execute();
    }

    public function delete($id)
    {
        $query = MySQLGrammer::buildDeleteQuery();
        $stmt = self::$instance->prepare($query);
        $stmt->bindValue(1, $id);
        return $stmt->execute();
    }
}