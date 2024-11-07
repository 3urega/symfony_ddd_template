<?php

namespace Eurega\Shared\Infrastructure\Symfony\Security\Usuario;

use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

abstract class SfUsuario implements UserInterface , PasswordAuthenticatedUserInterface
{
    public const ROLES = [ ];

    public function getRoles(): array {
        return self::ROLES;
    }

    abstract public function getPassword(): string;

    abstract public function getSalt();

    abstract public function getUsername(): string;

    abstract public function getId(): string;

    abstract public function getName(): string;

    abstract public function nombre(): string;

    abstract public function eraseCredentials(): void;
}
