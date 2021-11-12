<?php

namespace TeamBuilder\model\enum;

use InvalidArgumentException;

class RoleEnum extends Enum
{

    public const MEM = 1;
    public const MOD = 2;

    public static function fromValue(int $value): string
    {
        return match ($value) {
            self::MEM => 'Member',
            self::MOD => 'Moderator',
            default => throw new InvalidArgumentException("This value is not accepted as role !")
        };
    }
}
