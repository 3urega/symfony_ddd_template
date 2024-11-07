<?php

declare(strict_types=1);

namespace Eurega\Shared\Domain\Aggregate;

use Eurega\Shared\Domain\Bus\Event\DomainEvent;

abstract class AggregateRoot
{
	private array $domainEvents = [];

	final public function pullDomainEvents(): array
	{
		$domainEvents = $this->domainEvents;
		$this->domainEvents = [];

		return $domainEvents;
	}

	final protected function record(DomainEvent $domainEvent): void
	{
		$this->domainEvents[] = $domainEvent;
	}

	final public function domainEvents() {
		return $this->domainEvents;
	}
}