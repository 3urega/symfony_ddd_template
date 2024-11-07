<?php

declare(strict_types=1);

namespace Eurega\Backoffice\Application\Command\Usuario\Administrador;

class CrearUsuarioAdministradorCommand
{
    public function __construct(
        public string $nombre,
        public string $email,
    ) {
    }
}
