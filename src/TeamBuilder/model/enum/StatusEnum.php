<?php

namespace TeamBuilder\model\enum;

use InvalidArgumentException;

class StatusEnum extends Enum
{

    public const ACTIVE   = 1;
    public const INACTIVE = 2;
    public const BANNED   = 3;

    public static function fromValue(int $value): string
    {
        return match ($value) {
            self::ACTIVE => 'Actif',
            self::INACTIVE => 'Inactif',
            self::BANNED => 'Banni',
            default => throw new InvalidArgumentException("This value is not accepted as member !")
        };
    }
}
