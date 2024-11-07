<?php

namespace Eurega\Shared\Domain\Exception\ValueObject;

final class CantidadIsNotValid extends \Exception
{
    public static function becauseItIsNegative(int $value): self
    {
        return new self(
            sprintf(
                'Quantity "%s" is negative',
                $value
            )
        );
    }

    public static function becauseItIsZero(): self
    {
        return new self(
            'Quantity is zero'
        );
    }
}