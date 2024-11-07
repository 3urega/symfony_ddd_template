<?php

declare(strict_types=1);

namespace Eurega\Backoffice\Domain\Exception\Auth;

use Eurega\Shared\Domain\ValueObject\Common\Nombre;
use Eurega\Shared\Domain\ValueObject\Security\AuthUsername;
use RuntimeException;

final class InvalidAuthCredentials extends RuntimeException
{
	public function __construct(AuthUsername $username)
	{
		parent::__construct(sprintf('The credentials for <%s> are invalid', $username->value()));
	}
}
