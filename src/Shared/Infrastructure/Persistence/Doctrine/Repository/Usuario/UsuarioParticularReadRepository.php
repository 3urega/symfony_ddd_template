<?php

declare(strict_types=1);

namespace Eurega\Shared\Infrastructure\Persistence\Doctrine\Repository\Usuario;

use Eurega\Shared\Domain\Model\Usuario\UsuarioParticular;
use Eurega\Shared\Domain\ValueObject\Common\EmailAddress;
use Eurega\Shared\Domain\ValueObject\Common\Id;

use Eurega\Shared\Domain\Criteria\Criteria;
use Eurega\Shared\Domain\ValueObject\Repository\Limit;
use Eurega\Shared\Domain\ValueObject\Repository\OrderBy;
use Eurega\Shared\Infrastructure\Doctrine\DoctrineCriteriaConverter;
use Eurega\Shared\Infrastructure\ValueObject\Common\EmailAddressType;
use Eurega\Shared\Infrastructure\ValueObject\Common\IdType;
use Eurega\Shared\Infrastructure\Doctrine\DoctrineRepository;

use Eurega\ShoppingList\Infrastructure\Persistence\Doctrine\QueryBuilder\UsuarioParticularQueryBuilder;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NoResultException;
use Eurega\Shared\Domain\Exception\Usuario\UsuarioAlreadyExistException;
use Eurega\Shared\Domain\Exception\Usuario\UsuarioNotFoundException;
use Exception;

final class UsuarioParticularReadRepository 
extends DoctrineRepository 
implements \Eurega\Shared\Domain\Repository\Usuario\UsuarioParticularReadRepository 
{

    public function __construct(
        private EntityManagerInterface $entityManager,
        private UsuarioParticularQueryBuilder $queryBuilder
    ) {}

    public function ofIdOrFail(Id $id): UsuarioParticular {

        $qb = $this->queryBuilder->__invoke(['id' => $id]);

        return $qb->getQuery()->getSingleResult();
    }


    public function ofDireccionEmailAndActivoOrFail(EmailAddress $direccionEmail): UsuarioParticular
    {
        $usuario = $this->ofDireccionEmailOrFail($direccionEmail);

        return $usuario;

        /*
        if ($usuario->estado()->equalsTo(Estado::activo())) {
            return $usuario;
        }
        */

        // throw UsuarioAdministradorBloqueado::withDireccionEmail($direccionEmail);
    }

    public function ofIdOrNull(Id $id): UsuarioParticular {
        $qb = $this->entityManager->createQueryBuilder();

        $qb->select('usuario_particular')
            ->from(
                UsuarioParticular::class,
                'usuario_particular'
            )
            ->where('usuario_particular.id = :id')
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

    public function ofDireccionEmailOrFail(EmailAddress $direccionEmail): UsuarioParticular
    {
        $qb = $this->entityManager->createQueryBuilder();

        $qb
            ->select('usuario_particular')
            ->from(UsuarioParticular::class, 'usuario_particular')
            ->where(
                'usuario_particular.direccionEmail = :correo_electronico'
            )
            ->setParameter('correo_electronico', $direccionEmail, EmailAddressType::TYPE_NAME);

        
            return $qb
                ->getQuery()
                ->getSingleResult();
        
    }


    public function ofDireccionEmailAndFail(EmailAddress $emailAddress): void
    {
        $qb = $this->entityManager->createQueryBuilder();

        $qb
            ->select('COUNT(u)')
            ->from(UsuarioParticular::class, 'u')
            ->where(
                'u.direccionEmail = :email_address'
            )
            ->setParameter('email_address', $emailAddress, EmailAddressType::TYPE_NAME);

        $result = (int) $qb->getQuery()->getSingleScalarResult();

        if ($result === 0) {
            return;
        }

        throw new UsuarioAlreadyExistException();
    }
    

    public function all(
        ?Limit $limit,
        ?OrderBy $orderBy,
        array $filters
    ): array {
        $qb = $this->queryBuilder->__invoke(
            $filters,
            $limit,
            $orderBy
        );

        $qb->select('
            NEW Eurega\\ShoppingList\\Domain\\Dto\\Usuario\\UsuarioParticular\\ElementoDeAll(
                usuario.id,
                usuario.nombre,
                usuario.direccionEmail
            )        
        ');
        
        return $qb->getQuery()->getResult();
        
    }

    public function search(Criteria $criteria): array
	{
		$doctrineCriteria = DoctrineCriteriaConverter::convert(
            $criteria, 
            []
        );
        
        $repository = $this->entityManager->getRepository(UsuarioParticular::class);
        
		return $repository->matching($doctrineCriteria)->toArray();
	}
    
}
