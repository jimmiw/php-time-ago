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
 * Czech translations.
 */
final class Cs implements Language
{
    public function vocabulary(): Vocabulary
    {
        return new Vocabulary(
            plurals: PluralRule::CzechSlovak,
            full: new TenseSet(
                past: new TenseVocabulary(
                    lessThanAMinute: 'před méně než minutou',
                    oneMinute: 'před 1 minutou',
                    minutes: new PluralForms('před %s minutami', one: 'před %s minutou', few: 'před %s minutami'),
                    aboutOneHour: 'asi před 1 hodinou',
                    hours: new PluralForms('před %s hodinami', one: 'před %s hodinou', few: 'před %s hodinami'),
                    aboutOneDay: 'před 1 dnem',
                    days: new PluralForms('před %s dny', one: 'před %s dnem', few: 'před %s dny'),
                    aboutOneMonth: 'asi před 1 měsícem',
                    months: new PluralForms('před %s měsíci', one: 'před %s měsícem', few: 'před %s měsíci'),
                    aboutOneYear: 'asi před 1 rokem',
                    years: new PluralForms(
                        other: 'před více než %s lety',
                        one: 'před více než %s rokem',
                        few: 'před více než %s lety',
                    ),
                ),
                future: new TenseVocabulary(
                    lessThanAMinute: 'za méně než minutu',
                    oneMinute: 'za 1 minutu',
                    minutes: new PluralForms('za %s minut', one: 'za %s minutu', few: 'za %s minuty'),
                    aboutOneHour: 'asi za 1 hodinu',
                    hours: new PluralForms('za %s hodin', one: 'za %s hodinu', few: 'za %s hodiny'),
                    aboutOneDay: 'za 1 den',
                    days: new PluralForms('za %s dní', one: 'za %s den', few: 'za %s dny'),
                    aboutOneMonth: 'asi za 1 měsíc',
                    months: new PluralForms('za %s měsíců', one: 'za %s měsíc', few: 'za %s měsíce'),
                    aboutOneYear: 'asi za 1 rok',
                    years: new PluralForms('za více než %s let', one: 'za více než %s rok', few: 'za více než %s roky'),
                ),
                plain: new TenseVocabulary(
                    lessThanAMinute: 'méně než minuta',
                    oneMinute: '1 minuta',
                    minutes: new PluralForms('%s minut', one: '%s minuta', few: '%s minuty'),
                    aboutOneHour: 'asi 1 hodina',
                    hours: new PluralForms('%s hodin', one: '%s hodina', few: '%s hodiny'),
                    aboutOneDay: '1 den',
                    days: new PluralForms('%s dní', one: '%s den', few: '%s dny'),
                    aboutOneMonth: 'asi 1 měsíc',
                    months: new PluralForms('%s měsíců', one: '%s měsíc', few: '%s měsíce'),
                    aboutOneYear: 'asi 1 rok',
                    years: new PluralForms('více než %s let', one: 'více než %s rok', few: 'více než %s roky'),
                ),
            ),
            never: 'Nikdy',
            short: new TenseSet(
                past: new TenseVocabulary(
                    lessThanAMinute: 'před <1 min',
                    oneMinute: 'před 1 min',
                    minutes: PluralForms::invariant('před %s min'),
                    aboutOneHour: 'před ~1 h',
                    hours: PluralForms::invariant('před %s h'),
                    aboutOneDay: 'před 1 d',
                    days: PluralForms::invariant('před %s d'),
                    aboutOneMonth: 'před ~1 měs',
                    months: PluralForms::invariant('před %s měs'),
                    aboutOneYear: 'před ~1 r',
                    years: PluralForms::invariant('před >%s l'),
                ),
                future: new TenseVocabulary(
                    lessThanAMinute: 'za <1 min',
                    oneMinute: 'za 1 min',
                    minutes: PluralForms::invariant('za %s min'),
                    aboutOneHour: 'za ~1 h',
                    hours: PluralForms::invariant('za %s h'),
                    aboutOneDay: 'za 1 d',
                    days: PluralForms::invariant('za %s d'),
                    aboutOneMonth: 'za ~1 měs',
                    months: PluralForms::invariant('za %s měs'),
                    aboutOneYear: 'za ~1 r',
                    years: PluralForms::invariant('za >%s l'),
                ),
                plain: new TenseVocabulary(
                    lessThanAMinute: '<1 min',
                    oneMinute: '1 min',
                    minutes: PluralForms::invariant('%s min'),
                    aboutOneHour: '~1 h',
                    hours: PluralForms::invariant('%s h'),
                    aboutOneDay: '1 d',
                    days: PluralForms::invariant('%s d'),
                    aboutOneMonth: '~1 měs',
                    months: PluralForms::invariant('%s měs'),
                    aboutOneYear: '~1 r',
                    years: PluralForms::invariant('>%s l'),
                ),
            ),
        );
    }
}
