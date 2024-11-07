<?php

declare(strict_types=1);

namespace Eurega\Shared\Infrastructure\PhpUnit;

use Eurega\Shared\Infrastructure\CodelyTvConstraintIsSimilar;
use Mockery\Matcher\MatcherInterface;
use Stringable;

final readonly class CodelyTvMatcherIsSimilar implements Stringable, MatcherInterface
{
	private CodelyTvConstraintIsSimilar $constraint;

	public function __construct(mixed $value, float $delta = 0.0)
	{
		$this->constraint = new CodelyTvConstraintIsSimilar($value, $delta);
	}

	public function match(&$actual): bool
	{
		return $this->constraint->evaluate($actual, '', true);
	}

	public function __toString(): string
	{
		return 'Is similar';
	}
}
