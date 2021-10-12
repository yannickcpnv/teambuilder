<?php

namespace TeamBuilder\model\entity;

class Member extends Entity
{

    //region Fields

    protected const TABLE_NAME = 'members';

    protected string $name;
    protected string $password;
    protected int    $role_id;

    //endregion

    //region Methods

    /**
     * Get all teams of the member.
     *
     * @return Team[] An array of team.
     */
    public function getTeams(): array
    {
        $query = "
            SELECT t.id, t.name, t.state_id
            FROM members as m
                 INNER JOIN team_member tm on m.id = tm.member_id
                 INNER JOIN teams t on tm.team_id = t.id
            WHERE m.id=:id
        ";
        $queryArray = ['id' => $this->id];

        return self::createDatabase()->fetchRecords($query, Team::class, $queryArray);
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

        return self::createDatabase()->fetchRecords($query, Member::class, ["id" => $value]);
    }

    //endregion
}
