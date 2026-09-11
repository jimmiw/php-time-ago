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
 * Vietnamese translations.
 */
final class Vi implements Language
{
    public function vocabulary(): Vocabulary
    {
        return new Vocabulary(
            plurals: PluralRule::OtherOnly,
            full: new TenseSet(
                past: new TenseVocabulary(
                    lessThanAMinute: 'chưa đến 1 phút trước',
                    oneMinute: '1 phút trước',
                    minutes: new PluralForms('%s phút trước'),
                    aboutOneHour: 'khoảng 1 giờ trước',
                    hours: new PluralForms('%s giờ trước'),
                    aboutOneDay: '1 ngày trước',
                    days: new PluralForms('%s ngày trước'),
                    aboutOneMonth: 'khoảng 1 tháng trước',
                    months: new PluralForms('%s tháng trước'),
                    aboutOneYear: 'khoảng 1 năm trước',
                    years: new PluralForms('hơn %s năm trước'),
                ),
                future: new TenseVocabulary(
                    lessThanAMinute: 'chưa đến 1 phút nữa',
                    oneMinute: '1 phút nữa',
                    minutes: new PluralForms('%s phút nữa'),
                    aboutOneHour: 'khoảng 1 giờ nữa',
                    hours: new PluralForms('%s giờ nữa'),
                    aboutOneDay: '1 ngày nữa',
                    days: new PluralForms('%s ngày nữa'),
                    aboutOneMonth: 'khoảng 1 tháng nữa',
                    months: new PluralForms('%s tháng nữa'),
                    aboutOneYear: 'khoảng 1 năm nữa',
                    years: new PluralForms('hơn %s năm nữa'),
                ),
                plain: new TenseVocabulary(
                    lessThanAMinute: 'chưa đến 1 phút',
                    oneMinute: '1 phút',
                    minutes: new PluralForms('%s phút'),
                    aboutOneHour: 'khoảng 1 giờ',
                    hours: new PluralForms('%s giờ'),
                    aboutOneDay: '1 ngày',
                    days: new PluralForms('%s ngày'),
                    aboutOneMonth: 'khoảng 1 tháng',
                    months: new PluralForms('%s tháng'),
                    aboutOneYear: 'khoảng 1 năm',
                    years: new PluralForms('hơn %s năm'),
                ),
            ),
            never: 'Không xác định',
        );
    }
}
