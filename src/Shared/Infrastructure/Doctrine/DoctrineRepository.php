<?php

declare(strict_types=1);

namespace Eurega\Shared\Infrastructure\Doctrine;

use Eurega\Shared\Domain\Aggregate\AggregateRoot;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Exception\NotSupported;

abstract class DoctrineRepository
{
	public function __construct(
		private readonly EntityManagerInterface $entityManager
	) {}

	protected function entityManager(): EntityManager
	{
		return $this->entityManager;
	}

	protected function save(AggregateRoot $entity): void
	{
		$this->entityManager()->persist($entity);
		$this->entityManager()->flush($entity);
	}

	protected function remove(AggregateRoot $entity): void
	{
		$this->entityManager()->remove($entity);
		$this->entityManager()->flush($entity);
	}

	/**
	 * @template T of object
	 *
	 * @psalm-param class-string<T> $entityClass
	 *
	 * @psalm-return EntityRepository<T>
	 *
	 * @throws NotSupported
	 */
	protected function repository(string $entityClass): EntityRepository
	{
		return $this->entityManager->getRepository($entityClass);
	}
}
