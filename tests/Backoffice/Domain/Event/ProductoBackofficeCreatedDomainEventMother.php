<?php

declare(strict_types=1);

namespace Eurega\Shared\Infrastructure\PhpUnit;

use Eurega\Backoffice\Domain\Event\ProductoBackoffice\ProductoBackofficeCreatedDomainEvent;
use Eurega\Backoffice\Domain\Model\ProductoBackoffice\ProductoBackoffice;

final class ProductoBackofficeCreatedDomainEventMother
{
	public static function create(
		string $id,
		string $nombre,
		string $eventId = null,
		string $occurredOn = null
	): ProductoBackofficeCreatedDomainEvent {
		return new ProductoBackofficeCreatedDomainEvent(
			$id,
			$nombre,
			$eventId = null,
			$occurredOn = null
		);
	}

	
	public static function fromProductoBackoffice(ProductoBackoffice $producto): ProductoBackofficeCreatedDomainEvent
	{
		return self::create(
			$producto->id()->asString(), 
			$producto->nombre()->asString()
		);
	}
	
}
