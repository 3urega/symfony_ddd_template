<?php

declare(strict_types=1);

namespace Eurega\Backoffice\Application\Query\ProductoBackoffice;

use Eurega\Shared\Domain\Bus\Query\Query;
use Eurega\Shared\Domain\ValueObject\Repository\Limit;
use Eurega\Shared\Domain\ValueObject\Repository\OrderBy;

/**
 * @return ProductoBackofficeCollection
 */
final readonly class SearchProductoBackofficeQuery implements Query
{
	public function __construct(
        public array $filters,
		public ?OrderBy $orderBy,
		public ?Limit $limit
    ) {}
}
