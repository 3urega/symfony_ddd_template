<?php

declare(strict_types=1);

namespace Eurega\Shared\Infrastructure\Persistence\Doctrine\Repository\Usuario;

use Eurega\Shared\Domain\Model\Usuario\UsuarioAdministradorModel;
use Eurega\Shared\Domain\ValueObject\Common\Id as CommonId;
use Eurega\Shared\Domain\ValueObject\Common\Id;
use Doctrine\ORM\EntityManagerInterface;

// implements \ShoppingList\Domain\Repository\Usuario\Administrador\UsuarioAdministradorWriteRepository

class UsuarioAdministradorWriteRepository 
{

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $em)
    {
        $this->entityManager = $em;
    }

    public function nextIdentity(): CommonId
    {
        return Id::generate();
    }

    public function save(UsuarioAdministradorModel $usuarioAdministrador): void
    {
        $this->entityManager->persist($usuarioAdministrador);
    }
}
