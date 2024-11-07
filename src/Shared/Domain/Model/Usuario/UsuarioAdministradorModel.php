<?php

declare(strict_types=1);

namespace Eurega\Shared\Domain\Model\Usuario;

use Eurega\Shared\Domain\ValueObject\Common\EmailAddress;
use Eurega\Shared\Domain\ValueObject\Common\Id;
use Eurega\Shared\Domain\ValueObject\Common\Nombre;
use Eurega\Shared\Domain\ValueObject\Security\PasswordHash;
use Eurega\Backoffice\Application\Event\Usuario\UsuarioAdministradorCreatedDomainEvent;

final class UsuarioAdministradorModel extends Usuario
{
    private function __construct(
        Id $id,
        Nombre $nombre,
        EmailAddress $direccionEmail,
        PasswordHash $password
    ) {
        $this->id              = $id;
        $this->nombre          = $nombre;
        $this->direccionEmail  = $direccionEmail;
        $this->password        = $password;
        $this->recoveryToken   = null;
    }
    
    public static function crear(
        Id $id,
        Nombre $nombre,
        EmailAddress $direccionEmail,
        PasswordHash $password
    ): self {
        $nuevo_usuario = new self(
            $id,
            $nombre,
            $direccionEmail,
            $password,
        );

        $nuevo_usuario->record(
            new UsuarioAdministradorCreatedDomainEvent(
                $id->asString(), 
                $nombre->asString(), 
                $direccionEmail->asString()
            )
        );

        return $nuevo_usuario;

    }

    public function modificar(
        Nombre $nombre,
        EmailAddress $direccionEmail
    )
    {
        $this->nombre = $nombre;
        $this->direccionEmail = $direccionEmail;
        
    }

    public function toPrimitives(): array
    {
        return [
            "id" => $this->id->asString(),
            "email" => $this->direccionEmail->asString(),
            "nombre" => $this->nombre?->asString()
        ];
    }
}
