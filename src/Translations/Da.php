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
 * Danish translations.
 */
final class Da implements Language
{
    public function vocabulary(): Vocabulary
    {
        return new Vocabulary(
            plurals: PluralRule::OneOther,
            full: new TenseSet(
                past: new TenseVocabulary(
                    lessThanAMinute: 'mindre end et minut siden',
                    oneMinute: '1 minut siden',
                    minutes: new PluralForms('%s minutter siden', one: '%s minut siden'),
                    aboutOneHour: 'cirka 1 time siden',
                    hours: new PluralForms('%s timer siden', one: '%s time siden'),
                    aboutOneDay: '1 dag siden',
                    days: new PluralForms('%s dage siden', one: '%s dag siden'),
                    aboutOneMonth: 'cirka 1 måned siden',
                    months: new PluralForms('%s måneder siden', one: '%s måned siden'),
                    aboutOneYear: 'cirka 1 år siden',
                    years: new PluralForms('over %s år siden', one: 'over %s år siden'),
                ),
                future: new TenseVocabulary(
                    lessThanAMinute: 'om mindre end et minut',
                    oneMinute: 'om 1 minut',
                    minutes: new PluralForms('om %s minutter', one: 'om %s minut'),
                    aboutOneHour: 'om cirka 1 time',
                    hours: new PluralForms('om %s timer', one: 'om %s time'),
                    aboutOneDay: 'om 1 dag',
                    days: new PluralForms('om %s dage', one: 'om %s dag'),
                    aboutOneMonth: 'om cirka 1 måned',
                    months: new PluralForms('om %s måneder', one: 'om %s måned'),
                    aboutOneYear: 'om cirka 1 år',
                    years: new PluralForms('om over %s år', one: 'om over %s år'),
                ),
                plain: new TenseVocabulary(
                    lessThanAMinute: 'mindre end et minut',
                    oneMinute: '1 minut',
                    minutes: new PluralForms('%s minutter', one: '%s minut'),
                    aboutOneHour: 'cirka 1 time',
                    hours: new PluralForms('%s timer', one: '%s time'),
                    aboutOneDay: '1 dag',
                    days: new PluralForms('%s dage', one: '%s dag'),
                    aboutOneMonth: 'cirka 1 måned',
                    months: new PluralForms('%s måneder', one: '%s måned'),
                    aboutOneYear: 'cirka 1 år',
                    years: new PluralForms('over %s år', one: 'over %s år'),
                ),
            ),
            never: 'Aldrig',
            short: new TenseSet(
                past: new TenseVocabulary(
                    lessThanAMinute: '<1 min siden',
                    oneMinute: '1 min siden',
                    minutes: PluralForms::invariant('%s min siden'),
                    aboutOneHour: '~1 t siden',
                    hours: PluralForms::invariant('%s t siden'),
                    aboutOneDay: '1 d siden',
                    days: PluralForms::invariant('%s d siden'),
                    aboutOneMonth: '~1 md siden',
                    months: PluralForms::invariant('%s mdr siden'),
                    aboutOneYear: '~1 år siden',
                    years: PluralForms::invariant('>%s år siden'),
                ),
                future: new TenseVocabulary(
                    lessThanAMinute: 'om <1 min',
                    oneMinute: 'om 1 min',
                    minutes: PluralForms::invariant('om %s min'),
                    aboutOneHour: 'om ~1 t',
                    hours: PluralForms::invariant('om %s t'),
                    aboutOneDay: 'om 1 d',
                    days: PluralForms::invariant('om %s d'),
                    aboutOneMonth: 'om ~1 md',
                    months: PluralForms::invariant('om %s mdr'),
                    aboutOneYear: 'om ~1 år',
                    years: PluralForms::invariant('om >%s år'),
                ),
                plain: new TenseVocabulary(
                    lessThanAMinute: '<1 min',
                    oneMinute: '1 min',
                    minutes: PluralForms::invariant('%s min'),
                    aboutOneHour: '~1 t',
                    hours: PluralForms::invariant('%s t'),
                    aboutOneDay: '1 d',
                    days: PluralForms::invariant('%s d'),
                    aboutOneMonth: '~1 md',
                    months: PluralForms::invariant('%s mdr'),
                    aboutOneYear: '~1 år',
                    years: PluralForms::invariant('>%s år'),
                ),
            ),
        );
    }
}
