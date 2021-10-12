<?php

use TeamBuilder\controller\HomeController;
use TeamBuilder\controller\TeamController;
use TeamBuilder\controller\MemberController;
use TeamBuilder\controller\SessionController;

require_once 'vendor/autoload.php';

session_start();
if (!isset($_SESSION['web-user'])) {
    (new SessionController())->createSession();
}

$action = $_GET['action'] ?? null;
if ($action) {
    switch ($action) {
        case 'home':
        default:
            (new HomeController())->home();
            break;
        case 'members-list':
            (new MemberController())->membersList();
            break;
        case 'member-teams':
            (new MemberController())->memberTeams();
            break;
        case 'team-details':
            isset($_GET['team-id'])
                ? (new TeamController())->teamDetails($_GET['team-id'])
                : (new HomeController())->home();
            break;
    }
} else {
    (new HomeController())->home();
}
