<?php

declare(strict_types=1);

namespace Eurega\Shared\Infrastructure\Symfony\Security\Authenticator;

use Eurega\Shared\Domain\ValueObject\Security\ClearTextPassword;
use Eurega\Shared\Domain\ValueObject\Security\PasswordHash;
use Symfony\Component\PasswordHasher\Exception\InvalidPasswordException;
use Symfony\Component\PasswordHasher\Hasher\CheckPasswordLengthTrait;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;

class PasswordHasher implements PasswordHasherInterface
{
    use CheckPasswordLengthTrait;

    public function hash(string $plainPassword): string
    {
        if ($this->isPasswordTooLong($plainPassword)) {
            throw new InvalidPasswordException();
        }

        $hashedPassword = PasswordHash::fromString($plainPassword);

        return $hashedPassword->asString();
    }

    public function verify(string $hashedPassword, string $plainPassword): bool
    {
        
        if ('' === $plainPassword || $this->isPasswordTooLong($plainPassword)) {
            return false;
        }
        
        $password = ClearTextPassword::fromString(
            $plainPassword
        );

        
        return $password->matches(
            PasswordHash::fromHash($hashedPassword)
        );
    }

    public function needsRehash(string $hashedPassword): bool
    {
        // Check if a password hash would benefit from rehashing
        // return $needsRehash;
        return false;
    }
}