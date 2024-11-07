<?php

declare(strict_types=1);

namespace Eurega\Shared\Infrastructure\Symfony\Flash;

use Eurega\Shared\Domain\Utils;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\FlashBagAwareSessionInterface;

final class FlashSession
{
	private static array $flashes = [];

	public function __construct(
		RequestStack $requestStack
		)
	{
		$session = $requestStack->getSession();
		if ($session instanceof FlashBagAwareSessionInterface) {
			self::$flashes = Utils::dot($session->getFlashBag()->all());
		}
	}

	public function get(string $key, $default = null)
	{
		if (array_key_exists($key, self::$flashes)) {
			return self::$flashes[$key];
		}

		if (array_key_exists($key . '.0', self::$flashes)) {
			return self::$flashes[$key . '.0'];
		}

		if (array_key_exists($key . '.0.0', self::$flashes)) {
			return self::$flashes[$key . '.0.0'];
		}

		return $default;
	}

	public function has(string $key): bool
	{
		return array_key_exists($key, self::$flashes)
			   || array_key_exists($key . '.0', self::$flashes)
			   || array_key_exists($key . '.0.0', self::$flashes);
	}
}
