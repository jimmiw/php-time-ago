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
 * Chinese (Simplified) translations.
 */
final class ZhCn implements Language
{
    public function vocabulary(): Vocabulary
    {
        return new Vocabulary(
            plurals: PluralRule::OtherOnly,
            full: new TenseSet(
                past: new TenseVocabulary(
                    lessThanAMinute: '不到 1 分钟前',
                    oneMinute: '1 分钟前',
                    minutes: new PluralForms('%s 分钟前'),
                    aboutOneHour: '大约 1 小时前',
                    hours: new PluralForms('%s 小时前'),
                    aboutOneDay: '1 天前',
                    days: new PluralForms('%s 天前'),
                    aboutOneMonth: '大约 1 个月前',
                    months: new PluralForms('%s 个月前'),
                    aboutOneYear: '大约 1 年前',
                    years: new PluralForms('超过 %s 年前'),
                ),
                future: new TenseVocabulary(
                    lessThanAMinute: '不到 1 分钟后',
                    oneMinute: '1 分钟后',
                    minutes: new PluralForms('%s 分钟后'),
                    aboutOneHour: '大约 1 小时后',
                    hours: new PluralForms('%s 小时后'),
                    aboutOneDay: '1 天后',
                    days: new PluralForms('%s 天后'),
                    aboutOneMonth: '大约 1 个月后',
                    months: new PluralForms('%s 个月后'),
                    aboutOneYear: '大约 1 年后',
                    years: new PluralForms('超过 %s 年后'),
                ),
                plain: new TenseVocabulary(
                    lessThanAMinute: '不到 1 分钟',
                    oneMinute: '1 分钟',
                    minutes: new PluralForms('%s 分钟'),
                    aboutOneHour: '大约 1 小时',
                    hours: new PluralForms('%s 小时'),
                    aboutOneDay: '1 天',
                    days: new PluralForms('%s 天'),
                    aboutOneMonth: '大约 1 个月',
                    months: new PluralForms('%s 个月'),
                    aboutOneYear: '大约 1 年',
                    years: new PluralForms('超过 %s 年'),
                ),
            ),
            never: '从未',
        );
    }
}
