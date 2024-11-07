<?php

declare(strict_types=1);

namespace Eurega\Shared\Infrastructure\Symfony;

use Eurega\Shared\Domain\Bus\Command\Command;
use Eurega\Shared\Domain\Bus\Command\CommandBus;
use Eurega\Shared\Domain\Bus\Query\Query;
use Eurega\Shared\Domain\Bus\Query\QueryBus;
use Eurega\Shared\Domain\Bus\Query\Response;
use Eurega\Shared\Infrastructure\Symfony\Middleware\ApiExceptionsHttpStatusCodeMapping;

use function Lambdish\Phunctional\each;

abstract class ApiController
{
	public function __construct(
		private readonly QueryBus $queryBus,
		private readonly CommandBus $commandBus,
		ApiExceptionsHttpStatusCodeMapping $exceptionHandler
	) {
		each(
			fn (int $httpCode, string $exceptionClass) => $exceptionHandler->register($exceptionClass, $httpCode),
			$this->exceptions()
		);
	}

	abstract protected function exceptions(): array;

	protected function ask(Query $query): ?Response
	{
		return $this->queryBus->ask($query);
	}

	protected function handle(Command $command): void
	{
		$this->commandBus->handle($command);
	}
}
