<?php

declare(strict_types = 1);

namespace Tests\Backoffice\Application\Usuario;

use Eurega\Backoffice\Application\Handler\ProductoBackoffice\CreaProductoBackofficeCommandHandler;
use Eurega\Backoffice\Application\Service\ProductoBackoffice\ProductoBackofficeCreator;
use Eurega\Shared\Infrastructure\PhpUnit\Modules\Producto\CrearProductoBackofficeCommandMother;
use Eurega\Shared\Infrastructure\PhpUnit\Modules\Producto\ProductoBackofficeModuleUnitTestCase;
use Eurega\Shared\Infrastructure\PhpUnit\Modules\Producto\ProductoBackofficeMother;
use Eurega\Shared\Infrastructure\PhpUnit\Modules\Usuario\CrearUsuarioAdministradorCommandMother;
use Eurega\Shared\Infrastructure\PhpUnit\Modules\Usuario\UsuarioAdministradorMother;

use PHPUnit\Framework\Attributes\Test;

final class CreaProductoBackofficeCommandHandlerTest extends ProductoBackofficeModuleUnitTestCase
{

    private CreaProductoBackofficeCommandHandler | null $handler;

	protected function setUp(): void
	{
		parent::setUp();

		$this->handler = new CreaProductoBackofficeCommandHandler(
            new ProductoBackofficeCreator(
                $this->productoBackofficeWriteRepository(),
                $this->productoBackofficeReadRepository(), 
                $this->eventBus()
            )
        );
	}

    #[Test]
    public function it_should_create_a_valid_producto_backoffice() : void 
    {
        $command = CrearProductoBackofficeCommandMother::create();

		$producto = ProductoBackofficeMother::create( );

		$this->shouldSave();

        // $this->shouldNotFoundExistingUser($producto->direccionEmail());
        
		$this->shouldPublishNamedDomainEvent('backoffice.producto.backoffice.created');

        $this->handler->handle(($command));
    }
}