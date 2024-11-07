<?php

declare(strict_types=1);

namespace Tests\Shared\Infrastructure;

use Eurega\Shared\Domain\RandomNumberGenerator;

final class ConstantRandomNumberGenerator implements RandomNumberGenerator
{
	public function generate(): int
	{
		return 1;
	}
}
