<?php

namespace Eurega\Backoffice\Domain\Exception\ProductoBackoffice;

use Eurega\Shared\Domain\Exception\DomainException;
use Eurega\Backoffice\Domain\Exception\ErrorCodes;

class ProductoBackofficeCannotCreateException extends DomainException {

    public static function becauseNombreAlreadyExists() {
        return new self(ErrorCodes::$codes['PRODUCTO_BACKOFFICE']['CANNOT_CREATE']['NOMBRE_ALREADY_EXISTS']);
    }

}