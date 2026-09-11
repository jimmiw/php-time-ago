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
 * Swedish (Sweden) translations.
 */
final class SvSe implements Language
{
    public function vocabulary(): Vocabulary
    {
        return new Vocabulary(
            plurals: PluralRule::OneOther,
            full: new TenseSet(
                past: new TenseVocabulary(
                    lessThanAMinute: 'mindre än en minut sedan',
                    oneMinute: 'en minut sedan',
                    minutes: new PluralForms('%s minuter sedan', one: '%s minut sedan'),
                    aboutOneHour: 'ungefär en timme sedan',
                    hours: new PluralForms('%s timmar sedan', one: '%s timme sedan'),
                    aboutOneDay: 'en dag sedan',
                    days: new PluralForms('%s dagar sedan', one: '%s dag sedan'),
                    aboutOneMonth: 'ungefär en månad sedan',
                    months: new PluralForms('%s månader sedan', one: '%s månad sedan'),
                    aboutOneYear: 'ungefär ett år sedan',
                    years: new PluralForms('över %s år sedan', one: 'över %s år sedan'),
                ),
                future: new TenseVocabulary(
                    lessThanAMinute: 'om mindre än en minut',
                    oneMinute: 'om en minut',
                    minutes: new PluralForms('om %s minuter', one: 'om %s minut'),
                    aboutOneHour: 'om ungefär en timme',
                    hours: new PluralForms('om %s timmar', one: 'om %s timme'),
                    aboutOneDay: 'om en dag',
                    days: new PluralForms('om %s dagar', one: 'om %s dag'),
                    aboutOneMonth: 'om ungefär en månad',
                    months: new PluralForms('om %s månader', one: 'om %s månad'),
                    aboutOneYear: 'om ungefär ett år',
                    years: new PluralForms('om över %s år', one: 'om över %s år'),
                ),
                plain: new TenseVocabulary(
                    lessThanAMinute: 'mindre än en minut',
                    oneMinute: 'en minut',
                    minutes: new PluralForms('%s minuter', one: '%s minut'),
                    aboutOneHour: 'ungefär en timme',
                    hours: new PluralForms('%s timmar', one: '%s timme'),
                    aboutOneDay: 'en dag',
                    days: new PluralForms('%s dagar', one: '%s dag'),
                    aboutOneMonth: 'ungefär en månad',
                    months: new PluralForms('%s månader', one: '%s månad'),
                    aboutOneYear: 'ungefär ett år',
                    years: new PluralForms('över %s år', one: 'över %s år'),
                ),
            ),
            never: 'Aldrig',
            short: new TenseSet(
                past: new TenseVocabulary(
                    lessThanAMinute: '<1 min sedan',
                    oneMinute: '1 min sedan',
                    minutes: PluralForms::invariant('%s min sedan'),
                    aboutOneHour: '~1 tim sedan',
                    hours: PluralForms::invariant('%s tim sedan'),
                    aboutOneDay: '1 d sedan',
                    days: PluralForms::invariant('%s d sedan'),
                    aboutOneMonth: '~1 mån sedan',
                    months: PluralForms::invariant('%s mån sedan'),
                    aboutOneYear: '~1 år sedan',
                    years: PluralForms::invariant('>%s år sedan'),
                ),
                future: new TenseVocabulary(
                    lessThanAMinute: 'om <1 min',
                    oneMinute: 'om 1 min',
                    minutes: PluralForms::invariant('om %s min'),
                    aboutOneHour: 'om ~1 tim',
                    hours: PluralForms::invariant('om %s tim'),
                    aboutOneDay: 'om 1 d',
                    days: PluralForms::invariant('om %s d'),
                    aboutOneMonth: 'om ~1 mån',
                    months: PluralForms::invariant('om %s mån'),
                    aboutOneYear: 'om ~1 år',
                    years: PluralForms::invariant('om >%s år'),
                ),
                plain: new TenseVocabulary(
                    lessThanAMinute: '<1 min',
                    oneMinute: '1 min',
                    minutes: PluralForms::invariant('%s min'),
                    aboutOneHour: '~1 tim',
                    hours: PluralForms::invariant('%s tim'),
                    aboutOneDay: '1 d',
                    days: PluralForms::invariant('%s d'),
                    aboutOneMonth: '~1 mån',
                    months: PluralForms::invariant('%s mån'),
                    aboutOneYear: '~1 år',
                    years: PluralForms::invariant('>%s år'),
                ),
            ),
        );
    }
}
