<?php

declare(strict_types = 1);

namespace Tests\Backoffice\Application\Usuario;

use Eurega\Backoffice\Application\Handler\Usuario\Particular\CrearUsuarioParticularCommandHandler;
use Eurega\Backoffice\Application\Service\Usuario\UsuarioParticular\UsuarioParticularCreator;
use Eurega\Shared\Infrastructure\PhpUnit\CrearUsuarioParticularCommandMother;
use Eurega\Shared\Infrastructure\PhpUnit\Modules\UsuarioParticularSubModuleUnitTestCase;
use Eurega\Shared\Infrastructure\PhpUnit\UsuarioParticularMother;
use PHPUnit\Framework\Attributes\Test;

final class CrearUsuarioParticularCommandHandlerTest extends UsuarioParticularSubModuleUnitTestCase 
{

    private CrearUsuarioParticularCommandHandler | null $handler;

	protected function setUp(): void
	{
		parent::setUp();

		$this->handler = new CrearUsuarioParticularCommandHandler(
            new UsuarioParticularCreator(
                $this->usuarioParticularWriteRepository(), 
                $this->usuarioParticularReadRepository(),
                $this->eventBus()
            )
        );
	}

    #[Test]
    public function it_should_create_a_valid_usuario_particular() : void 
    {
        $command = CrearUsuarioParticularCommandMother::create();

		$usuario = UsuarioParticularMother::create(
            $this->usuarioParticularWriteRepository(),
            $this->eventBus()
        );

		$this->shouldSave($usuario);

        $this->shouldNotFoundExistingUser($usuario->direccionEmail());
        
		$this->shouldPublishNamedDomainEvent('backend.usuario.particular.created');

        $this->handler->handle(($command));
    }
}