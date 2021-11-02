<?php

namespace TeamBuilder\controller;

use TeamBuilder\model\ArrayHelpers;
use TeamBuilder\model\entity\Member;
use TeamBuilder\model\enums\RoleEnum;

class MemberController
{

    /**
     * Render the list of members.
     */
    public function membersList()
    {
        $members = ArrayHelpers::sortObjects(Member::all(), 'name');

        require 'src/TeamBuilder/views/members-list.php';
    }

    /**
     * Render the list of team of the connected member.
     */
    public function memberTeams()
    {
        $member = (new SessionController())->getUser();
        $teams = ArrayHelpers::sortObjects($member->getTeams(), 'name');

        require 'src/TeamBuilder/views/member-teams.php';
    }

    /**
     * Render the list of moderators.
     */
    public function moderatorsList()
    {
        $moderators = ArrayHelpers::sortObjects(Member::whereRoleSlug('MOD'), 'name');

        require 'src/TeamBuilder/views/moderators-list.php';
    }

    /**
     * Nominate a member to be moderator and render the list of moderator.
     */
    public function nominateModerator(int $memberId)
    {
        $member = Member::find($memberId);
        $member->role_id = RoleEnum::MOD;
        $member->save();

        self::moderatorsList();
    }
}
