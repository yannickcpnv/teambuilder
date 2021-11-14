<?php

namespace TeamBuilder\controller;

use TeamBuilder\model\entity\Team;
use TeamBuilder\model\exception\ExistingValueException;

class TeamController
{

    /**
     * Render the view to create a team.
     */
    public function renderCreateTeam()
    {
        require 'src/TeamBuilder/views/create_team.php';
    }

    /**
     * Create a new team.
     *
     * @param array $teamForm The team form passed by the user.
     */
    public function createTeam(array $teamForm)
    {
        try {
            Team::make(['name' => $teamForm['name']])->create((new SessionController())->getUser());
        } catch (ExistingValueException $e) {
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
