<?php

declare(strict_types=1);

namespace Eurega\Shared\Application\Service\Usuario;

final class FindUsuarioResponse
{
    public function __construct(
        private string $usuarioId,
        private string $usuarioEmail,
        private string $usuarioPassword
    ) {
    }

    public function usuarioId(): string
    {
        return $this->usuarioId;
    }

    public function usuarioEmail(): string
    {
        return $this->usuarioEmail;
    }

    public function usuarioPassword(): string
    {
        return $this->usuarioPassword;
    }
}