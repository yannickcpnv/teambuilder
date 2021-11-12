<?php

namespace TeamBuilder\controller;

use TeamBuilder\model\entity\Team;
use TeamBuilder\model\exception\ExistingTeamNameException;

class TeamController
{

    public function showCreateTeam()
    {
        require 'src/TeamBuilder/views/create_team.php';
    }

    public function createTeam(array $teamForm)
    {
        try {
            Team::make(['name' => $teamForm['name']])->create((new SessionController())->getUser());
        } catch (ExistingTeamNameException $e) {
            $errorMessage = $e->getMessage();
            require 'src/TeamBuilder/views/create_team.php';
        }

        (new MemberController())->memberTeams();
    }

    /**
     * Render details of a team.
     *
     * @param int $teamId The ID of the team.
     */
    public function teamDetails(int $teamId)
    {
        $team = Team::find($teamId);

        require 'src/TeamBuilder/views/team-details.php';
    }
}
