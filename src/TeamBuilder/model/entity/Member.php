<?php

namespace TeamBuilder\model\entity;

use PDOException;

class Member extends Entity
{

    //region Fields

    protected const TABLE_NAME = 'members';

    protected string $name;
    protected string $password;
    protected int    $role_id;

    //endregion

    //region Methods

    public function teams(): array
    {
        return [];
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
    //endregion
}
