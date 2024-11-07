<?php
declare(strict_types=1);

namespace Eurega\Shared\Domain\Exception\ValueObject;

final class PasswordHashIsNotValid extends \Exception
{
    public static function becauseItIsNotARealHash(string $hash): self
    {
        return new self(
            sprintf(
                'Invalid password hash "%s" provided',
                $hash
            )
        );
    }
}
