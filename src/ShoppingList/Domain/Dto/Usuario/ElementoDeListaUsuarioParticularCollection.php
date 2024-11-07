<?php

namespace Eurega\ShoppingList\Domain\Dto\Usuario;

use IteratorAggregate;
use Countable;
use Eurega\Shared\Domain\Collection;
use Traversable;
use Webmozart\Assert\Assert;

/**
 * Estos dto que terminan con la palabra "response" se usan para devolver datos estructurados desde un repositorio a un controlador
 */
final class ElementoDeListaUsuarioParticularCollection extends Collection
{

    /**
     * @param ListadoUsuarios[] $elements
     *
     * @throws InvalidArgumentException
     */
    public static function fromElements(array $elements): self
    {
        Assert::allIsInstanceOf($elements, ElementoDeListaUsuarioParticularResponse::class);

        $collection = new self();

        $collection->items = $elements;

        return $collection;
    }

    public function addElement($element): void
    {
        Assert::isInstanceOf($element, ElementoDeListaUsuarioParticularResponse::class);

        $this->items[] = $element;
    }

    public static function createEmpty(): self
    {
        return new self();
    }

    public function first(): ElementoDeListaUsuarioParticularResponse
    {
        return $this->items[0];
    }

    /*
    public function getIterator(): Traversable
    {
        yield from $this->elements;
    }
    */

    function type(): string {
        return ElementoDeListaUsuarioParticularResponse::class;
    }
}