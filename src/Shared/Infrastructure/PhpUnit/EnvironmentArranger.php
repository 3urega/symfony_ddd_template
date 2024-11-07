<?php

declare(strict_types=1);

namespace Eurega\Shared\Infrastructure\PhpUnit;

interface EnvironmentArranger
{
	public function arrange(): void;

	public function close(): void;
}
