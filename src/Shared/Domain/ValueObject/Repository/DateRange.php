<?php

declare(strict_types=1);

namespace Eurega\Shared\Domain\ValueObject\Repository;

use Eurega\Shared\Domain\Exception\ValueObject\DateRangeIsNotValid;
use Eurega\Shared\Domain\ValueObject\Common\DateTime;

final class DateRange
{
    private DateTime $from;

    private DateTime $to;

    private function __construct(
        DateTime $from,
        DateTime $to
    ) {
        $this->from = $from;
        $this->to   = $to;
    }

    public function from(): DateTime
    {
        return $this->from;
    }

    public function to(): DateTime
    {
        return $this->to;
    }

    /**
     * @throws DateRangeIsNotValid
     */
    public static function create(
        DateTime $from,
        DateTime $to
    ): self {
        self::validate(
            $from,
            $to
        );

        return new self(
            $from,
            $to
        );
    }

    /**
     * @throws DateRangeIsNotValid
     */
    public static function createOrNull(
        ?DateTime $from,
        ?DateTime $to
    ): ?self {
        if ($from === null && $to === null) {
            return null;
        }

        if (
            $from !== null && $to === null
            || $to !== null && $from === null
        ) {
            throw DateRangeIsNotValid::becauseBothValuesAreMandatory();
        }

        self::validate(
            $from,
            $to
        );

        return new self(
            $from,
            $to
        );
    }

    /**
     * @throws DateRangeIsNotValid
     */
    private static function validate(
        DateTime $from,
        DateTime $to
    ): void {
        if ($to->asTimestamp() < $from->asTimestamp()) {
            throw DateRangeIsNotValid::becauseToDateIsEarlierThanFromDate();
        }
    }
}
