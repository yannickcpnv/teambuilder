<?php

namespace TeamBuilder\controller;

use TeamBuilder\model\entity\Team;

class TeamController
{

    public function teamDetails(int $id)
    {
        $team = Team::find($id);

        require 'src/TeamBuilder/views/team-details.php';
    }
}
