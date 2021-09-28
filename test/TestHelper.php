<?php

namespace TeamBuilder\test;

use PDO;
use TeamBuilder\config\Conf;

class TestHelper
{

    public static function createDatabase()
    {
        $connection = new PDO(Conf::getDsn(), Conf::DB_USER_NAME, Conf::DB_USER_PWD);
        $query = file_get_contents(dirname(__DIR__) . '/sql/create_teambuilder_and_inserts.sql');
        $connection->exec($query);
    }
}
