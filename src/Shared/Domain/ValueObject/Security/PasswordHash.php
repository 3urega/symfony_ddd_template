<?php
declare(strict_types=1);

namespace Eurega\Shared\Domain\ValueObject\Security;

use Eurega\Shared\Domain\Exception\ValueObject\ClearTextPasswordIsNotValid;
use Eurega\Shared\Domain\Exception\ValueObject\PasswordHashIsNotValid;

final class PasswordHash
{
    /** @var int */
    public const PASSWORD_ALGORITHM = PASSWORD_ARGON2ID;

    /** @var int */
    private const RANDOM_PASSWORD_LENGTH = 100;

    private string $hash;

    private function __construct(string $hash)
    {
        $this->hash = $hash;
    }

    public function isEquals(self $other): bool
	{
		return $this->asString() === $other->asString();
	}

    public static function generateRandom(): self
    {
        $hash = password_hash(
            bin2hex(
                random_bytes(
                    self::RANDOM_PASSWORD_LENGTH
                )
            ),
            self::PASSWORD_ALGORITHM
        );

        if (false === $hash) {
            throw new \InvalidArgumentException('Invalid random password');
        }

        return new self(
            $hash
        );
    }

    public static function fromString(string $string): self
    {
        self::validate(trim($string));
        $hash = password_hash(
            $string,
            self::PASSWORD_ALGORITHM
        );

        if (false === $hash) {
            throw new \InvalidArgumentException('Invalid password');
        }

        return new self(
            $hash
        );
    }

    /**
     * @throws PasswordHashIsNotValid
     */
    public static function fromHash(string $hash): self
    {
        self::validateHash($hash);

        return new self($hash);
    }

    public function asString(): string
    {
        return $this->hash;
    }

    /** @throws ClearTextPasswordIsNotValid */
    private static function validate(string $string): void
    {
        if ("" === $string) {
            throw ClearTextPasswordIsNotValid::becauseStringIsEmpty();
        }
    }

    /**
     * @throws PasswordHashIsNotValid
     */
    private static function validateHash(string $hash): void
    {
        if (0 !== strpos($hash, '$')) {
            throw PasswordHashIsNotValid::becauseItIsNotARealHash($hash);
        }
    }
}
