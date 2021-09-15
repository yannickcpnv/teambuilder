<?php
/**
 * File : simpletest.php
 * Author : X. Carrel
 * Created : 14.09.21
 * Modified last :
 **/

namespace TeamBuilder\model;

use TeamBuilder\config\Conf;

require '../../vendor/autoload.php';

$dsn = Conf::DB_SQL_DRIVER .
       ':host=' . Conf::DB_HOSTNAME .
       ';dbname=' . Conf::DB_NAME .
       ';port=' . Conf::DB_PORT .
       ';charset=' . Conf::DB_CHARSET;
$database = new Database($dsn, Conf::DB_USER_NAME, Conf::DB_USER_PWD);

echo "\n>>>>> Test selectMany:\n";
$res = $database->fetchRecords("SELECT * FROM roles");
var_dump($res);

echo "\n>>>>> Test selectOne:\n";
$res = $database->fetchOne("SELECT * FROM roles where slug = :slug", ["slug" => "MOD"]);
var_dump($res);

echo "\n>>>>> Test insert:\n";
$res = $database->insert(
    "INSERT INTO roles(slug,name) VALUES (:slug, :name)",
    ["slug" => "XXX", "name" => "Slasher"]
);
var_dump($res);

echo "\n>>>>> Test update:\n";
$res = $database->update(
    "UPDATE roles set name = :name WHERE slug = :slug",
    ["slug" => "XXX", "name" => "Correcteur"]
);
var_dump($res);

$sqlFilePath = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . "sql/create_teambuilder_and_inserts.sql";
$database->executeQuery(file_get_contents($sqlFilePath));

echo "\nDone\n";
