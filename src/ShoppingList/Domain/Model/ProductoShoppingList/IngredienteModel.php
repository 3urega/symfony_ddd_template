<?php

declare(strict_types=1);

namespace Eurega\ShoppingList\Domain\Model\ProductoShoppingList;

use Eurega\Shared\Domain\ValueObject\Common\Id;
use Eurega\Shared\Domain\ValueObject\Common\Nombre;
use Eurega\Shared\Domain\Collection;

final class IngredienteModel {

    private Id $id;

    private Nombre $nombre;

    private Collection $productos;

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
        return new self(
            $id,
            $nombre
        );
    }

    public function id(): Id {
        return $this->id;
    }

    public function nombre(): Nombre {
        return $this->nombre;
    }

    public function productos(): Collection {
        return $this->productos;
    }

}