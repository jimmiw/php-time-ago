<?php

declare(strict_types=1);

namespace Alexxiy\TimeIntervals;

/**
 * Everything a language says about an interval in one {@see Tense}.
 *
 * The uncounted phrases are literal text. The counted ones carry their plural
 * forms; which one is used depends on the language's {@see PluralRule}.
 */
final readonly class TenseVocabulary
{
    public function __construct(
        public string $lessThanAMinute,
        public string $oneMinute,
        public PluralForms $minutes,
        public string $aboutOneHour,
        public PluralForms $hours,
        public string $aboutOneDay,
        public PluralForms $days,
        public string $aboutOneMonth,
        public PluralForms $months,
        public string $aboutOneYear,
        public PluralForms $years,
    ) {
    }

    /**
     * The pattern for a phrase. The category is ignored by uncounted phrases.
     */
    #[\NoDiscard]
    public function pattern(Phrase $phrase, ?PluralCategory $category = null): string
    {
        $category ??= PluralCategory::Other;

        return match ($phrase) {
            Phrase::LessThanAMinute => $this->lessThanAMinute,
            Phrase::OneMinute => $this->oneMinute,
            Phrase::Minutes => $this->minutes->forCategory($category),
            Phrase::AboutOneHour => $this->aboutOneHour,
            Phrase::Hours => $this->hours->forCategory($category),
            Phrase::AboutOneDay => $this->aboutOneDay,
            Phrase::Days => $this->days->forCategory($category),
            Phrase::AboutOneMonth => $this->aboutOneMonth,
            Phrase::Months => $this->months->forCategory($category),
            Phrase::AboutOneYear => $this->aboutOneYear,
            Phrase::Years => $this->years->forCategory($category),
        };
    }

    /**
     * The plural forms of a counted phrase, or null if the phrase takes no count.
     */
    #[\NoDiscard]
    public function formsFor(Phrase $phrase): ?PluralForms
    {
        return match ($phrase) {
            Phrase::Minutes => $this->minutes,
            Phrase::Hours => $this->hours,
            Phrase::Days => $this->days,
            Phrase::Months => $this->months,
            Phrase::Years => $this->years,
            default => null,
        };
    }
}
