<?php

declare(strict_types=1);

namespace App\ShoppingList\Backend\Test;

use Eurega\Shared\Domain\RandomNumberGenerator;

final class ConstantRandomNumberGenerator implements RandomNumberGenerator
{
	public function generate(): int
	{
		return 1;
	}
}
