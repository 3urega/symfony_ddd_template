<?php

declare(strict_types=1);

namespace Eurega\Shared\Infrastructure\Bus\Command\Tactician;

use Eurega\Shared\Domain\Bus\Command\CommandBus as DomainCommandBus;
use League\Tactician\CommandBus;

abstract class TacticianCommandBus implements DomainCommandBus
{

    public function __construct(
		protected CommandBus $commandBus)
    {  }

    public function handle(object $command)
    {
        return $this->commandBus->handle($command);
    }
}
