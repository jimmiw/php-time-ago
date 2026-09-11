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
 * Indonesian translations.
 */
final class Id implements Language
{
    public function vocabulary(): Vocabulary
    {
        return new Vocabulary(
            plurals: PluralRule::OtherOnly,
            full: new TenseSet(
                past: new TenseVocabulary(
                    lessThanAMinute: 'kurang dari semenit yang lalu',
                    oneMinute: '1 menit yang lalu',
                    minutes: new PluralForms('%s menit yang lalu'),
                    aboutOneHour: 'sekitar 1 jam yang lalu',
                    hours: new PluralForms('%s jam yang lalu'),
                    aboutOneDay: '1 hari yang lalu',
                    days: new PluralForms('%s hari yang lalu'),
                    aboutOneMonth: 'sekitar 1 bulan yang lalu',
                    months: new PluralForms('%s bulan yang lalu'),
                    aboutOneYear: 'sekitar 1 tahun yang lalu',
                    years: new PluralForms('lebih dari %s tahun yang lalu'),
                ),
                future: new TenseVocabulary(
                    lessThanAMinute: 'kurang dari semenit lagi',
                    oneMinute: '1 menit lagi',
                    minutes: new PluralForms('%s menit lagi'),
                    aboutOneHour: 'sekitar 1 jam lagi',
                    hours: new PluralForms('%s jam lagi'),
                    aboutOneDay: '1 hari lagi',
                    days: new PluralForms('%s hari lagi'),
                    aboutOneMonth: 'sekitar 1 bulan lagi',
                    months: new PluralForms('%s bulan lagi'),
                    aboutOneYear: 'sekitar 1 tahun lagi',
                    years: new PluralForms('lebih dari %s tahun lagi'),
                ),
                plain: new TenseVocabulary(
                    lessThanAMinute: 'kurang dari semenit',
                    oneMinute: '1 menit',
                    minutes: new PluralForms('%s menit'),
                    aboutOneHour: 'sekitar 1 jam',
                    hours: new PluralForms('%s jam'),
                    aboutOneDay: '1 hari',
                    days: new PluralForms('%s hari'),
                    aboutOneMonth: 'sekitar 1 bulan',
                    months: new PluralForms('%s bulan'),
                    aboutOneYear: 'sekitar 1 tahun',
                    years: new PluralForms('lebih dari %s tahun'),
                ),
            ),
            never: 'Tidak pernah',
            short: new TenseSet(
                past: new TenseVocabulary(
                    lessThanAMinute: '<1 mnt lalu',
                    oneMinute: '1 mnt lalu',
                    minutes: PluralForms::invariant('%s mnt lalu'),
                    aboutOneHour: '~1 jam lalu',
                    hours: PluralForms::invariant('%s jam lalu'),
                    aboutOneDay: '1 hr lalu',
                    days: PluralForms::invariant('%s hr lalu'),
                    aboutOneMonth: '~1 bln lalu',
                    months: PluralForms::invariant('%s bln lalu'),
                    aboutOneYear: '~1 thn lalu',
                    years: PluralForms::invariant('>%s thn lalu'),
                ),
                future: new TenseVocabulary(
                    lessThanAMinute: '<1 mnt lagi',
                    oneMinute: '1 mnt lagi',
                    minutes: PluralForms::invariant('%s mnt lagi'),
                    aboutOneHour: '~1 jam lagi',
                    hours: PluralForms::invariant('%s jam lagi'),
                    aboutOneDay: '1 hr lagi',
                    days: PluralForms::invariant('%s hr lagi'),
                    aboutOneMonth: '~1 bln lagi',
                    months: PluralForms::invariant('%s bln lagi'),
                    aboutOneYear: '~1 thn lagi',
                    years: PluralForms::invariant('>%s thn lagi'),
                ),
                plain: new TenseVocabulary(
                    lessThanAMinute: '<1 mnt',
                    oneMinute: '1 mnt',
                    minutes: PluralForms::invariant('%s mnt'),
                    aboutOneHour: '~1 jam',
                    hours: PluralForms::invariant('%s jam'),
                    aboutOneDay: '1 hr',
                    days: PluralForms::invariant('%s hr'),
                    aboutOneMonth: '~1 bln',
                    months: PluralForms::invariant('%s bln'),
                    aboutOneYear: '~1 thn',
                    years: PluralForms::invariant('>%s thn'),
                ),
            ),
        );
    }
}
