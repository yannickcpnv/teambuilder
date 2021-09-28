<?php
/**
 * File : simpletest.php
 * Author : X. Carrel
 * Created : 14.09.21
 * Modified last :
 **/

namespace TeamBuilder\model;

require '../../vendor/autoload.php';

$database = new Database($_ENV['DB_DSN'], $_ENV['DB_USER_NAME'], $_ENV['DB_USER_PWD']);

$sqlFilePath = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR;
$database->executeQuery(file_get_contents($sqlFilePath));

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

echo "\nDone\n";
