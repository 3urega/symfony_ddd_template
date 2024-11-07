<?php

namespace Tests\ShoppingList\Infrastructure;

use Eurega\Shared\Infrastructure\PhpUnit\UsuarioParticularMother;
use PHPUnit\Framework\Attributes\Test;

final class DoctrineUsuarioRepositoryTest extends UsuariosModuleInfrastructureTestCase {

    #[Test]
    public function it_should_save(): void
    {
        $usuario = UsuarioParticularMother::create();
    }
    
}