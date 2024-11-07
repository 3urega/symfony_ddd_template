<?php

declare(strict_types=1);

namespace Eurega\Backoffice\Application\Handler\Usuario\Administrador;

use Eurega\Backoffice\Application\Command\Usuario\Administrador\CrearUsuarioAdministradorCommand;
use Eurega\Shared\Application\Service\Usuario\Administrador\UsuarioAdministradorCreator;
use Eurega\Shared\Domain\ValueObject\Common\EmailAddress;
use Eurega\Shared\Domain\ValueObject\Common\Id;
use Eurega\Shared\Domain\ValueObject\Common\Nombre;
use Eurega\Shared\Domain\ValueObject\Security\PasswordHash;

class CrearUsuarioAdministradorCommandHandler
{
    public function __construct(
        private UsuarioAdministradorCreator $creator
    ) {
    }

    public function handle(CrearUsuarioAdministradorCommand $command): void
    {
        $userEmail = EmailAddress::fromString($command->email);

        $userPassword = PasswordHash::generateRandom();

        $userName = Nombre::fromStringOrNull($command->nombre);
        
        $id = Id::generate();

        $this->creator->create(
            $id,
            $userEmail,
            $userPassword,
            $userName
        );
    }
}
