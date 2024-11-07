<?php

declare(strict_types=1);

namespace App\Backoffice\Frontend\Command\Test;

use App\Backoffice\Frontend\Command\Test\TestCommand;

use Eurega\Shared\Domain\Bus\Command\CommandHandler;
use Eurega\ShoppingList\Application\Service\ProductoShoppingList\ProductoShoppingListCreator;

final readonly class TestCommandHandler implements CommandHandler
{
	public function __construct(
		private ProductoShoppingListCreator $creator
	) {}

	public function handle(TestCommand $command): void
	{

		$this->creator->create(
			"786f195a-2238-4063-a5b5-593ffe640685",
			'pruebas1'
		);
	}
}
