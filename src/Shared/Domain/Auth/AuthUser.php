<?php

declare(strict_types=1);

namespace Eurega\Shared\Domain\Auth;

use Eurega\Shared\Domain\ValueObject\Security\AuthPassword;
use Eurega\Shared\Domain\ValueObject\Security\AuthUsername;

final readonly class AuthUser
{
	public function __construct(
		private AuthUsername $username, 
		private AuthPassword $password
	) {}

	public function passwordMatches(AuthPassword $password): bool
	{
		return $this->password->isEquals($password);
	}

	public function username(): AuthUsername
	{
		return $this->username;
	}
}
