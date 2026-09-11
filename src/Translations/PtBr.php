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
 * Portuguese (Brazil) translations.
 */
final class PtBr implements Language
{
    public function vocabulary(): Vocabulary
    {
        return new Vocabulary(
            plurals: PluralRule::ZeroOneOther,
            full: new TenseSet(
                past: new TenseVocabulary(
                    lessThanAMinute: 'menos de um minuto atrás',
                    oneMinute: '1 minuto atrás',
                    minutes: new PluralForms('%s minutos atrás', one: '%s minuto atrás'),
                    aboutOneHour: 'cerca de 1 hora atrás',
                    hours: new PluralForms('%s horas atrás', one: '%s hora atrás'),
                    aboutOneDay: '1 dia atrás',
                    days: new PluralForms('%s dias atrás', one: '%s dia atrás'),
                    aboutOneMonth: 'cerca de 1 mês atrás',
                    months: new PluralForms('%s meses atrás', one: '%s mês atrás'),
                    aboutOneYear: 'cerca de 1 ano atrás',
                    years: new PluralForms('mais de %s anos atrás', one: 'mais de %s ano atrás'),
                ),
                future: new TenseVocabulary(
                    lessThanAMinute: 'em menos de um minuto',
                    oneMinute: 'em 1 minuto',
                    minutes: new PluralForms('em %s minutos', one: 'em %s minuto'),
                    aboutOneHour: 'em cerca de 1 hora',
                    hours: new PluralForms('em %s horas', one: 'em %s hora'),
                    aboutOneDay: 'em 1 dia',
                    days: new PluralForms('em %s dias', one: 'em %s dia'),
                    aboutOneMonth: 'em cerca de 1 mês',
                    months: new PluralForms('em %s meses', one: 'em %s mês'),
                    aboutOneYear: 'em cerca de 1 ano',
                    years: new PluralForms('em mais de %s anos', one: 'em mais de %s ano'),
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
                    lessThanAMinute: '<1 min atrás',
                    oneMinute: '1 min atrás',
                    minutes: PluralForms::invariant('%s min atrás'),
                    aboutOneHour: '~1 h atrás',
                    hours: PluralForms::invariant('%s h atrás'),
                    aboutOneDay: '1 d atrás',
                    days: PluralForms::invariant('%s d atrás'),
                    aboutOneMonth: '~1 mês atrás',
                    months: PluralForms::invariant('%s meses atrás'),
                    aboutOneYear: '~1 ano atrás',
                    years: PluralForms::invariant('>%s anos atrás'),
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
