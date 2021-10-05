<?php

use TeamBuilder\controller\HomeController;
use TeamBuilder\controller\SessionController;

require_once 'vendor/autoload.php';

session_start();
if (isset($_SESSION['web-user-id'])) {
    (new SessionController())->createSession();
}

$action = $_GET['action'] ?? null;
if ($action) {
    switch ($action) {
        case 'home':
        default:
            (new HomeController())->home();
            break;
    }
} else {
    (new HomeController())->home();
}
