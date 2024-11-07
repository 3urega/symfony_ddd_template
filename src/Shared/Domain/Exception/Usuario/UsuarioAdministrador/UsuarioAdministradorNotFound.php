<?php

namespace Eurega\Shared\Domain\Exception\Usuario\UsuarioAdministrador;

use App\Domain\ValueObject\Id;
use DomainException;
use Eurega\Shared\Domain\ValueObject\Common\EmailAddress;
use Eurega\Shared\Domain\ValueObject\Common\Id as CommonId;

final class UsuarioAdministradorNotFound extends DomainException
{
    public static function withDireccionEmail(EmailAddress $direccionEmail): self
    {
        return new self(
            'No existe ningún usuario admin con esta dirección email'
        );
    }

    public static function withId(CommonId $id): self
    {
        return new self(
            'No existe ningún administrador con este id'
        );
    }

    public static function throw(): self
    {
        return new self(
            'No existe ningún administrador con esos parámetros'
        );
    }
}
