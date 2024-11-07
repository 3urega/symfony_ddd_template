<?php

declare(strict_types=1);

namespace Eurega\Backoffice\Infrastructure\Persistence\Doctrine\Repository\ProductoBackoffice;

use Doctrine\ORM\EntityManagerInterface;

use Eurega\Backoffice\Domain\Model\ProductoBackoffice\ProductoBackoffice;
use Eurega\Backoffice\Domain\Repository\ProductoBackoffice\ProductoBackofficeWriteRepository;

use Eurega\Shared\Domain\ValueObject\Common\Id;

// implements \ShoppingList\Domain\Repository\Usuario\Administrador\UsuarioAdministradorWriteRepository

class MysqlProductoBackofficeWriteRepository implements ProductoBackofficeWriteRepository
{

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $em)
    {
        $this->entityManager = $em;
    }

    public function nextIdentity(): Id
    {
        return Id::generate();
    }

    public function save(ProductoBackoffice $producto): void
    {
        $this->entityManager->persist($producto);
        $this->entityManager->flush();
    }
}
