<?php

declare(strict_types=1);

namespace Eurega\Shared\Domain\Bus\Event;

use Eurega\Shared\Domain\Utils;
use Eurega\Shared\Domain\ValueObject\SimpleUuid;
use DateTimeImmutable;

abstract class DomainEvent
{
	private readonly string $eventId;
	private readonly string $occurredOn;

	/**
	 * @param aggregateId
	 * @param eventId
	 * @param ocurredOn
	 */
	public function __construct(
		private readonly string $aggregateId, 
		string $eventId = null, 
		string $occurredOn = null
	) {
		$this->eventId = $eventId ?: SimpleUuid::random()->value();
		$this->occurredOn = $occurredOn ?: Utils::dateToString(new DateTimeImmutable());
	}

	abstract public static function fromPrimitives(
		string $aggregateId,
		array $body,
		string $eventId,
		string $occurredOn
	): self;

	abstract public static function eventName(): string;

	abstract public function toPrimitives(): array;

	final public function aggregateId(): string
	{
		return $this->aggregateId;
	}

	final public function eventId(): string
	{
		return $this->eventId;
	}

	final public function occurredOn(): string
	{
		return $this->occurredOn;
	}
}
