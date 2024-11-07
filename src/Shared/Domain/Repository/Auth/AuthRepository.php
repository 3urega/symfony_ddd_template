<?php

declare(strict_types=1);

namespace Eurega\Shared\Domain\Repository\Auth;

use Eurega\Shared\Domain\Auth\AuthUser;
use Eurega\Shared\Domain\ValueObject\Security\AuthUsername;

interface AuthRepository
{
	public function search(AuthUsername $username): ?AuthUser;
	//public function search(AuthUsername $username): ?AuthUser;																																																																			ser;
}
