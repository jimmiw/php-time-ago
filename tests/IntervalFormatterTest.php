<?php

declare(strict_types=1);

namespace Alexxiy\TimeIntervals\Tests;

use Alexxiy\TimeIntervals\Locale;
use Alexxiy\TimeIntervals\Style;
use Alexxiy\TimeIntervals\Tense;
use Alexxiy\TimeIntervals\IntervalFormatter;
use Alexxiy\TimeIntervals\Translations\Da;
use Alexxiy\TimeIntervals\Translations\En;
use DateInterval;
use DateTime;
use DateTimeImmutable;
use DateTimeZone;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(IntervalFormatter::class)]
final class IntervalFormatterTest extends TestCase
{
    /**
     * A fixed "now" so that none of these tests depend on the wall clock or on
     * how long the suite takes to run.
     */
    private const string NOW = '2020-06-15 12:00:00';

    /**
     * Every threshold, expressed as the number of seconds before self::NOW, with
     * the value on each side of it. A threshold is the second at which the
     * rounded count ticks over.
     *
     * @return iterable<string, array{int, string}>
     */
    public static function secondsAgoProvider(): iterable
    {
        yield 'now' => [0, 'less than a minute ago'];
        yield '1 second' => [1, 'less than a minute ago'];
        yield '29 seconds' => [29, 'less than a minute ago'];

        yield '30 seconds' => [30, '1 minute ago'];
        yield '60 seconds' => [60, '1 minute ago'];
        yield '89 seconds' => [89, '1 minute ago'];

        yield '90 seconds' => [90, '2 minutes ago'];
        yield '2 minutes' => [120, '2 minutes ago'];
        // Rounds up: 2m40s is nearer three minutes than two.
        yield '2 minutes 40 seconds' => [160, '3 minutes ago'];
        yield '44 minutes' => [2640, '44 minutes ago'];
        yield '44 minutes 29 seconds' => [2669, '44 minutes ago'];

        yield '44 minutes 30 seconds' => [2670, 'about 1 hour ago'];
        yield '89 minutes 29 seconds' => [5369, 'about 1 hour ago'];
        yield '89 minutes 59 seconds' => [5399, 'about 1 hour ago'];

        yield '90 minutes' => [5400, '2 hours ago'];
        yield '110 minutes' => [6600, '2 hours ago'];
        yield '2 hours' => [7200, '2 hours ago'];
        yield '23 hours 29 minutes 59 seconds' => [84599, '23 hours ago'];

        yield '23 hours 30 minutes' => [84600, '1 day ago'];
        yield '24 hours' => [86400, '1 day ago'];
        yield '1 day 11 hours 59 minutes 59 seconds' => [129599, '1 day ago'];

        yield '1 day 12 hours' => [129600, '2 days ago'];
        // Regression: 47 hours used to read "1 day", because the bucket ran to 48.
        yield '47 hours' => [169200, '2 days ago'];
        yield '3 days' => [259200, '3 days ago'];
        yield '29 days 11 hours 59 minutes 59 seconds' => [2548799, '29 days ago'];

        yield '29 days 12 hours' => [2548800, 'about 1 month ago'];
    }

    #[DataProvider('secondsAgoProvider')]
    public function testInWordsAtEveryRuleBoundary(int $secondsAgo, string $expected): void
    {
        $now = new DateTimeImmutable(self::NOW, new DateTimeZone('UTC'));
        $past = $now->sub(new DateInterval('PT' . $secondsAgo . 'S'));

        self::assertSame($expected, (new IntervalFormatter())->inWords($past, $now));
    }

