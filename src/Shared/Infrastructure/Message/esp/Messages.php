<?php

declare(strict_types=1);

namespace Eurega\Shared\Infrastructure\Message\esp;

class Messages {

    static $messages = [
        "1" => "El nombre no puede estar vacío",
        "10000" => "El nombre del producto ya existe !"
    ];

    static public function message(string $code) {
        return array_key_exists($code, self::$messages) ? self::$messages[$code] : "Unhandled error (".$code.")";
    }
}