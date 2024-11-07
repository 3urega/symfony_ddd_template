<?php

declare(strict_types=1);

namespace Eurega\Shared\Infrastructure\Bus\Event\Mysql;

use Doctrine\ORM\EntityManagerInterface;
use Eurega\Shared\Domain\Bus\Event\DomainEvent;
use Eurega\Shared\Infrastructure\Bus\Event\DomainEventSubscriberLocator;
use Override;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;

use Symfony\Component\Console\Output\OutputInterface;
use function Lambdish\Phunctional\pipe;

#[AsCommand(name: 'shoppinglist:domain-events:mysql:consume', description: 'Consume domain events from MySql',)]
final class ConsumeMySqlDomainEventsCommand extends Command
{
	public function __construct(
		private readonly MySqlDoctrineDomainEventsConsumer $consumer,
		private readonly EntityManagerInterface $entityManager,
		private readonly DomainEventSubscriberLocator $subscriberLocator
	) {
		parent::__construct();
	}

	#[Override]
	protected function configure(): void
	{
		$this->addArgument('quantity', InputArgument::REQUIRED, 'Quantity of events to process');
	}

	#[Override]
	protected function execute(InputInterface $input, OutputInterface $output): int
	{
		$quantityEventsToProcess = (int) $input->getArgument('quantity');

		$consumer = pipe($this->consumer(), fn () => $this->entityManager->clear());

		$this->consumer->consume($consumer, $quantityEventsToProcess);

		return 0;
	}

	private function consumer(): callable
	{
		return function (DomainEvent $domainEvent): void {
			$subscribers = $this->subscriberLocator->allSubscribedTo($domainEvent::class);

			foreach ($subscribers as $subscriber) {
				// Una vez tenemos todos nuestros subscriptores los ejecutamos uno a uno
				$subscriber($domainEvent);
			}
		};
	}
}
