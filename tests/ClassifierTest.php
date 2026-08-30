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
     * @return iterable<string, array{int, Phrase, int|null}>
     */
    public static function boundaryProvider(): iterable
    {
        yield 'under 30s' => [29, Phrase::LessThanAMinute, null];
        yield 'at 30s' => [30, Phrase::OneMinute, null];
        yield 'at 90s' => [90, Phrase::Minutes, 2];
        yield 'at 44m29s' => [2669, Phrase::Minutes, 44];
        yield 'at 44m30s' => [2670, Phrase::AboutOneHour, null];
        yield 'at 90m' => [5400, Phrase::Hours, 2];
        yield 'at 23h59m29s' => [86369, Phrase::Hours, 23];
        yield 'at 23h59m30s' => [86370, Phrase::AboutOneDay, null];
        yield 'at 47h59m30s' => [172770, Phrase::Days, 2];
        yield 'at 29d23h59m29s' => [2591969, Phrase::Days, 29];
        yield 'at 29d23h59m30s' => [2591970, Phrase::AboutOneMonth, null];
        yield 'at 59d23h59m29s' => [5183969, Phrase::AboutOneMonth, null];
    }

    #[DataProvider('boundaryProvider')]
    public function testClassifiesEachBucket(int $seconds, Phrase $phrase, ?int $count): void
    {
        $now = new DateTimeImmutable('2020-06-15 12:00:00', new DateTimeZone('UTC'));
        $past = $now->sub(new DateInterval('PT' . $seconds . 'S'));

        $classification = (new Classifier())->classify($past->diff($now));

        self::assertSame($phrase, $classification->phrase);
        self::assertSame($count, $classification->count);
    }

    /**
     * Counted phrases must never be handed a 1, because every counted bucket
     * starts halfway through its first unit.
     */
    #[DataProvider('boundaryProvider')]
    public function testCountedPhrasesNeverReportASingleUnit(int $seconds, Phrase $phrase, ?int $count): void
    {
        if (!$phrase->takesCount()) {
            self::assertNull($count);

            return;
        }

        self::assertNotNull($count);
        self::assertGreaterThanOrEqual(2, $count);
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

        (new Classifier())->classify(new DateInterval('P2D'));
    }

    public function testItsExceptionsAreCatchableAsAPackageException(): void
    {
        try {
            (new Classifier())->classify(new DateInterval('P2D'));
        } catch (TimeIntervalsException $exception) {
            self::assertInstanceOf(InvalidIntervalException::class, $exception);

            return;
        }

        self::fail('Expected a TimeIntervalsException to be thrown.');
    }
}
