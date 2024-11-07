<?php

declare(strict_types=1);

namespace Eurega\Shared\Infrastructure\PhpUnit;

final class WordMother
{
	public static function create(): string
	{
		return MotherCreator::random()->word;
	}
}
