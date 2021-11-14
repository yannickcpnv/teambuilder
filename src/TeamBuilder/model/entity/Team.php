<?php

namespace TeamBuilder\model\entity;

use PDOException;
use TeamBuilder\model\exception\ExistingValueException;

class Team extends Entity
{

    //region Fields

    protected const TABLE_NAME = 'teams';

    protected string $name;
    protected int    $state_id;

    //endregion

    //region Methods
    public static function make(array $fields): Team
    {
        $fields['state_id'] = 1;
        return parent::make($fields);
    }

    /**
     * Get all members of the team.
     *
     * @return array All the members.
     */
    public function getTeamMembers(): array
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

    /**
     * Get the team.
     *
     * @return false|Entity The captain.
     */
    public function getCaptain(): bool|Entity
    {
        $query = "
            SELECT m.id, m.name, m.password, m.role_id, tm.is_captain, tm.membership_type
            FROM team_member tm
                INNER JOIN members m on tm.member_id = m.id
            WHERE tm.team_id=$this->id AND is_captain = 1
        ";

        return self::createDatabase()->fetchOne($query, TeamMember::class);
    }

    /**
     * Create a new team in the database.
     *
     * @param Member|null $connectedMember
     *
     * @return bool
     * @throws ExistingValueException Throw an exception if the name of the team
     */
    public function create(Member $connectedMember = null): bool
    {
        try {
            if (!parent::create()) {
                return false;
            }
        } catch (PDOException $e) {
            if ($e->errorInfo[1] == 1062) {
                throw new ExistingValueException("Le nom de cette équipe existe déjà !");
            }
            throw $e;
        }

        $teamMember = TeamMember::make(
            [
                'member_id' => $connectedMember->id,
                'team_id' => $this->id,
                'membership_type' => 1,
                'is_captain' => true,
            ]
        );

        return $teamMember->create();
    }
    //endregion
}
