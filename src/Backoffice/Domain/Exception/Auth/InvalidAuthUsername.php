<?php

declare(strict_types=1);

namespace Eurega\Backoffice\Domain\Exception\Auth;

use Eurega\Shared\Domain\ValueObject\Common\Nombre;
use RuntimeException;

final class InvalidAuthUsername extends RuntimeException
{
	public function __construct(Nombre $username)
	{
		parent::__construct(sprintf('The user <%s> does not exists', $username->asString()));
	}
}
