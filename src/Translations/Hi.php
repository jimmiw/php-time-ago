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
 * Hindi translations.
 */
final class Hi implements Language
{
    public function vocabulary(): Vocabulary
    {
        return new Vocabulary(
            plurals: PluralRule::ZeroOneOther,
            full: new TenseSet(
                past: new TenseVocabulary(
                    lessThanAMinute: 'एक मिनट से भी कम पहले',
                    oneMinute: '1 मिनट पहले',
                    minutes: new PluralForms('%s मिनट पहले', one: '%s मिनट पहले'),
                    aboutOneHour: 'लगभग 1 घंटे पहले',
                    hours: new PluralForms('%s घंटे पहले', one: '%s घंटे पहले'),
                    aboutOneDay: '1 दिन पहले',
                    days: new PluralForms('%s दिन पहले', one: '%s दिन पहले'),
                    aboutOneMonth: 'लगभग 1 महीने पहले',
                    months: new PluralForms('%s महीने पहले', one: '%s महीने पहले'),
                    aboutOneYear: 'लगभग 1 साल पहले',
                    years: new PluralForms('%s साल से ज़्यादा पहले', one: '%s साल से ज़्यादा पहले'),
                ),
                future: new TenseVocabulary(
                    lessThanAMinute: 'एक मिनट से भी कम में',
                    oneMinute: '1 मिनट में',
                    minutes: new PluralForms('%s मिनट में', one: '%s मिनट में'),
                    aboutOneHour: 'लगभग 1 घंटे में',
                    hours: new PluralForms('%s घंटे में', one: '%s घंटे में'),
                    aboutOneDay: '1 दिन में',
                    days: new PluralForms('%s दिन में', one: '%s दिन में'),
                    aboutOneMonth: 'लगभग 1 महीने में',
                    months: new PluralForms('%s महीने में', one: '%s महीने में'),
                    aboutOneYear: 'लगभग 1 साल में',
                    years: new PluralForms('%s साल से ज़्यादा में', one: '%s साल से ज़्यादा में'),
                ),
                plain: new TenseVocabulary(
                    lessThanAMinute: 'एक मिनट से भी कम',
                    oneMinute: '1 मिनट',
                    minutes: new PluralForms('%s मिनट', one: '%s मिनट'),
                    aboutOneHour: 'लगभग 1 घंटा',
                    hours: new PluralForms('%s घंटे', one: '%s घंटे'),
                    aboutOneDay: '1 दिन',
                    days: new PluralForms('%s दिन', one: '%s दिन'),
                    aboutOneMonth: 'लगभग 1 महीना',
                    months: new PluralForms('%s महीने', one: '%s महीने'),
                    aboutOneYear: 'लगभग 1 साल',
                    years: new PluralForms('%s साल से ज़्यादा', one: '%s साल से ज़्यादा'),
                ),
            ),
            never: 'कभी नहीं',
        );
    }
}
