<?php

declare(strict_types=1);

namespace Eurega\Shared\Infrastructure\Doctrine\Dbal;

interface DoctrineCustomType
{
	public static function customTypeName(): string;
}
