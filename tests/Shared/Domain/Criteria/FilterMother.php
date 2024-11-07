<?php

declare(strict_types=1);

namespace Tests\Shared\Domain\Criteria;

use Eurega\Shared\Domain\Criteria\Filter;
use Eurega\Shared\Domain\Criteria\FilterField;
use Eurega\Shared\Domain\Criteria\FilterOperator;
use Eurega\Shared\Domain\Criteria\FilterValue;
use Eurega\Shared\Domain\Criteria\FilterValuesParameter;
use Tests\Shared\Domain\RandomElementPicker;

final class FilterMother
{
	public static function create(
		?FilterField $field = null,
		?FilterOperator $operator = null,
		?FilterValue $value = null
	): Filter {
		return new Filter(
			$field ?? FilterFieldMother::create(),
			$operator ?? self::randomOperator(),
			$value ?? FilterValueMother::create()
		);
	}

	/** @param FilterValuesParameter $values */
	public static function fromValues(FilterValuesParameter $values): Filter
	{
		return Filter::fromValues($values);
	}


	private static function randomOperator(): FilterOperator
	{
		return RandomElementPicker::from(
			FilterOperator::EQUAL,
			FilterOperator::NOT_EQUAL,
			FilterOperator::GT,
			FilterOperator::LT,
			FilterOperator::CONTAINS,
			FilterOperator::NOT_CONTAINS
		);
	}
}
