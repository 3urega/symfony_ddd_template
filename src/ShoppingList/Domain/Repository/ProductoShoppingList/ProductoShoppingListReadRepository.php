<?php

declare(strict_types=1);

namespace Eurega\ShoppingList\Domain\Repository\ProductoShoppingList;

use Eurega\Shared\Domain\ValueObject\Common\Id;

use Eurega\ShoppingList\Domain\Model\ProductoShoppingList\ProductoShoppingList;

interface ProductoShoppingListReadRepository {
    
    public function ofIdOrFail(Id $id): ProductoShoppingList;

    public function ofIdOrNull(Id $id): ProductoShoppingList;

    // public function search(Id $id): ?UsuarioAdministradorModel;

	// public function searchByCriteria(Criteria $criteria): Collection;
    
}
