<?php

namespace Eurega\Backoffice\Domain\Dto\ProductoBackoffice;

use Eurega\Shared\Domain\ValueObject\Common;
use Eurega\Shared\Domain\ValueObject\Common\Id;
use Eurega\Shared\Domain\ValueObject\Common\Nombre;

/**
 * Estos dto que terminan con la palabra "response" se usan para devolver datos estructurados desde un repositorio a un controlador
 */
final readonly class ProductoBackofficeResponse
{
	public function __construct(
        private Id $id, 
        private Nombre $nombre
    ) {}

	public function id(): Id
	{
		return $this->id;
	}

	public function nombre(): Nombre
	{
		return $this->nombre;
	}
}