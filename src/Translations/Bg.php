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
 * Bulgarian translations.
 */
final class Bg implements Language
{
    public function vocabulary(): Vocabulary
    {
        return new Vocabulary(
            plurals: PluralRule::OneOther,
            full: new TenseSet(
                past: new TenseVocabulary(
                    lessThanAMinute: 'преди по-малко от минута',
                    oneMinute: 'преди минута',
                    minutes: new PluralForms('преди %s минути', one: 'преди %s минута'),
                    aboutOneHour: 'преди около час',
                    hours: new PluralForms('преди %s часа', one: 'преди %s час'),
                    aboutOneDay: 'преди един ден',
                    days: new PluralForms('преди %s дни', one: 'преди %s ден'),
                    aboutOneMonth: 'преди около месец',
                    months: new PluralForms('преди %s месеца', one: 'преди %s месец'),
                    aboutOneYear: 'преди около една година',
                    years: new PluralForms('преди повече от %s години', one: 'преди повече от %s година'),
                ),
                future: new TenseVocabulary(
                    lessThanAMinute: 'след по-малко от минута',
                    oneMinute: 'след минута',
                    minutes: new PluralForms('след %s минути', one: 'след %s минута'),
                    aboutOneHour: 'след около час',
                    hours: new PluralForms('след %s часа', one: 'след %s час'),
                    aboutOneDay: 'след един ден',
                    days: new PluralForms('след %s дни', one: 'след %s ден'),
                    aboutOneMonth: 'след около месец',
                    months: new PluralForms('след %s месеца', one: 'след %s месец'),
                    aboutOneYear: 'след около една година',
                    years: new PluralForms('след повече от %s години', one: 'след повече от %s година'),
                ),
                plain: new TenseVocabulary(
                    lessThanAMinute: 'по-малко от минута',
                    oneMinute: 'една минута',
                    minutes: new PluralForms('%s минути', one: '%s минута'),
                    aboutOneHour: 'около час',
                    hours: new PluralForms('%s часа', one: '%s час'),
                    aboutOneDay: 'един ден',
                    days: new PluralForms('%s дни', one: '%s ден'),
                    aboutOneMonth: 'около месец',
                    months: new PluralForms('%s месеца', one: '%s месец'),
                    aboutOneYear: 'около една година',
                    years: new PluralForms('повече от %s години', one: 'повече от %s година'),
                ),
            ),
            never: 'Никога',
            short: new TenseSet(
                past: new TenseVocabulary(
                    lessThanAMinute: 'преди <1 мин',
                    oneMinute: 'преди 1 мин',
                    minutes: PluralForms::invariant('преди %s мин'),
                    aboutOneHour: 'преди ~1 ч',
                    hours: PluralForms::invariant('преди %s ч'),
                    aboutOneDay: 'преди 1 д',
                    days: PluralForms::invariant('преди %s д'),
                    aboutOneMonth: 'преди ~1 мес',
                    months: PluralForms::invariant('преди %s мес'),
                    aboutOneYear: 'преди ~1 г',
                    years: PluralForms::invariant('преди >%s г'),
                ),
                future: new TenseVocabulary(
                    lessThanAMinute: 'след <1 мин',
                    oneMinute: 'след 1 мин',
                    minutes: PluralForms::invariant('след %s мин'),
                    aboutOneHour: 'след ~1 ч',
                    hours: PluralForms::invariant('след %s ч'),
                    aboutOneDay: 'след 1 д',
                    days: PluralForms::invariant('след %s д'),
                    aboutOneMonth: 'след ~1 мес',
                    months: PluralForms::invariant('след %s мес'),
                    aboutOneYear: 'след ~1 г',
                    years: PluralForms::invariant('след >%s г'),
                ),
                plain: new TenseVocabulary(
                    lessThanAMinute: '<1 мин',
                    oneMinute: '1 мин',
                    minutes: PluralForms::invariant('%s мин'),
                    aboutOneHour: '~1 ч',
                    hours: PluralForms::invariant('%s ч'),
                    aboutOneDay: '1 д',
                    days: PluralForms::invariant('%s д'),
                    aboutOneMonth: '~1 мес',
                    months: PluralForms::invariant('%s мес'),
                    aboutOneYear: '~1 г',
                    years: PluralForms::invariant('>%s г'),
                ),
            ),
        );
    }
}
