<?php

namespace TeamBuilder\model\entity;

class Role extends Entity
{

    //region Fields

    protected const TABLE_NAME = 'roles';

    protected string $name;
    protected string $slug;

    //endregion
}