    /**
     * Months and years are calendar units, so they are pinned to real dates
     * rather than to a second count.
     *
     * @return iterable<string, array{string, string}>
     */
    public static function calendarProvider(): iterable
    {
        yield '3 months' => ['2020-03-15 12:00:00', '3 months ago'];
        yield '11 months' => ['2019-07-01 12:00:00', '11 months ago'];
        yield 'a few days short of a year' => ['2019-06-19 12:00:00', 'about 1 year ago'];
        yield 'exactly a year' => ['2019-06-15 12:00:00', 'about 1 year ago'];
        yield 'a year and 5 months' => ['2019-01-15 12:00:00', 'about 1 year ago'];
        // Past 17 months the phrase switches, so that "about 1 year" stops being
        // asked to cover something nearly two years old.
        yield 'a year and a half' => ['2018-12-15 12:00:00', 'over 1 year ago'];
        yield 'a year and 11 months' => ['2018-07-15 12:00:00', 'over 1 year ago'];
        yield 'exactly two years' => ['2018-06-15 12:00:00', 'over 2 years ago'];
        yield 'two years and two months' => ['2018-04-15 12:00:00', 'over 2 years ago'];
        yield 'three years' => ['2017-06-15 12:00:00', 'over 3 years ago'];
        yield 'ten years' => ['2010-06-15 12:00:00', 'over 10 years ago'];
    }

    #[DataProvider('calendarProvider')]
    public function testInWordsForCalendarUnits(string $past, string $expected): void
    {
        $timeZone = new DateTimeZone('UTC');

        self::assertSame($expected, (new IntervalFormatter())->inWords(
            new DateTimeImmutable($past, $timeZone),
            new DateTimeImmutable(self::NOW, $timeZone),
        ));
    }

    /**
     * A leap-day interval is 365 days long but reports zero years, which used to
     * be enough to have it described in months.
     */
    public function testLeapDayIntervalIsNotDescribedInMonths(): void
    {
        $timeZone = new DateTimeZone('UTC');

        self::assertSame('about 1 year ago', (new IntervalFormatter())->inWords(
            new DateTimeImmutable('2024-02-29 12:00:00', $timeZone),
            new DateTimeImmutable('2025-02-28 12:00:00', $timeZone),
        ));
    }

    /**
     * Reported upstream as "1 months ago" for a two month span.
     */
    public function testTwoCalendarMonthsIsNotRenderedAsOne(): void
    {
        self::assertSame('2 months ago', (new IntervalFormatter())->inWords(
            new DateTimeImmutable('2022-07-01 15:00:00'),
            new DateTimeImmutable('2022-09-01 14:00:00'),
        ));
    }

    /**
     * Reported: two dates two months apart read "2 months", but a second less
     * read "about 1 month". The old bucket ran from 30 days to 60, so it was
     * swallowing everything up to two whole months.
     *
     * @return iterable<string, array{string}>
     */
    public static function nearlyTwoMonthsProvider(): iterable
    {
        yield 'one second under the old threshold' => ['PT5183969S'];
        yield 'exactly the old threshold' => ['PT5183970S'];
        yield '50 days' => ['P50D'];
        yield '59 days' => ['P59D'];
    }

    #[DataProvider('nearlyTwoMonthsProvider')]
    public function testTheMonthBucketNoLongerSwallowsTwoMonths(string $spec): void
    {
        $now = new DateTimeImmutable('2021-06-15 12:00:00', new DateTimeZone('UTC'));

        self::assertSame(
            '2 months ago',
            (new IntervalFormatter())->inWords($now->sub(new DateInterval($spec)), $now),
        );
    }

    /**
     * The same calendar delta used to answer differently depending on whether
     * February was short, because the month handover was a fixed day count.
     *
     * @return iterable<string, array{string}>
     */
    public static function februaryProvider(): iterable
    {
        yield '2021, 59 days' => ['2021'];
        yield '2024, 60 days' => ['2024'];
    }

    #[DataProvider('februaryProvider')]
    public function testTwoCalendarMonthsReadTheSameInEveryYear(string $year): void
    {
        $timeZone = new DateTimeZone('UTC');

        self::assertSame('2 months ago', (new IntervalFormatter())->inWords(
            new DateTimeImmutable($year . '-02-01 12:00:00', $timeZone),
            new DateTimeImmutable($year . '-04-01 12:00:00', $timeZone),
        ));
    }

