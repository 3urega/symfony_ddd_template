<?php

declare(strict_types=1);

namespace Eurega\Shared\Infrastructure\Bus\Event\InMemory;

use Eurega\Shared\Domain\Bus\Event\DomainEvent;
use Eurega\Shared\Domain\Bus\Event\EventBus;
use Eurega\Shared\Infrastructure\Bus\CallableFirstParameterExtractor;
use Symfony\Component\Messenger\Exception\NoHandlerForMessageException;
use Symfony\Component\Messenger\Handler\HandlersLocator;
use Symfony\Component\Messenger\MessageBus;
use Symfony\Component\Messenger\Middleware\HandleMessageMiddleware;

class InMemorySymfonyEventBus implements EventBus
{
	private readonly MessageBus $bus;

	public function __construct(iterable $subscribers = [])
	{
		$this->bus = new MessageBus(
			[
				new HandleMessageMiddleware(
					new HandlersLocator(CallableFirstParameterExtractor::forPipedCallables($subscribers))
				),
			]
		);
	}

	public function publish(DomainEvent ...$events): void
	{
		foreach ($events as $event) {
			try {
				$this->bus->dispatch($event);
			} catch (NoHandlerForMessageException) {
			}
		}
	}
}
