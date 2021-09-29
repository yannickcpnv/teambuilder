<?php

namespace TeamBuilder;

use PDO;

class TestHelper
{

    public static function createDatabase()
    {
        $connection = new PDO($_ENV['DB_DSN'], $_ENV['DB_USER_NAME'], $_ENV['DB_USER_PWD']);
        $query = file_get_contents(dirname(__DIR__, 2) . '/sql/create_teambuilder_and_inserts.sql');
        $connection->exec($query);
    }
}
