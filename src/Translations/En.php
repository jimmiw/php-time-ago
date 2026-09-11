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
 * English translations.
 */
final class En implements Language
{
    public function vocabulary(): Vocabulary
    {
        return new Vocabulary(
            plurals: PluralRule::OneOther,
            full: new TenseSet(
                past: new TenseVocabulary(
                    lessThanAMinute: 'less than a minute ago',
                    oneMinute: '1 minute ago',
                    minutes: new PluralForms('%s minutes ago', one: '%s minute ago'),
                    aboutOneHour: 'about 1 hour ago',
                    hours: new PluralForms('%s hours ago', one: '%s hour ago'),
                    aboutOneDay: '1 day ago',
                    days: new PluralForms('%s days ago', one: '%s day ago'),
                    aboutOneMonth: 'about 1 month ago',
                    months: new PluralForms('%s months ago', one: '%s month ago'),
                    aboutOneYear: 'about 1 year ago',
                    years: new PluralForms('over %s years ago', one: 'over %s year ago'),
                ),
                future: new TenseVocabulary(
                    lessThanAMinute: 'in less than a minute',
                    oneMinute: 'in 1 minute',
                    minutes: new PluralForms('in %s minutes', one: 'in %s minute'),
                    aboutOneHour: 'in about 1 hour',
                    hours: new PluralForms('in %s hours', one: 'in %s hour'),
                    aboutOneDay: 'in 1 day',
                    days: new PluralForms('in %s days', one: 'in %s day'),
                    aboutOneMonth: 'in about 1 month',
                    months: new PluralForms('in %s months', one: 'in %s month'),
                    aboutOneYear: 'in about 1 year',
                    years: new PluralForms('in over %s years', one: 'in over %s year'),
                ),
                plain: new TenseVocabulary(
                    lessThanAMinute: 'less than a minute',
                    oneMinute: '1 minute',
                    minutes: new PluralForms('%s minutes', one: '%s minute'),
                    aboutOneHour: 'about 1 hour',
                    hours: new PluralForms('%s hours', one: '%s hour'),
                    aboutOneDay: '1 day',
                    days: new PluralForms('%s days', one: '%s day'),
                    aboutOneMonth: 'about 1 month',
                    months: new PluralForms('%s months', one: '%s month'),
                    aboutOneYear: 'about 1 year',
                    years: new PluralForms('over %s years', one: 'over %s year'),
                ),
            ),
            never: 'Never',
            short: new TenseSet(
                past: new TenseVocabulary(
                    lessThanAMinute: '<1m ago',
                    oneMinute: '1m ago',
                    minutes: PluralForms::invariant('%sm ago'),
                    aboutOneHour: '~1h ago',
                    hours: PluralForms::invariant('%sh ago'),
                    aboutOneDay: '1d ago',
                    days: PluralForms::invariant('%sd ago'),
                    aboutOneMonth: '~1mo ago',
                    months: PluralForms::invariant('%smo ago'),
                    aboutOneYear: '~1y ago',
                    years: PluralForms::invariant('>%sy ago'),
                ),
                future: new TenseVocabulary(
                    lessThanAMinute: 'in <1m',
                    oneMinute: 'in 1m',
                    minutes: PluralForms::invariant('in %sm'),
                    aboutOneHour: 'in ~1h',
                    hours: PluralForms::invariant('in %sh'),
                    aboutOneDay: 'in 1d',
                    days: PluralForms::invariant('in %sd'),
                    aboutOneMonth: 'in ~1mo',
                    months: PluralForms::invariant('in %smo'),
                    aboutOneYear: 'in ~1y',
                    years: PluralForms::invariant('in >%sy'),
                ),
                plain: new TenseVocabulary(
                    lessThanAMinute: '<1m',
                    oneMinute: '1m',
                    minutes: PluralForms::invariant('%sm'),
                    aboutOneHour: '~1h',
                    hours: PluralForms::invariant('%sh'),
                    aboutOneDay: '1d',
                    days: PluralForms::invariant('%sd'),
                    aboutOneMonth: '~1mo',
                    months: PluralForms::invariant('%smo'),
                    aboutOneYear: '~1y',
                    years: PluralForms::invariant('>%sy'),
                ),
            ),
        );
    }
}
