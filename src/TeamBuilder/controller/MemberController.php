<?php

namespace TeamBuilder\controller;

use TeamBuilder\model\ArrayHelpers;
use TeamBuilder\model\enum\RoleEnum;
use TeamBuilder\model\entity\Member;
use TeamBuilder\model\exception\ExistingValueException;

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

    /**
     * Call the view to show profil page in read mode.
     *
     * @param int $memberId The ID of the member to display details.
     */
    public function readProfil(int $memberId)
    {
        $member = Member::find($memberId);
        $teams = $member->getTeams();
        $teamsWhereIsCaptain = array_filter($teams, function ($team) use ($member) {
            return $team->getCaptain()->id === $member->id;
        });
        $teamsWhereIsNotCaptain = array_filter($teams, function ($team) use ($member) {
            return $team->getCaptain()->id !== $member->id;
        });

        require 'src/TeamBuilder/views/profil-read.php';
    }

    /**
     * Call the view to show profil page in edit mode.
     *
     * @param int $memberId The ID of the member to edit details.
     */
    public function editProfil(int $memberId)
    {
        $member = Member::find($memberId);

        require 'src/TeamBuilder/views/profil-edit.php';
    }

    /**
     * Save a member passed in form.
     *
     * @param array $memberForm The member to save in the database.
     */
    public function saveMember(array $memberForm)
    {
        $connectedMember = (new SessionController())->getUser();
        $memberAsArray = ['id' => $memberForm['id']];
        $memberAsArray = $connectedMember->isModerator()
            ? array_merge($memberAsArray, [
                'role_id'   => $memberForm['role'],
                'status_id' => $memberForm['status'],
            ])
            : array_merge($memberAsArray, [
                'name' => $memberForm['name'],
            ]);

        $member = Member::make($memberAsArray);

        try {
            $member->save();
            $successMessage = "Le membre a bien été sauvegardé";
        } catch (ExistingValueException $e) {
            $errorMessage = $e->getMessage();
        }

        $member = Member::find($memberForm['id']);

        require 'src/TeamBuilder/views/profil-edit.php';
    }
}
