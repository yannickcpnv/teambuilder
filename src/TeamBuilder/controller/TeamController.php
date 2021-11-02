<?php

namespace TeamBuilder\controller;

use TeamBuilder\model\entity\Team;

class TeamController
{

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
