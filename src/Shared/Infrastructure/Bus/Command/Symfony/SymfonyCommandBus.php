<?php

declare(strict_types=1);

namespace Eurega\Shared\Infrastructure\Bus\Command\Symfony;

use Eurega\Shared\Domain\Bus\Command\Command;
use Eurega\Shared\Infrastructure\Bus\CallableFirstParameterExtractor;
use Eurega\Shared\Infrastructure\Bus\Command\CommandNotRegisteredError;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\Exception\NoHandlerForMessageException;
use Symfony\Component\Messenger\Handler\HandlersLocator;
use Symfony\Component\Messenger\MessageBus;
use Symfony\Component\Messenger\Middleware\HandleMessageMiddleware;

final class SymfonyCommandBus
{
	private readonly MessageBus $bus;

	public function __construct(iterable $commandHandlers = [])
	{
		$this->bus = new MessageBus(
			[
				new HandleMessageMiddleware(
					new HandlersLocator(CallableFirstParameterExtractor::forCallables($commandHandlers))
				),
			]
		);
	}

	public function dispatch(Command $command): void
	{
		try {
			$this->bus->dispatch($command);
		} catch (NoHandlerForMessageException) {
			throw new CommandNotRegisteredError($command);
		} catch (HandlerFailedException $error) {
			throw $error->getPrevious() ?? $error;
		}
	}
}
