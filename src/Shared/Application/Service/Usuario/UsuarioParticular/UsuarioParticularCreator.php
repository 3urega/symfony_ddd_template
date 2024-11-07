<?php

namespace Eurega\Shared\Application\Service\Usuario\UsuarioParticular;

use Eurega\Shared\Domain\Bus\Event\EventBus;
use Eurega\Shared\Domain\Exception\Usuario\UsuarioAlreadyExistException;
use Eurega\Shared\Domain\Exception\Usuario\UsuarioCannotCreateException;
use Eurega\Shared\Domain\Repository\Usuario\UsuarioParticularReadRepository;
use Eurega\Shared\Domain\Repository\Usuario\UsuarioParticularWriteRepository;
use Eurega\Shared\Domain\Model\Usuario\UsuarioParticular;

use Eurega\Shared\Domain\ValueObject\Common\EmailAddress;
use Eurega\Shared\Domain\ValueObject\Common\Id;
use Eurega\Shared\Domain\ValueObject\Common\Nombre;
use Eurega\Shared\Domain\ValueObject\Security\PasswordHash;

use Throwable;

final class UsuarioParticularCreator {

    public function __construct(
        private UsuarioParticularWriteRepository $writeRepository,
        private UsuarioParticularReadRepository $readRepository,
        private EventBus $eventBus   
    ) { }

    public function create(
        Id $id,
        EmailAddress $email,
        PasswordHash $password,
        Nombre $nombre
    ) {

        try {
            $this->readRepository->ofDireccionEmailAndFail($email);
        } catch (UsuarioAlreadyExistException $e) {
            throw UsuarioCannotCreateException::becauseUsuarioWithEmailAlreadyExist();
        }

        $nuevoUsuario = UsuarioParticular::crear(
            $id,
            $email,
            $password,
            $nombre
        );

// var_dump($nuevoUsuario); die;

        $this->writeRepository->save($nuevoUsuario);

        $this->eventBus->publish(...$nuevoUsuario->pullDomainEvents());

    }

}