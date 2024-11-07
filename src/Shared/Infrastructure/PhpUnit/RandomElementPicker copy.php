<?php

declare(strict_types=1);

namespace Eurega\Shared\Infrastructure\PhpUnit;

final class RandomElementPicker
{
	public static function from(mixed ...$elements): mixed
	{
		return MotherCreator::random()->randomElement($elements);
	}
}
