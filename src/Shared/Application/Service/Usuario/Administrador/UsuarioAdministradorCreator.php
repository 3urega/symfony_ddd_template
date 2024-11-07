<?php

namespace Eurega\Shared\Application\Service\Usuario\Administrador;

use Eurega\Shared\Domain\Bus\Event\EventBus;
use Eurega\Shared\Domain\Model\Usuario\UsuarioAdministradorModel;
use Eurega\Shared\Domain\Repository\Usuario\UsuarioAdministradorReadRepository;
use Eurega\Shared\Domain\Repository\Usuario\UsuarioAdministradorWriteRepository;
use Eurega\Shared\Domain\ValueObject\Common\EmailAddress;
use Eurega\Shared\Domain\ValueObject\Common\Id;
use Eurega\Shared\Domain\ValueObject\Common\Nombre;
use Eurega\Shared\Domain\ValueObject\Security\PasswordHash;
use Eurega\Shared\Domain\Exception\Usuario\UsuarioAlreadyExistException;
use Eurega\Shared\Domain\Exception\Usuario\UsuarioCannotCreateException;

class UsuarioAdministradorCreator {

    public function __construct(
        private UsuarioAdministradorReadRepository $readRepository,
        private UsuarioAdministradorWriteRepository $writeRepository,
        private EventBus $eventBus   
    ) {
    }

    public function create(
        Id $id,
        EmailAddress $email,
        PasswordHash $password,
        Nombre $nombre
    ): void
    {
        try {
            $this->readRepository->ofDireccionEmailAndFail($email);
        } catch (UsuarioAlreadyExistException $e) {
            throw UsuarioCannotCreateException::becauseUsuarioWithEmailAlreadyExist();
        }

        $nuevoUsuario = UsuarioAdministradorModel::crear(
            $id,
            $nombre,
            $email,
            $password
        );

// var_dump($nuevoUsuario); die;

        $this->writeRepository->save($nuevoUsuario);

        $this->eventBus->publish(...$nuevoUsuario->pullDomainEvents());
    }

}