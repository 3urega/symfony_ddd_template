<?php

declare(strict_types=1);

namespace Eurega\Shared\Infrastructure\PhpUnit;

use Eurega\Shared\Domain\Event\Usuario\UsuarioParticularCreatedDomainEvent;
use Eurega\Shared\Domain\Model\Usuario\UsuarioParticular;
use Eurega\Shared\Domain\ValueObject\Common\EmailAddress;
use Eurega\Shared\Domain\ValueObject\Common\Id;
use Eurega\Shared\Domain\ValueObject\Common\Nombre;
use Eurega\Shared\Domain\ValueObject\Security\PasswordHash;

final class UsuarioParticularCreatedDomainEventMother
{
	public static function create(
		?Id $id = null,
		?EmailAddress $email = null,
		?Nombre $nombre = null,
		?PasswordHash $password = null
	): UsuarioParticularCreatedDomainEvent {
		return new UsuarioParticularCreatedDomainEvent(
			$id?->asString() ?? UuidMother::create(),
			$nombre?->asString() ?? WordMother::create(),
			$email?->asString() ?? "user@email.com"
		);
	}

	
	public static function fromUsuarioParticular(UsuarioParticular $usuario): UsuarioParticularCreatedDomainEvent
	{
		return self::create(
			$usuario->id(), 
			$usuario->direccionEmail(),
			$usuario->nombre(), 
			PasswordHash::generateRandom()
		);
	}
	
}
