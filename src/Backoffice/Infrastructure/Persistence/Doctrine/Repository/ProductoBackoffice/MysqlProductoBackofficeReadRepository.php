<?php

declare(strict_types=1);

namespace Eurega\Backoffice\Infrastructure\Persistence\Doctrine\Repository\ProductoBackoffice;

use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;

use Eurega\Backoffice\Domain\Exception\ProductoBackoffice\ProductoBackofficeAlreadyExistException;
use Eurega\Backoffice\Domain\Model\ProductoBackoffice\ProductoBackoffice;
use Eurega\Backoffice\Domain\Repository\ProductoBackoffice\ProductoBackofficeReadRepository;

use Eurega\Backoffice\Infrastructure\Persistence\Doctrine\QueryBuilder\ProductoBackofficeQueryBuilder;

use Eurega\Shared\Infrastructure\ValueObject\Common\EmailAddressType;
use Eurega\Shared\Infrastructure\ValueObject\Common\IdType;

use Eurega\Shared\Domain\ValueObject\Common\Id;
use Eurega\Shared\Domain\ValueObject\Common\Nombre;
use Eurega\Shared\Domain\ValueObject\Repository\Limit;
use Eurega\Shared\Domain\ValueObject\Repository\OrderBy;
use Eurega\Shared\Infrastructure\ValueObject\Common\NombreType;

class MysqlProductoBackofficeReadRepository 
    implements ProductoBackofficeReadRepository 
{

    public function __construct(
		private readonly ProductoBackofficeQueryBuilder $queryBuilder
	) {}

    public function ofIdOrFail(Id $id): ProductoBackoffice
    {
        $qb = $this->queryBuilder->__invoke();

        $qb->where(
                'producto.id = :id'
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

    public function ofNombreOrFail(Nombre $nombre): ProductoBackoffice {

        $qb = $this->queryBuilder->__invoke();

        $qb->where(
                'producto.nombre = :nombre'
            )
            ->setParameter('nombre', $nombre, EmailAddressType::TYPE_NAME);

        $result = $qb->getQuery()->getSingleResult();

        if ($result === 0) {
            return null;
        }
        
        return $result;
    }

    /**
     * @throws ProductoBackofficeAlreadyExistException
     */
    public function ofNombreAndFail(Nombre $nombre): void {

        $qb = $this->queryBuilder->__invoke();

        $qb->where(
                'producto.nombre = :nombre'
            )
            ->setParameter('nombre', $nombre, NombreType::TYPE_NAME);
            
        $result = $qb->getQuery()->getOneOrNullResult();
        
        if($result === null) return;

        throw new ProductoBackofficeAlreadyExistException() ;
    }

    public function search(
        Id $id,
        string $className
    ): ?ProductoBackoffice {
		$qb = $this->queryBuilder->__invoke();
        $qb->where(
            'producto.id = :id'
        )
        ->setParameter('id', $id, IdType::TYPE_NAME);
        return $qb->getQuery()->getResult();
	}

    public function searchFiltered(
        ?Limit $limit,
        ?OrderBy $orderBy,
        array $filters
    ): array {
        $qb = $this->queryBuilder->__invoke(
            $filters,
            $limit,
            $orderBy
        );

		return $qb->getQuery()->getResult();
	}

    /*
	public function searchByCriteria(
        Criteria $criteria,
        string $className,
        array $criteriaToDoctrineFields
    ): array {
		$doctrineCriteria = DoctrineCriteriaConverter::convert(
			$criteria,
			$criteriaToDoctrineFields
		);
		return $this->repository($className)->matching($doctrineCriteria)->toArray();
	}
    */

}
