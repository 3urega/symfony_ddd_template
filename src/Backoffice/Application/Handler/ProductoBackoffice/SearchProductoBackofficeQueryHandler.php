<?php

declare(strict_types=1);

namespace Eurega\Backoffice\Application\Handler\ProductoBackoffice;

use Eurega\Backoffice\Application\Collection\ProductoBackoffice\ProductoBackofficeCollection;
use Eurega\Backoffice\Application\Query\ProductoBackoffice\SearchProductoBackofficeQuery;
use Eurega\Backoffice\Application\Service\ProductoBackoffice\ProductoBackofficeResponseFilterSearcher;
use Eurega\Shared\Domain\Bus\Query\QueryHandler;

final readonly class SearchProductoBackofficeQueryHandler implements QueryHandler
{
	public function __construct(
		private ProductoBackofficeResponseFilterSearcher $searcher
	) {}

	public function handle(
		SearchProductoBackofficeQuery $query
	): ProductoBackofficeCollection {

		$elements =  $this->searcher->__invoke(
			$query->limit,
			$query->orderBy,
			$query->filters
		);

		$response = ProductoBackofficeCollection::fromElements($elements);

		return $response;
	}
}
