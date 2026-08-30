<?php

declare(strict_types=1);

namespace Alexxiy\TimeIntervals\Translations;

use Alexxiy\TimeIntervals\Language;
use Alexxiy\TimeIntervals\PluralForms;
use Alexxiy\TimeIntervals\PluralRule;
use Alexxiy\TimeIntervals\TenseSet;
use Alexxiy\TimeIntervals\TenseVocabulary;
use Alexxiy\TimeIntervals\Vocabulary;

/**
 * Azerbaijani translations.
 */
final class Az implements Language
{
    public function vocabulary(): Vocabulary
    {
        return new Vocabulary(
            plurals: PluralRule::OneOther,
            full: new TenseSet(
                past: new TenseVocabulary(
                    lessThanAMinute: 'bir dəqiqədən az əvvəl',
                    oneMinute: '1 dəqiqə əvvəl',
                    minutes: new PluralForms('%s dəqiqə əvvəl', one: '%s dəqiqə əvvəl'),
                    aboutOneHour: 'təxminən 1 saat əvvəl',
                    hours: new PluralForms('%s saat əvvəl', one: '%s saat əvvəl'),
                    aboutOneDay: '1 gün əvvəl',
                    days: new PluralForms('%s gün əvvəl', one: '%s gün əvvəl'),
                    aboutOneMonth: 'təxminən 1 ay əvvəl',
                    months: new PluralForms('%s ay əvvəl', one: '%s ay əvvəl'),
                    aboutOneYear: 'təxminən 1 il əvvəl',
                    years: new PluralForms('%s ildən çox əvvəl', one: '%s ildən çox əvvəl'),
                ),
                future: new TenseVocabulary(
                    lessThanAMinute: 'bir dəqiqədən az sonra',
                    oneMinute: '1 dəqiqə sonra',
                    minutes: new PluralForms('%s dəqiqə sonra', one: '%s dəqiqə sonra'),
                    aboutOneHour: 'təxminən 1 saat sonra',
                    hours: new PluralForms('%s saat sonra', one: '%s saat sonra'),
                    aboutOneDay: '1 gün sonra',
                    days: new PluralForms('%s gün sonra', one: '%s gün sonra'),
                    aboutOneMonth: 'təxminən 1 ay sonra',
                    months: new PluralForms('%s ay sonra', one: '%s ay sonra'),
                    aboutOneYear: 'təxminən 1 il sonra',
                    years: new PluralForms('%s ildən çox sonra', one: '%s ildən çox sonra'),
                ),
                plain: new TenseVocabulary(
                    lessThanAMinute: 'bir dəqiqədən az',
                    oneMinute: '1 dəqiqə',
                    minutes: new PluralForms('%s dəqiqə', one: '%s dəqiqə'),
                    aboutOneHour: 'təxminən 1 saat',
                    hours: new PluralForms('%s saat', one: '%s saat'),
                    aboutOneDay: '1 gün',
                    days: new PluralForms('%s gün', one: '%s gün'),
                    aboutOneMonth: 'təxminən 1 ay',
                    months: new PluralForms('%s ay', one: '%s ay'),
                    aboutOneYear: 'təxminən 1 il',
                    years: new PluralForms('%s ildən çox', one: '%s ildən çox'),
                ),
            ),
            never: 'Heç vaxt',
        );
    }
}
