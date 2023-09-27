<?php
namespace MgahedMvc\Database\Grammars;

use App\Models\Model;

class MySQLGrammer
{
    public static function buildInsertQuery(array $columns)
    {
        $values = str_repeat('?, ', count($columns));

        return 'INSERT INTO ' . Model::getTableName() . ' (`' . implode('`, `', $columns) . '`) VALUES(' . rtrim($values, ', ') . ')';
    }

    public static function buildSelectQuery($columns = '*', $filter = null)
    {
        $columns = is_array($columns) ? implode(', ', $columns) : $columns;
        $query = "SELECT {$columns} FROM " . Model::getTableName();
        if ($filter) {
            $query .= " WHERE {$filter[0]} {$filter[1]} ?";
        }
        return $query;
    }

    public static function buildUpdateQuery(array $columns)
    {
        $query = "UPDATE " . Model::getTableName() . " SET ";
        foreach ($columns as $column) {
            $query .= "{$column} = ?, ";
        }

        return rtrim($query, ', ') . " WHERE id = ?";
    }

    public static function buildDeleteQuery()
    {
        return "DELETE FROM " . Model::getTableName() . " WHERE id = ?";
    }
}