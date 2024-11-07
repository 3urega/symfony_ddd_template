<?php

namespace Eurega\Backoffice\Domain\Exception\Usuario;

use DomainException;
use Eurega\Shared\Domain\ValueObject\Common\EmailAddress;

final class CannotCreateUsuario extends DomainException
{
    public static function becauseUsuarioAlreadyExists(string $email): self
    {
        return new self(
            sprintf( 'El usuario con email %s ya existe' ,
            $email
            )
        );
    }
}