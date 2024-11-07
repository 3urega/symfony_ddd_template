<?php

namespace Eurega\Shared\Application\Service\Usuario;

use Eurega\Shared\Application\Service\Usuario\FindUsuarioRequest;
use Eurega\Shared\Domain\Model\Usuario\Usuario;
use Eurega\Shared\Domain\Service\Usuario\UsuarioFinder;

final class FindUsuarioDomainModelByIdentifier
{
    public function __construct(private UsuarioFinder $usuarioFinder)
    {
    }

    /**
     * @return Usuario
     */
    public function find(FindUsuarioRequest $request): Usuario {
        
        return $this->usuarioFinder->find($request->usuarioEmail());
          
    }
}