<?php

namespace TeamBuilder\controller;

use TeamBuilder\model\ArrayHelpers;
use TeamBuilder\model\entity\Member;
use TeamBuilder\model\enums\RoleEnum;

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

    public function moderatorsList()
    {
        $moderators = ArrayHelpers::sortObjects(Member::whereRoleSlug('MOD'), 'name');

        require 'src/TeamBuilder/views/moderators-list.php';
    }

    public function nominateModerator(int $memberId)
    {
        $member = Member::find($memberId);
        $member->role_id = RoleEnum::MOD;
        $member->save();

        $moderators = ArrayHelpers::sortObjects(Member::whereRoleSlug('MOD'), 'name');
        require 'src/TeamBuilder/views/moderators-list.php';
    }
}
