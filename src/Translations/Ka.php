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
 * Georgian translations.
 */
final class Ka implements Language
{
    public function vocabulary(): Vocabulary
    {
        return new Vocabulary(
            plurals: PluralRule::OneOther,
            full: new TenseSet(
                past: new TenseVocabulary(
                    lessThanAMinute: 'წუთზე ნაკლები ხნის წინ',
                    oneMinute: '1 წუთის წინ',
                    minutes: new PluralForms('%s წუთის წინ', one: '%s წუთის წინ'),
                    aboutOneHour: 'დაახლოებით 1 საათის წინ',
                    hours: new PluralForms('%s საათის წინ', one: '%s საათის წინ'),
                    aboutOneDay: '1 დღის წინ',
                    days: new PluralForms('%s დღის წინ', one: '%s დღის წინ'),
                    aboutOneMonth: 'დაახლოებით 1 თვის წინ',
                    months: new PluralForms('%s თვის წინ', one: '%s თვის წინ'),
                    aboutOneYear: 'დაახლოებით 1 წლის წინ',
                    years: new PluralForms('%s წელზე მეტი ხნის წინ', one: '%s წელზე მეტი ხნის წინ'),
                ),
                future: new TenseVocabulary(
                    lessThanAMinute: 'წუთზე ნაკლებში',
                    oneMinute: '1 წუთში',
                    minutes: new PluralForms('%s წუთში', one: '%s წუთში'),
                    aboutOneHour: 'დაახლოებით 1 საათში',
                    hours: new PluralForms('%s საათში', one: '%s საათში'),
                    aboutOneDay: '1 დღეში',
                    days: new PluralForms('%s დღეში', one: '%s დღეში'),
                    aboutOneMonth: 'დაახლოებით 1 თვეში',
                    months: new PluralForms('%s თვეში', one: '%s თვეში'),
                    aboutOneYear: 'დაახლოებით 1 წელიწადში',
                    years: new PluralForms('%s წელზე მეტში', one: '%s წელზე მეტში'),
                ),
                plain: new TenseVocabulary(
                    lessThanAMinute: 'წუთზე ნაკლები',
                    oneMinute: '1 წუთი',
                    minutes: new PluralForms('%s წუთი', one: '%s წუთი'),
                    aboutOneHour: 'დაახლოებით 1 საათი',
                    hours: new PluralForms('%s საათი', one: '%s საათი'),
                    aboutOneDay: '1 დღე',
                    days: new PluralForms('%s დღე', one: '%s დღე'),
                    aboutOneMonth: 'დაახლოებით 1 თვე',
                    months: new PluralForms('%s თვე', one: '%s თვე'),
                    aboutOneYear: 'დაახლოებით 1 წელი',
                    years: new PluralForms('%s წელზე მეტი', one: '%s წელზე მეტი'),
                ),
            ),
            never: 'არასდროს',
        );
    }
}
