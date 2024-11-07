<?php

namespace Eurega\Shared\Domain\Exception\Usuario\UsuarioAdministrador;


class UsuarioAdministradorAlreadyExists extends \Exception
{
    public static function withEmailAddress(): self
    {
        return new self(
            sprintf(
                'Ya existe un usuario con este e-mail',
            )
        );
    }
}
