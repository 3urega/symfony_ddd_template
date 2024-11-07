<?php

declare(strict_types=1);

namespace Eurega\Shared\Infrastructure\Symfony\Logger;

use Eurega\Shared\Domain\Bus\Query\Response;
use Psr\Log\LoggerInterface;

final class LoggerCommand {

    public function __construct(
        private LoggerInterface $domainEventLogger
    ){ }

    public function __invoke(): void
    {

        $this->domainEventLogger->warning('Warning from command !');
        
    }
}