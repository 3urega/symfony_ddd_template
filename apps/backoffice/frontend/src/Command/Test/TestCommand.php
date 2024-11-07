<?php

declare(strict_types=1);

namespace App\Backoffice\Frontend\Command\Test;

use Eurega\Shared\Domain\Bus\Command\Command;

class TestCommand implements Command
{
    public function __construct(
        public string $param = ""
    ) { }
}
