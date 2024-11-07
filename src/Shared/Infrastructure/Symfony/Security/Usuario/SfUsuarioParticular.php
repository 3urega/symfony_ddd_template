<?php

namespace Eurega\Shared\Infrastructure\Symfony\Security\Usuario;

use Eurega\Shared\Domain\Model\Usuario\UsuarioParticular;

final class SfUsuarioParticular extends SfUsuario {
    public const ROLES = [
        'ROLE_INVITADO',
        'ROLE_PARTICULAR'
    ];

    public function __construct(
        private UsuarioParticular $usuario
    ) { }

    public static function fromDomainModel(UsuarioParticular $usuario): self
    {
        return new self($usuario);
    }

    public function getRoles(): array
    {
        return self::ROLES;
    }

    public function getPassword(): string
    {
        return $this->usuario->password()->asString();
    }

    public function getSalt()
    {
        return null;
    }

    public function getUsername(): string
    {
        return $this->usuario->direccionEmail()->asString();
    }

    public function getUserIdentifier(): string
    {
        return $this->usuario->direccionEmail()->asString();
    }

    public function getId(): string
    {
        return $this->usuario->id()->asString();
    }

    public function getName(): string
    {
        return $this->usuario->nombre()->asString();
    }

    public function eraseCredentials(): void {
        return;
    }

    public function nombre(): string {
        return $this->usuario->nombre()->asString();
    }
}
