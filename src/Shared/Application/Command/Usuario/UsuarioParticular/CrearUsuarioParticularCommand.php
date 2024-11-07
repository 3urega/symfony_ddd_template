<?php

declare(strict_types=1);

namespace Eurega\Shared\Application\Command\Usuario\UsuarioParticular;

use Eurega\Shared\Domain\Bus\Command\Command;

class CrearUsuarioParticularCommand implements Command
{
    public function __construct(
        public string $email,
        public string $password,
        public ?string $nombre

    ) {
    }
}
