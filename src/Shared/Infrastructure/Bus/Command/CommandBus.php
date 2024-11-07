<?php
declare(strict_types=1);

namespace Eurega\Shared\Infrastructure\Bus\Command;

use Eurega\Shared\Domain\Bus\Command\CommandBus as DomainCommandBus;
use League\Tactician\CommandBus as TacticianCommandBus;

abstract class CommandBus implements DomainCommandBus
{
    protected TacticianCommandBus $commandBus;

    public function __construct(TacticianCommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function handle(object $command)
    {
        return $this->commandBus->handle($command);
    }
}
