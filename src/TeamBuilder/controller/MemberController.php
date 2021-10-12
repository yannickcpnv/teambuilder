<?php

namespace TeamBuilder\controller;

use TeamBuilder\model\ArrayHelpers;
use TeamBuilder\model\entity\Member;

class MemberController
{

    public function membersList()
    {
        $members = ArrayHelpers::sortObjects(Member::all(), 'name');

        require 'src/TeamBuilder/views/members-list.php';
    }

    public function memberTeams()
    {
        $member = (new SessionController())->getUser();
        $teams = ArrayHelpers::sortObjects($member->getTeams(), 'name');

        require 'src/TeamBuilder/views/member-teams.php';
    }
}
