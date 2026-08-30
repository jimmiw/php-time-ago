<?php

declare(strict_types=1);

namespace Alexxiy\TimeIntervals\Tests;

use Alexxiy\TimeIntervals\Phrase;
use Alexxiy\TimeIntervals\PluralCategory;
use Alexxiy\TimeIntervals\PluralForms;
use Alexxiy\TimeIntervals\PluralRule;
use Alexxiy\TimeIntervals\Style;
use Alexxiy\TimeIntervals\Tense;
use Alexxiy\TimeIntervals\TenseSet;
use Alexxiy\TimeIntervals\TenseVocabulary;
use Alexxiy\TimeIntervals\Vocabulary;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(Phrase::class)]
#[CoversClass(PluralForms::class)]
#[CoversClass(TenseVocabulary::class)]
#[CoversClass(Vocabulary::class)]
#[CoversClass(Tense::class)]
#[CoversClass(Style::class)]
#[CoversClass(TenseSet::class)]
final class PhraseTest extends TestCase
{
    /**
     * @return iterable<string, array{Phrase}>
     */
    public static function phraseProvider(): iterable
    {
        foreach (Phrase::cases() as $phrase) {
            yield $phrase->value => [$phrase];
        }
    }

    /**
     * Each phrase must read a different property of the vocabulary; a duplicated
     * match arm would make two phrases render identically.
     */
    #[DataProvider('phraseProvider')]
    public function testEveryPhraseMapsToItsOwnVocabularyEntry(Phrase $phrase): void
    {
        self::assertSame($phrase->value, self::vocabularyNamingItsOwnProperties()->pattern($phrase));
    }

    public function testOnlyUnitPhrasesTakeACount(): void
    {
        $counted = array_values(array_filter(
            Phrase::cases(),
            static fn(Phrase $phrase): bool => $phrase->takesCount(),
        ));

        self::assertSame(
            [Phrase::Minutes, Phrase::Hours, Phrase::Days, Phrase::Months, Phrase::Years],
            $counted,
        );
    }

    #[DataProvider('phraseProvider')]
    public function testOnlyCountedPhrasesExposePluralForms(Phrase $phrase): void
    {
        $forms = self::vocabularyNamingItsOwnProperties()->formsFor($phrase);

        if ($phrase->takesCount()) {
            self::assertInstanceOf(PluralForms::class, $forms);
            self::assertSame($phrase->value, $forms->other);

            return;
        }

        self::assertNull($forms);
    }

    public function testAnUnsuppliedPluralFormFallsBackToOther(): void
    {
        $forms = new PluralForms('%s days', one: '%s day');

        self::assertSame('%s day', $forms->forCategory(PluralCategory::One));
        self::assertSame('%s days', $forms->forCategory(PluralCategory::Few));
        self::assertSame('%s days', $forms->forCategory(PluralCategory::Other));

        self::assertTrue($forms->has(PluralCategory::One));
        self::assertTrue($forms->has(PluralCategory::Other));
        self::assertFalse($forms->has(PluralCategory::Zero));
        self::assertFalse($forms->has(PluralCategory::Two));
        self::assertFalse($forms->has(PluralCategory::Few));
        self::assertFalse($forms->has(PluralCategory::Many));
    }

    public function testACountedPhraseResolvesThroughItsPluralForms(): void
    {
        $vocabulary = self::vocabularyNamingItsOwnProperties();

        self::assertSame('days/few', $vocabulary->pattern(Phrase::Days, PluralCategory::Few));
        self::assertSame('days', $vocabulary->pattern(Phrase::Days, PluralCategory::Many));
    }

    public function testEachTenseIsKeptSeparate(): void
    {
        $vocabulary = self::vocabularyNamingItsOwnSlots(withShort: false);

        foreach (Tense::cases() as $tense) {
            self::assertSame(
                $tense->value,
                $vocabulary->forTense($tense)->pattern(Phrase::LessThanAMinute),
            );
        }
    }

    public function testEachStyleIsKeptSeparate(): void
    {
        $vocabulary = self::vocabularyNamingItsOwnSlots(withShort: true);

        foreach (Style::cases() as $style) {
            foreach (Tense::cases() as $tense) {
                self::assertSame(
                    sprintf('%s/%s', $style->value, $tense->value),
                    $vocabulary->forTense($tense, $style)->pattern(Phrase::LessThanAMinute),
                );
            }
        }
    }

    public function testTheShortStyleIsOptionalAndFallsBackToFull(): void
    {
        $vocabulary = self::vocabularyNamingItsOwnSlots(withShort: false);

        self::assertFalse($vocabulary->abbreviates());
        self::assertSame($vocabulary->forStyle(Style::Full), $vocabulary->forStyle(Style::Short));

        $abbreviating = self::vocabularyNamingItsOwnSlots(withShort: true);

        self::assertTrue($abbreviating->abbreviates());
        self::assertNotSame(
            $abbreviating->forStyle(Style::Full),
            $abbreviating->forStyle(Style::Short),
        );
    }

    public function testAnInvariantPhraseAnswersToEveryCategory(): void
    {
        $forms = PluralForms::invariant('%sd');

        foreach (PluralCategory::cases() as $category) {
            self::assertTrue($forms->has($category), $category->value);
            self::assertSame('%sd', $forms->forCategory($category));
        }
    }

    private static function vocabularyNamingItsOwnSlots(bool $withShort): Vocabulary
    {
        $set = static fn(string $style): TenseSet => new TenseSet(
            past: self::tenseNaming($style . '/past'),
            future: self::tenseNaming($style . '/future'),
            plain: self::tenseNaming($style . '/plain'),
        );

        // The unprefixed names keep testEachTenseIsKeptSeparate readable.
        $full = $withShort ? $set(Style::Full->value) : new TenseSet(
            past: self::tenseNaming('past'),
            future: self::tenseNaming('future'),
            plain: self::tenseNaming('plain'),
        );

        return new Vocabulary(
            plurals: PluralRule::OtherOnly,
            full: $full,
            never: 'never',
            short: $withShort ? $set(Style::Short->value) : null,
        );
    }

    private static function vocabularyNamingItsOwnProperties(): TenseVocabulary
    {
        return new TenseVocabulary(
            lessThanAMinute: Phrase::LessThanAMinute->value,
            oneMinute: Phrase::OneMinute->value,
            minutes: new PluralForms(Phrase::Minutes->value),
            aboutOneHour: Phrase::AboutOneHour->value,
            hours: new PluralForms(Phrase::Hours->value),
            aboutOneDay: Phrase::AboutOneDay->value,
            days: new PluralForms(Phrase::Days->value, few: 'days/few'),
            aboutOneMonth: Phrase::AboutOneMonth->value,
            months: new PluralForms(Phrase::Months->value),
            aboutOneYear: Phrase::AboutOneYear->value,
            years: new PluralForms(Phrase::Years->value),
        );
    }

    private static function tenseNaming(string $name): TenseVocabulary
    {
        return new TenseVocabulary(
            lessThanAMinute: $name,
            oneMinute: $name,
            minutes: new PluralForms($name),
            aboutOneHour: $name,
            hours: new PluralForms($name),
            aboutOneDay: $name,
            days: new PluralForms($name),
            aboutOneMonth: $name,
            months: new PluralForms($name),
            aboutOneYear: $name,
            years: new PluralForms($name),
        );
    }
}
