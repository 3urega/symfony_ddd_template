<?php

declare(strict_types=1);

namespace Eurega\Shared\Domain\Criteria;


final class FilterValuesParameter {


    public function __construct(
        public string $field,
        public string $operator,
        public string $value
    ) { }
}
