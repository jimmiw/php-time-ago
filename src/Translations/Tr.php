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
 * Turkish translations.
 */
final class Tr implements Language
{
    public function vocabulary(): Vocabulary
    {
        return new Vocabulary(
            plurals: PluralRule::OneOther,
            full: new TenseSet(
                past: new TenseVocabulary(
                    lessThanAMinute: 'az önce',
                    oneMinute: '1 dakika önce',
                    minutes: new PluralForms('%s dakika önce', one: '%s dakika önce'),
                    aboutOneHour: 'yaklaşık 1 saat önce',
                    hours: new PluralForms('%s saat önce', one: '%s saat önce'),
                    aboutOneDay: '1 gün önce',
                    days: new PluralForms('%s gün önce', one: '%s gün önce'),
                    aboutOneMonth: 'yaklaşık 1 ay önce',
                    months: new PluralForms('%s ay önce', one: '%s ay önce'),
                    aboutOneYear: 'yaklaşık 1 yıl önce',
                    years: new PluralForms('%s yıldan fazla önce', one: '%s yıldan fazla önce'),
                ),
                future: new TenseVocabulary(
                    lessThanAMinute: 'birazdan',
                    oneMinute: '1 dakika sonra',
                    minutes: new PluralForms('%s dakika sonra', one: '%s dakika sonra'),
                    aboutOneHour: 'yaklaşık 1 saat sonra',
                    hours: new PluralForms('%s saat sonra', one: '%s saat sonra'),
                    aboutOneDay: '1 gün sonra',
                    days: new PluralForms('%s gün sonra', one: '%s gün sonra'),
                    aboutOneMonth: 'yaklaşık 1 ay sonra',
                    months: new PluralForms('%s ay sonra', one: '%s ay sonra'),
                    aboutOneYear: 'yaklaşık 1 yıl sonra',
                    years: new PluralForms('%s yıldan fazla sonra', one: '%s yıldan fazla sonra'),
                ),
                plain: new TenseVocabulary(
                    lessThanAMinute: '1 dakikadan az',
                    oneMinute: '1 dakika',
                    minutes: new PluralForms('%s dakika', one: '%s dakika'),
                    aboutOneHour: 'yaklaşık 1 saat',
                    hours: new PluralForms('%s saat', one: '%s saat'),
                    aboutOneDay: '1 gün',
                    days: new PluralForms('%s gün', one: '%s gün'),
                    aboutOneMonth: 'yaklaşık 1 ay',
                    months: new PluralForms('%s ay', one: '%s ay'),
                    aboutOneYear: 'yaklaşık 1 yıl',
                    years: new PluralForms('%s yıldan fazla', one: '%s yıldan fazla'),
                ),
            ),
            never: 'Asla',
            short: new TenseSet(
                past: new TenseVocabulary(
                    lessThanAMinute: '<1 dk önce',
                    oneMinute: '1 dk önce',
                    minutes: PluralForms::invariant('%s dk önce'),
                    aboutOneHour: '~1 sa önce',
                    hours: PluralForms::invariant('%s sa önce'),
                    aboutOneDay: '1 g önce',
                    days: PluralForms::invariant('%s g önce'),
                    aboutOneMonth: '~1 ay önce',
                    months: PluralForms::invariant('%s ay önce'),
                    aboutOneYear: '~1 y önce',
                    years: PluralForms::invariant('>%s y önce'),
                ),
                future: new TenseVocabulary(
                    lessThanAMinute: '<1 dk sonra',
                    oneMinute: '1 dk sonra',
                    minutes: PluralForms::invariant('%s dk sonra'),
                    aboutOneHour: '~1 sa sonra',
                    hours: PluralForms::invariant('%s sa sonra'),
                    aboutOneDay: '1 g sonra',
                    days: PluralForms::invariant('%s g sonra'),
                    aboutOneMonth: '~1 ay sonra',
                    months: PluralForms::invariant('%s ay sonra'),
                    aboutOneYear: '~1 y sonra',
                    years: PluralForms::invariant('>%s y sonra'),
                ),
                plain: new TenseVocabulary(
                    lessThanAMinute: '<1 dk',
                    oneMinute: '1 dk',
                    minutes: PluralForms::invariant('%s dk'),
                    aboutOneHour: '~1 sa',
                    hours: PluralForms::invariant('%s sa'),
                    aboutOneDay: '1 g',
                    days: PluralForms::invariant('%s g'),
                    aboutOneMonth: '~1 ay',
                    months: PluralForms::invariant('%s ay'),
                    aboutOneYear: '~1 y',
                    years: PluralForms::invariant('>%s y'),
                ),
            ),
        );
    }
}
