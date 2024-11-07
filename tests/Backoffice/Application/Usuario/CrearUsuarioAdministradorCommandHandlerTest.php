<?php

declare(strict_types = 1);

namespace Tests\Backoffice\Application\Usuario;

use Eurega\Backoffice\Application\Handler\Usuario\Administrador\CrearUsuarioAdministradorCommandHandler;
use Eurega\Backoffice\Application\Service\Usuario\Administrador\UsuarioAdministradorCreator;
use Eurega\Shared\Infrastructure\PhpUnit\Modules\Usuario\CrearUsuarioAdministradorCommandMother;
use Eurega\Shared\Infrastructure\PhpUnit\Modules\Usuario\UsuarioAdministradorMother;
use Eurega\Shared\Infrastructure\PhpUnit\Modules\Usuario\UsuarioAdministradorSubModuleUnitTestCase;

use PHPUnit\Framework\Attributes\Test;

final class CrearUsuarioAdministradorCommandHandlerTest extends UsuarioAdministradorSubModuleUnitTestCase
{

    private CrearUsuarioAdministradorCommandHandler | null $handler;

	protected function setUp(): void
	{
		parent::setUp();

		$this->handler = new CrearUsuarioAdministradorCommandHandler(
            new UsuarioAdministradorCreator(
                $this->UsuarioAdministradorReadRepository(), 
                $this->UsuarioAdministradorWriteRepository(),
                $this->eventBus()
            )
        );
	}

    #[Test]
    public function it_should_create_a_valid_usuario_administrador() : void 
    {
        $command = CrearUsuarioAdministradorCommandMother::create();

		$usuario = UsuarioAdministradorMother::create(
            $this->usuarioAdministradorWriteRepository(),
            $this->eventBus()
        );

		$this->shouldSave();

        $this->shouldNotFoundExistingUser($usuario->direccionEmail());
        
		$this->shouldPublishNamedDomainEvent('backend.usuario.administrador.created');

        $this->handler->handle(($command));
    }
}