<?php

declare(strict_types=1);

namespace Eurega\ShoppingList\Domain\Event\ProductoShoppingList;

use Eurega\Shared\Domain\Bus\Event\DomainEvent;

final class ProductoShoppingListCreatedDomainEvent extends DomainEvent
{	
	/**
	 * @param id Id del agregado
	 * @param nombre Nombre del atributo del usuario creado
	 * @param email
	 * @param eventId Si no se recibe se genera automáticamente
	 * @param occurredOn Si no se recibe se genera automáticamente
	 */
	public function __construct(
		string $id,
		private readonly string $nombre,
		string $eventId = null,
		string $occurredOn = null
	) {
		parent::__construct($id, $eventId, $occurredOn);
	}

	public static function eventName(): string
	{
		return 'producto.shoppinglist.created';
	}

	public static function fromPrimitives(
		string $aggregateId,
		array $body,
		string $eventId,
		string $occurredOn
	): DomainEvent {
		return new self($aggregateId, $body['nombre'], $eventId, $occurredOn);
	}

	public function toPrimitives(): array
	{
		return [
			'nombre' => $this->nombre
		];
	}

	public function nombre(): string
	{
		return $this->nombre;
	}
}
