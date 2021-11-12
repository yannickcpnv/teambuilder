<?php

namespace TeamBuilder\model\entity;

use TeamBuilder\model\enum\RoleEnum;

class Member extends Entity
{

    //region Fields

    protected const TABLE_NAME = 'members';

    protected string $name;
    protected string $password;
    protected int    $role_id;
    protected int    $status_id;

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
     * @param mixed  $value  The value searched.
     *
     * @return Member[] An array of members founds, empty if not found.
     */
    public static function where(string $column, mixed $value): array
    {
        $query = "SELECT * FROM members WHERE $column = :value";

        return self::createDatabase()->fetchRecords($query, Member::class, ["value" => $value]);
    }

    /**
     * Search a member where the slug role equal value.
     *
     * @param string $slug The slug.
     *
     * @return Member[] An array of members founds by slug, empty if not found.
     */
    public static function whereRoleSlug(string $slug): array
    {
        $query = "
            SELECT m.id, m.name, m.password, m.role_id
            FROM members m
                INNER JOIN roles r on m.role_id = r.id
            WHERE slug=:slug
        ";

        return self::createDatabase()->fetchRecords($query, Member::class, ["slug" => $slug]);
    }

    /**
     * Tell if the member is a moderator or not.
     *
     * @return bool True if moderator, false otherwise.
     */
    public function isModerator(): bool
    {
        return $this->role_id == RoleEnum::MOD;
    }
    //endregion
}
