<?php

declare(strict_types=1);

namespace Eurega\Shared\Infrastructure\Message\esp;

class SuccessMessages {

    static $messages = [
        "10000" => "Producto creado con éxito !"
    ];

    static public function message(string $code) {
        return array_key_exists($code, self::$messages) ? self::$messages[$code] : "Unhandled success";
    }
}