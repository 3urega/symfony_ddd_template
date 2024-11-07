<?php

namespace Eurega\Backoffice\Infrastructure\Persistence\Doctrine\QueryBuilder;


use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use Eurega\Backoffice\Domain\Model\ProductoBackoffice\ProductoBackoffice;
use Eurega\Shared\Domain\ValueObject\Repository\Limit;
use Eurega\Shared\Domain\ValueObject\Repository\OrderBy;

class ProductoBackofficeQueryBuilder
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {
    }

    public function __invoke(
        array $filters = [],
        ?Limit $limit = null,
        ?OrderBy $orderBy = null
        ): QueryBuilder
    {

        $qb = $this->entityManager->createQueryBuilder();

        $qb->select('producto')
            ->from(ProductoBackoffice::class, 'producto');

        if ($limit !== null && $limit->hasLimit()) {
            $qb->setMaxResults($limit->limit());
        }

        if ($limit !== null && $limit->hasOffset()) {
            $qb->setFirstResult($limit->offset());
        }

        if ($orderBy !== null && ! $orderBy->isEmpty()) {
            foreach ($orderBy->fields() as $field) {
                $qb->addOrderBy(
                    sprintf('producto.%s', $field->name()),
                    $field->direction()
                );
            }
        }


        if (array_key_exists('nombre', $filters)) {
            $qb
                ->where('producto.nombre LIKE  :nombre')
                ->setParameter('nombre', "%".$filters['nombre']."%");
        }

        return $qb;
    }
}