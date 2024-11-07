<?php

namespace Eurega\Shared\Domain\Exception\ValueObject\Usuario;

final class EstadoIsNotValid extends \Exception
{
    public static function becauseCodeIsNotValid(string $code): self
    {
        return new self(
            sprintf(
                'El código de estado "%s" no es válido',
                $code
            )
        );
    }
}