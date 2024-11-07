<?php

namespace Eurega\ShoppingList\Application\Service\Usuario;

use Eurega\ShoppingList\Domain\Exception\Usuario\UsuarioCannotCreateException;
use Eurega\Shared\Domain\Repository\Usuario\UsuarioParticularReadRepository;

use Eurega\Shared\Domain\ValueObject\Common\EmailAddress;
use Eurega\Shared\Domain\ValueObject\Common\Id;

final class UsuarioParticularFinder {

    public function __construct(
        private UsuarioParticularReadRepository $usuarioParticularReadRepository
    ) {

    }

    public function FindOneByIdOrFail(Id $id) {
        
        $this->usuarioParticularReadRepository->ofIdOrFail($id);
        
    }

    /**
     * @throws UsuarioCannotCreateException
     */
    public function FindOneByEmailAndFail(EmailAddress $email) {

        $this->usuarioParticularReadRepository->ofDireccionEmailAndFail($email);
        
    }

}