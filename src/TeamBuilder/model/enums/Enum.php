<?php

namespace TeamBuilder\model\enums;

abstract class Enum
{

    private function __construct() { }

    abstract public static function fromValue(int $value);
}
