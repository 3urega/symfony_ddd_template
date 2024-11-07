<?php

namespace App\ShoppingList\Backend\Controller\Usuario;

use Eurega\Shared\Domain\Bus\Command\CommandBusWrite;
use Eurega\ShoppingList\Application\Command\Usuario\CrearUsuarioParticularCommand;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class UsuarioParticularPutController {

    public function __construct(
        private CommandBusWrite $writeBus
    ) { }

    public function __invoke(
        string $id,
        Request $request
    ) {

        $parameters = json_decode($request->getContent(), true);

        $nombre = $parameters['nombre'];
        $password = $parameters['password'];
        $email = $parameters['email'];

        $this->writeBus->handle(
            new CrearUsuarioParticularCommand(
                $email,
                $password,
                $nombre
            )
        );
        
        return new Response('', Response::HTTP_CREATED);
        
    }
}