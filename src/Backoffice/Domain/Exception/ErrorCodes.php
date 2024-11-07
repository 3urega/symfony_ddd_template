<?php

namespace Eurega\Backoffice\Domain\Exception;

final class ErrorCodes {
    static public $codes = [
        "COMMON" => [],
        "USUARIO" => [
            "CANNOT_CREATE" => [
                "EMAIL_ALREADY_EXISTS" => 1000
            ]
        ],
        "PRODUCTO_BACKOFFICE" => [
            "CANNOT_CREATE" => [
                "NOMBRE_ALREADY_EXISTS" => 10000
            ]
        ]
    ];
}