    public function testNowDefaultsToTheCurrentTime(): void
    {
        $formatter = new IntervalFormatter();

        self::assertSame('less than a minute ago', $formatter->inWords(new DateTimeImmutable()));
        self::assertSame(
            '1 minute ago',
            $formatter->inWords((new DateTimeImmutable())->sub(new DateInterval('PT45S'))),
        );
    }

    public function testAcceptsMutableAndImmutableDates(): void
    {
        $formatter = new IntervalFormatter();
        $past = '2020-06-14 12:00:00';

        self::assertSame(
            $formatter->inWords(new DateTime($past), new DateTime(self::NOW)),
            $formatter->inWords(new DateTimeImmutable($past), new DateTimeImmutable(self::NOW)),
        );
    }

    public function testDoesNotMutateTheDatesItIsGiven(): void
    {
        $past = new DateTime('2020-06-14 12:00:00');
        $now = new DateTime(self::NOW);

        (void) (new IntervalFormatter())->inWords($past, $now);

        self::assertSame('2020-06-14 12:00:00', $past->format('Y-m-d H:i:s'));
        self::assertSame(self::NOW, $now->format('Y-m-d H:i:s'));
    }

    /**
     * The same instant written in two timezones has to read the same.
     */
    public function testResultIsIndependentOfTimezoneRepresentation(): void
    {
        $formatter = new IntervalFormatter();
        $now = new DateTimeImmutable('2020-06-15 12:00:00', new DateTimeZone('UTC'));

        $inUtc = new DateTimeImmutable('2020-06-13 12:00:00', new DateTimeZone('UTC'));
        $inTokyo = $inUtc->setTimezone(new DateTimeZone('Asia/Tokyo'));

        self::assertSame('2 days ago', $formatter->inWords($inUtc, $now));
        self::assertSame('2 days ago', $formatter->inWords($inTokyo, $now));
    }

    /**
     * With no tense pinned, the direction of the interval picks one.
     */
    public function testTenseFollowsTheDirectionOfTheInterval(): void
    {
        $formatter = new IntervalFormatter();
        $now = new DateTimeImmutable('2020-06-15 12:00:00', new DateTimeZone('UTC'));

        self::assertSame('3 days ago', $formatter->inWords($now->sub(new DateInterval('P3D')), $now));
        self::assertSame('in 3 days', $formatter->inWords($now->add(new DateInterval('P3D')), $now));
    }

    /**
     * @return iterable<string, array{Tense, string, string}>
     */
    public static function tenseProvider(): iterable
    {
        yield 'past' => [Tense::Past, '3 days ago', '3 days ago'];
        yield 'future' => [Tense::Future, 'in 3 days', 'in 3 days'];
        yield 'plain' => [Tense::Plain, '3 days', '3 days'];
    }

    /**
     * A pinned tense wins over the direction of the interval, in both directions.
     */
    #[DataProvider('tenseProvider')]
    public function testAPinnedTenseOverridesTheDirection(
        Tense $tense,
        string $forAPastDate,
        string $forAFutureDate,
    ): void {
        $now = new DateTimeImmutable('2020-06-15 12:00:00', new DateTimeZone('UTC'));
        $formatter = new IntervalFormatter(tense: $tense);

        self::assertSame($forAPastDate, $formatter->inWords($now->sub(new DateInterval('P3D')), $now));
        self::assertSame($forAFutureDate, $formatter->inWords($now->add(new DateInterval('P3D')), $now));
    }

    public function testTheTenseCanBeOverriddenForASingleCall(): void
    {
        $formatter = new IntervalFormatter();
        $now = new DateTimeImmutable('2020-06-15 12:00:00', new DateTimeZone('UTC'));
        $past = $now->sub(new DateInterval('P3D'));

        self::assertSame('3 days ago', $formatter->inWords($past, $now));
        self::assertSame('3 days', $formatter->inWords($past, $now, Tense::Plain));
        self::assertSame('in 3 days', $formatter->inWords($past, $now, Tense::Future));

        // The override is per call and leaves the instance alone.
        self::assertNull($formatter->tense());
        self::assertSame('3 days ago', $formatter->inWords($past, $now));
    }

