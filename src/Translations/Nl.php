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
 * Dutch translations.
 */
final class Nl implements Language
{
    public function vocabulary(): Vocabulary
    {
        return new Vocabulary(
            plurals: PluralRule::OneOther,
            full: new TenseSet(
                past: new TenseVocabulary(
                    lessThanAMinute: 'minder dan een minuut geleden',
                    oneMinute: '1 minuut geleden',
                    minutes: new PluralForms('%s minuten geleden', one: '%s minuut geleden'),
                    aboutOneHour: 'ongeveer 1 uur geleden',
                    hours: new PluralForms('%s uur geleden', one: '%s uur geleden'),
                    aboutOneDay: '1 dag geleden',
                    days: new PluralForms('%s dagen geleden', one: '%s dag geleden'),
                    aboutOneMonth: 'ongeveer 1 maand geleden',
                    months: new PluralForms('%s maanden geleden', one: '%s maand geleden'),
                    aboutOneYear: 'ongeveer 1 jaar geleden',
                    years: new PluralForms('meer dan %s jaar geleden', one: 'meer dan %s jaar geleden'),
                ),
                future: new TenseVocabulary(
                    lessThanAMinute: 'over minder dan een minuut',
                    oneMinute: 'over 1 minuut',
                    minutes: new PluralForms('over %s minuten', one: 'over %s minuut'),
                    aboutOneHour: 'over ongeveer 1 uur',
                    hours: new PluralForms('over %s uur', one: 'over %s uur'),
                    aboutOneDay: 'over 1 dag',
                    days: new PluralForms('over %s dagen', one: 'over %s dag'),
                    aboutOneMonth: 'over ongeveer 1 maand',
                    months: new PluralForms('over %s maanden', one: 'over %s maand'),
                    aboutOneYear: 'over ongeveer 1 jaar',
                    years: new PluralForms('over meer dan %s jaar', one: 'over meer dan %s jaar'),
                ),
                plain: new TenseVocabulary(
                    lessThanAMinute: 'minder dan een minuut',
                    oneMinute: '1 minuut',
                    minutes: new PluralForms('%s minuten', one: '%s minuut'),
                    aboutOneHour: 'ongeveer 1 uur',
                    hours: new PluralForms('%s uur', one: '%s uur'),
                    aboutOneDay: '1 dag',
                    days: new PluralForms('%s dagen', one: '%s dag'),
                    aboutOneMonth: 'ongeveer 1 maand',
                    months: new PluralForms('%s maanden', one: '%s maand'),
                    aboutOneYear: 'ongeveer 1 jaar',
                    years: new PluralForms('meer dan %s jaar', one: 'meer dan %s jaar'),
                ),
            ),
            never: 'Nooit',
            short: new TenseSet(
                past: new TenseVocabulary(
                    lessThanAMinute: '<1 min geleden',
                    oneMinute: '1 min geleden',
                    minutes: PluralForms::invariant('%s min geleden'),
                    aboutOneHour: '~1 u geleden',
                    hours: PluralForms::invariant('%s u geleden'),
                    aboutOneDay: '1 d geleden',
                    days: PluralForms::invariant('%s d geleden'),
                    aboutOneMonth: '~1 mnd geleden',
                    months: PluralForms::invariant('%s mnd geleden'),
                    aboutOneYear: '~1 jr geleden',
                    years: PluralForms::invariant('>%s jr geleden'),
                ),
                future: new TenseVocabulary(
                    lessThanAMinute: 'over <1 min',
                    oneMinute: 'over 1 min',
                    minutes: PluralForms::invariant('over %s min'),
                    aboutOneHour: 'over ~1 u',
                    hours: PluralForms::invariant('over %s u'),
                    aboutOneDay: 'over 1 d',
                    days: PluralForms::invariant('over %s d'),
                    aboutOneMonth: 'over ~1 mnd',
                    months: PluralForms::invariant('over %s mnd'),
                    aboutOneYear: 'over ~1 jr',
                    years: PluralForms::invariant('over >%s jr'),
                ),
                plain: new TenseVocabulary(
                    lessThanAMinute: '<1 min',
                    oneMinute: '1 min',
                    minutes: PluralForms::invariant('%s min'),
                    aboutOneHour: '~1 u',
                    hours: PluralForms::invariant('%s u'),
                    aboutOneDay: '1 d',
                    days: PluralForms::invariant('%s d'),
                    aboutOneMonth: '~1 mnd',
                    months: PluralForms::invariant('%s mnd'),
                    aboutOneYear: '~1 jr',
                    years: PluralForms::invariant('>%s jr'),
                ),
            ),
        );
    }
}
