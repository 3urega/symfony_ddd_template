<?php

declare(strict_types=1);

namespace Tests\ShoppingList\Infrastructure;

use Doctrine\ORM\EntityManager;
use Eurega\Shared\Infrastructure\PhpUnit\ShoppingListContextInfrastructureTestCase;
use Eurega\Shared\Domain\Repository\Usuario\UsuarioReadRepository;
use Eurega\ShoppingList\Infrastructure\Persistence\Doctrine\QueryBuilder\UsuarioParticularQueryBuilder;
use Eurega\Shared\Infrastructure\Persistence\Doctrine\Repository\Usuario\UsuarioParticularReadRepository;

// Para hacer unit test de infrastructura
abstract class UsuariosModuleInfrastructureTestCase extends ShoppingListContextInfrastructureTestCase
{
	protected function usuarioParticularDoctrineRepository(): UsuarioReadRepository
	{
		$className = EntityManager::class;
		$queryBuilder = new UsuarioParticularQueryBuilder($this->service($className));
		
		return new UsuarioParticularReadRepository($this->service($className), $queryBuilder);
	}
}
