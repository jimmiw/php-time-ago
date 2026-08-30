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
 * Portuguese translations.
 */
final class Pt implements Language
{
    public function vocabulary(): Vocabulary
    {
        return new Vocabulary(
            plurals: PluralRule::ZeroOneOther,
            full: new TenseSet(
                past: new TenseVocabulary(
                    lessThanAMinute: 'há menos de um minuto',
                    oneMinute: 'há 1 minuto',
                    minutes: new PluralForms('há %s minutos', one: 'há %s minuto'),
                    aboutOneHour: 'há cerca de 1 hora',
                    hours: new PluralForms('há %s horas', one: 'há %s hora'),
                    aboutOneDay: 'há 1 dia',
                    days: new PluralForms('há %s dias', one: 'há %s dia'),
                    aboutOneMonth: 'há cerca de 1 mês',
                    months: new PluralForms('há %s meses', one: 'há %s mês'),
                    aboutOneYear: 'há cerca de 1 ano',
                    years: new PluralForms('há mais de %s anos', one: 'há mais de %s ano'),
                ),
                future: new TenseVocabulary(
                    lessThanAMinute: 'dentro de menos de um minuto',
                    oneMinute: 'dentro de 1 minuto',
                    minutes: new PluralForms('dentro de %s minutos', one: 'dentro de %s minuto'),
                    aboutOneHour: 'dentro de cerca de 1 hora',
                    hours: new PluralForms('dentro de %s horas', one: 'dentro de %s hora'),
                    aboutOneDay: 'dentro de 1 dia',
                    days: new PluralForms('dentro de %s dias', one: 'dentro de %s dia'),
                    aboutOneMonth: 'dentro de cerca de 1 mês',
                    months: new PluralForms('dentro de %s meses', one: 'dentro de %s mês'),
                    aboutOneYear: 'dentro de cerca de 1 ano',
                    years: new PluralForms('dentro de mais de %s anos', one: 'dentro de mais de %s ano'),
                ),
                plain: new TenseVocabulary(
                    lessThanAMinute: 'menos de um minuto',
                    oneMinute: '1 minuto',
                    minutes: new PluralForms('%s minutos', one: '%s minuto'),
                    aboutOneHour: 'cerca de 1 hora',
                    hours: new PluralForms('%s horas', one: '%s hora'),
                    aboutOneDay: '1 dia',
                    days: new PluralForms('%s dias', one: '%s dia'),
                    aboutOneMonth: 'cerca de 1 mês',
                    months: new PluralForms('%s meses', one: '%s mês'),
                    aboutOneYear: 'cerca de 1 ano',
                    years: new PluralForms('mais de %s anos', one: 'mais de %s ano'),
                ),
            ),
            never: 'Nunca',
            short: new TenseSet(
                past: new TenseVocabulary(
                    lessThanAMinute: 'há <1 min',
                    oneMinute: 'há 1 min',
                    minutes: PluralForms::invariant('há %s min'),
                    aboutOneHour: 'há ~1 h',
                    hours: PluralForms::invariant('há %s h'),
                    aboutOneDay: 'há 1 d',
                    days: PluralForms::invariant('há %s d'),
                    aboutOneMonth: 'há ~1 mês',
                    months: PluralForms::invariant('há %s meses'),
                    aboutOneYear: 'há ~1 ano',
                    years: PluralForms::invariant('há >%s anos'),
                ),
                future: new TenseVocabulary(
                    lessThanAMinute: 'em <1 min',
                    oneMinute: 'em 1 min',
                    minutes: PluralForms::invariant('em %s min'),
                    aboutOneHour: 'em ~1 h',
                    hours: PluralForms::invariant('em %s h'),
                    aboutOneDay: 'em 1 d',
                    days: PluralForms::invariant('em %s d'),
                    aboutOneMonth: 'em ~1 mês',
                    months: PluralForms::invariant('em %s meses'),
                    aboutOneYear: 'em ~1 ano',
                    years: PluralForms::invariant('em >%s anos'),
                ),
                plain: new TenseVocabulary(
                    lessThanAMinute: '<1 min',
                    oneMinute: '1 min',
                    minutes: PluralForms::invariant('%s min'),
                    aboutOneHour: '~1 h',
                    hours: PluralForms::invariant('%s h'),
                    aboutOneDay: '1 d',
                    days: PluralForms::invariant('%s d'),
                    aboutOneMonth: '~1 mês',
                    months: PluralForms::invariant('%s meses'),
                    aboutOneYear: '~1 ano',
                    years: PluralForms::invariant('>%s anos'),
                ),
            ),
        );
    }
}
