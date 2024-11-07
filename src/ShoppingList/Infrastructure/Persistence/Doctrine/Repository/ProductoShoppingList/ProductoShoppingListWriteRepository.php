<?php

declare(strict_types=1);

namespace Eurega\ShoppingList\Infrastructure\Persistence\Doctrine\Repository\ProductoShoppingList;

use Eurega\Shared\Domain\ValueObject\Common\Id as CommonId;
use Eurega\Shared\Domain\ValueObject\Common\Id;
use Doctrine\ORM\EntityManagerInterface;
use Eurega\ShoppingList\Domain\Model\ProductoShoppingList\ProductoShoppingList;

final class ProductoShoppingListWriteRepository 
implements \Eurega\ShoppingList\Domain\Repository\ProductoShoppingList\ProductoShoppingListWriteRepository
{

    public function __construct(
        private EntityManagerInterface $em
    ) { }

    public function nextIdentity(): CommonId
    {
        return Id::generate();
    }

    public function save(ProductoShoppingList $producto): void
    {
        $this->em->persist($producto);
        $this->em->flush();
    }
}