    /**
     * The plain tense also drops the direction from the uncounted phrases, not
     * only from the counted ones.
     */
    public function testPlainTenseDropsTheDirectionEverywhere(): void
    {
        $formatter = new IntervalFormatter(tense: Tense::Plain);
        $now = new DateTimeImmutable('2020-06-15 12:00:00', new DateTimeZone('UTC'));

        self::assertSame('less than a minute', $formatter->inWords($now, $now));
        self::assertSame(
            'about 1 hour',
            $formatter->inWords($now->sub(new DateInterval('PT2670S')), $now),
        );
        self::assertSame(
            '1 day',
            $formatter->inWords($now->sub(new DateInterval('PT86370S')), $now),
        );
    }

    public function testWithTenseReturnsANewInstance(): void
    {
        $automatic = new IntervalFormatter();
        $plain = $automatic->withTense(Tense::Plain);

        self::assertNotSame($automatic, $plain);
        self::assertNull($automatic->tense());
        self::assertSame(Tense::Plain, $plain->tense());
        self::assertNull($plain->withTense(null)->tense());
    }

    public function testWithLanguageKeepsThePinnedTense(): void
    {
        $formatter = (new IntervalFormatter(tense: Tense::Plain))->withLocale(Locale::German);

        self::assertSame(Tense::Plain, $formatter->tense());
        self::assertSame(
            '3 Tage',
            $formatter->inWords(
                new DateTimeImmutable('2020-06-12 12:00:00'),
                new DateTimeImmutable('2020-06-15 12:00:00'),
            ),
        );
    }

    public function testForLocaleAcceptsATense(): void
    {
        self::assertSame(
            Tense::Future,
            IntervalFormatter::forLocale(Locale::German, Tense::Future)->tense(),
        );
    }

    /**
     * Russian needs three plural forms, and the count in each bucket is large
     * enough to reach all of them.
     *
     * @return iterable<string, array{int, string}>
     */
    public static function russianPluralProvider(): iterable
    {
        yield '2 days (few)' => [2, '2 дня назад'];
        yield '3 days (few)' => [3, '3 дня назад'];
        yield '4 days (few)' => [4, '4 дня назад'];
        yield '5 days (many)' => [5, '5 дней назад'];
        yield '11 days (many)' => [11, '11 дней назад'];
        yield '12 days (many)' => [12, '12 дней назад'];
        yield '14 days (many)' => [14, '14 дней назад'];
        yield '20 days (many)' => [20, '20 дней назад'];
        yield '21 days (one)' => [21, '21 день назад'];
        yield '22 days (few)' => [22, '22 дня назад'];
        yield '25 days (many)' => [25, '25 дней назад'];
    }

    #[DataProvider('russianPluralProvider')]
    public function testRussianPicksTheRightPluralForm(int $days, string $expected): void
    {
        $now = new DateTimeImmutable('2020-06-30 12:00:00', new DateTimeZone('UTC'));
        $past = $now->sub(new DateInterval('P' . $days . 'D'));

        self::assertSame($expected, IntervalFormatter::forLocale(Locale::Russian)->inWords($past, $now));
    }

    /**
     * The same counts, in the other two tenses.
     */
    public function testRussianPluralsHoldInEveryTense(): void
    {
        $now = new DateTimeImmutable('2020-06-30 12:00:00', new DateTimeZone('UTC'));
        $formatter = IntervalFormatter::forLocale(Locale::Russian);

        $twoDaysAgo = $now->sub(new DateInterval('P2D'));
        $fiveDaysAgo = $now->sub(new DateInterval('P5D'));

        self::assertSame('через 2 дня', $formatter->inWords($twoDaysAgo, $now, Tense::Future));
        self::assertSame('через 5 дней', $formatter->inWords($fiveDaysAgo, $now, Tense::Future));
        self::assertSame('2 дня', $formatter->inWords($twoDaysAgo, $now, Tense::Plain));
        self::assertSame('5 дней', $formatter->inWords($fiveDaysAgo, $now, Tense::Plain));
    }

