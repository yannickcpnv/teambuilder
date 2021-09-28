<?php

namespace TeamBuilder\model;

use PDOException;
use TeamBuilder\config\Conf;
use JetBrains\PhpStorm\Pure;
use phpDocumentor\Reflection\Types\This;

class Member
{

    //region Fields

    public int    $id;
    public string $name;
    public string $password;
    public int    $role_id;

    //endregion

    //region Methods

    public static function make(array $fields): Member
    {
        $member = new Member();

        foreach ($fields as $key => $value) {
            if (property_exists(self::class, $key)) {
                $member->$key = $value;
            }
        }

        return $member;
    }

    public static function all(): array
    {
        return self::createDatabase()->fetchRecords("SELECT * FROM members");
    }

    public static function find(int $id): ?Member
    {
        $result = self::createDatabase()->fetchOne("SELECT * FROM members WHERE id=:id", ["id" => $id]);

        return $result ? self::make($result) : null;
    }

    public static function where(string $searched, int $id): array
    {
        return [];
    }

    public static function destroy(int $id): bool
    {
        $query = "DELETE FROM members WHERE id=:id";
        try {
            self::createDatabase()->delete($query, ["id" => $id]);
            return true;
        } catch (PDOException) {
            return false;
        }
    }

    public function create(): bool
    {
        $query = "
            INSERT INTO members (name, password, role_id) 
            VALUES (:name, :password, :role_id)
        ";

        try {
            $this->id = self::createDatabase()->insert($query, (array)$this);
            return true;
        } catch (PDOException) {
            return false;
        }
    }

    public function save(): bool
    {
        $query = "
            UPDATE members
            SET name=:name, password=:password, role_id=:role_id
            WHERE id=:id
        ";

        try {
            self::createDatabase()->update($query, (array)$this);
            return true;
        } catch (PDOException) {
            return false;
        }
    }

    public function delete(): bool
    {
        return self::destroy($this->id);
    }

    private static function createDatabase(): Database
    {
        return new Database(Conf::getDsn(), Conf::DB_USER_NAME, Conf::DB_USER_PWD);
    }

    //endregion
}
