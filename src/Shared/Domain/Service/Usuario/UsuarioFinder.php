<?php

declare(strict_types=1);

namespace Eurega\Shared\Domain\Service\Usuario;

use Doctrine\ORM\NoResultException;
use Eurega\Shared\Domain\Exception\Usuario\UsuarioNotFoundException;
use Eurega\Shared\Domain\Model\Usuario\Usuario;
use Eurega\Shared\Domain\Repository\Usuario\UsuarioAdministradorReadRepository;
use Eurega\Shared\Domain\Repository\Usuario\UsuarioParticularReadRepository;
use Eurega\Shared\Domain\ValueObject\Common\EmailAddress;

final class UsuarioFinder
{
    public function __construct(
        private UsuarioParticularReadRepository $usuarioParticularReadRepository,
        private UsuarioAdministradorReadRepository $usuarioAdministradorReadRepository
    ){}
    
    /**
     * @throws UsuarioNotFoundException
     */
    public function find(string $email): Usuario
    {
        try {
            
            $response = $this->usuarioParticularReadRepository->ofDireccionEmailAndActivoOrFail(
                EmailAddress::fromString($email)
            );
            return $response;
            
        } catch(NoResultException $e){ }
        try {
            $response = $this->usuarioAdministradorReadRepository->ofDireccionEmailAndActivoOrFail(
                EmailAddress::fromString($email)
            );
            return $response;
        } catch(NoResultException $e){ }

        throw new UsuarioNotFoundException();
    }
}