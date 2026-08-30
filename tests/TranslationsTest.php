<?php

declare(strict_types=1);

namespace Alexxiy\TimeIntervals\Tests;

use Alexxiy\TimeIntervals\Language;
use Alexxiy\TimeIntervals\Locale;
use Alexxiy\TimeIntervals\Phrase;
use Alexxiy\TimeIntervals\PluralCategory;
use Alexxiy\TimeIntervals\Style;
use Alexxiy\TimeIntervals\Tense;
use Alexxiy\TimeIntervals\IntervalFormatter;
use Alexxiy\TimeIntervals\Vocabulary;
use DateInterval;
use DateTimeImmutable;
use DateTimeZone;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

/**
 * Checks that every bundled language is complete and safe to render so that a
 * new translation cannot be merged half-finished.
 */
final class TranslationsTest extends TestCase
{
    private const string TRANSLATIONS_DIRECTORY = __DIR__ . '/../src/Translations';

    /**
     * The largest count the library can realistically produce. Years are the only
     * unbounded unit, and nothing needs a plural form for the year one million.
     */
    private const int PRACTICAL_COUNT_LIMIT = 10000;

    /**
     * @return iterable<string, array{Locale}>
     */
    public static function localeProvider(): iterable
    {
        foreach (Locale::cases() as $locale) {
            yield $locale->value => [$locale];
        }
    }

    /**
     * Only the languages that spell out their own abbreviations.
     *
     * @return iterable<string, array{Locale}>
     */
    public static function abbreviatingLocaleProvider(): iterable
    {
        foreach (Locale::cases() as $locale) {
            if ($locale->language()->vocabulary()->abbreviates()) {
                yield $locale->value => [$locale];
            }
        }
    }

    /**
     * @return iterable<string, array{Locale, Style, Tense, Phrase}>
     */
    public static function localeStyleTensePhraseProvider(): iterable
    {
        foreach (Locale::cases() as $locale) {
            foreach (Style::cases() as $style) {
                foreach (Tense::cases() as $tense) {
                    foreach (Phrase::cases() as $phrase) {
                        yield sprintf(
                            '%s/%s/%s/%s',
                            $locale->value,
                            $style->value,
                            $tense->value,
                            $phrase->value,
                        ) => [$locale, $style, $tense, $phrase];
                    }
                }
            }
        }
    }

    #[DataProvider('localeStyleTensePhraseProvider')]
    public function testEveryPhraseIsTranslatedInEveryTenseAndStyle(
        Locale $locale,
        Style $style,
        Tense $tense,
        Phrase $phrase,
    ): void {
        $vocabulary = $locale->language()->vocabulary();
        $pattern = $vocabulary->forTense($tense, $style)->pattern($phrase);

        self::assertNotSame('', trim($pattern));
    }

    /**
     * A language has to spell out every plural form its own rule can select. If
     * it does not, lookup silently falls back to `other` and the count reads
     * ungrammatically: "2 дней" instead of "2 дня".
     */
    #[DataProvider('localeStyleTensePhraseProvider')]
    public function testCountedPhrasesCoverEveryCategoryTheLanguageUses(
        Locale $locale,
        Style $style,
        Tense $tense,
        Phrase $phrase,
    ): void {
        $vocabulary = $locale->language()->vocabulary();

        if (!$phrase->takesCount()) {
            self::assertNull($vocabulary->forTense($tense, $style)->formsFor($phrase));

            return;
        }

        $forms = $vocabulary->forTense($tense, $style)->formsFor($phrase);
        self::assertNotNull($forms);

        foreach (self::categoriesInPracticalUse($locale) as $category) {
            self::assertTrue(
                $forms->has($category),
                sprintf(
                    '%s is missing the "%s" form of %s in the %s %s tense.',
                    $locale->value,
                    $category->value,
                    $phrase->value,
                    $style->value,
                    $tense->value,
                ),
            );
        }
    }

    /**
     * A counted phrase without a placeholder silently drops the number; two
     * placeholders throw. The singular and dual forms are exempt because some
     * languages spell those out as a word rather than a digit.
     */
    #[DataProvider('localeStyleTensePhraseProvider')]
    public function testPlaceholdersAreWellFormed(
        Locale $locale,
        Style $style,
        Tense $tense,
        Phrase $phrase,
    ): void {
        $forms = $locale->language()->vocabulary()->forTense($tense, $style);

        if (!$phrase->takesCount()) {
            self::assertStringNotContainsString('%', $forms->pattern($phrase));

            return;
        }

        $spellsOutTheNumber = [PluralCategory::Zero, PluralCategory::One, PluralCategory::Two];

        foreach (PluralCategory::cases() as $category) {
            $pattern = $forms->pattern($phrase, $category);
            $placeholders = substr_count($pattern, '%s');
            $message = sprintf(
                '%s/%s/%s/%s/%s: %s',
                $locale->value,
                $style->value,
                $tense->value,
                $phrase->value,
                $category->value,
                $pattern,
            );

            self::assertSame($placeholders, substr_count($pattern, '%'), $message);

            if (in_array($category, $spellsOutTheNumber, true)) {
                self::assertLessThanOrEqual(1, $placeholders, $message);

                continue;
            }

            self::assertSame(1, $placeholders, $message);
        }
    }

