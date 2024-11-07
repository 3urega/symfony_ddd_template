<?php

declare(strict_types=1);

namespace Eurega\Shared\Infrastructure\PhpUnit\Modules\Usuario;

use Eurega\Shared\Domain\Bus\Event\EventBus;
use Eurega\Shared\Domain\Model\Usuario\UsuarioAdministradorModel;
use Eurega\Shared\Domain\Repository\Usuario\UsuarioAdministradorWriteRepository;
use Eurega\Shared\Domain\ValueObject\Common\EmailAddress;
use Eurega\Shared\Domain\ValueObject\Common\Id;
use Eurega\Shared\Domain\ValueObject\Common\Nombre;
use Eurega\Shared\Domain\ValueObject\Security\PasswordHash;
use Eurega\Shared\Infrastructure\PhpUnit\UuidMother;
use Eurega\Shared\Infrastructure\PhpUnit\WordMother;

final class UsuarioAdministradorMother
{
	public static function create(
       UsuarioAdministradorWriteRepository $writeRepository,
       EventBus $bus
    ): UsuarioAdministradorModel
	{
		return UsuarioAdministradorModel::crear(
            Id::fromString(UuidMother::create()),
            Nombre::fromString(WordMother::create()),
            EmailAddress::fromString("user@email.com"),
            PasswordHash::fromString("1234"),
            $writeRepository,
            $bus
        );
	}
}
