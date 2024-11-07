<?php

declare(strict_types=1);

namespace Eurega\Shared\Infrastructure\PhpUnit\Modules\Usuario;

use Eurega\Shared\Domain\Model\Usuario\UsuarioAdministradorModel;
use Eurega\Shared\Domain\Repository\Usuario\UsuarioAdministradorReadRepository;
use Eurega\Shared\Domain\Repository\Usuario\UsuarioAdministradorWriteRepository;
use Eurega\Shared\Domain\ValueObject\Common\EmailAddress;
use Eurega\Shared\Domain\ValueObject\Common\Id;

use Tests\Shared\Infrastructure\PhpUnit\UnitTestCase;

use Mockery;
use Mockery\MockInterface;

abstract class UsuarioAdministradorSubModuleUnitTestCase extends UnitTestCase
{

	protected UsuarioAdministradorReadRepository | MockInterface | null $UsuarioAdministradorReadRepository = null;

	protected UsuarioAdministradorWriteRepository | MockInterface | null $UsuarioAdministradorWriteRepository = null;

	
	protected function shouldSave(): void
	{
		$this->UsuarioAdministradorWriteRepository
			->shouldReceive('save')
			->with(Mockery::type(UsuarioAdministradorModel::class))
			->once()
			->andReturnNull();
	}

	protected function shouldSearch(Id $id, ?UsuarioAdministradorModel $usuario): void
	{
		$this->usuarioAdministradorReadRepository()
			->shouldReceive('search')
			->with($this->similarTo($id))
			->once()
			->andReturn($usuario);
	}
	
	protected function shouldNotFoundExistingUser(EmailAddress $email): void
	{
		$this->usuarioAdministradorReadRepository()
			->shouldReceive('ofDireccionEmailAndFail')
			->with($this->similarTo($email))
			->once()
			->andReturn(null);
	}

	protected function usuarioAdministradorReadRepository(): UsuarioAdministradorReadRepository | MockInterface {
		return $this->UsuarioAdministradorReadRepository ??= $this->mock(UsuarioAdministradorReadRepository::class);
	}

	protected function usuarioAdministradorWriteRepository(): UsuarioAdministradorWriteRepository | MockInterface {
		return $this->UsuarioAdministradorWriteRepository ??= $this->mock(UsuarioAdministradorWriteRepository::class);
	}
}