    /**
     * Polish and Russian disagree at 21, which is the case that catches a rule
     * that was copied from one to the other.
     */
    public function testPolishAndRussianDivergeAtTwentyOne(): void
    {
        $now = new DateTimeImmutable('2020-06-30 12:00:00', new DateTimeZone('UTC'));
        $past = $now->sub(new DateInterval('P21D'));

        self::assertSame('21 день назад', IntervalFormatter::forLocale(Locale::Russian)->inWords($past, $now));
        self::assertSame('21 dni temu', IntervalFormatter::forLocale(Locale::Polish)->inWords($past, $now));
    }

    /**
     * Arabic spells the dual out as a word, so its two-form carries no digit.
     */
    public function testArabicUsesItsDualForm(): void
    {
        $now = new DateTimeImmutable('2020-06-30 12:00:00', new DateTimeZone('UTC'));
        $formatter = IntervalFormatter::forLocale(Locale::Arabic);

        self::assertSame('منذ يومين', $formatter->inWords($now->sub(new DateInterval('P2D')), $now));
        self::assertSame('منذ 5 أيام', $formatter->inWords($now->sub(new DateInterval('P5D')), $now));
        self::assertSame('منذ 15 يومًا', $formatter->inWords($now->sub(new DateInterval('P15D')), $now));
    }

    public function testDefaultsToEnglish(): void
    {
        self::assertInstanceOf(En::class, (new IntervalFormatter())->language());
        self::assertSame('less than a minute ago', (new IntervalFormatter())->inWords(new DateTimeImmutable()));
    }

    public function testUsesTheLanguageItIsGiven(): void
    {
        $formatter = new IntervalFormatter(new Da());

        self::assertSame('mindre end et minut siden', $formatter->inWords(new DateTimeImmutable()));
    }

    public function testCanBeBuiltFromALocale(): void
    {
        self::assertSame(
            'vor weniger als einer Minute',
            IntervalFormatter::forLocale(Locale::German)->inWords(new DateTimeImmutable()),
        );
        self::assertSame(
            'mindre än en minut sedan',
            IntervalFormatter::forLocale(Locale::Swedish)->inWords(new DateTimeImmutable()),
        );
    }

    public function testWithLanguageReturnsANewInstance(): void
    {
        $english = new IntervalFormatter();
        $danish = $english->withLanguage(new Da());

        self::assertNotSame($english, $danish);
        self::assertInstanceOf(En::class, $english->language());
        self::assertInstanceOf(Da::class, $danish->language());
    }

    public function testWithLocaleReturnsANewInstance(): void
    {
        $formatter = (new IntervalFormatter())->withLocale(Locale::Russian);

        self::assertSame('меньше минуты назад', $formatter->inWords(new DateTimeImmutable()));
        self::assertSame('меньше минуты', $formatter->inWords(new DateTimeImmutable(), tense: Tense::Plain));
    }

    /**
     * Style and tense are independent axes: every combination has to be
     * expressible, which is the whole reason Short is not a Tense.
     *
     * @return iterable<string, array{Tense, Style, string}>
     */
    public static function styleAndTenseProvider(): iterable
    {
        yield 'full past' => [Tense::Past, Style::Full, '5 days ago'];
        yield 'full future' => [Tense::Future, Style::Full, 'in 5 days'];
        yield 'full plain' => [Tense::Plain, Style::Full, '5 days'];
        yield 'short past' => [Tense::Past, Style::Short, '5d ago'];
        yield 'short future' => [Tense::Future, Style::Short, 'in 5d'];
        yield 'short plain' => [Tense::Plain, Style::Short, '5d'];
    }

