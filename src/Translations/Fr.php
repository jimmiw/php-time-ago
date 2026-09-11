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
 * French translations.
 */
final class Fr implements Language
{
    public function vocabulary(): Vocabulary
    {
        return new Vocabulary(
            plurals: PluralRule::French,
            full: new TenseSet(
                past: new TenseVocabulary(
                    lessThanAMinute: 'il y a moins d\'une minute',
                    oneMinute: 'il y a une minute',
                    minutes: new PluralForms('il y a %s minutes', one: 'il y a %s minute'),
                    aboutOneHour: 'il y a environ une heure',
                    hours: new PluralForms('il y a %s heures', one: 'il y a %s heure'),
                    aboutOneDay: 'il y a un jour',
                    days: new PluralForms('il y a %s jours', one: 'il y a %s jour'),
                    aboutOneMonth: 'il y a environ un mois',
                    months: new PluralForms('il y a %s mois', one: 'il y a %s mois'),
                    aboutOneYear: 'il y a environ un an',
                    years: new PluralForms('il y a plus de %s ans', one: 'il y a plus de %s an'),
                ),
                future: new TenseVocabulary(
                    lessThanAMinute: 'dans moins d\'une minute',
                    oneMinute: 'dans une minute',
                    minutes: new PluralForms('dans %s minutes', one: 'dans %s minute'),
                    aboutOneHour: 'dans environ une heure',
                    hours: new PluralForms('dans %s heures', one: 'dans %s heure'),
                    aboutOneDay: 'dans un jour',
                    days: new PluralForms('dans %s jours', one: 'dans %s jour'),
                    aboutOneMonth: 'dans environ un mois',
                    months: new PluralForms('dans %s mois', one: 'dans %s mois'),
                    aboutOneYear: 'dans environ un an',
                    years: new PluralForms('dans plus de %s ans', one: 'dans plus de %s an'),
                ),
                plain: new TenseVocabulary(
                    lessThanAMinute: 'moins d\'une minute',
                    oneMinute: 'une minute',
                    minutes: new PluralForms('%s minutes', one: '%s minute'),
                    aboutOneHour: 'environ une heure',
                    hours: new PluralForms('%s heures', one: '%s heure'),
                    aboutOneDay: 'un jour',
                    days: new PluralForms('%s jours', one: '%s jour'),
                    aboutOneMonth: 'environ un mois',
                    months: new PluralForms('%s mois', one: '%s mois'),
                    aboutOneYear: 'environ un an',
                    years: new PluralForms('plus de %s ans', one: 'plus de %s an'),
                ),
            ),
            never: 'Jamais',
            short: new TenseSet(
                past: new TenseVocabulary(
                    lessThanAMinute: 'il y a <1 min',
                    oneMinute: 'il y a 1 min',
                    minutes: PluralForms::invariant('il y a %s min'),
                    aboutOneHour: 'il y a ~1 h',
                    hours: PluralForms::invariant('il y a %s h'),
                    aboutOneDay: 'il y a 1 j',
                    days: PluralForms::invariant('il y a %s j'),
                    aboutOneMonth: 'il y a ~1 mois',
                    months: PluralForms::invariant('il y a %s mois'),
                    aboutOneYear: 'il y a ~1 an',
                    years: PluralForms::invariant('il y a >%s ans'),
                ),
                future: new TenseVocabulary(
                    lessThanAMinute: 'dans <1 min',
                    oneMinute: 'dans 1 min',
                    minutes: PluralForms::invariant('dans %s min'),
                    aboutOneHour: 'dans ~1 h',
                    hours: PluralForms::invariant('dans %s h'),
                    aboutOneDay: 'dans 1 j',
                    days: PluralForms::invariant('dans %s j'),
                    aboutOneMonth: 'dans ~1 mois',
                    months: PluralForms::invariant('dans %s mois'),
                    aboutOneYear: 'dans ~1 an',
                    years: PluralForms::invariant('dans >%s ans'),
                ),
                plain: new TenseVocabulary(
                    lessThanAMinute: '<1 min',
                    oneMinute: '1 min',
                    minutes: PluralForms::invariant('%s min'),
                    aboutOneHour: '~1 h',
                    hours: PluralForms::invariant('%s h'),
                    aboutOneDay: '1 j',
                    days: PluralForms::invariant('%s j'),
                    aboutOneMonth: '~1 mois',
                    months: PluralForms::invariant('%s mois'),
                    aboutOneYear: '~1 an',
                    years: PluralForms::invariant('>%s ans'),
                ),
            ),
        );
    }
}
