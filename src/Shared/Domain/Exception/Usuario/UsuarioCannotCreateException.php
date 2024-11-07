<?php

namespace Eurega\Shared\Domain\Exception\Usuario;

use Eurega\ShoppingList\Domain\Exception\ErrorCodes;

final class UsuarioCannotCreateException extends \Exception
{
    public static function becauseUsuarioWithEmailAlreadyExist(): self
    {
        return new self(ErrorCodes::$codes['USUARIO']['CANNOT_CREATE']['EMAIL_ALREADY_EXISTS']);
    }
}