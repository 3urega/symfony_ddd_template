<?php

declare(strict_types=1);

namespace Eurega\Shared\Infrastructure\PhpUnit\Modules\Producto;

use Eurega\Backoffice\Domain\Repository\ProductoBackoffice\ProductoBackofficeReadRepository;
use Eurega\Backoffice\Domain\Repository\ProductoBackoffice\ProductoBackofficeWriteRepository;
use Eurega\Shared\Domain\Model\Usuario\UsuarioAdministradorModel;
use Eurega\Shared\Domain\ValueObject\Common\Id;

use Tests\Shared\Infrastructure\PhpUnit\UnitTestCase;

use Mockery;
use Mockery\MockInterface;

abstract class ProductoBackofficeModuleUnitTestCase extends UnitTestCase
{

	protected ProductoBackofficeReadRepository | MockInterface | null $productoBackofficeReadRepository = null;

	protected ProductoBackofficeWriteRepository | MockInterface | null $productoBackofficeWriteRepository = null;

	
	protected function shouldSave(): void
	{
		$this->productoBackofficeWriteRepository
			->shouldReceive('save')
			->with(Mockery::type(UsuarioAdministradorModel::class))
			->once()
			->andReturnNull();
	}

	protected function shouldSearch(Id $id, ?UsuarioAdministradorModel $usuario): void
	{
		$this->productoBackofficeReadRepository()
			->shouldReceive('search')
			->with($this->similarTo($id))
			->once()
			->andReturn($usuario);
	}

	protected function productoBackofficeReadRepository(): ProductoBackofficeReadRepository | MockInterface {
		return $this->productoBackofficeReadRepository ??= $this->mock(ProductoBackofficeReadRepository::class);
	}

	protected function productoBackofficeWriteRepository(): ProductoBackofficeWriteRepository | MockInterface {
		return $this->productoBackofficeWriteRepository ??= $this->mock(ProductoBackofficeWriteRepository::class);
	}
}