<?php

declare(strict_types=1);

namespace Eurega\Shared\Application\Service\Auth;

use Eurega\Backoffice\Domain\Exception\Auth\InvalidAuthCredentials;
use Eurega\Shared\Domain\Auth\AuthUser;
use Eurega\Shared\Domain\Auth\InvalidAuthUsername;
use Eurega\Shared\Domain\ValueObject\Security\AuthPassword;
use Eurega\Shared\Domain\ValueObject\Security\AuthUsername;
use Eurega\Shared\Domain\Repository\Auth\AuthRepository;

final readonly class UserAuthenticator
{
	public function __construct(private AuthRepository $repository) {}

	public function authenticate(AuthUsername $username, AuthPassword $password): void
	{
		$auth = $this->repository->search($username);
		if ($auth === null) {
			throw new InvalidAuthUsername($username);
		}

		$this->ensureCredentialsAreValid($auth, $password);
	}

	private function ensureCredentialsAreValid(AuthUser $auth, AuthPassword $password): void
	{
		if (!$auth->passwordMatches($password)) {
			throw new InvalidAuthCredentials($auth->username());
		}
	}
}
