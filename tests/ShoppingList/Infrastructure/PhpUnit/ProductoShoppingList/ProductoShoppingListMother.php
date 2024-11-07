<?php

declare(strict_types=1);

namespace Tests\ShoppingList\Infrastructure\ProductoShoppingList;

use Eurega\Shared\Domain\ValueObject\Common\Id;
use Eurega\Shared\Domain\ValueObject\Common\Nombre;
use Eurega\Shared\Infrastructure\PhpUnit\UuidMother;
use Eurega\Shared\Infrastructure\PhpUnit\WordMother;
use Eurega\ShoppingList\Domain\Model\ProductoShoppingList\ProductoShoppingList;

final class ProductoShoppingListMother
{
	public static function create(
    ): ProductoShoppingList
	{
		return ProductoShoppingList::crear(
            Id::fromString(UuidMother::create()),
            Nombre::fromString(WordMother::create())
        );
	}
}
