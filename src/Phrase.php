<?php

declare(strict_types=1);

namespace Alexxiy\TimeIntervals;

/**
 * The distinct things this library can say about an elapsed interval.
 *
 * Every case maps to exactly one property of {@see TenseVocabulary}, which is
 * why a language can never be partially translated: the compiler enforces it.
 */
enum Phrase: string
{
    case LessThanAMinute = 'lessThanAMinute';
    case OneMinute = 'oneMinute';
    case Minutes = 'minutes';
    case AboutOneHour = 'aboutOneHour';
    case Hours = 'hours';
    case AboutOneDay = 'aboutOneDay';
    case Days = 'days';
    case AboutOneMonth = 'aboutOneMonth';
    case Months = 'months';
    case AboutOneYear = 'aboutOneYear';
    case Years = 'years';

    /**
     * Whether the phrase is rendered with a numeric count substituted into it,
     * and therefore has plural forms.
     */
    #[\NoDiscard]
    public function takesCount(): bool
    {
        return match ($this) {
            self::Minutes, self::Hours, self::Days, self::Months, self::Years => true,
            default => false,
        };
    }
}
