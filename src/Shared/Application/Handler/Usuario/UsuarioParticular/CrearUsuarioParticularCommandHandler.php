<?php

declare(strict_types=1);

namespace Eurega\Shared\Application\Handler\Usuario\UsuarioParticular;

use Eurega\Shared\Application\Command\Usuario\UsuarioParticular\CrearUsuarioParticularCommand;
use Eurega\Shared\Application\Service\Usuario\UsuarioParticular\UsuarioParticularCreator;
use Eurega\Shared\Domain\ValueObject\Common\EmailAddress;
use Eurega\Shared\Domain\ValueObject\Common\Id;
use Eurega\Shared\Domain\ValueObject\Common\Nombre;
use Eurega\Shared\Domain\ValueObject\Security\PasswordHash;

use Throwable;

class CrearUsuarioParticularCommandHandler
{
    public function __construct(
        private UsuarioParticularCreator $creator
    ) {

    }

    public function handle(CrearUsuarioParticularCommand $command): void {

        $userEmail = EmailAddress::fromString($command->email);

        $userPassword = PasswordHash::fromString($command->password);

        $userName = Nombre::fromStringOrNull($command->nombre);
        
        $id = Id::generate();

        $this->creator->create($id, $userEmail, $userPassword, $userName);
    }
}
