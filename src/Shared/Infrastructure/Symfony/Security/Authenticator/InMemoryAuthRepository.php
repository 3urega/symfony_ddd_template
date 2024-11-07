<?php

declare(strict_types=1);

namespace Eurega\Shared\Infrastructure\Symfony\Security\Authenticator;


use Eurega\Shared\Domain\Auth\AuthUser;
use Eurega\Shared\Domain\ValueObject\Security\AuthPassword;
use Eurega\Shared\Domain\ValueObject\Security\AuthUsername;
use Eurega\Shared\Domain\Repository\Auth\AuthRepository;

use function Lambdish\Phunctional\get;

final class InMemoryAuthRepository implements AuthRepository
{
	private const array USERS = [
		'javier' => 'barbitas',
		'rafa' => 'pelazo',
	];

	public function search(AuthUsername $username): ?AuthUser
	{
		
		$password = get($username->value(), self::USERS);

		return $password !== null ? new AuthUser($username, new AuthPassword($password)) : null;
	}
}
