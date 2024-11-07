<?php
declare(strict_types=1);

namespace Eurega\Shared\Infrastructure\ValueObject\Common;

use Eurega\Shared\Domain\Exception\ValueObject\CantidadIsNotValid;
use Webmozart\Assert\Assert;

final class Cantidad
{
    private const MIN_VALUE = 0;

    private int $value;

    private function __construct(int $value)
    {
        $this->value = $value;
    }

    /**
     * @throws CantidadIsNotValid
     */
    public static function fromInt(int $value): self
    {
        self::validate($value);

        return new self($value);
    }

    /**
     * @throws CantidadIsNotValid
     */
    public static function fromIntOrNull(?int $value): ?self
    {
        if (null === $value) {
            return null;
        }

        self::validate($value);

        return new self($value);
    }

    public static function zero(): Cantidad
    {
        return new self(self::MIN_VALUE);
    }

    public function add(Cantidad $anotherCantidad): self
    {
        return new self(
            $this->value + $anotherCantidad->value
        );
    }

    public function subtract(Cantidad $anotherCantidad): self
    {
        return new self(
            $this->value - $anotherCantidad->value
        );
    }

    public function isZero(): bool
    {
        return $this->value === 0;
    }

    public function multiplyBy(Cantidad $anotherCantidad): self
    {
        return new self(
            $this->value * $anotherCantidad->value
        );
    }

    public function equalsTo(Cantidad $anotherCantidad): bool
    {
        return $this->value === $anotherCantidad->value;
    }

    public function none(): bool
    {
        return $this->value === self::MIN_VALUE;
    }

    public function asInt(): int
    {
        return $this->value;
    }

    public function asString(): string
    {
        return (string) $this->value;
    }

    public function asStringWithThousandSeparator(): string
    {
        return number_format(
            $this->value,
            0,
            ',',
            '.'
        );
    }

    /**
     * @throws CantidadIsNotValid
     */
    private static function validate(int $value): void
    {
        try {
            Assert::greaterThanEq($value, self::MIN_VALUE);
        } catch (\InvalidArgumentException $e) {
            throw CantidadIsNotValid::becauseItIsNegative($value);
        }
    }
}
