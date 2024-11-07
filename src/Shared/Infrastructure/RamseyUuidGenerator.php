<?php

declare(strict_types=1);

namespace Eurega\Shared\Infrastructure;

use Eurega\Shared\Domain\UuidGenerator as DomainUuidGenerator;
use Ramsey\Uuid\Uuid;

final class RamseyUuidGenerator implements DomainUuidGenerator
{
	public function generate(): string
	{
		return Uuid::uuid4()->toString();
	}
}
