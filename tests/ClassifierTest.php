<?php

declare(strict_types=1);

namespace Alexxiy\TimeIntervals\Tests;

use Alexxiy\TimeIntervals\Classification;
use Alexxiy\TimeIntervals\Classifier;
use Alexxiy\TimeIntervals\Exception\InvalidIntervalException;
use Alexxiy\TimeIntervals\Exception\TimeIntervalsException;
use Alexxiy\TimeIntervals\Phrase;
use DateInterval;
use DateTimeImmutable;
use DateTimeZone;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(Classifier::class)]
#[CoversClass(Classification::class)]
#[CoversClass(InvalidIntervalException::class)]
final class ClassifierTest extends TestCase
{
    /**
     * Both sides of every threshold. Each one is the second at which the rounded
     * count ticks over, so these are written from the rule table rather than
     * read back off the implementation.
     *
     * @return iterable<string, array{int, Phrase, int|null}>
     */
    public static function boundaryProvider(): iterable
    {
        yield 'under 30s' => [29, Phrase::LessThanAMinute, null];
        yield 'at 30s' => [30, Phrase::OneMinute, null];
        yield 'at 1m29s' => [89, Phrase::OneMinute, null];
        yield 'at 1m30s' => [90, Phrase::Minutes, 2];
        yield 'at 44m29s' => [2669, Phrase::Minutes, 44];
        yield 'at 44m30s' => [2670, Phrase::AboutOneHour, null];
        yield 'at 1h29m59s' => [5399, Phrase::AboutOneHour, null];
        yield 'at 1h30m' => [5400, Phrase::Hours, 2];
        yield 'at 23h29m59s' => [84599, Phrase::Hours, 23];
        yield 'at 23h30m' => [84600, Phrase::AboutOneDay, null];
        yield 'at 1d11h59m59s' => [129599, Phrase::AboutOneDay, null];
        yield 'at 1d12h' => [129600, Phrase::Days, 2];
        yield 'at 29d11h59m59s' => [2548799, Phrase::Days, 29];
        yield 'at 29d12h' => [2548800, Phrase::AboutOneMonth, null];
    }

    #[DataProvider('boundaryProvider')]
    public function testClassifiesEachBucket(int $seconds, Phrase $phrase, ?int $count): void
    {
        $classification = (new Classifier())->classify(self::interval($seconds));

        self::assertSame($phrase, $classification->phrase);
        self::assertSame($count, $classification->count);
    }

    /**
     * Counts round rather than floor, so a value reads as the unit it is nearest
     * to and not the one it has merely passed.
     *
     * @return iterable<string, array{int, Phrase, int}>
     */
    public static function roundingProvider(): iterable
    {
        yield '2m40s is nearer 3 minutes' => [160, Phrase::Minutes, 3];
        yield '2m20s is nearer 2 minutes' => [140, Phrase::Minutes, 2];
        yield '2h59m is nearer 3 hours' => [10740, Phrase::Hours, 3];
        yield '2h20m is nearer 2 hours' => [8400, Phrase::Hours, 2];
        yield '3d23h is nearer 4 days' => [342000, Phrase::Days, 4];
        yield '3d02h is nearer 3 days' => [266400, Phrase::Days, 3];
    }

    #[DataProvider('roundingProvider')]
    public function testCountsRoundToTheNearestUnit(int $seconds, Phrase $phrase, int $count): void
    {
        $classification = (new Classifier())->classify(self::interval($seconds));

        self::assertSame($phrase, $classification->phrase);
        self::assertSame($count, $classification->count);
    }

    /**
     * Minutes, hours, days and months each have a dedicated phrase for a count of
     * one, so rounding can never hand them a 1. Years are the exception: "over 1
     * year" says something "about 1 year" does not.
     */
    #[DataProvider('boundaryProvider')]
    #[DataProvider('roundingProvider')]
    public function testUnitsWithASingularPhraseNeverReportOne(int $seconds, Phrase $phrase, ?int $count): void
    {
        if (!$phrase->takesCount()) {
            self::assertNull($count);

            return;
        }

        self::assertNotNull($count);
        self::assertGreaterThanOrEqual(2, $count);
    }

    /**
     * "over N years" has to stay literally true, so the count is the number of
     * whole years elapsed. Rounding the months up can reach 24 without the
     * interval ever having reached two years.
     */
    public function testTheYearCountNeverOverstatesTheInterval(): void
    {
        $now = new DateTimeImmutable('2021-06-15 12:00:00', new DateTimeZone('UTC'));
        $past = $now->sub(new DateInterval('P1Y11M21D'));

        $classification = (new Classifier())->classify($past->diff($now));

        self::assertSame(Phrase::Years, $classification->phrase);
        self::assertSame(1, $classification->count);
    }

