<?php

declare(strict_types=1);

namespace Eurega\ShoppingList\Domain\Repository\ProductoShoppingList;

use Eurega\Shared\Domain\ValueObject\Common\Id;

use Eurega\ShoppingList\Domain\Model\ProductoShoppingList\ProductoShoppingList;

interface ProductoShoppingListWriteRepository 
{
    public function nextIdentity(): Id;

    public function save(ProductoShoppingList $producto): void;
}
