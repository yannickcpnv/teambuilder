<?php

namespace TeamBuilder\model\exception;

use JetBrains\PhpStorm\Pure;

/**
 * Exception when an entity ise created or save with an existing name.
 */
class ExistingValueException extends \Exception
{

    /**
     * Initialise a new {@link ExistingValueException}.
     *
     * @param $message string The message of the exception.
     */
    #[Pure] public function __construct(string $message)
    {
        parent::__construct($message);
    }
}
