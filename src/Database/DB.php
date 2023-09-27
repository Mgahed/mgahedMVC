<?php
namespace MgahedMvc\Database;

use MgahedMvc\Database\Concerns\ConnectsTo;
use MgahedMvc\Database\Managers\Contracts\DatabaseManager;

class DB
{
    protected DatabaseManager $manager;

    public function __construct(DatabaseManager $manager)
    {
        $this->manager = $manager;
    }

    public function init()
    {
        ConnectsTo::connect($this->manager);
    }

    protected function raw(string $query, $value = [])
    {
        return $this->manager->query($query, $value);
    }

    protected function create(array $data)
    {
        return $this->manager->create($data);
    }

    protected function read($columns = '*', $filters = null)
    {
        return $this->manager->read($columns, $filters);
    }

    protected function update($id, $data)
    {
        return $this->manager->update($id, $data);
    }

    protected function delete($id)
    {
        return $this->manager->delete($id);
    }

    public function __call($name, $arguments)
    {
        if (method_exists($this, $name)) {
            return call_user_func_array([$this, $name], $arguments);
        }
        dump($name, $arguments);
    }
}