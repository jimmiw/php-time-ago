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
 * Spanish translations.
 */
final class Es implements Language
{
    public function vocabulary(): Vocabulary
    {
        return new Vocabulary(
            plurals: PluralRule::OneOther,
            full: new TenseSet(
                past: new TenseVocabulary(
                    lessThanAMinute: 'hace menos de 1 minuto',
                    oneMinute: 'hace 1 minuto',
                    minutes: new PluralForms('hace %s minutos', one: 'hace %s minuto'),
                    aboutOneHour: 'hace alrededor de 1 hora',
                    hours: new PluralForms('hace %s horas', one: 'hace %s hora'),
                    aboutOneDay: 'hace 1 día',
                    days: new PluralForms('hace %s días', one: 'hace %s día'),
                    aboutOneMonth: 'hace alrededor de 1 mes',
                    months: new PluralForms('hace %s meses', one: 'hace %s mes'),
                    aboutOneYear: 'hace alrededor de 1 año',
                    years: new PluralForms('hace más de %s años', one: 'hace más de %s año'),
                ),
                future: new TenseVocabulary(
                    lessThanAMinute: 'en menos de 1 minuto',
                    oneMinute: 'en 1 minuto',
                    minutes: new PluralForms('en %s minutos', one: 'en %s minuto'),
                    aboutOneHour: 'en alrededor de 1 hora',
                    hours: new PluralForms('en %s horas', one: 'en %s hora'),
                    aboutOneDay: 'en 1 día',
                    days: new PluralForms('en %s días', one: 'en %s día'),
                    aboutOneMonth: 'en alrededor de 1 mes',
                    months: new PluralForms('en %s meses', one: 'en %s mes'),
                    aboutOneYear: 'en alrededor de 1 año',
                    years: new PluralForms('en más de %s años', one: 'en más de %s año'),
                ),
                plain: new TenseVocabulary(
                    lessThanAMinute: 'menos de 1 minuto',
                    oneMinute: '1 minuto',
                    minutes: new PluralForms('%s minutos', one: '%s minuto'),
                    aboutOneHour: 'alrededor de 1 hora',
                    hours: new PluralForms('%s horas', one: '%s hora'),
                    aboutOneDay: '1 día',
                    days: new PluralForms('%s días', one: '%s día'),
                    aboutOneMonth: 'alrededor de 1 mes',
                    months: new PluralForms('%s meses', one: '%s mes'),
                    aboutOneYear: 'alrededor de 1 año',
                    years: new PluralForms('más de %s años', one: 'más de %s año'),
                ),
            ),
            never: 'Nunca',
            short: new TenseSet(
                past: new TenseVocabulary(
                    lessThanAMinute: 'hace <1 min',
                    oneMinute: 'hace 1 min',
                    minutes: PluralForms::invariant('hace %s min'),
                    aboutOneHour: 'hace ~1 h',
                    hours: PluralForms::invariant('hace %s h'),
                    aboutOneDay: 'hace 1 d',
                    days: PluralForms::invariant('hace %s d'),
                    aboutOneMonth: 'hace ~1 mes',
                    months: PluralForms::invariant('hace %s meses'),
                    aboutOneYear: 'hace ~1 año',
                    years: PluralForms::invariant('hace >%s años'),
                ),
                future: new TenseVocabulary(
                    lessThanAMinute: 'en <1 min',
                    oneMinute: 'en 1 min',
                    minutes: PluralForms::invariant('en %s min'),
                    aboutOneHour: 'en ~1 h',
                    hours: PluralForms::invariant('en %s h'),
                    aboutOneDay: 'en 1 d',
                    days: PluralForms::invariant('en %s d'),
                    aboutOneMonth: 'en ~1 mes',
                    months: PluralForms::invariant('en %s meses'),
                    aboutOneYear: 'en ~1 año',
                    years: PluralForms::invariant('en >%s años'),
                ),
                plain: new TenseVocabulary(
                    lessThanAMinute: '<1 min',
                    oneMinute: '1 min',
                    minutes: PluralForms::invariant('%s min'),
                    aboutOneHour: '~1 h',
                    hours: PluralForms::invariant('%s h'),
                    aboutOneDay: '1 d',
                    days: PluralForms::invariant('%s d'),
                    aboutOneMonth: '~1 mes',
                    months: PluralForms::invariant('%s meses'),
                    aboutOneYear: '~1 año',
                    years: PluralForms::invariant('>%s años'),
                ),
            ),
        );
    }
}
