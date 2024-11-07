<?php

declare(strict_types=1);

namespace Eurega\Shared\Infrastructure\PhpUnit\Modules\Producto;

use Eurega\Backoffice\Application\Command\ProductoBackoffice\CreaProductoBackofficeCommand;
use Eurega\Shared\Domain\ValueObject\Common\Id;
use Eurega\Shared\Domain\ValueObject\Common\Nombre;
use Eurega\Shared\Infrastructure\PhpUnit\UuidMother;
use Eurega\Shared\Infrastructure\PhpUnit\WordMother;

final class CrearProductoBackofficeCommandMother
{
	public static function create(
		?Nombre $nombre = null,
		?Id $id = null
	): CreaProductoBackofficeCommand {
		return new CreaProductoBackofficeCommand(
			$nombre?->asString() ?? WordMother::create(),
			$id?->asString() ?? UuidMother::create()
		);
	}
}
