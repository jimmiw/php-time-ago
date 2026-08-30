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
 * Catalan translations.
 */
final class Ca implements Language
{
    public function vocabulary(): Vocabulary
    {
        return new Vocabulary(
            plurals: PluralRule::OneOther,
            full: new TenseSet(
                past: new TenseVocabulary(
                    lessThanAMinute: 'fa menys d\'un minut',
                    oneMinute: 'fa 1 minut',
                    minutes: new PluralForms('fa %s minuts', one: 'fa %s minut'),
                    aboutOneHour: 'fa aproximadament 1 hora',
                    hours: new PluralForms('fa %s hores', one: 'fa %s hora'),
                    aboutOneDay: 'fa 1 dia',
                    days: new PluralForms('fa %s dies', one: 'fa %s dia'),
                    aboutOneMonth: 'fa aproximadament 1 mes',
                    months: new PluralForms('fa %s mesos', one: 'fa %s mes'),
                    aboutOneYear: 'fa aproximadament 1 any',
                    years: new PluralForms('fa més de %s anys', one: 'fa més de %s any'),
                ),
                future: new TenseVocabulary(
                    lessThanAMinute: 'd\'aquí a menys d\'un minut',
                    oneMinute: 'd\'aquí a 1 minut',
                    minutes: new PluralForms('d\'aquí a %s minuts', one: 'd\'aquí a %s minut'),
                    aboutOneHour: 'd\'aquí a aproximadament 1 hora',
                    hours: new PluralForms('d\'aquí a %s hores', one: 'd\'aquí a %s hora'),
                    aboutOneDay: 'd\'aquí a 1 dia',
                    days: new PluralForms('d\'aquí a %s dies', one: 'd\'aquí a %s dia'),
                    aboutOneMonth: 'd\'aquí a aproximadament 1 mes',
                    months: new PluralForms('d\'aquí a %s mesos', one: 'd\'aquí a %s mes'),
                    aboutOneYear: 'd\'aquí a aproximadament 1 any',
                    years: new PluralForms('d\'aquí a més de %s anys', one: 'd\'aquí a més de %s any'),
                ),
                plain: new TenseVocabulary(
                    lessThanAMinute: 'menys d\'un minut',
                    oneMinute: '1 minut',
                    minutes: new PluralForms('%s minuts', one: '%s minut'),
                    aboutOneHour: 'aproximadament 1 hora',
                    hours: new PluralForms('%s hores', one: '%s hora'),
                    aboutOneDay: '1 dia',
                    days: new PluralForms('%s dies', one: '%s dia'),
                    aboutOneMonth: 'aproximadament 1 mes',
                    months: new PluralForms('%s mesos', one: '%s mes'),
                    aboutOneYear: 'aproximadament 1 any',
                    years: new PluralForms('més de %s anys', one: 'més de %s any'),
                ),
            ),
            never: 'Mai',
            short: new TenseSet(
                past: new TenseVocabulary(
                    lessThanAMinute: 'fa <1 min',
                    oneMinute: 'fa 1 min',
                    minutes: PluralForms::invariant('fa %s min'),
                    aboutOneHour: 'fa ~1 h',
                    hours: PluralForms::invariant('fa %s h'),
                    aboutOneDay: 'fa 1 d',
                    days: PluralForms::invariant('fa %s d'),
                    aboutOneMonth: 'fa ~1 mes',
                    months: PluralForms::invariant('fa %s mesos'),
                    aboutOneYear: 'fa ~1 any',
                    years: PluralForms::invariant('fa >%s anys'),
                ),
                future: new TenseVocabulary(
                    lessThanAMinute: 'd\'aquí a <1 min',
                    oneMinute: 'd\'aquí a 1 min',
                    minutes: PluralForms::invariant('d\'aquí a %s min'),
                    aboutOneHour: 'd\'aquí a ~1 h',
                    hours: PluralForms::invariant('d\'aquí a %s h'),
                    aboutOneDay: 'd\'aquí a 1 d',
                    days: PluralForms::invariant('d\'aquí a %s d'),
                    aboutOneMonth: 'd\'aquí a ~1 mes',
                    months: PluralForms::invariant('d\'aquí a %s mesos'),
                    aboutOneYear: 'd\'aquí a ~1 any',
                    years: PluralForms::invariant('d\'aquí a >%s anys'),
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
                    months: PluralForms::invariant('%s mesos'),
                    aboutOneYear: '~1 any',
                    years: PluralForms::invariant('>%s anys'),
                ),
            ),
        );
    }
}
