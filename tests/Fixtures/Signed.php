<?php

declare(strict_types=1);

namespace Alexxiy\TimeIntervals\Tests\Fixtures;

use Alexxiy\TimeIntervals\Language;
use Alexxiy\TimeIntervals\PluralForms;
use Alexxiy\TimeIntervals\PluralRule;
use Alexxiy\TimeIntervals\TenseSet;
use Alexxiy\TimeIntervals\TenseVocabulary;
use Alexxiy\TimeIntervals\Vocabulary;

/**
 * A language that is not bundled with the package, kept in a step with the "Your
 * own language" section of the README so the documented example cannot quietly
 * stop compiling.
 *
 * It signs the interval instead of wording it — "-3d", "+3d", "3d" — which is
 * handy for logs and diagnostics. It also shows that the short style is optional:
 * the output is already terse, so `short` is left off and the short style serves
 * these same forms.
 */
final class Signed implements Language
{
    public function vocabulary(): Vocabulary
    {
        return new Vocabulary(
            plurals: PluralRule::OtherOnly,
            full: new TenseSet(
                past: new TenseVocabulary(
                    lessThanAMinute: '-0m',
                    oneMinute: '-1m',
                    minutes: new PluralForms('-%sm'),
                    aboutOneHour: '-1h',
                    hours: new PluralForms('-%sh'),
                    aboutOneDay: '-1d',
                    days: new PluralForms('-%sd'),
                    aboutOneMonth: '-1mo',
                    months: new PluralForms('-%smo'),
                    aboutOneYear: '-1y',
                    years: new PluralForms('-%sy'),
                ),
                future: new TenseVocabulary(
                    lessThanAMinute: '+0m',
                    oneMinute: '+1m',
                    minutes: new PluralForms('+%sm'),
                    aboutOneHour: '+1h',
                    hours: new PluralForms('+%sh'),
                    aboutOneDay: '+1d',
                    days: new PluralForms('+%sd'),
                    aboutOneMonth: '+1mo',
                    months: new PluralForms('+%smo'),
                    aboutOneYear: '+1y',
                    years: new PluralForms('+%sy'),
                ),
                plain: new TenseVocabulary(
                    lessThanAMinute: '0m',
                    oneMinute: '1m',
                    minutes: new PluralForms('%sm'),
                    aboutOneHour: '1h',
                    hours: new PluralForms('%sh'),
                    aboutOneDay: '1d',
                    days: new PluralForms('%sd'),
                    aboutOneMonth: '1mo',
                    months: new PluralForms('%smo'),
                    aboutOneYear: '1y',
                    years: new PluralForms('%sy'),
                ),
            ),
            never: '-',
        );
    }
}
