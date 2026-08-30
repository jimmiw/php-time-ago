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
 * Italian translations.
 */
final class It implements Language
{
    public function vocabulary(): Vocabulary
    {
        return new Vocabulary(
            plurals: PluralRule::OneOther,
            full: new TenseSet(
                past: new TenseVocabulary(
                    lessThanAMinute: 'meno di un minuto fa',
                    oneMinute: '1 minuto fa',
                    minutes: new PluralForms('%s minuti fa', one: '%s minuto fa'),
                    aboutOneHour: 'circa 1 ora fa',
                    hours: new PluralForms('%s ore fa', one: '%s ora fa'),
                    aboutOneDay: '1 giorno fa',
                    days: new PluralForms('%s giorni fa', one: '%s giorno fa'),
                    aboutOneMonth: 'circa 1 mese fa',
                    months: new PluralForms('%s mesi fa', one: '%s mese fa'),
                    aboutOneYear: 'circa 1 anno fa',
                    years: new PluralForms('più di %s anni fa', one: 'più di %s anno fa'),
                ),
                future: new TenseVocabulary(
                    lessThanAMinute: 'tra meno di un minuto',
                    oneMinute: 'tra 1 minuto',
                    minutes: new PluralForms('tra %s minuti', one: 'tra %s minuto'),
                    aboutOneHour: 'tra circa 1 ora',
                    hours: new PluralForms('tra %s ore', one: 'tra %s ora'),
                    aboutOneDay: 'tra 1 giorno',
                    days: new PluralForms('tra %s giorni', one: 'tra %s giorno'),
                    aboutOneMonth: 'tra circa 1 mese',
                    months: new PluralForms('tra %s mesi', one: 'tra %s mese'),
                    aboutOneYear: 'tra circa 1 anno',
                    years: new PluralForms('tra più di %s anni', one: 'tra più di %s anno'),
                ),
                plain: new TenseVocabulary(
                    lessThanAMinute: 'meno di un minuto',
                    oneMinute: '1 minuto',
                    minutes: new PluralForms('%s minuti', one: '%s minuto'),
                    aboutOneHour: 'circa 1 ora',
                    hours: new PluralForms('%s ore', one: '%s ora'),
                    aboutOneDay: '1 giorno',
                    days: new PluralForms('%s giorni', one: '%s giorno'),
                    aboutOneMonth: 'circa 1 mese',
                    months: new PluralForms('%s mesi', one: '%s mese'),
                    aboutOneYear: 'circa 1 anno',
                    years: new PluralForms('più di %s anni', one: 'più di %s anno'),
                ),
            ),
            never: 'Mai',
            short: new TenseSet(
                past: new TenseVocabulary(
                    lessThanAMinute: '<1 min fa',
                    oneMinute: '1 min fa',
                    minutes: PluralForms::invariant('%s min fa'),
                    aboutOneHour: '~1 h fa',
                    hours: PluralForms::invariant('%s h fa'),
                    aboutOneDay: '1 g fa',
                    days: PluralForms::invariant('%s g fa'),
                    aboutOneMonth: '~1 mese fa',
                    months: PluralForms::invariant('%s mesi fa'),
                    aboutOneYear: '~1 anno fa',
                    years: PluralForms::invariant('>%s anni fa'),
                ),
                future: new TenseVocabulary(
                    lessThanAMinute: 'tra <1 min',
                    oneMinute: 'tra 1 min',
                    minutes: PluralForms::invariant('tra %s min'),
                    aboutOneHour: 'tra ~1 h',
                    hours: PluralForms::invariant('tra %s h'),
                    aboutOneDay: 'tra 1 g',
                    days: PluralForms::invariant('tra %s g'),
                    aboutOneMonth: 'tra ~1 mese',
                    months: PluralForms::invariant('tra %s mesi'),
                    aboutOneYear: 'tra ~1 anno',
                    years: PluralForms::invariant('tra >%s anni'),
                ),
                plain: new TenseVocabulary(
                    lessThanAMinute: '<1 min',
                    oneMinute: '1 min',
                    minutes: PluralForms::invariant('%s min'),
                    aboutOneHour: '~1 h',
                    hours: PluralForms::invariant('%s h'),
                    aboutOneDay: '1 g',
                    days: PluralForms::invariant('%s g'),
                    aboutOneMonth: '~1 mese',
                    months: PluralForms::invariant('%s mesi'),
                    aboutOneYear: '~1 anno',
                    years: PluralForms::invariant('>%s anni'),
                ),
            ),
        );
    }
}
