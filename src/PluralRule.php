<?php

declare(strict_types=1);

namespace Alexxiy\TimeIntervals;

/**
 * The CLDR cardinal plural rules, grouped by the families this library needs.
 *
 * Only the integer branches of each rule are implemented, because a count here
 * is always a whole number of minutes, hours, days, months, or years. The
 * fraction-only categories some languages define (Czech "many", for instance)
 * are therefore unreachable and are not listed by {@see categories()}.
 *
 * @see https://www.unicode.org/cldr/charts/47/supplemental/language_plural_rules.html
 */
enum PluralRule
{
    /** One form for every count: Chinese, Japanese, Korean, Thai, Vietnamese, Indonesian. */
    case OtherOnly;

    /** Singular at exactly one: most Germanic, Romance, Turkic, and Finno-Ugric languages. */
    case OneOther;

    /** Singular at zero and one: Portuguese, Hindi, Persian. */
    case ZeroOneOther;

    /** As ZeroOneOther, plus a separate form for whole millions. */
    case French;

    /** Belarusian, Russian, Ukrainian: 21 day, 22 days, 25 days. */
    case EastSlavic;

    /** Polish: as EastSlavic, but only a literal 1 is singular. */
    case Polish;

    /** Czech and Slovak: 1, then 2-4, then everything else. */
    case CzechSlovak;

    /** Latvian, which has a distinct form for the teens and the round tens. */
    case Latvian;

    /** Arabic, with singular, dual, a form for 3-10 and one for 11-99. */
    case Arabic;

    /**
     * The plural category a count falls into.
     */
    #[\NoDiscard]
    public function categoryFor(int $count): PluralCategory
    {
        $count = abs($count);
        $lastDigit = $count % 10;
        $lastTwoDigits = $count % 100;

        return match ($this) {
            self::OtherOnly => PluralCategory::Other,

            self::OneOther => $count === 1
                ? PluralCategory::One
                : PluralCategory::Other,

            self::ZeroOneOther => $count <= 1
                ? PluralCategory::One
                : PluralCategory::Other,

            self::French => match (true) {
                $count <= 1 => PluralCategory::One,
                $count % 1000000 === 0 => PluralCategory::Many,
                default => PluralCategory::Other,
            },

            self::EastSlavic => match (true) {
                $lastDigit === 1 && $lastTwoDigits !== 11 => PluralCategory::One,
                $lastDigit >= 2 && $lastDigit <= 4
                    && ($lastTwoDigits < 12 || $lastTwoDigits > 14) => PluralCategory::Few,
                default => PluralCategory::Many,
            },

            self::Polish => match (true) {
                $count === 1 => PluralCategory::One,
                $lastDigit >= 2 && $lastDigit <= 4
                    && ($lastTwoDigits < 12 || $lastTwoDigits > 14) => PluralCategory::Few,
                default => PluralCategory::Many,
            },

            self::CzechSlovak => match (true) {
                $count === 1 => PluralCategory::One,
                $count >= 2 && $count <= 4 => PluralCategory::Few,
                default => PluralCategory::Other,
            },

            self::Latvian => match (true) {
                $lastDigit === 0 || ($lastTwoDigits >= 11 && $lastTwoDigits <= 19) => PluralCategory::Zero,
                // CLDR also excludes 11 here; the teens arm above already has.
                $lastDigit === 1 => PluralCategory::One,
                default => PluralCategory::Other,
            },

            self::Arabic => match (true) {
                $count === 0 => PluralCategory::Zero,
                $count === 1 => PluralCategory::One,
                $count === 2 => PluralCategory::Two,
                $lastTwoDigits >= 3 && $lastTwoDigits <= 10 => PluralCategory::Few,
                // CLDR bounds this at 99, which %% 100 already guarantees.
                $lastTwoDigits >= 11 => PluralCategory::Many,
                default => PluralCategory::Other,
            },
        };
    }

    /**
     * Every category this rule can produce for a count of one or more.
     *
     * A count of zero never reaches a plural form: an interval that short is
     * described as "less than a minute", so Arabic's zero form is not listed.
     *
     * @return non-empty-list<PluralCategory>
     */
    #[\NoDiscard]
    public function categories(): array
    {
        return match ($this) {
            self::OtherOnly => [PluralCategory::Other],
            self::OneOther, self::ZeroOneOther => [PluralCategory::One, PluralCategory::Other],
            self::French => [PluralCategory::One, PluralCategory::Many, PluralCategory::Other],
            self::EastSlavic, self::Polish => [
                PluralCategory::One,
                PluralCategory::Few,
                PluralCategory::Many,
            ],
            self::CzechSlovak => [PluralCategory::One, PluralCategory::Few, PluralCategory::Other],
            self::Latvian => [PluralCategory::Zero, PluralCategory::One, PluralCategory::Other],
            self::Arabic => [
                PluralCategory::One,
                PluralCategory::Two,
                PluralCategory::Few,
                PluralCategory::Many,
                PluralCategory::Other,
            ],
        };
    }
}
