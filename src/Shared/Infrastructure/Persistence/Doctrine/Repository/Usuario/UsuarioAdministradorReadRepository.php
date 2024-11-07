<?php

declare(strict_types=1);

namespace Eurega\Shared\Infrastructure\Persistence\Doctrine\Repository\Usuario;

use Eurega\Shared\Domain\Model\Usuario\UsuarioAdministradorModel;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Eurega\Backoffice\Domain\Exception\Usuario\UsuarioAdministrador\UsuarioAdministradorAlreadyExists;
use Eurega\Shared\Domain\Exception\Usuario\UsuarioNotFoundException;
use Eurega\Shared\Infrastructure\ValueObject\Common\EmailAddressType;
use Eurega\Shared\Infrastructure\ValueObject\Common\IdType;
use Eurega\Shared\Domain\ValueObject\Common\EmailAddress;
use Eurega\Shared\Domain\ValueObject\Common\Id;
use Exception;

class UsuarioAdministradorReadRepository implements \Eurega\Shared\Domain\Repository\Usuario\UsuarioAdministradorReadRepository
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function ofIdOrFail(Id $id): UsuarioAdministradorModel
    {
        $qb = $this->entityManager->createQueryBuilder();

        $qb
            ->select('usuario_administrador')
            ->from(UsuarioAdministradorModel::class, 'usuario_administrador')
            ->where(
                'usuario_administrador.id = :id'
            )
            ->setParameter('id', $id, IdType::TYPE_NAME);

        try {
            return $qb
                ->getQuery()
                ->getSingleResult();
        } catch (NoResultException | NonUniqueResultException $e) {
           throw $e;
        }
    }

    public function ofDireccionEmailAndFail(EmailAddress $emailAddress): void
    {
        $qb = $this->entityManager->createQueryBuilder();

        $qb
            ->select('COUNT(u)')
            ->from(UsuarioAdministradorModel::class, 'u')
            ->where(
                'u.direccionEmail = :email_address'
            )
            ->setParameter('email_address', $emailAddress, EmailAddressType::TYPE_NAME);

        $result = (int) $qb->getQuery()->getSingleScalarResult();

        if ($result === 0) {
            return;
        }

        throw UsuarioAdministradorAlreadyExists::withEmailAddress();
    }

    public function ofDireccionEmailOrFail(EmailAddress $direccionEmail): UsuarioAdministradorModel
    {
        $qb = $this->entityManager->createQueryBuilder();

        $qb
            ->select('usuario_administrador')
            ->from(UsuarioAdministradorModel::class, 'usuario_administrador')
            ->where(
                'usuario_administrador.direccionEmail = :correo_electronico'
            )
            ->setParameter('correo_electronico', $direccionEmail, EmailAddressType::TYPE_NAME);

                return $qb
                    ->getQuery()
                    ->getSingleResult();
    }

    public function ofDireccionEmailAndActivoOrFail(EmailAddress $direccionEmail): UsuarioAdministradorModel
    {
        return $this->ofDireccionEmailOrFail($direccionEmail);

        /*
        if ($usuario->estado()->equalsTo(Estado::activo())) {
            return $usuario;
        }
        */

        // throw UsuarioAdministradorBloqueado::withDireccionEmail($direccionEmail);
    }

    public function ofIdOrNull(Id $id): UsuarioAdministradorModel
    {
        $qb = $this->entityManager->createQueryBuilder();

        $qb->select('usuario_administrador')
            ->from(
                UsuarioAdministradorModel::class,
                'usuario_administrador'
            )
            ->where('usuario_administrador.id = :id')
            ->setParameter(
                'id',
                $id,
                IdType::TYPE_NAME
            );

        try {
            return $qb->getQuery()->getSingleResult();
        } catch (NoResultException $exception) {
            return null;
        }
    }
}
