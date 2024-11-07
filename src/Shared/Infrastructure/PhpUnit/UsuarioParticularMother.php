<?php

declare(strict_types=1);

namespace Eurega\Shared\Infrastructure\PhpUnit;

use Eurega\Shared\Domain\Bus\Event\EventBus;
use Eurega\Shared\Domain\Model\Usuario\UsuarioParticular;
use Eurega\Shared\Domain\Repository\Usuario\UsuarioParticularWriteRepository;
use Eurega\Shared\Domain\ValueObject\Common\EmailAddress;
use Eurega\Shared\Domain\ValueObject\Common\Id;
use Eurega\Shared\Domain\ValueObject\Common\Nombre;
use Eurega\Shared\Domain\ValueObject\Security\PasswordHash;

final class UsuarioParticularMother
{
	public static function create(
       UsuarioParticularWriteRepository $writeRepository,
       EventBus $bus
    ): UsuarioParticular
	{
		return UsuarioParticular::crear(
            Id::fromString(UuidMother::create()),
            EmailAddress::fromString("user@email.com"),
            PasswordHash::fromString("1234"),
			Nombre::fromString(WordMother::create()),
            $writeRepository,
            $bus
        );
	}
}
