<?php

declare(strict_types=1);

namespace Eurega\Shared\Domain\ValueObject\Security;

use Eurega\Shared\Domain\ValueObject\StringValueObject;

final class AuthPassword extends StringValueObject
{
	public function isEquals(self $other): bool
	{
		return $this->value() === $other->value();
	}
}
