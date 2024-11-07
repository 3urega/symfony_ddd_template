<?php
declare(strict_types=1);

namespace Eurega\Shared\Domain\ValueObject\Security\Token;

use Eurega\ShoppingList\Domain\Exception\ValueObject\Security\Token\ClearTextTokenIsNotValid;
use Webmozart\Assert\Assert;

final class ClearTextToken
{
    private string $token;

    private function __construct(string $token)
    {
        $this->token = $token;
    }

    /**
     * @throws ClearTextTokenIsNotValid
     */
    public static function fromString(string $token): self
    {
        $token = trim($token);

        self::validate($token);

        return new self($token);
    }

    public function asString(): string
    {
        return $this->token;
    }

    public function makeHash(): TokenHash
    {
        return TokenHash::fromHash(
            hash(
                TokenHash::HASH_ALGORITHM,
                $this->token
            )
        );
    }

    public function matches(TokenHash $hash): bool
    {
        return hash_equals(
            $this->makeHash()->asString(),
            $hash->asString()
        );
    }

    /**
     * @throws ClearTextTokenIsNotValid
     */
    private static function validate(string $token): void
    {
        try {
            Assert::stringNotEmpty($token);
        } catch (\InvalidArgumentException $e) {
            throw ClearTextTokenIsNotValid::becauseTokenIsEmpty();
        }
    }
}
