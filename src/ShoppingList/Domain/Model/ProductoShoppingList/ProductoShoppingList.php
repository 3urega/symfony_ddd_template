<?php

declare(strict_types=1);

namespace Eurega\ShoppingList\Domain\Model\ProductoShoppingList;

use Doctrine\ORM\PersistentCollection;
use Eurega\Shared\Domain\Aggregate\Producto\ProductoRoot;
use Eurega\Shared\Domain\ValueObject\Common\Id;
use Eurega\Shared\Domain\ValueObject\Common\Nombre;

use Eurega\ShoppingList\Domain\Event\ProductoShoppingList\ProductoShoppingListCreatedDomainEvent;

final class ProductoShoppingList extends ProductoRoot {

    private Id $id;

    private Nombre $nombre;

    protected PersistentCollection $ingredientes;

    private function __construct(
        Id $id,
        Nombre $nombre
    ) {
        $this->id              = $id;
        $this->nombre          = $nombre;
    }

    public static function crear(
        Id $id,
        Nombre $nombre
    ): self {
        $nuevo_producto =  new self(
            $id,
            $nombre
        );

        $nuevo_producto->record(
            new ProductoShoppingListCreatedDomainEvent(
                $id->asString(), 
                $nombre->asString()
            )
        );

        return $nuevo_producto;
    }

    public function id(): Id {
        return $this->id;
    }

    public function nombre(): Nombre {
        return $this->nombre;
    }

    public function toPrimitives(): array
    {
        return [
            "id" => $this->id->asString(),
            "nombre" => $this->nombre?->asString()
        ];
    }

}