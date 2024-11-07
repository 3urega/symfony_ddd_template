<?php

declare(strict_types=1);

namespace Eurega\Shared\Domain\Aggregate\Producto;

use Doctrine\ORM\PersistentCollection;
use Eurega\Shared\Domain\Aggregate\AggregateRoot;
use Eurega\Shared\Domain\ValueObject\Common\Id;
use Eurega\Shared\Domain\ValueObject\Common\Nombre;

abstract class ProductoRoot extends AggregateRoot{

    private Id $id;

    private Nombre $nombre;

    private PersistentCollection $ingredientes;

    abstract public function toPrimitives(): array;

    public function id(): Id {
        return $this->id;
    }

    public function nombre(): Nombre {
        return $this->nombre;
    }

    public function ingredientes(): PersistentCollection {
        return $this->ingredientes;
    }
    

}