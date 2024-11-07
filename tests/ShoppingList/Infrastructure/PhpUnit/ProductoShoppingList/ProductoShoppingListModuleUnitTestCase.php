<?php

declare(strict_types=1);

namespace Tests\ShoppingList\Infrastructure\PhpUnit\ProductoShoppingList;

use Eurega\Backoffice\Domain\Repository\ProductoBackoffice\ProductoBackofficeReadRepository;
use Eurega\Backoffice\Domain\Repository\ProductoBackoffice\ProductoBackofficeWriteRepository;
use Eurega\Shared\Domain\Model\Usuario\UsuarioAdministradorModel;
use Eurega\Shared\Domain\ValueObject\Common\Id;
use Eurega\ShoppingList\Domain\Model\ProductoShoppingList\ProductoShoppingList;
use Eurega\ShoppingList\Domain\Repository\ProductoShoppingList\ProductoShoppingListReadRepository;
use Eurega\ShoppingList\Domain\Repository\ProductoShoppingList\ProductoShoppingListWriteRepository;
use Tests\Shared\Infrastructure\PhpUnit\UnitTestCase;

use Mockery;
use Mockery\MockInterface;

abstract class ProductoShoppingListModuleUnitTestCase extends UnitTestCase
{

	protected ProductoShoppingListReadRepository | MockInterface | null $productoShoppingListReadRepository = null;

	protected ProductoShoppingListWriteRepository | MockInterface | null $productoShoppingListWriteRepository = null;

	
	protected function shouldSave(): void
	{
		$this->productoShoppingListWriteRepository
			->shouldReceive('save')
			->with(Mockery::type(ProductoShoppingList::class))
			->once()
			->andReturnNull();
	}

	protected function shouldSearch(Id $id, ?ProductoShoppingList $producto): void
	{
		$this->productoShoppingListReadRepository()
			->shouldReceive('search')
			->with($this->similarTo($id))
			->once()
			->andReturn($producto);
	}

	protected function productoShoppingListReadRepository(): ProductoBackofficeReadRepository | MockInterface {
		return $this->productoShoppingListReadRepository ??= $this->mock(ProductoBackofficeReadRepository::class);
	}

	protected function productoShoppingListWriteRepository(): ProductoBackofficeWriteRepository | MockInterface {
		return $this->productoShoppingListWriteRepository ??= $this->mock(ProductoBackofficeWriteRepository::class);
	}
}