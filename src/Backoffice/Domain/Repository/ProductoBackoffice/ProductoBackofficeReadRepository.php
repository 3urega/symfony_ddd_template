<?php

declare(strict_types=1);

namespace Eurega\Backoffice\Domain\Repository\ProductoBackoffice;

use Eurega\Backoffice\Domain\Exception\ProductoBackoffice\ProductoBackofficeAlreadyExistException;
use Eurega\Backoffice\Domain\Model\ProductoBackoffice\ProductoBackoffice;
use Eurega\Shared\Domain\ValueObject\Common;
use Eurega\Shared\Domain\Aggregate\AggregateRoot;
use Eurega\Shared\Domain\Criteria\Criteria;
use Eurega\Shared\Domain\ValueObject\Common\Id;
use Eurega\Shared\Domain\ValueObject\Common\Nombre;
use Eurega\Shared\Domain\ValueObject\Repository\Limit;
use Eurega\Shared\Domain\ValueObject\Repository\OrderBy;

interface ProductoBackofficeReadRepository {
    
    /** @throws ProductoBackofficeAlreadyExistException */
    public function ofNombreAndFail(Nombre $nombre): void;

    public function ofNombreOrFail(Nombre $nombre): ProductoBackoffice;

    public function ofIdOrFail(Id $id): ProductoBackoffice;

    public function search(Id $id, string $className): ?AggregateRoot;

    public function searchFiltered(
        ?Limit $limit,
        ?OrderBy $orderBy,
        array $filters
    ): array;
}
