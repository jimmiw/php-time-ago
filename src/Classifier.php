<?php

declare(strict_types=1);

namespace Alexxiy\TimeIntervals;

use Alexxiy\TimeIntervals\Exception\InvalidIntervalException;
use DateInterval;

/**
 * Decides which {@see Phrase} describes an elapsed interval.
 *
 * Every threshold is the point at which the rounded count changes, so an
 * interval is always described by the nearest unit rather than the one it has
 * merely reached:
 *
 *     0 secs            <-> 29 secs                    less than a minute
 *     30 secs           <-> 1 min, 29 secs             1 minute
 *     1 min, 30 secs    <-> 44 mins, 29 secs           [2..44] minutes
 *     44 mins, 30 secs  <-> 1 hr, 29 mins, 59 secs     about 1 hour
 *     1 hr, 30 mins     <-> 23 hrs, 29 mins, 59 secs   [2..23] hours
 *     23 hrs, 30 mins   <-> 1 day, 11 hrs, 59 mins     about 1 day
 *     1 day, 12 hrs     <-> 29 days, 11 hrs, 59 mins   [2..29] days
 *     29 days, 12 hrs   <-> 1 month, 14 days           about 1 month
 *     1 month, 15 days  <-> 11 months                  [2..11] months
 *     12 months         <-> 17 months                  about 1 year
 *     18 months and up                                 over N years
 *
 * Minutes, hours and days have a fixed length, so they are decided on the exact
 * number of elapsed seconds. Months and years vary, so they are decided on the
 * calendar fields of the interval — which is why 1 February to 1 April is two
 * months in every year, and not one month whenever February is short.
 *
 * Classification is magnitude-only: an interval of three days classifies the same
 * whichever way it points. Which direction it is then worded in is the caller's
 * business, and {@see IntervalFormatter} decides it from the interval's invert
 * flag.
 */
final readonly class Classifier
{
    private const int LESS_THAN_A_MINUTE = 30;

    private const int SECONDS_PER_MINUTE = 60;
    private const int SECONDS_PER_HOUR = 3600;
    private const int SECONDS_PER_DAY = 86400;
    private const int MONTHS_PER_YEAR = 12;

    /** Counts above these hand over to the next unit up. */
    private const int MOST_MINUTES = 44;
    private const int MOST_HOURS = 23;
    private const int MOST_DAYS = 29;
    private const int MOST_MONTHS = 11;

    /** Up to and including this many months still reads as "about one year". */
    private const int MOST_MONTHS_CALLED_A_YEAR = 17;

    /**
     * Where the trailing part-month rounds up. A month is 28 to 31 days, so its
     * true midpoint moves between 14 and 15.5; fixing it at 15 shifts the
     * rounding point by at most half a day, which nothing perceives.
     */
    private const int HALF_A_MONTH = 15;

    /**
     * @throws InvalidIntervalException if the interval did not come from
     *                                  DateTimeInterface::diff()
     */
    #[\NoDiscard]
    public function classify(DateInterval $difference): Classification
    {
        $seconds = $this->totalSeconds($difference);

        if ($seconds < self::LESS_THAN_A_MINUTE) {
            return Classification::of(Phrase::LessThanAMinute);
        }

        $minutes = $this->nearest($seconds, self::SECONDS_PER_MINUTE);
        if ($minutes === 1) {
            return Classification::of(Phrase::OneMinute);
        }
        if ($minutes <= self::MOST_MINUTES) {
            return Classification::counted(Phrase::Minutes, $minutes);
        }

        $hours = $this->nearest($seconds, self::SECONDS_PER_HOUR);
        if ($hours === 1) {
            return Classification::of(Phrase::AboutOneHour);
        }
        if ($hours <= self::MOST_HOURS) {
            return Classification::counted(Phrase::Hours, $hours);
        }

        $days = $this->nearest($seconds, self::SECONDS_PER_DAY);
        if ($days === 1) {
            return Classification::of(Phrase::AboutOneDay);
        }
        if ($days <= self::MOST_DAYS) {
            return Classification::counted(Phrase::Days, $days);
        }

        return $this->classifyByCalendar($difference);
    }

    /**
     * Months and years are not a fixed number of seconds, so past the one-month
     * mark the interval's own calendar fields decide.
     */
    private function classifyByCalendar(DateInterval $difference): Classification
    {
        $months = $difference->y * self::MONTHS_PER_YEAR + $difference->m
            + ($difference->d >= self::HALF_A_MONTH ? 1 : 0);

        if ($months <= 1) {
            return Classification::of(Phrase::AboutOneMonth);
        }
        if ($months <= self::MOST_MONTHS) {
            return Classification::counted(Phrase::Months, $months);
        }
        if ($months <= self::MOST_MONTHS_CALLED_A_YEAR) {
            return Classification::of(Phrase::AboutOneYear);
        }

        // Whole years elapsed, never the rounded month count: "over 2 years" has
        // to stay true, and 1 year 11 months rounds up to 24 months without ever
        // having reached two years.
        return Classification::counted(Phrase::Years, $difference->y);
    }

    /**
     * The number of whole units the interval is closest to, rounding halves up.
     */
    private function nearest(int $seconds, int $secondsPerUnit): int
    {
        return intdiv($seconds + intdiv($secondsPerUnit, 2), $secondsPerUnit);
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
