<?php

namespace TeamBuilder\model\entity;

class Team extends Entity
{

    //region Fields

    protected const TABLE_NAME = 'teams';

    protected string $name;
    protected int    $state_id;

    //endregion

    //region Methods
    public function getMembers(): array
    {
        $query = "
            SELECT m.id, m.name, m.password, m.role_id, tm.is_captain, tm.membership_type
            FROM teams as t
                INNER JOIN team_member tm on t.id = tm.team_id
                INNER JOIN members m on tm.member_id = m.id
            WHERE t.id=:id
            GROUP BY m.id
        ";
        $queryArray = ['id' => $this->id];

        return self::createDatabase()->fetchRecords($query, TeamMember::class, $queryArray);
    }

    public function getCaptain()
    {
        $query = "
            SELECT m.id, m.name, m.password, m.role_id, tm.is_captain, tm.membership_type
            FROM team_member tm
                INNER JOIN members m on tm.member_id = m.id
            WHERE tm.team_id=$this->id AND is_captain = 1
        ";

        return self::createDatabase()->fetchOne($query, TeamMember::class);
    }
    //endregion
}
