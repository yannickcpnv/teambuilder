<?php

namespace TeamBuilder\model;

use TeamBuilder\config\Conf;
use PHPUnit\Framework\TestCase;

class DatabaseTest extends TestCase
{

    private Database $database;
    private string   $query;

    public function __construct()
    {
        parent::__construct();

        $dsn = Conf::DB_SQL_DRIVER .
               ':host=' . Conf::DB_HOSTNAME .
               ';dbname=' . Conf::DB_NAME .
               ';port=' . Conf::DB_PORT .
               ';charset=' . Conf::DB_CHARSET;
        $this->database = new Database($dsn, Conf::DB_USER_NAME, Conf::DB_USER_PWD);
        $sqlFilePath = file_get_contents(dirname(__DIR__, 2) . '/sql/create_teambuilder_and_inserts.sql');
        $this->database->executeQuery($sqlFilePath);
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
        $this->query = "SELECT * FROM roles where slug = :slug";
        $expectedRoleName = "Moderator";

        /* When */
        $result = $this->database->fetchOne($this->query, ["slug" => "MOD"]);

        /* Then */
        $this->assertEquals($expectedRoleName, $result["name"]);
    }

    public function testInsert_slugWithName_rowId()
    {
        /* Given */
        $this->query = "UPDATE roles set name = :name WHERE slug = :slug";
        $expectedRowCount = 2;

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
