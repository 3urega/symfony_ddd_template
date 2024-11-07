<?php

declare(strict_types=1);

namespace Eurega\Shared\Infrastructure\PhpUnit;

use Eurega\ShoppingList\Application\Command\Usuario\CrearUsuarioParticularCommand;
use Eurega\Shared\Domain\ValueObject\Common\EmailAddress;
use Eurega\Shared\Domain\ValueObject\Common\Id;
use Eurega\Shared\Domain\ValueObject\Common\Nombre;

final class CrearUsuarioParticularCommandMother
{
	public static function create(
		?Id $id = null,
		?Nombre $nombre = null,
		?EmailAddress $email = null
	): CrearUsuarioParticularCommand {
		return new CrearUsuarioParticularCommand(
			$email?->asString() ?? "user@email.com",
			"4321",
			$nombre?->asString() ?? WordMother::create()
		);
	}
}
