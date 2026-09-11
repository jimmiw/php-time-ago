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
 * Persian (Iran) translations.
 */
final class FaIr implements Language
{
    public function vocabulary(): Vocabulary
    {
        return new Vocabulary(
            plurals: PluralRule::ZeroOneOther,
            full: new TenseSet(
                past: new TenseVocabulary(
                    lessThanAMinute: 'کمتر از 1 دقیقه قبل',
                    oneMinute: '1 دقیقه قبل',
                    minutes: new PluralForms('%s دقیقه قبل', one: '%s دقیقه قبل'),
                    aboutOneHour: 'حدود 1 ساعت قبل',
                    hours: new PluralForms('%s ساعت قبل', one: '%s ساعت قبل'),
                    aboutOneDay: '1 روز قبل',
                    days: new PluralForms('%s روز قبل', one: '%s روز قبل'),
                    aboutOneMonth: 'حدود 1 ماه قبل',
                    months: new PluralForms('%s ماه قبل', one: '%s ماه قبل'),
                    aboutOneYear: 'حدود 1 سال قبل',
                    years: new PluralForms('بیش از %s سال قبل', one: 'بیش از %s سال قبل'),
                ),
                future: new TenseVocabulary(
                    lessThanAMinute: 'کمتر از 1 دقیقه دیگر',
                    oneMinute: '1 دقیقه دیگر',
                    minutes: new PluralForms('%s دقیقه دیگر', one: '%s دقیقه دیگر'),
                    aboutOneHour: 'حدود 1 ساعت دیگر',
                    hours: new PluralForms('%s ساعت دیگر', one: '%s ساعت دیگر'),
                    aboutOneDay: '1 روز دیگر',
                    days: new PluralForms('%s روز دیگر', one: '%s روز دیگر'),
                    aboutOneMonth: 'حدود 1 ماه دیگر',
                    months: new PluralForms('%s ماه دیگر', one: '%s ماه دیگر'),
                    aboutOneYear: 'حدود 1 سال دیگر',
                    years: new PluralForms('بیش از %s سال دیگر', one: 'بیش از %s سال دیگر'),
                ),
                plain: new TenseVocabulary(
                    lessThanAMinute: 'کمتر از 1 دقیقه',
                    oneMinute: '1 دقیقه',
                    minutes: new PluralForms('%s دقیقه', one: '%s دقیقه'),
                    aboutOneHour: 'حدود 1 ساعت',
                    hours: new PluralForms('%s ساعت', one: '%s ساعت'),
                    aboutOneDay: '1 روز',
                    days: new PluralForms('%s روز', one: '%s روز'),
                    aboutOneMonth: 'حدود 1 ماه',
                    months: new PluralForms('%s ماه', one: '%s ماه'),
                    aboutOneYear: 'حدود 1 سال',
                    years: new PluralForms('بیش از %s سال', one: 'بیش از %s سال'),
                ),
            ),
            never: 'هرگز',
        );
    }
}
