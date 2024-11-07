<?php

declare(strict_types=1);

namespace Eurega\ShoppingList\Domain\Collection\Usuario\UsuarioParticular;

use Countable;
use Eurega\ShoppingList\Domain\Dto\Usuario\UsuarioParticular\ElementoDeAll;
use InvalidArgumentException;
use IteratorAggregate;
use Traversable;
use Webmozart\Assert\Assert;

use function count;

class ListadoUsuarioParticularCollection implements IteratorAggregate, Countable
{
    /** @var ElementoDeAll[] */
    private array $elements = [];

    private int $count = 0;

    private function __construct()
    {
    }

    /**
     * @param ElementoDeAll[] $elements
     *
     * @throws InvalidArgumentException
     */
    public static function fromElements(array $elements): self
    {
        Assert::allIsInstanceOf($elements, ElementoDeAll::class);

        $collection = new self();

        $collection->elements = $elements;
        $collection->count    = count($elements);

        return $collection;
    }

    public function addElement($element): void
    {
        Assert::isInstanceOf($element, ElementoDeAll::class);

        $this->elements[] = $element;
        $this->count++;
    }

    public static function createEmpty(): self
    {
        return new self();
    }

    public function count(): int
    {
        return $this->count;
    }

    public function first(): ElementoDeAll
    {
        return $this->elements[0];
    }

    public function getIterator(): Traversable
    {
        yield from $this->elements;
    }
}
