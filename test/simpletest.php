<?php
/**
 * File : simpletest.php
 * Author : X. Carrel
 * Created : 14.09.21
 * Modified last :
 **/

$rootDir = dirname(__DIR__, 1) . DIRECTORY_SEPARATOR;

require $rootDir . 'src/model/Database.php';
require $rootDir . 'config/env.php';

$dsn = DB_SQL_DRIVER . ':host=' . DB_HOSTNAME . ';dbname=' . DB_NAME . ';port=' . DB_PORT . ';charset=' . DB_CHARSET;
$database = new Database($dsn, DB_USER_NAME, DB_USER_PWD);

echo "\n>>>>> Test selectMany:\n";
$res = $database->fetchRecords("SELECT * FROM roles", []);
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

$database->execute(file_get_contents($rootDir . 'sql/create_teambuilder_and_inserts.sql'));

echo "\nDone\n";
