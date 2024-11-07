<?php

declare(strict_types=1);

namespace Eurega\ShoppingList\Application\Subscriber;

use Eurega\Backoffice\Domain\Event\ProductoBackoffice\ProductoBackofficeCreatedDomainEvent;
use Eurega\Shared\Domain\Bus\Event\DomainEventSubscriber;
use Eurega\ShoppingList\Application\Service\ProductoShoppingList\ProductoShoppingListCreator;

final readonly class CreateProductoShoppingListOnProductoBackofficeCreated implements DomainEventSubscriber
{
	public function __construct(private ProductoShoppingListCreator $creator) {}

	public static function subscribedTo(): array
	{
		return [ProductoBackofficeCreatedDomainEvent::class];
	}

	public function __invoke(ProductoBackofficeCreatedDomainEvent $event): void
	{
		
		$this->creator->create($event->aggregateId(), $event->nombre());
	}
}
