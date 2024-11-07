<?php

declare(strict_types=1);

namespace Eurega\Backoffice\Domain\Model\ProductoBackoffice;

use Doctrine\ORM\PersistentCollection;
use Eurega\Backoffice\Domain\Event\ProductoBackoffice\ProductoBackofficeCreatedDomainEvent;
use Eurega\Shared\Domain\ValueObject\Common\Id;
use Eurega\Shared\Domain\Aggregate\Producto\ProductoRoot;
use Eurega\Shared\Domain\ValueObject\Common\Nombre;

final class ProductoBackoffice extends ProductoRoot {

    protected Nombre $nombre;

    protected Id $id;

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
        $nuevo_producto_backoffice = new self(
            $id,
            $nombre
        );

        $nuevo_producto_backoffice->record(
            new ProductoBackofficeCreatedDomainEvent(
                $id->asString(), 
                $nombre->asString()
            )
        );

        return $nuevo_producto_backoffice;
    }

    public function toPrimitives(): array
    {
        return [
            "id" => $this->id->asString(),
            "nombre" => $this->nombre?->asString()
        ];
    }

    public function nombre(): Nombre {
        return $this->nombre;
    }

    public function id(): Id {
        return $this->id;
    }

    public function ingredientes(): PersistentCollection {
        return $this->ingredientes;
    }

}