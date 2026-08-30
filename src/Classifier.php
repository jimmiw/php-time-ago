<?php

declare(strict_types=1);

namespace Alexxiy\TimeIntervals;

use Alexxiy\TimeIntervals\Exception\InvalidIntervalException;
use DateInterval;

/**
 * Decides which {@see Phrase} describes an elapsed interval.
 *
 * The rules, in order:
 *
 *     0 secs                <-> 29 secs                              less than a minute
 *     30 secs               <-> 1 min, 29 secs                        1 minute
 *     1 min, 30 secs        <-> 44 mins, 29 secs                      [2..44] minutes
 *     44 mins, 30 secs      <-> 1 hr, 29 mins, 59 secs                about 1 hour
 *     1 hr, 30 mins         <-> 23 hrs, 59 mins, 29 secs              [2..23] hours
 *     23 hrs, 59 mins, 30 s <-> 47 hrs, 59 mins, 29 secs              1 day
 *     47 hrs, 59 mins, 30 s <-> 29 days, 23 hrs, 59 mins, 29 secs     [2..29] days
 *     29 days, 23:59:30     <-> 59 days, 23 hrs, 59 mins, 29 secs     about 1 month
 *     59 days, 23:59:30     <-> 1 year minus 1 sec                    [2..11] months
 *     1 year                <-> 2 years minus 1 sec                   about 1 year
 *     2 years or more                                                 over N years
 *
 * Everything below the two-month mark is decided on the exact number of elapsed
 * seconds, because those units have a fixed length. Months and years fall back
 * to the calendar fields of the interval, since their length varies.
 *
 * Classification is magnitude-only: an interval of three days classifies the same
 * whichever way it points. Which direction it is then worded in is the caller's
 * business, and {@see IntervalFormatter} decides it from the interval's invert
 * flag.
 */
final readonly class Classifier
{
    private const int ONE_MINUTE = 30;
    private const int TWO_MINUTES = 90;
    private const int ABOUT_ONE_HOUR = 2670;
    private const int TWO_HOURS = 5400;
    private const int ONE_DAY = 86370;
    private const int TWO_DAYS = 172770;
    private const int ABOUT_ONE_MONTH = 2591970;
    private const int TWO_MONTHS = 5183970;

    private const int SECONDS_PER_MINUTE = 60;
    private const int SECONDS_PER_HOUR = 3600;
    private const int SECONDS_PER_DAY = 86400;

    /**
     * The largest total day count that is still treated as "less than a year".
     * Guards against a leap-day interval such as 2024-02-29 -> 2025-02-28, which
     * DateInterval reports as 0 years but 365 days.
     */
    private const int MAX_DAYS_WITHIN_A_YEAR = 363;

    /**
     * @throws InvalidIntervalException if the interval did not come from
     *                                  DateTimeInterface::diff()
     */
    public function classify(DateInterval $difference): Classification
    {
        $seconds = $this->totalSeconds($difference);

        return match (true) {
            $seconds < self::ONE_MINUTE => Classification::of(Phrase::LessThanAMinute),
            $seconds < self::TWO_MINUTES => Classification::of(Phrase::OneMinute),
            $seconds < self::ABOUT_ONE_HOUR => Classification::counted(
                Phrase::Minutes,
                $this->atLeastTwo($seconds, self::SECONDS_PER_MINUTE),
            ),
            $seconds < self::TWO_HOURS => Classification::of(Phrase::AboutOneHour),
            $seconds < self::ONE_DAY => Classification::counted(
                Phrase::Hours,
                $this->atLeastTwo($seconds, self::SECONDS_PER_HOUR),
            ),
            $seconds < self::TWO_DAYS => Classification::of(Phrase::AboutOneDay),
            $seconds < self::ABOUT_ONE_MONTH => Classification::counted(
                Phrase::Days,
                $this->atLeastTwo($seconds, self::SECONDS_PER_DAY),
            ),
            $seconds < self::TWO_MONTHS => Classification::of(Phrase::AboutOneMonth),
            default => $this->classifyByCalendar($difference),
        };
    }

    /**
     * Months and years are not a fixed number of seconds, so past the two-month
     * mark the interval's own calendar fields decide.
     */
    private function classifyByCalendar(DateInterval $difference): Classification
    {
        if ($difference->y < 1 && $difference->days <= self::MAX_DAYS_WITHIN_A_YEAR) {
            return Classification::counted(Phrase::Months, max(2, $difference->m));
        }

        if ($difference->y < 2) {
            return Classification::of(Phrase::AboutOneYear);
        }

        return Classification::counted(Phrase::Years, $difference->y);
    }

    /**
     * The number of whole units in the interval, floored at two.
     *
     * Each bucket starts halfway through its first unit (two hours begins at
     * 1h30m, for instance), so a plain division would produce the nonsensical
     * "1 hours ago" at the bottom of the range.
     */
    private function atLeastTwo(int $seconds, int $secondsPerUnit): int
    {
        return max(2, intdiv($seconds, $secondsPerUnit));
    }

    /**
     * @throws InvalidIntervalException
     */
    private function totalSeconds(DateInterval $difference): int
    {
        // ->days is only populated on intervals produced by diff(); it is false
        // on hand-built ones, and without it, we cannot total the interval up.
        $days = $difference->days;

        if ($days === false) {
            throw InvalidIntervalException::withoutTotalDays();
        }

        return ((($days * 24 + $difference->h) * 60) + $difference->i) * 60 + $difference->s;
    }
}
