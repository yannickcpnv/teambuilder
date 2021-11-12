<?php

namespace TeamBuilder\model\exception;

class ExistingTeamNameException extends \Exception
{

    protected $message = 'Le nom de cette équipe existe déjà !';
}
