<?php

namespace TeamBuilder\controller;

use TeamBuilder\model\entity\Member;

class SessionController
{

    /**
     * Create the session.
     */
    public function createSession()
    {
        $_SESSION['web-user'] = Member::find($_ENV['WEB_USER_ID']);
    }
}
