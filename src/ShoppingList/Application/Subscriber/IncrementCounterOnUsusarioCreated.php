<?php

declare(strict_types=1);

namespace Eurega\ShoppingList\Application\Subscriber;

use Eurega\Shared\Domain\Bus\Event\DomainEventSubscriber;
use Eurega\ShoppingList\Application\Service\Usuario\UsuarioCounterIncrementer;
use Eurega\ShoppingList\Domain\Event\Usuario\UsuarioParticularCreatedDomainEvent;
use Eurega\Shared\Domain\ValueObject\Common\Id;

use function Lambdish\Phunctional\apply;

final readonly class IncrementCounterOnUsusarioCreated implements DomainEventSubscriber
{
	public function __construct(private UsuarioCounterIncrementer $incrementer) {}

	public static function subscribedTo(): array
	{
		return [UsuarioParticularCreatedDomainEvent::class];
	}

	public function __invoke(UsuarioParticularCreatedDomainEvent $event): void
	{
		$userId = Id::fromString($event->aggregateId());

		apply($this->incrementer, [$userId]);
	}
}
