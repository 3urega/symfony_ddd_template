<?php

declare(strict_types=1);

namespace Eurega\Shared\Domain;

use ArrayIterator;
use Countable;
use IteratorAggregate;
use Traversable;
use Webmozart\Assert\Assert;

/** @template-implements IteratorAggregate<mixed>*/
abstract class Collection implements Countable, IteratorAggregate
{
	public function __construct(
		protected array $items = []
		)
	{
		Assert::allIsInstanceOf($items, $this->type());
	}

	abstract protected function type(): string;

	final public function getIterator(): Traversable
	{
		return new ArrayIterator($this->items());
	}

	final public function count(): int
	{
		return count($this->items());
	}

	protected function items(): array
	{
		return $this->items;
	}
}
