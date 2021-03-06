<?php

use TeamBuilder\controller\HomeController;
use TeamBuilder\controller\TeamController;
use TeamBuilder\controller\MemberController;
use TeamBuilder\controller\SessionController;

require_once 'vendor/autoload.php';

session_start();
(new SessionController())->createSession();

$action = $_GET['action'] ?? null;
if ($action) {
    switch ($action) {
        case 'create-team':
            (new TeamController())->renderCreateTeam();
            break;
        case 'save-team':
            (new TeamController())->createTeam($_POST['team']);
            break;
        case 'members-list':
            (new MemberController())->membersList();
            break;
        case 'member-teams':
            (new MemberController())->memberTeams();
            break;
        case 'moderators-list':
            (new MemberController())->moderatorsList();
            break;
        case 'team-details':
            isset($_GET['team-id'])
                ? (new TeamController())->teamDetails($_GET['team-id'])
                : (new HomeController())->home();
            break;
        case 'nominate-moderator':
            isset($_GET['member-id'])
                ? (new MemberController())->nominateModerator($_GET['member-id'])
                : (new HomeController())->home();
            break;
        case 'read-profil':
            (new MemberController())->readProfil($_GET['member-id']);
            break;
        case 'edit-profil':
            (new MemberController())->editProfil($_GET['member-id']);
            break;
        case 'save-member':
            (new MemberController())->saveMember($_POST['member']);
            break;
        default:
        case 'home':
            (new HomeController())->home();
            break;
    }
} else {
    (new HomeController())->home();
}
