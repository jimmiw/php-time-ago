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
 * German translations.
 */
final class De implements Language
{
    public function vocabulary(): Vocabulary
    {
        return new Vocabulary(
            plurals: PluralRule::OneOther,
            full: new TenseSet(
                past: new TenseVocabulary(
                    lessThanAMinute: 'vor weniger als einer Minute',
                    oneMinute: 'vor 1 Minute',
                    minutes: new PluralForms('vor %s Minuten', one: 'vor %s Minute'),
                    aboutOneHour: 'vor etwa 1 Stunde',
                    hours: new PluralForms('vor %s Stunden', one: 'vor %s Stunde'),
                    aboutOneDay: 'vor 1 Tag',
                    days: new PluralForms('vor %s Tagen', one: 'vor %s Tag'),
                    aboutOneMonth: 'vor etwa 1 Monat',
                    months: new PluralForms('vor %s Monaten', one: 'vor %s Monat'),
                    aboutOneYear: 'vor etwa 1 Jahr',
                    years: new PluralForms('vor mehr als %s Jahren', one: 'vor mehr als %s Jahr'),
                ),
                future: new TenseVocabulary(
                    lessThanAMinute: 'in weniger als einer Minute',
                    oneMinute: 'in 1 Minute',
                    minutes: new PluralForms('in %s Minuten', one: 'in %s Minute'),
                    aboutOneHour: 'in etwa 1 Stunde',
                    hours: new PluralForms('in %s Stunden', one: 'in %s Stunde'),
                    aboutOneDay: 'in 1 Tag',
                    days: new PluralForms('in %s Tagen', one: 'in %s Tag'),
                    aboutOneMonth: 'in etwa 1 Monat',
                    months: new PluralForms('in %s Monaten', one: 'in %s Monat'),
                    aboutOneYear: 'in etwa 1 Jahr',
                    years: new PluralForms('in mehr als %s Jahren', one: 'in mehr als %s Jahr'),
                ),
                plain: new TenseVocabulary(
                    lessThanAMinute: 'weniger als eine Minute',
                    oneMinute: '1 Minute',
                    minutes: new PluralForms('%s Minuten', one: '%s Minute'),
                    aboutOneHour: 'etwa 1 Stunde',
                    hours: new PluralForms('%s Stunden', one: '%s Stunde'),
                    aboutOneDay: '1 Tag',
                    days: new PluralForms('%s Tage', one: '%s Tag'),
                    aboutOneMonth: 'etwa 1 Monat',
                    months: new PluralForms('%s Monate', one: '%s Monat'),
                    aboutOneYear: 'etwa 1 Jahr',
                    years: new PluralForms('mehr als %s Jahre', one: 'mehr als %s Jahr'),
                ),
            ),
            never: 'Nie',
            short: new TenseSet(
                past: new TenseVocabulary(
                    lessThanAMinute: 'vor <1 Min.',
                    oneMinute: 'vor 1 Min.',
                    minutes: PluralForms::invariant('vor %s Min.'),
                    aboutOneHour: 'vor ~1 Std.',
                    hours: PluralForms::invariant('vor %s Std.'),
                    aboutOneDay: 'vor 1 Tg.',
                    days: PluralForms::invariant('vor %s Tg.'),
                    aboutOneMonth: 'vor ~1 Mon.',
                    months: PluralForms::invariant('vor %s Mon.'),
                    aboutOneYear: 'vor ~1 J.',
                    years: PluralForms::invariant('vor >%s J.'),
                ),
                future: new TenseVocabulary(
                    lessThanAMinute: 'in <1 Min.',
                    oneMinute: 'in 1 Min.',
                    minutes: PluralForms::invariant('in %s Min.'),
                    aboutOneHour: 'in ~1 Std.',
                    hours: PluralForms::invariant('in %s Std.'),
                    aboutOneDay: 'in 1 Tg.',
                    days: PluralForms::invariant('in %s Tg.'),
                    aboutOneMonth: 'in ~1 Mon.',
                    months: PluralForms::invariant('in %s Mon.'),
                    aboutOneYear: 'in ~1 J.',
                    years: PluralForms::invariant('in >%s J.'),
                ),
                plain: new TenseVocabulary(
                    lessThanAMinute: '<1 Min.',
                    oneMinute: '1 Min.',
                    minutes: PluralForms::invariant('%s Min.'),
                    aboutOneHour: '~1 Std.',
                    hours: PluralForms::invariant('%s Std.'),
                    aboutOneDay: '1 Tg.',
                    days: PluralForms::invariant('%s Tg.'),
                    aboutOneMonth: '~1 Mon.',
                    months: PluralForms::invariant('%s Mon.'),
                    aboutOneYear: '~1 J.',
                    years: PluralForms::invariant('>%s J.'),
                ),
            ),
        );
    }
}
