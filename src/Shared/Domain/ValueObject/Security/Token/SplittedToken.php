<?php
declare(strict_types=1);

namespace Eurega\Shared\Domain\ValueObject\Security\Token;

use Eurega\ShoppingList\Domain\Exception\ValueObject\Security\Token\SplittedTokenIsNotValid;
use ParagonIE\ConstantTime\Hex;
use Webmozart\Assert\Assert;

final class SplittedToken
{
    /** @var int */
    public const TOKEN_LENGTH = 32;

    /** @var int */
    public const SINGLE_TOKEN_LENGTH = 16;

    /** @var int */
    private const TOKEN_BYTES_LENGTH = 8;

    private ClearTextToken $selector;
    private ClearTextToken $verifier;

    private function __construct(ClearTextToken $selector, ClearTextToken $verifier)
    {
        $this->selector = $selector;
        $this->verifier = $verifier;
    }

    public static function generate(): self
    {
        return new self(
            ClearTextToken::fromString(
                Hex::encode(\random_bytes(self::TOKEN_BYTES_LENGTH))
            ),
            ClearTextToken::fromString(
                Hex::encode(\random_bytes(self::TOKEN_BYTES_LENGTH))
            )
        );
    }

    /**
     * @throws SplittedTokenIsNotValid
     */
    public static function fromString(string $token): self
    {
        $token = trim($token);

        self::validate($token);

        return new self(
            ClearTextToken::fromString(substr($token, 0, self::SINGLE_TOKEN_LENGTH)),
            ClearTextToken::fromString(substr($token, self::SINGLE_TOKEN_LENGTH))
        );
    }

    public function selector(): ClearTextToken
    {
        return $this->selector;
    }

    public function verifier(): TokenHash
    {
        return $this->verifier->makeHash();
    }

    public function asString(): string
    {
        return sprintf(
            '%s%s',
            $this->selector->asString(),
            $this->verifier->asString()
        );
    }

    public function matchesVerifier(TokenHash $hash): bool
    {
        return $this->verifier->matches($hash);
    }

    /**
     * @throws SplittedTokenIsNotValid
     */
    private static function validate(string $token): void
    {
        try {
            Assert::stringNotEmpty($token);
        } catch (\InvalidArgumentException $e) {
            throw SplittedTokenIsNotValid::becauseStringIsEmpty();
        }

        try {
            Assert::length($token, self::TOKEN_LENGTH);
        } catch (\InvalidArgumentException $e) {
            throw SplittedTokenIsNotValid::becauseStringLengthIsInvalid($token);
        }
    }
}
