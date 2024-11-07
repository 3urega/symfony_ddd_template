<?php

declare(strict_types=1);

namespace Eurega\Backoffice\Application\Query\ProductoBackoffice;

use Eurega\Shared\Domain\Bus\Query\Query;
use Eurega\Shared\Infrastructure\ValueObject\Common\Cantidad;

/**
 * @return Cantidad
 */
final readonly class CountProductoBackofficeFilteredQuery implements Query
{
	public function __construct(
        public ?array $filters = []
    ) {}
}
