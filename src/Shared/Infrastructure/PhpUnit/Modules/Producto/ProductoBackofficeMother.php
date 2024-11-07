<?php

declare(strict_types=1);

namespace Eurega\Shared\Infrastructure\PhpUnit\Modules\Producto;

use Eurega\Backoffice\Domain\Model\ProductoBackoffice\ProductoBackoffice;
use Eurega\Shared\Domain\ValueObject\Common\Id;
use Eurega\Shared\Domain\ValueObject\Common\Nombre;
use Eurega\Shared\Infrastructure\PhpUnit\UuidMother;
use Eurega\Shared\Infrastructure\PhpUnit\WordMother;

final class ProductoBackofficeMother
{
	public static function create(
    ): ProductoBackoffice
	{
		return ProductoBackoffice::crear(
            Id::fromString(UuidMother::create()),
            Nombre::fromString(WordMother::create())
        );
	}
}
