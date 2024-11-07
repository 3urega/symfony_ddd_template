<?php

namespace Eurega\Shared\Infrastructure\Symfony\Security\Provider;

use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Eurega\Shared\Domain\Repository\Usuario\UsuarioAdministradorReadRepository;
use Eurega\Shared\Domain\ValueObject\Common\EmailAddress as CommonEmailAddress;
use Eurega\Shared\Infrastructure\Symfony\Security\Usuario\SfUsuarioParticular;
use Eurega\Shared\Domain\Repository\Usuario\UsuarioParticularReadRepository;
use Eurega\Shared\Infrastructure\Symfony\Security\Usuario\SfUsuario;
use Eurega\Shared\Infrastructure\Symfony\Security\Usuario\SfUsuarioAdministrador;
use Exception;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Throwable;

final class UsuarioSymfonyProvider implements UserProviderInterface {

    public function __construct(
        private UsuarioParticularReadRepository $usuarioParticularReadRepository,
        private UsuarioAdministradorReadRepository $usuarioAdministradorReadRepository
        )
    { }

    /**
     * @param identifier Tenemos en cuenta que el identifier que nos llega es el email con el que se ha registrado 
     */
    public function loadUserByIdentifier(string $identifier): UserInterface {
        try {
            return SfUsuarioParticular::fromDomainModel(
                $this->usuarioParticularReadRepository->ofDireccionEmailAndActivoOrFail(
                    CommonEmailAddress::fromString($identifier)
                )
            );
        } catch(NoResultException $e){ }
        try {
            return SfUsuarioAdministrador::fromDomainModel(
                $this->usuarioAdministradorReadRepository->ofDireccionEmailAndActivoOrFail(
                    CommonEmailAddress::fromString($identifier)
                )
            );
        } catch(NoResultException $e){}
        throw New Exception('User or password are incorrect'); 
    }

    public function loadUserByUsername(string $username): SfUsuarioParticular
    {
        try {
            return SfUsuarioParticular::fromDomainModel(
                $this->usuarioParticularReadRepository->ofDireccionEmailAndActivoOrFail(
                    CommonEmailAddress::fromString($username)
                )
            );
        } catch (Throwable $e) {
        // catch (UsuarioAdministradorNotFound | UsuarioAdministradorBloqueado $e) {
            // throw new UsernameNotFoundException('El nom o el password no es correcte.');
            throw new Exception('El nom o el password no es correcte.');
        }
        
    }

    public function refreshUser(UserInterface $user): UserInterface
    {
        return $this->loadUserByUsername($user->getUserIdentifier());
    }

    public function supportsClass(string $class): bool
    {
        return $class === SfUsuario::class;
    }
}
