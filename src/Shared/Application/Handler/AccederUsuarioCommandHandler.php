<?php

declare(strict_types=1);

namespace Eurega\Shared\Application\Handler;

use Eurega\Shared\Application\Command\AccederUsuarioCommand;
use Eurega\Shared\Domain\Repository\Usuario\UsuarioReadRepository;
use Eurega\Shared\Domain\ValueObject\Common\Id;

class AccederUsuarioCommandHandler {

    public function __construct(
        private UsuarioReadRepository $usuarioReadRepository
    ) {
    }

    public function __invoke(AccederUsuarioCommand $command): void
    {
        $usuario = $this->usuarioReadRepository->ofIdOrFail(
            Id::fromString($command->id)
        );

        $usuario->acceder();
    }
}