    /**
     * Renders every rule bucket, in every tense, in every language, and checks
     * that nothing throws and no placeholder survives into the output.
     */
    #[DataProvider('localeProvider')]
    public function testEveryLanguageRendersEveryBucketInEveryTenseAndStyle(Locale $locale): void
    {
        $formatter = IntervalFormatter::forLocale($locale);
        $now = new DateTimeImmutable('2020-06-15 12:00:00', new DateTimeZone('UTC'));

        $offsets = [0, 30, 90, 2670, 5400, 86370, 172770, 2591970, 5183970];
        $dates = [];
        foreach ($offsets as $offset) {
            $dates[] = $now->sub(new DateInterval('PT' . $offset . 'S'));
        }
        foreach (['2019-06-15 12:00:00', '2010-06-15 12:00:00'] as $past) {
            $dates[] = new DateTimeImmutable($past, new DateTimeZone('UTC'));
        }

        foreach ($dates as $date) {
            foreach (Tense::cases() as $tense) {
                foreach (Style::cases() as $style) {
                    $rendered = $formatter->inWords($date, $now, $tense, $style);

                    self::assertNotSame('', $rendered);
                    self::assertStringNotContainsString('%s', $rendered);
                }
            }
        }

        self::assertNotSame('', $formatter->never());
    }

    /**
     * The three tenses have to actually differ, in both styles, or a language has
     * been filled in by copying one column across.
     */
    #[DataProvider('localeProvider')]
    public function testTheThreeTensesAreDistinct(Locale $locale): void
    {
        $vocabulary = $locale->language()->vocabulary();

        foreach (Style::cases() as $style) {
            $past = $vocabulary->forTense(Tense::Past, $style);
            $future = $vocabulary->forTense(Tense::Future, $style);
            $plain = $vocabulary->forTense(Tense::Plain, $style);
            $where = sprintf('%s (%s)', $locale->value, $style->value);

            self::assertNotEquals($past, $future, sprintf('%s: past and future are identical.', $where));
            self::assertNotEquals($future, $plain, sprintf('%s: future and plain are identical.', $where));
            self::assertNotEquals($past, $plain, sprintf('%s: past and plain are identical.', $where));
        }
    }

    /**
     * A language that does not abbreviate serves its full forms for the short
     * style, which is the right answer rather than a gap: Japanese "3日前" is
     * already as short as it gets.
     */
    #[DataProvider('localeProvider')]
    public function testLanguagesWithoutShortFormsFallBackToTheirFullOnes(Locale $locale): void
    {
        $vocabulary = $locale->language()->vocabulary();

        if ($vocabulary->abbreviates()) {
            self::assertNotEquals(
                $vocabulary->forStyle(Style::Full),
                $vocabulary->forStyle(Style::Short),
                sprintf('%s declares short forms identical to its full ones.', $locale->value),
            );

            return;
        }

        self::assertSame($vocabulary->forStyle(Style::Full), $vocabulary->forStyle(Style::Short));
    }

    /**
     * The point of the short style is to be shorter. Checked on rendered output
     * rather than on the patterns, because that is what a user sees.
     */
    #[DataProvider('abbreviatingLocaleProvider')]
    public function testShortFormsAreNeverLongerThanFullOnes(Locale $locale): void
    {
        $formatter = IntervalFormatter::forLocale($locale);
        $now = new DateTimeImmutable('2020-06-15 12:00:00', new DateTimeZone('UTC'));

        foreach ([90, 5400, 172770, 5183970] as $offset) {
            $date = $now->sub(new DateInterval('PT' . $offset . 'S'));

            foreach (Tense::cases() as $tense) {
                $full = $formatter->inWords($date, $now, $tense, Style::Full);
                $short = $formatter->inWords($date, $now, $tense, Style::Short);

                self::assertLessThanOrEqual(
                    mb_strlen($full),
                    mb_strlen($short),
                    sprintf('%s: "%s" is not shorter than "%s".', $locale->value, $short, $full),
                );
            }
        }
    }

    /**
     * Every file in src/Translations has to be reachable through the Locale
     * enum, otherwise a bundled language is effectively invisible.
     */
    public function testMostLanguagesAbbreviate(): void
    {
        $abbreviating = iterator_to_array(self::abbreviatingLocaleProvider());

        // Guards the filtered provider above: if this ever drops to zero, the
        // short-form tests would pass by testing nothing at all.
        self::assertGreaterThan(count(Locale::cases()) / 2, count($abbreviating));
    }

    public function testEveryTranslationClassIsRegisteredAsALocale(): void
    {
        $registered = [];
        foreach (Locale::cases() as $locale) {
            $registered[] = $locale->language()::class;
        }

        $files = glob(self::TRANSLATIONS_DIRECTORY . '/*.php');
        self::assertIsArray($files);
        self::assertNotEmpty($files);

        foreach ($files as $file) {
            $class = 'Alexxiy\\TimeIntervals\\Translations\\' . basename($file, '.php');

            self::assertContains($class, $registered, sprintf('%s is not exposed by Locale.', $class));
        }

        self::assertCount(count($files), Locale::cases());
    }

    #[DataProvider('localeProvider')]
    public function testLanguagesAreStatelessAndInterchangeable(Locale $locale): void
    {
        $language = $locale->language();

        self::assertInstanceOf(Language::class, $language);
        self::assertInstanceOf(Vocabulary::class, $language->vocabulary());
        self::assertEquals($language->vocabulary(), $language->vocabulary());
    }

    /**
     * The plural categories a language can actually be asked for, given that
     * counts start at two and stay within a sane range.
     *
     * @return list<PluralCategory>
     */
    private static function categoriesInPracticalUse(Locale $locale): array
    {
        $rule = $locale->language()->vocabulary()->plurals;

        $categories = [];
        for ($count = 1; $count <= self::PRACTICAL_COUNT_LIMIT; $count++) {
            $category = $rule->categoryFor($count);
            $categories[$category->value] = $category;
        }

        return array_values($categories);
    }
}
