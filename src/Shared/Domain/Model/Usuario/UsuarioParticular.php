<?php

declare(strict_types=1);

namespace Eurega\Shared\Domain\Model\Usuario;

use Eurega\Shared\Domain\Event\Usuario\UsuarioParticularCreatedDomainEvent;
use Eurega\Shared\Domain\ValueObject\Common\EmailAddress;
use Eurega\Shared\Domain\ValueObject\Common\Id;
use Eurega\Shared\Domain\ValueObject\Common\Nombre;
use Eurega\Shared\Domain\ValueObject\Security\PasswordHash;
use Eurega\Shared\Domain\ValueObject\Usuario\EstadoUsuario;

final class UsuarioParticular extends Usuario
{
    private function __construct(
        protected ?Id $id = null,
        protected EmailAddress $direccionEmail,
        protected PasswordHash $password,
        protected EstadoUsuario $estado,
        protected ?Nombre $nombre
    ) {
        $this->id              = $id;
        $this->nombre          = $nombre;
        $this->direccionEmail  = $direccionEmail;
        $this->password        = $password;
        $this->recoveryToken   = null;
    }

    public static function crear(
        Id $id,
        EmailAddress $direccionEmail,
        PasswordHash $password,
        ?Nombre $nombre
    ): self {
        $nuevo_usuario = new self(
            $id,
            $direccionEmail,
            $password,
            // hasta que no se confirme el email el usuario permanece inactivo
            EstadoUsuario::inactivo(),
            $nombre
        );

        $nuevo_usuario->record(
            new UsuarioParticularCreatedDomainEvent(
                $id->asString(), 
                $nombre->asString(), 
                $direccionEmail->asString()
            )
        );

        return $nuevo_usuario;
    }

    public function modificarNombre(
        Nombre $nombre
    ) {
        $this->nombre = $nombre;
    }

    public function modificarEmail(
        EmailAddress $direccionEmail
    ) {
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
