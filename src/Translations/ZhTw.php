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
 * Chinese (Traditional) translations.
 */
final class ZhTw implements Language
{
    public function vocabulary(): Vocabulary
    {
        return new Vocabulary(
            plurals: PluralRule::OtherOnly,
            full: new TenseSet(
                past: new TenseVocabulary(
                    lessThanAMinute: '不到1分鐘前',
                    oneMinute: '1分鐘前',
                    minutes: new PluralForms('%s分鐘前'),
                    aboutOneHour: '大約1小時前',
                    hours: new PluralForms('%s小時前'),
                    aboutOneDay: '1天前',
                    days: new PluralForms('%s天前'),
                    aboutOneMonth: '大約1個月前',
                    months: new PluralForms('%s個月前'),
                    aboutOneYear: '大約1年前',
                    years: new PluralForms('超過%s年前'),
                ),
                future: new TenseVocabulary(
                    lessThanAMinute: '不到1分鐘後',
                    oneMinute: '1分鐘後',
                    minutes: new PluralForms('%s分鐘後'),
                    aboutOneHour: '大約1小時後',
                    hours: new PluralForms('%s小時後'),
                    aboutOneDay: '1天後',
                    days: new PluralForms('%s天後'),
                    aboutOneMonth: '大約1個月後',
                    months: new PluralForms('%s個月後'),
                    aboutOneYear: '大約1年後',
                    years: new PluralForms('超過%s年後'),
                ),
                plain: new TenseVocabulary(
                    lessThanAMinute: '不到1分鐘',
                    oneMinute: '1分鐘',
                    minutes: new PluralForms('%s分鐘'),
                    aboutOneHour: '大約1小時',
                    hours: new PluralForms('%s小時'),
                    aboutOneDay: '1天',
                    days: new PluralForms('%s天'),
                    aboutOneMonth: '大約1個月',
                    months: new PluralForms('%s個月'),
                    aboutOneYear: '大約1年',
                    years: new PluralForms('超過%s年'),
                ),
            ),
            never: '從未',
        );
    }
}
