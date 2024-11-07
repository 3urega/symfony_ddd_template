<?php

declare(strict_types=1);

namespace Eurega\ShoppingList\Infrastructure\Persistence\Doctrine\Repository\ProductoShoppingList;

use Eurega\Shared\Domain\Model\Usuario\UsuarioParticular;
use Eurega\Shared\Domain\ValueObject\Common\Id;

use Eurega\Shared\Infrastructure\ValueObject\Common\IdType;
use Eurega\Shared\Infrastructure\Doctrine\DoctrineRepository;

use Eurega\ShoppingList\Infrastructure\Persistence\Doctrine\QueryBuilder\UsuarioParticularQueryBuilder;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NoResultException;
use Eurega\ShoppingList\Domain\Model\ProductoShoppingList\ProductoShoppingList;

final class ProductoShoppingListReadRepository 
extends DoctrineRepository 
implements \Eurega\ShoppingList\Domain\Repository\ProductoShoppingList\ProductoShoppingListReadRepository 
{

    public function __construct(
        private EntityManagerInterface $entityManager,
        private UsuarioParticularQueryBuilder $queryBuilder
    ) {}

    public function ofIdOrFail(Id $id): ProductoShoppingList {

        $qb = $this->queryBuilder->__invoke(['id' => $id]);

        return $qb->getQuery()->getSingleResult();
    }


    public function ofIdOrNull(Id $id): ProductoShoppingList {
        $qb = $this->entityManager->createQueryBuilder();

        $qb->select('producto')
            ->from(
                UsuarioParticular::class,
                'producto'
            )
            ->where('producto.id = :id')
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
