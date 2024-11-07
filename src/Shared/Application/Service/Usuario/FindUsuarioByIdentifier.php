<?php

namespace Eurega\Shared\Application\Service\Usuario;

use Eurega\Shared\Application\Service\Usuario\FindUsuarioRequest;
use Eurega\Shared\Domain\Service\Usuario\UsuarioFinder;

final class FindUsuarioByIdentifier
{
    public function __construct(private UsuarioFinder $usuarioFinder)
    {
    }

    /**
     * @return FindUsuarioResponse
     */
    public function find(FindUsuarioRequest $request): FindUsuarioResponse {
        
        $usuario = $this->usuarioFinder->find($request->usuarioEmail());
        $response = new FindUsuarioResponse(
            $usuario->id()->asString(),
            $usuario->direccionEmail()->asString(),
            $usuario->password()->asString()
        );
        return $response;
    }
}