<?php

declare(strict_types=1);

namespace App\Backoffice\Frontend\Request\Producto;

final class CrearProductoBackofficeRequest extends ProductoBackofficeRequest
{
    public static function createEmpty(): CrearProductoBackofficeRequest
    {
        return new self(
            '',
            ''
        );
    }

    /**
     * @return string[]
     */
    public function validationGroups(): array
    {
        return ['create'];
    }
}