    private static function interval(int $seconds): DateInterval
    {
        $now = new DateTimeImmutable('2020-06-15 12:00:00', new DateTimeZone('UTC'));

        return $now->sub(new DateInterval('PT' . $seconds . 'S'))->diff($now);
    }

    /**
     * As the interval grows the description must never go backwards. Phrase cases
     * are declared in ascending order of magnitude, so ordering by (case index,
     * count) gives a value that is only allowed to climb. Any threshold that
     * overlapped or left a gap would show up here as an inversion.
     */
    public function testTheDescriptionNeverGoesBackwardsAsTheIntervalGrows(): void
    {
        $classifier = new Classifier();
        $now = new DateTimeImmutable('2021-06-15 12:00:00', new DateTimeZone('UTC'));
        $rank = array_flip(array_map(
            static fn(Phrase $phrase): string => $phrase->value,
            Phrase::cases(),
        ));

        $previous = [-1, -1];
        $previousSeconds = 0;

        // One second at a time across every sub-day threshold, then hourly out to
        // two and a half years to cover the calendar ones.
        $offsets = [...range(0, 200000), ...range(200000, 86400 * 900, 3600)];

        foreach ($offsets as $seconds) {
            $classification = $classifier->classify(
                $now->sub(new DateInterval('PT' . $seconds . 'S'))->diff($now),
            );
            $current = [$rank[$classification->phrase->value], $classification->count ?? 0];

            self::assertGreaterThanOrEqual(
                $previous,
                $current,
                sprintf(
                    'at %d seconds the description went backwards (was %s at %d seconds)',
                    $seconds,
                    $classification->phrase->value,
                    $previousSeconds,
                ),
            );

            $previous = $current;
            $previousSeconds = $seconds;
        }
    }

    /**
     * "over N years" is a claim about the interval, so it has to hold: adding N
     * years back onto the past date must not overshoot the present.
     */
    public function testOverNYearsIsNeverAnOverstatement(): void
    {
        $classifier = new Classifier();
        $now = new DateTimeImmutable('2021-06-15 12:00:00', new DateTimeZone('UTC'));
        $checked = 0;

        for ($months = 12; $months <= 240; $months++) {
            foreach ([0, 1, 14, 15, 20, 27] as $days) {
                $past = $now->sub(new DateInterval(sprintf('P%dM%dD', $months, $days)));
                $classification = $classifier->classify($past->diff($now));

                if ($classification->phrase !== Phrase::Years) {
                    continue;
                }

                self::assertNotNull($classification->count);
                self::assertLessThanOrEqual(
                    $now,
                    $past->add(new DateInterval('P' . $classification->count . 'Y')),
                    sprintf('"over %d years" overstates %s', $classification->count, $past->format('Y-m-d')),
                );
                $checked++;
            }
        }

        self::assertGreaterThan(1000, $checked);
    }

    public function testTheDirectionOfTheIntervalDoesNotChangeTheClassification(): void
    {
        $classifier = new Classifier();
        $earlier = new DateTimeImmutable('2020-06-13 12:00:00', new DateTimeZone('UTC'));
        $later = new DateTimeImmutable('2020-06-15 12:00:00', new DateTimeZone('UTC'));

        $forwards = $classifier->classify($earlier->diff($later));
        $backwards = $classifier->classify($later->diff($earlier));

        self::assertSame($forwards->phrase, $backwards->phrase);
        self::assertSame($forwards->count, $backwards->count);
    }

    /**
     * An interval built by hand has no total day count, so it cannot be totaled
     * up into seconds. Failing loudly beats silently classifying it as "less than
     * a minute".
     */
    public function testRejectsAnIntervalThatDidNotComeFromDiff(): void
    {
        $this->expectException(InvalidIntervalException::class);

        (void) (new Classifier())->classify(new DateInterval('P2D'));
    }

    public function testItsExceptionsAreCatchableAsAPackageException(): void
    {
        try {
            (void) (new Classifier())->classify(new DateInterval('P2D'));
        } catch (TimeIntervalsException $exception) {
            self::assertInstanceOf(InvalidIntervalException::class, $exception);

            return;
        }

        self::fail('Expected a TimeIntervalsException to be thrown.');
    }
}
