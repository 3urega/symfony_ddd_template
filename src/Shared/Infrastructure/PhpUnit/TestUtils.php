<?php

declare(strict_types=1);

namespace Eurega\Shared\Infrastructure\PhpUnit;

use Eurega\Shared\Infrastructure\CodelyTvConstraintIsSimilar;

final class TestUtils
{
	public static function isSimilar(mixed $expected, mixed $actual): bool
	{
		$constraint = new CodelyTvConstraintIsSimilar($expected);

		return $constraint->evaluate($actual, '', true);
	}

	public static function assertSimilar(mixed $expected, mixed $actual): void
	{
		$constraint = new CodelyTvConstraintIsSimilar($expected);

		$constraint->evaluate($actual);
	}

	public static function similarTo(mixed $value, float $delta = 0.0): CodelyTvMatcherIsSimilar
	{
		return new CodelyTvMatcherIsSimilar($value, $delta);
	}
}
