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
 * Thai translations.
 */
final class Th implements Language
{
    public function vocabulary(): Vocabulary
    {
        return new Vocabulary(
            plurals: PluralRule::OtherOnly,
            full: new TenseSet(
                past: new TenseVocabulary(
                    lessThanAMinute: 'ไม่ถึง 1 นาทีที่แล้ว',
                    oneMinute: '1 นาทีที่แล้ว',
                    minutes: new PluralForms('%s นาทีที่แล้ว'),
                    aboutOneHour: 'ประมาณ 1 ชั่วโมงที่แล้ว',
                    hours: new PluralForms('%s ชั่วโมงที่แล้ว'),
                    aboutOneDay: '1 วันที่แล้ว',
                    days: new PluralForms('%s วันที่แล้ว'),
                    aboutOneMonth: 'ประมาณ 1 เดือนที่แล้ว',
                    months: new PluralForms('%s เดือนที่แล้ว'),
                    aboutOneYear: 'ประมาณ 1 ปีที่แล้ว',
                    years: new PluralForms('เกิน %s ปีที่แล้ว'),
                ),
                future: new TenseVocabulary(
                    lessThanAMinute: 'ในอีกไม่ถึง 1 นาที',
                    oneMinute: 'ในอีก 1 นาที',
                    minutes: new PluralForms('ในอีก %s นาที'),
                    aboutOneHour: 'ในอีกประมาณ 1 ชั่วโมง',
                    hours: new PluralForms('ในอีก %s ชั่วโมง'),
                    aboutOneDay: 'ในอีก 1 วัน',
                    days: new PluralForms('ในอีก %s วัน'),
                    aboutOneMonth: 'ในอีกประมาณ 1 เดือน',
                    months: new PluralForms('ในอีก %s เดือน'),
                    aboutOneYear: 'ในอีกประมาณ 1 ปี',
                    years: new PluralForms('ในอีกเกิน %s ปี'),
                ),
                plain: new TenseVocabulary(
                    lessThanAMinute: 'ไม่ถึง 1 นาที',
                    oneMinute: '1 นาที',
                    minutes: new PluralForms('%s นาที'),
                    aboutOneHour: 'ประมาณ 1 ชั่วโมง',
                    hours: new PluralForms('%s ชั่วโมง'),
                    aboutOneDay: '1 วัน',
                    days: new PluralForms('%s วัน'),
                    aboutOneMonth: 'ประมาณ 1 เดือน',
                    months: new PluralForms('%s เดือน'),
                    aboutOneYear: 'ประมาณ 1 ปี',
                    years: new PluralForms('เกิน %s ปี'),
                ),
            ),
            never: 'ไม่มีข้อมูล',
        );
    }
}
