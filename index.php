<?php

use TeamBuilder\controller\HomeController;
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
    }
} else {
    (new HomeController())->home();
}
