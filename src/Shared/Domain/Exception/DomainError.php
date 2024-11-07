<?php

declare(strict_types=1);

namespace Eurega\Shared\Domain\Exception;

use DomainException;

/**
 * @description A diferencia de DomainException Esta clase será la que se envie al usuario final
 * normalmente desde un controlador
 */
abstract class DomainError extends DomainException
{
	public function __construct()
	{
		parent::__construct($this->errorMessage());
	}

	abstract public function errorCode(): string;

	abstract protected function errorMessage(): string;
}
