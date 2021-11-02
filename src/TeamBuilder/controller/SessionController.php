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
        $_SESSION['web-user'] = serialize(Member::find($_ENV['WEB_USER_ID']));
    }

    /**
     * Get the connected member.
     *
     * @return Member the connected member.
     */
    public function getUser(): Member
    {
        return unserialize($_SESSION['web-user']);
    }
}
