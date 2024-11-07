<?php

declare(strict_types=1);

namespace Tests\Shared\Infrastructure\PhpUnit;

use Eurega\Shared\Domain\Bus\Command\Command;
use Eurega\Shared\Domain\Bus\Event\DomainEvent;
use Eurega\Shared\Domain\Bus\Event\EventBus;
use Eurega\Shared\Domain\Bus\Query\Query;
use Eurega\Shared\Domain\Bus\Query\Response;
use Eurega\Shared\Domain\UuidGenerator;
use Eurega\Shared\Infrastructure\PhpUnit\CodelyTvMatcherIsSimilar;
use Eurega\Shared\Infrastructure\PhpUnit\TestUtils;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use Mockery\MockInterface;
use Throwable;
use Mockery;

/**
 * Los metodos que extiendan a UnitTestCase heredarán los casos de test generales y deberán implementar 
 * los particulares de cada modulo / submodulo 
 */
abstract class UnitTestCase extends MockeryTestCase
{
	
	private EventBus | MockInterface | null $eventBus = null;
	private MockInterface | UuidGenerator | null $uuidGenerator = null;

	protected function mock(string $className): MockInterface
	{
		return Mockery::mock($className);
	}

	protected function uuidGenerator(): MockInterface | UuidGenerator
	{
		return $this->uuidGenerator ??= $this->mock(UuidGenerator::class);
	}

	protected function eventBus(): EventBus | MockInterface
	{
		return $this->eventBus ??= $this->mock(EventBus::class);
	}

	protected function shouldPublishDomainEvent(DomainEvent $domainEvent): void
	{
		$this->eventBus()
			->shouldReceive('publish')
			->with(Mockery::type(DomainEvent::class))
			->andReturnNull();
	}

	protected function shouldPublishNamedDomainEvent($name): void
	{
		$this->eventBus()
			->shouldReceive('publish')
			->with(Mockery::on(function(DomainEvent $argument) use ($name){
				return 
					$argument instanceof DomainEvent &&
					$argument->eventName() === $name;
			}))
			->andReturnNull();
	}


	/*
	protected function shouldSearch(Nombre $username): void
	{
		$this->usuarioParticularReadRepository()
			->shouldReceive('search') // ofDireccionEmailAndFail
			->once();
	}
	*/
	protected function shouldNotPublishDomainEvent(): void
	{
		$this->eventBus()
			->shouldReceive('publish')
			->withNoArgs()
			->andReturnNull();
	}

	

	protected function shouldGenerateUuid(string $uuid): void
	{
		$this->uuidGenerator()
			->shouldReceive('generate')
			->once()
			->withNoArgs()
			->andReturn($uuid);
	}

	

	protected function notify(DomainEvent $event, callable $subscriber): void
	{
		$subscriber($event);
	}

	protected function dispatch(Command $command, callable $commandHandler): void
	{
		$commandHandler($command);
	}

	protected function assertAskResponse(Response $expected, Query $query, callable $queryHandler): void
	{
		$actual = $queryHandler($query);

		$this->assertEquals($expected, $actual);
	}

	/** @param class-string<Throwable> $expectedErrorClass */
	protected function assertAskThrowsException(string $expectedErrorClass, Query $query, callable $queryHandler): void
	{
		$this->expectException($expectedErrorClass);

		$queryHandler($query);
	}
	
	protected function isSimilar(mixed $expected, mixed $actual): bool
	{
		return TestUtils::isSimilar($expected, $actual);
	}

	protected function assertSimilar(mixed $expected, mixed $actual): void
	{
		TestUtils::assertSimilar($expected, $actual);
	}

	protected function similarTo(mixed $value, float $delta = 0.0): CodelyTvMatcherIsSimilar
	{
		return TestUtils::similarTo($value, $delta);
	}
	
}
