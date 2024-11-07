<?php

namespace Eurega\ShoppingList\Application\Service\ProductoShoppingList;

use Eurega\Shared\Domain\Bus\Event\EventBus;
use Eurega\Shared\Domain\ValueObject\Common\Id;
use Eurega\Shared\Domain\ValueObject\Common\Nombre;
use Eurega\ShoppingList\Domain\Model\ProductoShoppingList\ProductoShoppingList;
use Eurega\ShoppingList\Domain\Repository\ProductoShoppingList\ProductoShoppingListReadRepository;
use Eurega\ShoppingList\Domain\Repository\ProductoShoppingList\ProductoShoppingListWriteRepository;

final class ProductoShoppingListCreator {

    public function __construct(
        private ProductoShoppingListReadRepository $readRepository,
        private ProductoShoppingListWriteRepository $writeRepository,
        private EventBus $eventBus
    ) { }

    public function create(
        string $id,
        string $nombre
    ) {

        $nuevoProducto = ProductoShoppingList::crear(
            Id:: fromString($id),
            Nombre::fromString($nombre)
        );

        $this->writeRepository->save($nuevoProducto);

        $this->eventBus->publish(...$nuevoProducto->pullDomainEvents());

    }

}