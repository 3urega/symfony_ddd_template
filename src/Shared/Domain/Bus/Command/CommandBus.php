<?php

declare(strict_types=1);

namespace Eurega\Shared\Domain\Bus\Command;

interface CommandBus
{
	public function handle(object $command);
}
