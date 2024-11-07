<?php

declare(strict_types=1);

namespace Eurega\Shared\Domain\Event\Usuario;

use Eurega\Shared\Domain\Bus\Event\DomainEvent;

final class UsuarioAdministradorCreatedDomainEvent extends DomainEvent
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
		private readonly string $email,
		string $eventId = null,
		string $occurredOn = null
	) {
		parent::__construct($id, $eventId, $occurredOn);
	}

	public static function eventName(): string
	{
		return 'backend.usuario.administrador.created';
	}

	public static function fromPrimitives(
		string $aggregateId,
		array $body,
		string $eventId,
		string $occurredOn
	): DomainEvent {
		return new self($aggregateId, $body['nombre'], $body['email'], $eventId, $occurredOn);
	}

	public function toPrimitives(): array
	{
		return [
			'nombre' => $this->nombre,
			'email' => $this->email,
		];
	}

	public function nombre(): string
	{
		return $this->nombre;
	}

	public function email(): string
	{
		return $this->email;
	}
}
