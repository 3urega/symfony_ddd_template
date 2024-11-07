<?php

namespace Eurega\Shared\Domain\Exception\Usuario\UsuarioAdministrador;

use Eurega\Shared\Domain\ValueObject\Common\EmailAddress;

final class UsuarioAdministradorBloqueado extends \Exception
{
    public static function withDireccionEmail(EmailAddress $direccionEmail): self
    {
        return new self(
            'Esta cuenta de usuario está bloqueada'
        );
    }
}
