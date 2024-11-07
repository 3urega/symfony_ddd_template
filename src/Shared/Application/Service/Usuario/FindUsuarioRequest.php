<?php

declare(strict_types=1);

namespace Eurega\Shared\Application\Service\Usuario;

final class FindUsuarioRequest
{
    public function __construct(
        private string $usuarioEmail
    ) { }

    public function usuarioEmail(): string
    {
        return $this->usuarioEmail;
    }
}