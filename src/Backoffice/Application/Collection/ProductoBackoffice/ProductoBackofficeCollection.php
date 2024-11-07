<?php

namespace Eurega\Backoffice\Application\Collection\ProductoBackoffice;

use Eurega\Backoffice\Domain\Dto\ProductoBackoffice\ProductoBackofficeResponse;
use Eurega\Shared\Domain\Collection;
use Webmozart\Assert\Assert;

/**
 * Estos dto que terminan con la palabra "response" se usan para devolver datos estructurados desde un repositorio a un controlador
 */
final class ProductoBackofficeCollection extends Collection
{
    /**
     *
     * @throws InvalidArgumentException
     */
    public static function fromElements(array $elements): self
    {
        Assert::allIsInstanceOf($elements, ProductoBackofficeResponse::class);

        $collection = new self();

        $collection->items = $elements;

        return $collection;
    }

    public function addElement($element): void
    {
        Assert::isInstanceOf($element, ProductoBackofficeResponse::class);

        $this->items[] = $element;
    }

    public static function createEmpty(): self
    {
        return new self();
    }

    public function first(): ProductoBackofficeResponse
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
        return ProductoBackofficeResponse::class;
    }
}