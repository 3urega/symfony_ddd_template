<?php
declare(strict_types=1);

namespace Eurega\Shared\Domain\ValueObject\Security\Token;

use Eurega\ShoppingList\Domain\Exception\ValueObject\Security\Token\TokenHashIsNotValid;
use Webmozart\Assert\Assert;

final class TokenHash
{
    /** @var string */
    public const HASH_ALGORITHM = 'sha256';

    /** @var int */
    public const HASH_SIZE = 64;

    private string $hash;

    private function __construct(string $hash)
    {
        $this->hash = $hash;
    }

    /**
     * @throws TokenHashIsNotValid
     */
    public static function fromHash(string $hash): self
    {
        self::validate($hash);

        return new self($hash);
    }

    public function asString(): string
    {
        return $this->hash;
    }

    /**
     * @throws TokenHashIsNotValid
     */
    private static function validate(string $hash): void
    {
        try {
            Assert::length($hash, self::HASH_SIZE);
        } catch (\InvalidArgumentException $e) {
            throw TokenHashIsNotValid::becauseHashSizeIsNotValid($hash);
        }
    }
}
