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
 * Latvian translations.
 */
final class Lv implements Language
{
    public function vocabulary(): Vocabulary
    {
        return new Vocabulary(
            plurals: PluralRule::Latvian,
            full: new TenseSet(
                past: new TenseVocabulary(
                    lessThanAMinute: 'pirms mazāk nekā minūtes',
                    oneMinute: 'pirms 1 minūtes',
                    minutes: new PluralForms('pirms %s minūtēm', zero: 'pirms %s minūtēm', one: 'pirms %s minūtes'),
                    aboutOneHour: 'apmēram pirms 1 stundas',
                    hours: new PluralForms('pirms %s stundām', zero: 'pirms %s stundām', one: 'pirms %s stundas'),
                    aboutOneDay: 'pirms 1 dienas',
                    days: new PluralForms('pirms %s dienām', zero: 'pirms %s dienām', one: 'pirms %s dienas'),
                    aboutOneMonth: 'apmēram pirms 1 mēneša',
                    months: new PluralForms('pirms %s mēnešiem', zero: 'pirms %s mēnešiem', one: 'pirms %s mēneša'),
                    aboutOneYear: 'apmēram pirms 1 gada',
                    years: new PluralForms(
                        other: 'pirms vairāk nekā %s gadiem',
                        zero: 'pirms vairāk nekā %s gadiem',
                        one: 'pirms vairāk nekā %s gada',
                    ),
                ),
                future: new TenseVocabulary(
                    lessThanAMinute: 'pēc mazāk nekā minūtes',
                    oneMinute: 'pēc 1 minūtes',
                    minutes: new PluralForms('pēc %s minūtēm', zero: 'pēc %s minūtēm', one: 'pēc %s minūtes'),
                    aboutOneHour: 'apmēram pēc 1 stundas',
                    hours: new PluralForms('pēc %s stundām', zero: 'pēc %s stundām', one: 'pēc %s stundas'),
                    aboutOneDay: 'pēc 1 dienas',
                    days: new PluralForms('pēc %s dienām', zero: 'pēc %s dienām', one: 'pēc %s dienas'),
                    aboutOneMonth: 'apmēram pēc 1 mēneša',
                    months: new PluralForms('pēc %s mēnešiem', zero: 'pēc %s mēnešiem', one: 'pēc %s mēneša'),
                    aboutOneYear: 'apmēram pēc 1 gada',
                    years: new PluralForms(
                        other: 'pēc vairāk nekā %s gadiem',
                        zero: 'pēc vairāk nekā %s gadiem',
                        one: 'pēc vairāk nekā %s gada',
                    ),
                ),
                plain: new TenseVocabulary(
                    lessThanAMinute: 'mazāk nekā minūte',
                    oneMinute: '1 minūte',
                    minutes: new PluralForms('%s minūtes', zero: '%s minūšu', one: '%s minūte'),
                    aboutOneHour: 'apmēram 1 stunda',
                    hours: new PluralForms('%s stundas', zero: '%s stundu', one: '%s stunda'),
                    aboutOneDay: '1 diena',
                    days: new PluralForms('%s dienas', zero: '%s dienu', one: '%s diena'),
                    aboutOneMonth: 'apmēram 1 mēnesis',
                    months: new PluralForms('%s mēneši', zero: '%s mēnešu', one: '%s mēnesis'),
                    aboutOneYear: 'apmēram 1 gads',
                    years: new PluralForms(
                        other: 'vairāk nekā %s gadi',
                        zero: 'vairāk nekā %s gadu',
                        one: 'vairāk nekā %s gads',
                    ),
                ),
            ),
            never: 'Nekad',
            short: new TenseSet(
                past: new TenseVocabulary(
                    lessThanAMinute: 'pirms <1 min.',
                    oneMinute: 'pirms 1 min.',
                    minutes: PluralForms::invariant('pirms %s min.'),
                    aboutOneHour: 'pirms ~1 st.',
                    hours: PluralForms::invariant('pirms %s st.'),
                    aboutOneDay: 'pirms 1 d.',
                    days: PluralForms::invariant('pirms %s d.'),
                    aboutOneMonth: 'pirms ~1 mēn.',
                    months: PluralForms::invariant('pirms %s mēn.'),
                    aboutOneYear: 'pirms ~1 g.',
                    years: PluralForms::invariant('pirms >%s g.'),
                ),
                future: new TenseVocabulary(
                    lessThanAMinute: 'pēc <1 min.',
                    oneMinute: 'pēc 1 min.',
                    minutes: PluralForms::invariant('pēc %s min.'),
                    aboutOneHour: 'pēc ~1 st.',
                    hours: PluralForms::invariant('pēc %s st.'),
                    aboutOneDay: 'pēc 1 d.',
                    days: PluralForms::invariant('pēc %s d.'),
                    aboutOneMonth: 'pēc ~1 mēn.',
                    months: PluralForms::invariant('pēc %s mēn.'),
                    aboutOneYear: 'pēc ~1 g.',
                    years: PluralForms::invariant('pēc >%s g.'),
                ),
                plain: new TenseVocabulary(
                    lessThanAMinute: '<1 min.',
                    oneMinute: '1 min.',
                    minutes: PluralForms::invariant('%s min.'),
                    aboutOneHour: '~1 st.',
                    hours: PluralForms::invariant('%s st.'),
                    aboutOneDay: '1 d.',
                    days: PluralForms::invariant('%s d.'),
                    aboutOneMonth: '~1 mēn.',
                    months: PluralForms::invariant('%s mēn.'),
                    aboutOneYear: '~1 g.',
                    years: PluralForms::invariant('>%s g.'),
                ),
            ),
        );
    }
}
