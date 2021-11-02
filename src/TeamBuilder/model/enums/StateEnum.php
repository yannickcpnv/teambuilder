<?php

namespace TeamBuilder\model\enums;

use InvalidArgumentException;

class StateEnum extends Enum
{

    public const WAIT_CHANG = 1;
    public const WAIT_VAL   = 2;
    public const VALIDATED  = 3;
    public const COMMITTED  = 4;
    public const RECRUTING  = 5;

    public static function fromValue(int $value): string
    {
        return match ($value) {
            self::WAIT_CHANG => "Attente de chagement",
            self::WAIT_VAL => "Attente de validation",
            self::VALIDATED => "Validé",
            self::COMMITTED => "Engagée",
            self::RECRUTING => "Recrutement",
            default => throw new InvalidArgumentException("This value is not accepted as state !")
        };
    }
}
