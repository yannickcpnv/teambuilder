<?php

namespace TeamBuilder\model\entity;

class TeamMember extends Member
{

    protected int $member_id;
    protected int $team_id;
    protected int $membership_type;
    protected int $is_captain;
}
