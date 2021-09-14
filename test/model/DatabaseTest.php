<?php

namespace TeamBuilder\test\model;

use Database;
use PHPUnit\Framework\TestCase;
use TeamBuilder\env;

class DatabaseTest extends TestCase
{

    private Database $database;
    private string $query;

    public function __construct()
    {
        parent::__construct();

        $dsn = DB_SQL_DRIVER .
               ':host=' . DB_HOSTNAME .
               ';dbname=' . DB_NAME .
               ';port=' . DB_PORT .
               ';charset=' . DB_CHARSET;
        $this->database = new Database($dsn, DB_USER_NAME, DB_USER_PWD);
        $this->database->execute(file_get_contents('sql/create_teambuilder_and_inserts.sql'));
    }

    public function testFetchRecords_roles_allRoles()
    {
        /* Given */
        $this->query = "SELECT * FROM roles";
        $expectedRowCount = 2;

        /* When */
        $result = $this->database->fetchRecords($this->query);

        /* Then */
        $this->assertCount($expectedRowCount, $result);
    }

    public function testFetchOne_roleWhereSlugMug_allRoles()
    {
        /* Given */


        /* When */
        /* Then */
    }

    public function testInsert_slugWithName_rowId()
    {
        /* Given */

        /* When */
        /* Then */
    }

    public function testUpdate_roleWithName_rowCount()
    {
        /* Given */

        /* When */
        /* Then */
    }
}
