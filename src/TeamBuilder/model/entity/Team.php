<?php

namespace TeamBuilder\model\entity;

class Team extends Entity
{

    //region Fields

    protected const TABLE_NAME = 'teams';

    protected string $name;
    protected int    $state_id;

    //endregion
}
