<?php

namespace Eurega\Shared\Domain\ValueObject\Common;

use Eurega\ShoppingList\Domain\Exception\ValueObject\EmailAddressIsNotValid;

final class EmailAddress
{
    private string $emailAddress;

    private function __construct(string $emailAddress)
    {
        $this->emailAddress = $emailAddress;
    }

    /**
     * @throws EmailAddressIsNotValid
     */
    public static function fromString(string $emailAddress): self
    {
        $emailAddress = trim($emailAddress);

        self::validate($emailAddress);

        return new self(
            $emailAddress
        );
    }

    /**
     * @throws EmailAddressIsNotValid
     */
    public static function fromStringOrNull(?string $emailAddress): ?self
    {
        if (null === $emailAddress) {
            return null;
        }

        $emailAddress = trim($emailAddress);

        self::validate($emailAddress);

        return new self(
            $emailAddress
        );
    }

    public function asString(): string
    {
        return $this->emailAddress;
    }

    public function equalsTo(EmailAddress $anotherEmailAddress): bool
    {
        return $this->emailAddress === $anotherEmailAddress->emailAddress;
    }

    /**
     * @throws EmailAddressIsNotValid
     */
    private static function validate(string $emailAddress): void
    {
        if (!\filter_var($emailAddress, \FILTER_VALIDATE_EMAIL)) {
            throw EmailAddressIsNotValid::becauseItIsNotARealAddress($emailAddress);
        }
    }
}