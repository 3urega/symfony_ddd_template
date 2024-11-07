<?php

declare(strict_types=1);

namespace Tests\Shared\Infrastructure;

use Eurega\Shared\Infrastructure\PhpRandomNumberGenerator;
use PHPUnit\Framework\Attributes\Test;
use Tests\Shared\Infrastructure\PhpUnit\UnitTestCase;

final class PhpRandomNumberGeneratorTest extends UnitTestCase
{
	#[Test]
	public function it_should_generate_a_random_number(): void
	{
		$generator = new PhpRandomNumberGenerator();

		$this->assertIsNumeric($generator->generate());
	}
}
