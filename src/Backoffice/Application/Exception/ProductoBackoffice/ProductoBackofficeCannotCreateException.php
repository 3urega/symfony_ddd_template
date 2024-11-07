<?php

namespace Eurega\Backoffice\Application\Exception\ProductoBackoffice;

use Eurega\Backoffice\Application\Exception\ApplicationException;
use Eurega\ShoppingList\Domain\Exception\ErrorCodes;

class ProductoBackofficeCannotCreateException extends ApplicationException {

    public static function becauseNombreAlreadyExists() {
        return new self(ErrorCodes::$codes['PRODUCTO_BACKOFFICE']['CANNOT_CREATE']['NOMBRE_ALREADY_EXISTS']);
    }
    
}