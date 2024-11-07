<?php

declare(strict_types=1);

namespace Eurega\ShoppingList\Application\Service\Usuario;

use Eurega\Shared\Domain\Bus\Event\EventBus;
use Eurega\Shared\Domain\UuidGenerator;
use Eurega\Shared\Domain\Repository\Usuario\UsuarioParticularReadRepository;
use Eurega\Shared\Domain\Repository\Usuario\UsuarioParticularWriteRepository;
use Eurega\Shared\Domain\ValueObject\Common\Id;
use Eurega\Shared\Domain\ValueObject\Common\Nombre;

final readonly class UsuarioCounterIncrementer
{
	public function __construct(
		private UsuarioParticularReadRepository $readRepository,
		private UsuarioParticularWriteRepository $WriteRepository,
		private UuidGenerator $uuidGenerator,
		private EventBus $bus
	) {}

	public function __invoke(Id $id): void
	{
		$usuario = $this->readRepository->ofIdOrFail($id);
		$usuario->modificarNombre(Nombre::fromString('cambiado despues'));
		$this->WriteRepository->save($usuario);
	}
}
