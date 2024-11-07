<?php

declare(strict_types=1);

namespace Eurega\Backoffice\Application\Handler\ProductoBackoffice;

use Eurega\Backoffice\Application\Query\ProductoBackoffice\CountProductoBackofficeFilteredQuery;
use Eurega\Backoffice\Application\Service\ProductoBackoffice\ProductoBackofficeResponseFilterSearcher;
use Eurega\Shared\Domain\Bus\Query\QueryHandler;
use Eurega\Shared\Infrastructure\ValueObject\Common\Cantidad;

final readonly class CountProductoBackofficeFilteredQueryHandler implements QueryHandler
{
	public function __construct(
		private ProductoBackofficeResponseFilterSearcher $searcher
	) {}

	public function handle(
		CountProductoBackofficeFilteredQuery $query
	): Cantidad {

		$collection = $this->searcher->__invoke(
			null,
			null,
			$query->filters
		);

		return Cantidad::fromIntOrNull($collection->count());
	}
}
