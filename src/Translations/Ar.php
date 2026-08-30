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
 * Arabic translations.
 */
final class Ar implements Language
{
    public function vocabulary(): Vocabulary
    {
        return new Vocabulary(
            plurals: PluralRule::Arabic,
            full: new TenseSet(
                past: new TenseVocabulary(
                    lessThanAMinute: 'منذ أقل من دقيقة',
                    oneMinute: 'منذ دقيقة',
                    minutes: new PluralForms(
                        other: 'منذ %s دقيقة',
                        one: 'منذ %s دقيقة',
                        two: 'منذ دقيقتين',
                        few: 'منذ %s دقائق',
                        many: 'منذ %s دقيقة',
                    ),
                    aboutOneHour: 'منذ ساعة تقريبًا',
                    hours: new PluralForms(
                        other: 'منذ %s ساعة',
                        one: 'منذ %s ساعة',
                        two: 'منذ ساعتين',
                        few: 'منذ %s ساعات',
                        many: 'منذ %s ساعة',
                    ),
                    aboutOneDay: 'منذ يوم',
                    days: new PluralForms(
                        other: 'منذ %s يوم',
                        one: 'منذ %s يوم',
                        two: 'منذ يومين',
                        few: 'منذ %s أيام',
                        many: 'منذ %s يومًا',
                    ),
                    aboutOneMonth: 'منذ شهر تقريبًا',
                    months: new PluralForms(
                        other: 'منذ %s شهر',
                        one: 'منذ %s شهر',
                        two: 'منذ شهرين',
                        few: 'منذ %s أشهر',
                        many: 'منذ %s شهرًا',
                    ),
                    aboutOneYear: 'منذ سنة تقريبًا',
                    years: new PluralForms(
                        other: 'منذ أكثر من %s سنة',
                        one: 'منذ أكثر من %s سنة',
                        two: 'منذ أكثر من سنتين',
                        few: 'منذ أكثر من %s سنوات',
                        many: 'منذ أكثر من %s سنة',
                    ),
                ),
                future: new TenseVocabulary(
                    lessThanAMinute: 'بعد أقل من دقيقة',
                    oneMinute: 'بعد دقيقة',
                    minutes: new PluralForms(
                        other: 'بعد %s دقيقة',
                        one: 'بعد %s دقيقة',
                        two: 'بعد دقيقتين',
                        few: 'بعد %s دقائق',
                        many: 'بعد %s دقيقة',
                    ),
                    aboutOneHour: 'بعد ساعة تقريبًا',
                    hours: new PluralForms(
                        other: 'بعد %s ساعة',
                        one: 'بعد %s ساعة',
                        two: 'بعد ساعتين',
                        few: 'بعد %s ساعات',
                        many: 'بعد %s ساعة',
                    ),
                    aboutOneDay: 'بعد يوم',
                    days: new PluralForms(
                        other: 'بعد %s يوم',
                        one: 'بعد %s يوم',
                        two: 'بعد يومين',
                        few: 'بعد %s أيام',
                        many: 'بعد %s يومًا',
                    ),
                    aboutOneMonth: 'بعد شهر تقريبًا',
                    months: new PluralForms(
                        other: 'بعد %s شهر',
                        one: 'بعد %s شهر',
                        two: 'بعد شهرين',
                        few: 'بعد %s أشهر',
                        many: 'بعد %s شهرًا',
                    ),
                    aboutOneYear: 'بعد سنة تقريبًا',
                    years: new PluralForms(
                        other: 'بعد أكثر من %s سنة',
                        one: 'بعد أكثر من %s سنة',
                        two: 'بعد أكثر من سنتين',
                        few: 'بعد أكثر من %s سنوات',
                        many: 'بعد أكثر من %s سنة',
                    ),
                ),
                plain: new TenseVocabulary(
                    lessThanAMinute: 'أقل من دقيقة',
                    oneMinute: 'دقيقة',
                    minutes: new PluralForms(
                        other: '%s دقيقة',
                        one: '%s دقيقة',
                        two: 'دقيقتان',
                        few: '%s دقائق',
                        many: '%s دقيقة',
                    ),
                    aboutOneHour: 'ساعة تقريبًا',
                    hours: new PluralForms('%s ساعة', one: '%s ساعة', two: 'ساعتان', few: '%s ساعات', many: '%s ساعة'),
                    aboutOneDay: 'يوم',
                    days: new PluralForms('%s يوم', one: '%s يوم', two: 'يومان', few: '%s أيام', many: '%s يومًا'),
                    aboutOneMonth: 'شهر تقريبًا',
                    months: new PluralForms('%s شهر', one: '%s شهر', two: 'شهران', few: '%s أشهر', many: '%s شهرًا'),
                    aboutOneYear: 'سنة تقريبًا',
                    years: new PluralForms(
                        other: 'أكثر من %s سنة',
                        one: 'أكثر من %s سنة',
                        two: 'أكثر من سنتين',
                        few: 'أكثر من %s سنوات',
                        many: 'أكثر من %s سنة',
                    ),
                ),
            ),
            never: 'أبداً',
        );
    }
}
