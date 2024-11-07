<?php

namespace Eurega\ShoppingList\Domain\Exception;

final class ErrorCodes {
    static public $codes = [
        "COMMON" => [],
        "USUARIO" => [
            "CANNOT_CREATE" => [
                "EMAIL_ALREADY_EXISTS" => 1000
            ]
        ]
    ];
}