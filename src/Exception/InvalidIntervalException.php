<?php

declare(strict_types=1);

namespace Alexxiy\TimeIntervals\Exception;

use InvalidArgumentException;

/**
 * Thrown when a DateInterval cannot be classified, which in practice means it
 * was constructed by hand (`new DateInterval('P2D')`) rather than produced by
 * `DateTimeInterface::diff()` and therefore has no total day count.
 */
final class InvalidIntervalException extends InvalidArgumentException implements TimeIntervalsException
{
    public static function withoutTotalDays(): self
    {
        return new self(
            'The given DateInterval has no total day count. Only intervals produced by '
            . 'DateTimeInterface::diff() can be classified.',
        );
    }
}
