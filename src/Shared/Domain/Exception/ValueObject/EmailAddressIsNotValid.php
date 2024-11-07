<?php

namespace Eurega\Shared\Domain\Exception\ValueObject;

final class EmailAddressIsNotValid extends \Exception
{
    public static function becauseItIsNotARealAddress(string $value): self
    {
        return new self(
            sprintf(
                'String "%s" is not a valid email address.',
                $value
            )
        );
    }
}