<?php

declare(strict_types=1);

namespace Tests\Shared\Domain\Criteria;

use Eurega\Shared\Domain\Criteria\Order;
use Eurega\Shared\Domain\Criteria\OrderBy;
use Eurega\Shared\Domain\Criteria\OrderType;
use Tests\Shared\Domain\RandomElementPicker;

final class OrderMother
{
	public static function create(?OrderBy $orderBy = null, ?OrderType $orderType = null): Order
	{
		return new Order($orderBy ?? OrderByMother::create(), $orderType ?? self::randomOrderType());
	}

	public static function none(): Order
	{
		return Order::none();
	}

	private static function randomOrderType(): Order
	{
		return RandomElementPicker::from(OrderType::ASC, OrderType::DESC, OrderType::NONE);
	}
}
