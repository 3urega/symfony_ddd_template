<?php
declare(strict_types=1);

namespace Eurega\Shared\Domain\ValueObject\Security;

use Eurega\Shared\Domain\ValueObject\Common\DateTime;
use Eurega\Shared\Domain\ValueObject\Security\Token\ClearTextToken;
use Eurega\Shared\Domain\ValueObject\Security\Token\TokenHash;

final class AuthenticationToken
{
    /** @var string */
    private const TOKEN_LIFE_SPAN = '+3 months';

    private ClearTextToken $selector;
    private TokenHash $verifier;
    private DateTime $validUntil;

    private function __construct(ClearTextToken $selector, TokenHash $verifier)
    {
        $this->selector = $selector;
        $this->verifier = $verifier;
        $this->validUntil = DateTime::createIn(self::TOKEN_LIFE_SPAN);
    }

    public static function fromSplittedToken(Token\SplittedToken $splittedToken): self
    {
        return new self(
            $splittedToken->selector(),
            $splittedToken->verifier()
        );
    }

    public function selector(): ClearTextToken
    {
        return $this->selector;
    }

    public function verifier(): TokenHash
    {
        return $this->verifier;
    }

    public function validUntil(): DateTime
    {
        return $this->validUntil;
    }
}
