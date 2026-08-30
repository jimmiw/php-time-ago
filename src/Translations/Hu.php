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
 * Hungarian translations.
 */
final class Hu implements Language
{
    public function vocabulary(): Vocabulary
    {
        return new Vocabulary(
            plurals: PluralRule::OneOther,
            full: new TenseSet(
                past: new TenseVocabulary(
                    lessThanAMinute: 'kevesebb, mint egy perce',
                    oneMinute: '1 perce',
                    minutes: new PluralForms('%s perce', one: '%s perce'),
                    aboutOneHour: 'körülbelül 1 órája',
                    hours: new PluralForms('%s órája', one: '%s órája'),
                    aboutOneDay: '1 napja',
                    days: new PluralForms('%s napja', one: '%s napja'),
                    aboutOneMonth: 'körülbelül 1 hónapja',
                    months: new PluralForms('%s hónapja', one: '%s hónapja'),
                    aboutOneYear: 'körülbelül 1 éve',
                    years: new PluralForms('több, mint %s éve', one: 'több, mint %s éve'),
                ),
                future: new TenseVocabulary(
                    lessThanAMinute: 'kevesebb, mint egy perc múlva',
                    oneMinute: '1 perc múlva',
                    minutes: new PluralForms('%s perc múlva', one: '%s perc múlva'),
                    aboutOneHour: 'körülbelül 1 óra múlva',
                    hours: new PluralForms('%s óra múlva', one: '%s óra múlva'),
                    aboutOneDay: '1 nap múlva',
                    days: new PluralForms('%s nap múlva', one: '%s nap múlva'),
                    aboutOneMonth: 'körülbelül 1 hónap múlva',
                    months: new PluralForms('%s hónap múlva', one: '%s hónap múlva'),
                    aboutOneYear: 'körülbelül 1 év múlva',
                    years: new PluralForms('több, mint %s év múlva', one: 'több, mint %s év múlva'),
                ),
                plain: new TenseVocabulary(
                    lessThanAMinute: 'kevesebb, mint egy perc',
                    oneMinute: '1 perc',
                    minutes: new PluralForms('%s perc', one: '%s perc'),
                    aboutOneHour: 'körülbelül 1 óra',
                    hours: new PluralForms('%s óra', one: '%s óra'),
                    aboutOneDay: '1 nap',
                    days: new PluralForms('%s nap', one: '%s nap'),
                    aboutOneMonth: 'körülbelül 1 hónap',
                    months: new PluralForms('%s hónap', one: '%s hónap'),
                    aboutOneYear: 'körülbelül 1 év',
                    years: new PluralForms('több, mint %s év', one: 'több, mint %s év'),
                ),
            ),
            never: 'Soha',
        );
    }
}
