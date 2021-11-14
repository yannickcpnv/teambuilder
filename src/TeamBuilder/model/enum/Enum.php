<?php

namespace TeamBuilder\model\enum;

use ReflectionClass;

abstract class Enum
{

    private function __construct() { }

    /**
     * Get enum description from a value.
     *
     * @param int $value Value to math the enum.
     *
     * @return mixed The match from the value.
     */
    abstract public static function fromValue(int $value);

    public static function getValues(): array
    {
        return (new ReflectionClass(static::class))->getConstants();
    }
}
