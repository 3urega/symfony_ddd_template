<?php

declare(strict_types=1);

namespace Eurega\Shared\Infrastructure\Service;

use Eurega\Shared\Domain\ValueObject\Repository\Limit;
use Eurega\Shared\Domain\ValueObject\Repository\OrderBy;
use Symfony\Component\HttpFoundation\RequestStack;

use function array_key_exists;
use function is_array;
use function sprintf;

final class DataTableService
{
    private array $query   = [];
    private array $filters = [];

    public function __construct(RequestStack $requestStack)
    {
        if ($requestStack->getCurrentRequest() === null) {
            return;
        }

        $this->query = $requestStack->getCurrentRequest()->query->all();
    }

    public function orderBy(): ?OrderBy
    {
        $columns = $this->getDataTableColumns();
        $orders  = [];

        if (array_key_exists('order', $this->query)) {
            foreach ($this->query['order'] as $order) {
                $orderColumn = $columns[$order['column']];

                if (is_array($orderColumn) && array_key_exists('relationship', $orderColumn)) {
                    $field = sprintf('%s_%s', $orderColumn['relationship'], $orderColumn['relationship_field']);
                } else {
                    $field = $orderColumn;
                }

                $dir = $order['dir'];

                $orders[$field] = $dir;
            }
        }

        return OrderBy::fromFieldsWithDirectionsAsValuesOrNull($orders);
    }

    /**
     * @throws LimitIsNotValid
     */
    public function limit(): ?Limit
    {
        $offset = null;
        $length = null;

        if (array_key_exists('start', $this->query)) {
            $offset = (int) $this->query['start'];
        }

        if (array_key_exists('length', $this->query)) {
            $length = (int) $this->query['length'];
        }

        return Limit::fromLimitAndOffsetNullable(
            $length,
            $offset
        );
    }

    public function filters(): array
    {
        if (array_key_exists('filters', $this->query)) {
            foreach ($this->query['filters'] as $key => $value) {
                if ($value === '') {
                    continue;
                }

                $this->filters[$key] = $value;
            }
        }

        return $this->filters;
    }

    private function getDataTableColumns(): array
    {
        $columns = [];

        foreach ($this->query['columns'] as $column) {
            $columns[] = $column['data'];
        }

        return $columns;
    }
}
