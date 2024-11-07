<?php

declare(strict_types=1);

namespace Eurega\Shared\Infrastructure\Persistence\Doctrine\Repository;

use Eurega\Shared\Domain\Aggregate\AggregateRoot;
use Eurega\Shared\Domain\Criteria\Criteria;
use Eurega\Shared\Domain\ValueObject\Common\Id;
use Eurega\Shared\Infrastructure\Doctrine\DoctrineCriteriaConverter;
use Eurega\Shared\Infrastructure\Doctrine\DoctrineRepository;

abstract class MysqlReadRepository extends DoctrineRepository
{
	public function search(
        Id $id,
        string $className
    ): ?AggregateRoot {
		return $this->repository($className)->find($id);
	}

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
}
