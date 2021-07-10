<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

class EntityException extends Exception
{
    public static function invalidParameterType(string $parameter, string $expected, string $actual): self
    {
        return new self(
            sprintf(
                "Invalid parameter type '%s'. Expected type is '%s' but has type of '%s'",
                $parameter,
                $expected,
                $actual
            )
        );
    }
}
