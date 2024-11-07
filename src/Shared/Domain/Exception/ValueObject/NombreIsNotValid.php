<?php

namespace Eurega\Shared\Domain\Exception\ValueObject;

use Eurega\Shared\Domain\Exception\DomainException;
use Eurega\Shared\Domain\Exception\ErrorCodes;
use Eurega\Shared\Domain\ValueObject\Common\Nombre;

final class NombreIsNotValid extends DomainException
{
    public static function becauseStringLengthIsLargerThanLimit(): self
    {
        return new self(
            sprintf(
                'String is too large. Limit is "%s"',
                Nombre::MAX_LENGTH
            )
        );
    }

    public static function becauseStringIsEmpty(): self
    {
        return new self(ErrorCodes::$codes["NOMBRE"]["IS_EMPTY"]);
    }
}