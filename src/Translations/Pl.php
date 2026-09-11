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
 * Polish translations.
 */
final class Pl implements Language
{
    public function vocabulary(): Vocabulary
    {
        return new Vocabulary(
            plurals: PluralRule::Polish,
            full: new TenseSet(
                past: new TenseVocabulary(
                    lessThanAMinute: 'mniej niż minutę temu',
                    oneMinute: 'minutę temu',
                    minutes: new PluralForms(
                        other: '%s minut temu',
                        one: '%s minutę temu',
                        few: '%s minuty temu',
                        many: '%s minut temu',
                    ),
                    aboutOneHour: 'około godziny temu',
                    hours: new PluralForms(
                        other: '%s godzin temu',
                        one: '%s godzinę temu',
                        few: '%s godziny temu',
                        many: '%s godzin temu',
                    ),
                    aboutOneDay: 'dzień temu',
                    days: new PluralForms('%s dni temu', one: '%s dzień temu', few: '%s dni temu', many: '%s dni temu'),
                    aboutOneMonth: 'około miesiąca temu',
                    months: new PluralForms(
                        other: '%s miesięcy temu',
                        one: '%s miesiąc temu',
                        few: '%s miesiące temu',
                        many: '%s miesięcy temu',
                    ),
                    aboutOneYear: 'około roku temu',
                    years: new PluralForms(
                        other: 'ponad %s lat temu',
                        one: 'ponad %s rok temu',
                        few: 'ponad %s lata temu',
                        many: 'ponad %s lat temu',
                    ),
                ),
                future: new TenseVocabulary(
                    lessThanAMinute: 'za mniej niż minutę',
                    oneMinute: 'za minutę',
                    minutes: new PluralForms(
                        other: 'za %s minut',
                        one: 'za %s minutę',
                        few: 'za %s minuty',
                        many: 'za %s minut',
                    ),
                    aboutOneHour: 'za około godzinę',
                    hours: new PluralForms(
                        other: 'za %s godzin',
                        one: 'za %s godzinę',
                        few: 'za %s godziny',
                        many: 'za %s godzin',
                    ),
                    aboutOneDay: 'za dzień',
                    days: new PluralForms('za %s dni', one: 'za %s dzień', few: 'za %s dni', many: 'za %s dni'),
                    aboutOneMonth: 'za około miesiąc',
                    months: new PluralForms(
                        other: 'za %s miesięcy',
                        one: 'za %s miesiąc',
                        few: 'za %s miesiące',
                        many: 'za %s miesięcy',
                    ),
                    aboutOneYear: 'za około rok',
                    years: new PluralForms(
                        other: 'za ponad %s lat',
                        one: 'za ponad %s rok',
                        few: 'za ponad %s lata',
                        many: 'za ponad %s lat',
                    ),
                ),
                plain: new TenseVocabulary(
                    lessThanAMinute: 'mniej niż minuta',
                    oneMinute: 'minuta',
                    minutes: new PluralForms('%s minut', one: '%s minuta', few: '%s minuty', many: '%s minut'),
                    aboutOneHour: 'około godziny',
                    hours: new PluralForms('%s godzin', one: '%s godzina', few: '%s godziny', many: '%s godzin'),
                    aboutOneDay: 'dzień',
                    days: new PluralForms('%s dni', one: '%s dzień', few: '%s dni', many: '%s dni'),
                    aboutOneMonth: 'około miesiąca',
                    months: new PluralForms('%s miesięcy', one: '%s miesiąc', few: '%s miesiące', many: '%s miesięcy'),
                    aboutOneYear: 'około roku',
                    years: new PluralForms(
                        other: 'ponad %s lat',
                        one: 'ponad %s rok',
                        few: 'ponad %s lata',
                        many: 'ponad %s lat',
                    ),
                ),
            ),
            never: 'Nigdy',
            short: new TenseSet(
                past: new TenseVocabulary(
                    lessThanAMinute: '<1 min temu',
                    oneMinute: '1 min temu',
                    minutes: PluralForms::invariant('%s min temu'),
                    aboutOneHour: '~1 godz temu',
                    hours: PluralForms::invariant('%s godz temu'),
                    aboutOneDay: '1 d temu',
                    days: PluralForms::invariant('%s d temu'),
                    aboutOneMonth: '~1 mies temu',
                    months: PluralForms::invariant('%s mies temu'),
                    aboutOneYear: '~1 r temu',
                    years: PluralForms::invariant('>%s l temu'),
                ),
                future: new TenseVocabulary(
                    lessThanAMinute: 'za <1 min',
                    oneMinute: 'za 1 min',
                    minutes: PluralForms::invariant('za %s min'),
                    aboutOneHour: 'za ~1 godz',
                    hours: PluralForms::invariant('za %s godz'),
                    aboutOneDay: 'za 1 d',
                    days: PluralForms::invariant('za %s d'),
                    aboutOneMonth: 'za ~1 mies',
                    months: PluralForms::invariant('za %s mies'),
                    aboutOneYear: 'za ~1 r',
                    years: PluralForms::invariant('za >%s l'),
                ),
                plain: new TenseVocabulary(
                    lessThanAMinute: '<1 min',
                    oneMinute: '1 min',
                    minutes: PluralForms::invariant('%s min'),
                    aboutOneHour: '~1 godz',
                    hours: PluralForms::invariant('%s godz'),
                    aboutOneDay: '1 d',
                    days: PluralForms::invariant('%s d'),
                    aboutOneMonth: '~1 mies',
                    months: PluralForms::invariant('%s mies'),
                    aboutOneYear: '~1 r',
                    years: PluralForms::invariant('>%s l'),
                ),
            ),
        );
    }
}
