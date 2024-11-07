<?php

namespace Eurega\ShoppingList\Infrastructure\Persistence\Doctrine\QueryBuilder;


use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use Eurega\Shared\Domain\ValueObject\Repository\Limit;
use Eurega\Shared\Domain\ValueObject\Repository\OrderBy;
use Eurega\Shared\Infrastructure\ValueObject\Common\IdType;
use Eurega\Shared\Domain\Model\Usuario\UsuarioParticular;

class UsuarioParticularQueryBuilder
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

        $qb->select('usuario')
            ->from(UsuarioParticular::class, 'usuario');

        if (array_key_exists('id', $filters)) {
            $qb
                ->andWhere('usuario.id = :id')
                ->setParameter(
                    'id',
                    $filters['id'],
                    IdType::TYPE_NAME
                );
        }


        // if (array_key_exists('estado', $filters)) {
        //     $qb
        //         ->andWhere('usuario.estado = :estado')
        //         ->setParameter('estado', $filters['estado']);
        // }

        if ($limit !== null && $limit->hasLimit()) {
            $qb->setMaxResults($limit->limit());
        }

        if ($limit !== null && $limit->hasOffset()) {
            $qb->setFirstResult($limit->offset());
        }

        if ($orderBy !== null && !$orderBy->isEmpty()) {
            foreach ($orderBy->fields() as $field) {
                $qb->addOrderBy(
                    sprintf('usuario.%s', $field->name()),
                    $field->direction()
                );
            }
        }

        return $qb;
    }
}