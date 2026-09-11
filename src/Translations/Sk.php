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
 * Slovak translations.
 */
final class Sk implements Language
{
    public function vocabulary(): Vocabulary
    {
        return new Vocabulary(
            plurals: PluralRule::CzechSlovak,
            full: new TenseSet(
                past: new TenseVocabulary(
                    lessThanAMinute: 'pred menej ako minútou',
                    oneMinute: 'pred 1 minútou',
                    minutes: new PluralForms('pred %s minútami', one: 'pred %s minútou', few: 'pred %s minútami'),
                    aboutOneHour: 'asi pred 1 hodinou',
                    hours: new PluralForms('pred %s hodinami', one: 'pred %s hodinou', few: 'pred %s hodinami'),
                    aboutOneDay: 'pred 1 dňom',
                    days: new PluralForms('pred %s dňami', one: 'pred %s dňom', few: 'pred %s dňami'),
                    aboutOneMonth: 'asi pred 1 mesiacom',
                    months: new PluralForms('pred %s mesiacmi', one: 'pred %s mesiacom', few: 'pred %s mesiacmi'),
                    aboutOneYear: 'asi pred 1 rokom',
                    years: new PluralForms(
                        other: 'pred viac ako %s rokmi',
                        one: 'pred viac ako %s rokom',
                        few: 'pred viac ako %s rokmi',
                    ),
                ),
                future: new TenseVocabulary(
                    lessThanAMinute: 'o menej ako minútu',
                    oneMinute: 'o 1 minútu',
                    minutes: new PluralForms('o %s minút', one: 'o %s minútu', few: 'o %s minúty'),
                    aboutOneHour: 'asi o 1 hodinu',
                    hours: new PluralForms('o %s hodín', one: 'o %s hodinu', few: 'o %s hodiny'),
                    aboutOneDay: 'o 1 deň',
                    days: new PluralForms('o %s dní', one: 'o %s deň', few: 'o %s dni'),
                    aboutOneMonth: 'asi o 1 mesiac',
                    months: new PluralForms('o %s mesiacov', one: 'o %s mesiac', few: 'o %s mesiace'),
                    aboutOneYear: 'asi o 1 rok',
                    years: new PluralForms('o viac ako %s rokov', one: 'o viac ako %s rok', few: 'o viac ako %s roky'),
                ),
                plain: new TenseVocabulary(
                    lessThanAMinute: 'menej ako minúta',
                    oneMinute: '1 minúta',
                    minutes: new PluralForms('%s minút', one: '%s minúta', few: '%s minúty'),
                    aboutOneHour: 'asi 1 hodina',
                    hours: new PluralForms('%s hodín', one: '%s hodina', few: '%s hodiny'),
                    aboutOneDay: '1 deň',
                    days: new PluralForms('%s dní', one: '%s deň', few: '%s dni'),
                    aboutOneMonth: 'asi 1 mesiac',
                    months: new PluralForms('%s mesiacov', one: '%s mesiac', few: '%s mesiace'),
                    aboutOneYear: 'asi 1 rok',
                    years: new PluralForms('viac ako %s rokov', one: 'viac ako %s rok', few: 'viac ako %s roky'),
                ),
            ),
            never: 'Nikdy',
            short: new TenseSet(
                past: new TenseVocabulary(
                    lessThanAMinute: 'pred <1 min',
                    oneMinute: 'pred 1 min',
                    minutes: PluralForms::invariant('pred %s min'),
                    aboutOneHour: 'pred ~1 h',
                    hours: PluralForms::invariant('pred %s h'),
                    aboutOneDay: 'pred 1 d',
                    days: PluralForms::invariant('pred %s d'),
                    aboutOneMonth: 'pred ~1 mes',
                    months: PluralForms::invariant('pred %s mes'),
                    aboutOneYear: 'pred ~1 r',
                    years: PluralForms::invariant('pred >%s r'),
                ),
                future: new TenseVocabulary(
                    lessThanAMinute: 'o <1 min',
                    oneMinute: 'o 1 min',
                    minutes: PluralForms::invariant('o %s min'),
                    aboutOneHour: 'o ~1 h',
                    hours: PluralForms::invariant('o %s h'),
                    aboutOneDay: 'o 1 d',
                    days: PluralForms::invariant('o %s d'),
                    aboutOneMonth: 'o ~1 mes',
                    months: PluralForms::invariant('o %s mes'),
                    aboutOneYear: 'o ~1 r',
                    years: PluralForms::invariant('o >%s r'),
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
                    months: PluralForms::invariant('%s mes'),
                    aboutOneYear: '~1 r',
                    years: PluralForms::invariant('>%s r'),
                ),
            ),
        );
    }
}
