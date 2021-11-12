<?php

namespace TeamBuilder\model\entity;

class TeamMember extends Member
{

    protected const TABLE_NAME = 'team_member';

    protected int  $member_id;
    protected int  $team_id;
    protected int  $membership_type;
    protected bool $is_captain;

    /**
     * Retrieve a team member from the database with composite keys.
     *
     * @param int $teamId   The team ID of the member team.
     * @param int $memberId The member ID of the member team.
     *
     * @return Entity|null The team member entity.
     */
    public static function findComposite(int $teamId, int $memberId): ?Entity
    {
        $query = "SELECT * FROM team_member WHERE member_id=:member_id AND team_id=:team_id";
        $queryArray = ['team_id' => $teamId, 'member_id' => $memberId];
        $result = self::createDatabase()->fetchOne($query, TeamMember::class, $queryArray);

        return $result ?: null;
    }
}