    #[DataProvider('styleAndTenseProvider')]
    public function testStyleAndTenseAreIndependent(Tense $tense, Style $style, string $expected): void
    {
        $now = new DateTimeImmutable('2020-06-15 12:00:00', new DateTimeZone('UTC'));
        $past = $now->sub(new DateInterval('P5D'));

        self::assertSame($expected, (new IntervalFormatter())->inWords($past, $now, $tense, $style));
    }

    /**
     * With nothing pinned, the short style still takes its direction from the
     * interval, exactly as the full style does.
     */
    public function testTheShortStyleStillFollowsTheIntervalDirection(): void
    {
        $formatter = new IntervalFormatter(style: Style::Short);
        $now = new DateTimeImmutable('2020-06-15 12:00:00', new DateTimeZone('UTC'));

        self::assertSame('5d ago', $formatter->inWords($now->sub(new DateInterval('P5D')), $now));
        self::assertSame('in 5d', $formatter->inWords($now->add(new DateInterval('P5D')), $now));
    }

    public function testTheStyleCanBeOverriddenForASingleCall(): void
    {
        $formatter = new IntervalFormatter();
        $now = new DateTimeImmutable('2020-06-15 12:00:00', new DateTimeZone('UTC'));
        $past = $now->sub(new DateInterval('P5D'));

        self::assertSame('5 days ago', $formatter->inWords($past, $now));
        self::assertSame('5d ago', $formatter->inWords($past, $now, style: Style::Short));

        // The override is per call and leaves the instance alone.
        self::assertSame(Style::Full, $formatter->style());
        self::assertSame('5 days ago', $formatter->inWords($past, $now));
    }

    public function testWithStyleReturnsANewInstance(): void
    {
        $full = new IntervalFormatter();
        $short = $full->withStyle(Style::Short);

        self::assertNotSame($full, $short);
        self::assertSame(Style::Full, $full->style());
        self::assertSame(Style::Short, $short->style());
    }

    public function testTheStyleSurvivesALanguageChange(): void
    {
        $formatter = (new IntervalFormatter(style: Style::Short))->withLocale(Locale::Russian);
        $now = new DateTimeImmutable('2020-06-15 12:00:00', new DateTimeZone('UTC'));

        self::assertSame(Style::Short, $formatter->style());
        self::assertSame('5 дн назад', $formatter->inWords($now->sub(new DateInterval('P5D')), $now));
    }

    public function testTheStyleSurvivesATenseChange(): void
    {
        $formatter = (new IntervalFormatter(style: Style::Short))->withTense(Tense::Plain);

        self::assertSame(Style::Short, $formatter->style());
        self::assertSame(Tense::Plain, $formatter->tense());
    }

    public function testForLocaleAcceptsAStyle(): void
    {
        self::assertSame(
            Style::Short,
            IntervalFormatter::forLocale(Locale::German, style: Style::Short)->style(),
        );
    }

    /**
     * Abbreviations do not inflect, so Russian says "дн" at every count where the
     * full forms would need день / дня / дней.
     *
     * @return iterable<string, array{int, string}>
     */
    public static function russianShortProvider(): iterable
    {
        yield '2 days' => [2, '2 дн назад'];
        yield '5 days' => [5, '5 дн назад'];
        yield '21 days' => [21, '21 дн назад'];
    }

    #[DataProvider('russianShortProvider')]
    public function testAbbreviationsDoNotInflect(int $days, string $expected): void
    {
        $now = new DateTimeImmutable('2020-06-30 12:00:00', new DateTimeZone('UTC'));
        $past = $now->sub(new DateInterval('P' . $days . 'D'));

        self::assertSame(
            $expected,
            IntervalFormatter::forLocale(Locale::Russian, style: Style::Short)->inWords($past, $now),
        );
    }

    public function testNeverIsTranslated(): void
    {
        self::assertSame('Never', (new IntervalFormatter())->never());
        self::assertSame('Никогда', IntervalFormatter::forLocale(Locale::Russian)->never());
    }
}
