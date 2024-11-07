<?php

declare(strict_types=1);

namespace Eurega\Shared\Domain;

interface RandomNumberGenerator
{
	public function generate(): int;
}
