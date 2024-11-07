<?php

namespace Eurega\Shared\Infrastructure\Symfony\Security\Usuario;

use Eurega\Shared\Domain\Model\Usuario\UsuarioAdministradorModel;

final class SfUsuarioAdministrador extends SfUsuario {
    public const ROLES = [
        'ROLE_INVITADO',
        'ROLE_PARTICULAR',
        'ROLE_ADMINISTRADOR'
    ];

    public function __construct(
        private UsuarioAdministradorModel $usuarioAdministrador
    ) { }

    public static function fromDomainModel(UsuarioAdministradorModel $usuarioAdministrador): self
    {
        return new self($usuarioAdministrador);
    }

    public function getRoles(): array
    {
        return self::ROLES;
    }

    public function getPassword(): string
    {
        return $this->usuarioAdministrador->password()->asString();
    }

    public function getSalt()
    {
        return null;
    }

    public function getUsername(): string
    {
        return $this->usuarioAdministrador->direccionEmail()->asString();
    }

    public function getUserIdentifier(): string
    {
        return $this->usuarioAdministrador->direccionEmail()->asString();
    }

    public function getId(): string
    {
        return $this->usuarioAdministrador->id()->asString();
    }

    public function getName(): string
    {
        return $this->usuarioAdministrador->nombre()->asString();
    }

    public function eraseCredentials(): void {
        return;
    }

    public function nombre(): string {
        return $this->usuarioAdministrador->nombre()->asString();
    }
}
