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
 * Finnish translations.
 */
final class Fi implements Language
{
    public function vocabulary(): Vocabulary
    {
        return new Vocabulary(
            plurals: PluralRule::OneOther,
            full: new TenseSet(
                past: new TenseVocabulary(
                    lessThanAMinute: 'alle minuutti sitten',
                    oneMinute: '1 minuutti sitten',
                    minutes: new PluralForms('%s minuuttia sitten', one: '%s minuutti sitten'),
                    aboutOneHour: 'noin tunti sitten',
                    hours: new PluralForms('%s tuntia sitten', one: '%s tunti sitten'),
                    aboutOneDay: '1 päivä sitten',
                    days: new PluralForms('%s päivää sitten', one: '%s päivä sitten'),
                    aboutOneMonth: 'noin kuukausi sitten',
                    months: new PluralForms('%s kuukautta sitten', one: '%s kuukausi sitten'),
                    aboutOneYear: 'noin vuosi sitten',
                    years: new PluralForms('yli %s vuotta sitten', one: 'yli %s vuosi sitten'),
                ),
                future: new TenseVocabulary(
                    lessThanAMinute: 'alle minuutin kuluttua',
                    oneMinute: '1 minuutin kuluttua',
                    minutes: new PluralForms('%s minuutin kuluttua', one: '%s minuutin kuluttua'),
                    aboutOneHour: 'noin tunnin kuluttua',
                    hours: new PluralForms('%s tunnin kuluttua', one: '%s tunnin kuluttua'),
                    aboutOneDay: '1 päivän kuluttua',
                    days: new PluralForms('%s päivän kuluttua', one: '%s päivän kuluttua'),
                    aboutOneMonth: 'noin kuukauden kuluttua',
                    months: new PluralForms('%s kuukauden kuluttua', one: '%s kuukauden kuluttua'),
                    aboutOneYear: 'noin vuoden kuluttua',
                    years: new PluralForms('yli %s vuoden kuluttua', one: 'yli %s vuoden kuluttua'),
                ),
                plain: new TenseVocabulary(
                    lessThanAMinute: 'alle minuutti',
                    oneMinute: '1 minuutti',
                    minutes: new PluralForms('%s minuuttia', one: '%s minuutti'),
                    aboutOneHour: 'noin tunti',
                    hours: new PluralForms('%s tuntia', one: '%s tunti'),
                    aboutOneDay: '1 päivä',
                    days: new PluralForms('%s päivää', one: '%s päivä'),
                    aboutOneMonth: 'noin kuukausi',
                    months: new PluralForms('%s kuukautta', one: '%s kuukausi'),
                    aboutOneYear: 'noin vuosi',
                    years: new PluralForms('yli %s vuotta', one: 'yli %s vuosi'),
                ),
            ),
            never: 'Ei koskaan',
            short: new TenseSet(
                past: new TenseVocabulary(
                    lessThanAMinute: '<1 min sitten',
                    oneMinute: '1 min sitten',
                    minutes: PluralForms::invariant('%s min sitten'),
                    aboutOneHour: '~1 t sitten',
                    hours: PluralForms::invariant('%s t sitten'),
                    aboutOneDay: '1 pv sitten',
                    days: PluralForms::invariant('%s pv sitten'),
                    aboutOneMonth: '~1 kk sitten',
                    months: PluralForms::invariant('%s kk sitten'),
                    aboutOneYear: '~1 v sitten',
                    years: PluralForms::invariant('>%s v sitten'),
                ),
                future: new TenseVocabulary(
                    lessThanAMinute: '<1 min kuluttua',
                    oneMinute: '1 min kuluttua',
                    minutes: PluralForms::invariant('%s min kuluttua'),
                    aboutOneHour: '~1 t kuluttua',
                    hours: PluralForms::invariant('%s t kuluttua'),
                    aboutOneDay: '1 pv kuluttua',
                    days: PluralForms::invariant('%s pv kuluttua'),
                    aboutOneMonth: '~1 kk kuluttua',
                    months: PluralForms::invariant('%s kk kuluttua'),
                    aboutOneYear: '~1 v kuluttua',
                    years: PluralForms::invariant('>%s v kuluttua'),
                ),
                plain: new TenseVocabulary(
                    lessThanAMinute: '<1 min',
                    oneMinute: '1 min',
                    minutes: PluralForms::invariant('%s min'),
                    aboutOneHour: '~1 t',
                    hours: PluralForms::invariant('%s t'),
                    aboutOneDay: '1 pv',
                    days: PluralForms::invariant('%s pv'),
                    aboutOneMonth: '~1 kk',
                    months: PluralForms::invariant('%s kk'),
                    aboutOneYear: '~1 v',
                    years: PluralForms::invariant('>%s v'),
                ),
            ),
        );
    }
}
