<?php

declare(strict_types = 1);

namespace Tests\ShoppingList\Application\ProductoShoppingList;

use Eurega\Shared\Infrastructure\PhpUnit\Modules\Producto\ProductoBackofficeMother;
use Eurega\Shared\Infrastructure\PhpUnit\ProductoBackofficeCreatedDomainEventMother;
use PHPUnit\Framework\Attributes\Test;
use Tests\ShoppingList\Infrastructure\PhpUnit\ProductoShoppingList\ProductoShoppingListModuleUnitTestCase;
use Tests\ShoppingList\Infrastructure\ProductoShoppingList\ProductoShoppingListMother;

final class CreateProductoShoppingListOnProductoBackofficeCreatedTest extends ProductoShoppingListModuleUnitTestCase
{

    protected function setUp(): void
	{
		parent::setUp();
	}

    #[Test]
    public function it_should_create_a_valid_producto_shopping_list() : void 
    {
        $nuevo_producto = ProductoBackofficeMother::create();

        $productoBackofficeCreatedDomainEvent = ProductoBackofficeCreatedDomainEventMother::fromProductoBackoffice(
            $nuevo_producto
        );

        // $this->shouldSearch();
    }

}