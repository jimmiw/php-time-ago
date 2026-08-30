<?php

declare(strict_types=1);

namespace Alexxiy\TimeIntervals\Tests;

use Alexxiy\TimeIntervals\IntervalFormatter;
use Alexxiy\TimeIntervals\Style;
use Alexxiy\TimeIntervals\Tense;
use Alexxiy\TimeIntervals\Tests\Fixtures\Signed;
use DateInterval;
use DateTimeImmutable;
use DateTimeZone;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversNothing]
final class CustomLanguageTest extends TestCase
{
    private const string NOW = '2020-06-15 12:00:00';

    /**
     * @return iterable<string, array{int, Tense|null, string}>
     */
    public static function renderProvider(): iterable
    {
        yield 'seconds' => [10, null, '-0m'];
        yield 'a minute' => [60, null, '-1m'];
        yield 'minutes' => [600, null, '-10m'];
        yield 'about an hour' => [2700, null, '-1h'];
        yield 'hours' => [21600, null, '-6h'];
        yield 'a day' => [86400, null, '-1d'];
        yield 'days' => [432000, null, '-5d'];
        yield 'a month' => [2600000, null, '-1mo'];
        yield 'plain days' => [432000, Tense::Plain, '5d'];
        yield 'future days' => [432000, Tense::Future, '+5d'];
    }

    #[DataProvider('renderProvider')]
    public function testACustomLanguageNeedsNoRegistration(
        int $secondsAgo,
        ?Tense $tense,
        string $expected,
    ): void {
        $now = new DateTimeImmutable(self::NOW, new DateTimeZone('UTC'));
        $past = $now->sub(new DateInterval('PT' . $secondsAgo . 'S'));

        self::assertSame($expected, (new IntervalFormatter(new Signed()))->inWords($past, $now, $tense));
    }

    public function testACustomLanguageStillFollowsTheIntervalDirection(): void
    {
        $formatter = new IntervalFormatter(new Signed());
        $now = new DateTimeImmutable(self::NOW, new DateTimeZone('UTC'));

        self::assertSame('-5d', $formatter->inWords($now->sub(new DateInterval('P5D')), $now));
        self::assertSame('+5d', $formatter->inWords($now->add(new DateInterval('P5D')), $now));
        self::assertSame('-', $formatter->never());
    }

    /**
     * Omitting the short style is legal, and asking for it serves the full forms.
     */
    public function testOmittingTheShortStyleFallsBackToTheFullForms(): void
    {
        $formatter = new IntervalFormatter(new Signed());
        $now = new DateTimeImmutable(self::NOW, new DateTimeZone('UTC'));
        $past = $now->sub(new DateInterval('P5D'));

        self::assertFalse((new Signed())->vocabulary()->abbreviates());
        self::assertSame(
            $formatter->inWords($past, $now, style: Style::Full),
            $formatter->inWords($past, $now, style: Style::Short),
        );
    }
}
