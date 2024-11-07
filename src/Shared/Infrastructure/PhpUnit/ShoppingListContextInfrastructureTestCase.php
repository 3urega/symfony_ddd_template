<?php

declare(strict_types=1);

namespace Eurega\Shared\Infrastructure\PhpUnit;

use Doctrine\ORM\EntityManager;
use Tests\ShoppingList\Infrastructure\InfrastructureTestCase;

abstract class ShoppingListContextInfrastructureTestCase extends InfrastructureTestCase
{
	protected function setUp(): void
	{
		parent::setUp();

		$arranger = new MoocEnvironmentArranger($this->service(EntityManager::class));

		$arranger->arrange();
	}

	protected function tearDown(): void
	{
		$arranger = new MoocEnvironmentArranger($this->service(EntityManager::class));

		$arranger->close();

		parent::tearDown();
	}

	protected function kernelClass(): string
	{
		return ShoppingListBackendKernel::class;
	}
}
