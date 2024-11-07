<?php
declare(strict_types=1);

namespace Eurega\Shared\Domain\Exception\ValueObject;

use Eurega\Shared\Domain\ValueObject\Security\ClearTextPassword;

final class ClearTextPasswordIsNotValid extends \Exception
{
    public static function becauseStringIsEmpty(): self
    {
        return new self(
            'Password is empty'
        );
    }

    public static function becauseDoesNotHaveMinimalLength(string $clearTextPassword): self
    {
        return new self(
            sprintf(
                'Password requires a minimum of %s characters. Passed password has only %s',
                ClearTextPassword::MIN_PASSWORD_LENGTH,
                \mb_strlen($clearTextPassword)
            )
        );
    }
}
