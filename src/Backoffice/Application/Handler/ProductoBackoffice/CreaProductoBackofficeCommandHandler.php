<?php

declare(strict_types=1);

namespace Eurega\Backoffice\Application\Handler\ProductoBackoffice;

use Eurega\Backoffice\Application\Command\ProductoBackoffice\CreaProductoBackofficeCommand;
use Eurega\Backoffice\Application\Service\ProductoBackoffice\ProductoBackofficeCreator;

use Eurega\Shared\Domain\Bus\Command\CommandHandler;
use Eurega\Shared\Domain\ValueObject\Common\Id;
use Eurega\Shared\Domain\ValueObject\Common\Nombre;

final readonly class CreaProductoBackofficeCommandHandler implements CommandHandler
{
	public function __construct(
		private ProductoBackofficeCreator $creator
	) {}

	public function handle(CreaProductoBackofficeCommand $command): void
	{
		$nombre = Nombre::fromString($command->nombre());

		$id = Id::fromStringOrNull($command->id()) ?? Id::generate();

		$this->creator->__invoke(
			$id,
			$nombre
		);
	}
}
