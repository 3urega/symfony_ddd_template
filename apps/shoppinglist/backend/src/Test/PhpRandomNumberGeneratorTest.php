<?php

declare(strict_types=1);

namespace App\ShoppingList\Backend\Test;

use Eurega\Shared\Infrastructure\PhpRandomNumberGenerator;
use Tests\Shared\Infrastructure\PhpUnit\UnitTestCase;

final class PhpRandomNumberGeneratorTest extends UnitTestCase
{
	/** @test */
	public function it_should_generate_a_random_number(): void
	{
		$generator = new PhpRandomNumberGenerator();

		$this->assertIsNumeric($generator->generate());
	}
}
