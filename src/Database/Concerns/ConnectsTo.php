<?php

namespace MgahedMvc\Database\Concerns;

use MgahedMvc\Database\Managers\Contracts\DatabaseManager;

trait ConnectsTo
{
    public static function connect(DatabaseManager $manager): \PDO
    {
        return $manager->connect();
    }

}