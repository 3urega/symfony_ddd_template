<?php

declare(strict_types=1);

namespace Eurega\Shared\Infrastructure\PhpUnit;

final class UuidMother
{
	public static function create(): string
	{
		return MotherCreator::random()->unique()->uuid;
	}
}
