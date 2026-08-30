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
 * Norwegian Bokmal translations.
 */
final class NbNo implements Language
{
    public function vocabulary(): Vocabulary
    {
        return new Vocabulary(
            plurals: PluralRule::OneOther,
            full: new TenseSet(
                past: new TenseVocabulary(
                    lessThanAMinute: 'mindre enn ett minutt siden',
                    oneMinute: 'ett minutt siden',
                    minutes: new PluralForms('%s minutter siden', one: '%s minutt siden'),
                    aboutOneHour: 'omtrent en time siden',
                    hours: new PluralForms('%s timer siden', one: '%s time siden'),
                    aboutOneDay: 'en dag siden',
                    days: new PluralForms('%s dager siden', one: '%s dag siden'),
                    aboutOneMonth: 'omtrent en måned siden',
                    months: new PluralForms('%s måneder siden', one: '%s måned siden'),
                    aboutOneYear: 'omtrent ett år siden',
                    years: new PluralForms('over %s år siden', one: 'over %s år siden'),
                ),
                future: new TenseVocabulary(
                    lessThanAMinute: 'om mindre enn ett minutt',
                    oneMinute: 'om ett minutt',
                    minutes: new PluralForms('om %s minutter', one: 'om %s minutt'),
                    aboutOneHour: 'om omtrent en time',
                    hours: new PluralForms('om %s timer', one: 'om %s time'),
                    aboutOneDay: 'om en dag',
                    days: new PluralForms('om %s dager', one: 'om %s dag'),
                    aboutOneMonth: 'om omtrent en måned',
                    months: new PluralForms('om %s måneder', one: 'om %s måned'),
                    aboutOneYear: 'om omtrent ett år',
                    years: new PluralForms('om over %s år', one: 'om over %s år'),
                ),
                plain: new TenseVocabulary(
                    lessThanAMinute: 'mindre enn ett minutt',
                    oneMinute: 'ett minutt',
                    minutes: new PluralForms('%s minutter', one: '%s minutt'),
                    aboutOneHour: 'omtrent en time',
                    hours: new PluralForms('%s timer', one: '%s time'),
                    aboutOneDay: 'en dag',
                    days: new PluralForms('%s dager', one: '%s dag'),
                    aboutOneMonth: 'omtrent en måned',
                    months: new PluralForms('%s måneder', one: '%s måned'),
                    aboutOneYear: 'omtrent ett år',
                    years: new PluralForms('over %s år', one: 'over %s år'),
                ),
            ),
            never: 'Aldri',
            short: new TenseSet(
                past: new TenseVocabulary(
                    lessThanAMinute: '<1 min siden',
                    oneMinute: '1 min siden',
                    minutes: PluralForms::invariant('%s min siden'),
                    aboutOneHour: '~1 t siden',
                    hours: PluralForms::invariant('%s t siden'),
                    aboutOneDay: '1 d siden',
                    days: PluralForms::invariant('%s d siden'),
                    aboutOneMonth: '~1 mnd siden',
                    months: PluralForms::invariant('%s mnd siden'),
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
                    aboutOneMonth: 'om ~1 mnd',
                    months: PluralForms::invariant('om %s mnd'),
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
                    aboutOneMonth: '~1 mnd',
                    months: PluralForms::invariant('%s mnd'),
                    aboutOneYear: '~1 år',
                    years: PluralForms::invariant('>%s år'),
                ),
            ),
        );
    }
}
