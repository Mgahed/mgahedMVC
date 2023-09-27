<?php
namespace MgahedMvc\Database\Managers;

use MgahedMvc\Database\Grammars\MySQLGrammer;
use MgahedMvc\Database\Managers\Contracts\DatabaseManager;

class SQLiteManager implements DatabaseManager
{

    public function connect(): \PDO
    {
        // TODO: Implement connect() method.
    }

    public function query(string $query, $values = [])
    {
        // TODO: Implement query() method.
    }

    public function create($data)
    {
        // TODO: Implement create() method.
    }

    public function read($columns = '*', $filter = null)
    {
        // TODO: Implement read() method.
    }

    public function update($id, $data)
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }
}