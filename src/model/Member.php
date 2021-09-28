<?php

namespace TeamBuilder\model;

use PDOException;
use TeamBuilder\config\Conf;
use JetBrains\PhpStorm\Pure;

class Member extends Model
{

    //region Fields

    public int    $id;
    public string $name;
    public string $password;
    public int    $role_id;

    //endregion

    //region Methods

    /**
     * Make a member instance from an array of fields.
     *
     * @param array $fields - The array of fields.
     *
     * @return Member The new member with fields.
     */
    #[Pure] public static function make(array $fields): Member
    {
        $member = new Member();

        foreach ($fields as $key => $value) {
            if (property_exists(self::class, $key)) {
                $member->$key = $value;
            }
        }

        return $member;
    }

    /**
     * Retrieve all members from database.
     *
     * @return array An array of all members.
     */
    public static function all(): array
    {
        return self::createDatabase()->fetchRecords("SELECT * FROM members");
    }

    /**
     * Retrieve one member from an ID.
     *
     * @param int $id The ID.
     *
     * @return Member|null A member if success, otherwise null.
     */
    public static function find(int $id): ?Member
    {
        $result = self::createDatabase()->fetchOne("SELECT * FROM members WHERE id=:id", ["id" => $id]);

        return $result ? self::make($result) : null;
    }

    /**
     * Search a member where value equal column.
     *
     * @param string $column The column.
     * @param int    $value  The value searched.
     *
     * @return array An array of members founds, empty if not found.
     */
    public static function where(string $column, int $value): array
    {
        $query = "SELECT * FROM members WHERE $column = :id";

        return self::createDatabase()->fetchRecords($query, ["id" => $value]);
    }

    /**
     * Delete the members corresponding the ID.
     *
     * @param int $id The ID.
     *
     * @return bool True is success, false on failure.
     */
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

    /**
     * Create a new member in the database.
     *
     * @return bool True is success, false on failure.
     */
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

    /**
     * Save the member in the database.
     *
     * @return bool True is success, false on failure.
     */
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

    /**
     * Delete the member in the database.
     *
     * @return bool True is success, false on failure.
     */
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
