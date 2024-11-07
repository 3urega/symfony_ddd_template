<?php

declare(strict_types=1);

namespace Eurega\Shared\Domain\Auth;

use Eurega\Shared\Domain\ValueObject\Common\Nombre;
use Eurega\Shared\Domain\ValueObject\Security\AuthUsername;
use RuntimeException;

final class InvalidAuthUsername extends RuntimeException
{
	public function __construct(AuthUsername $username)
	{
		parent::__construct(sprintf('The user <%s> does not exists', $username->value()));
	}
}
