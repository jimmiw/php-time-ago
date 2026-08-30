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
 * Japanese translations.
 */
final class Ja implements Language
{
    public function vocabulary(): Vocabulary
    {
        return new Vocabulary(
            plurals: PluralRule::OtherOnly,
            full: new TenseSet(
                past: new TenseVocabulary(
                    lessThanAMinute: 'たった今',
                    oneMinute: '1分前',
                    minutes: new PluralForms('%s分前'),
                    aboutOneHour: '約1時間前',
                    hours: new PluralForms('%s時間前'),
                    aboutOneDay: '1日前',
                    days: new PluralForms('%s日前'),
                    aboutOneMonth: '約1ヶ月前',
                    months: new PluralForms('%sヶ月前'),
                    aboutOneYear: '約1年前',
                    years: new PluralForms('%s年以上前'),
                ),
                future: new TenseVocabulary(
                    lessThanAMinute: 'まもなく',
                    oneMinute: '1分後',
                    minutes: new PluralForms('%s分後'),
                    aboutOneHour: '約1時間後',
                    hours: new PluralForms('%s時間後'),
                    aboutOneDay: '1日後',
                    days: new PluralForms('%s日後'),
                    aboutOneMonth: '約1ヶ月後',
                    months: new PluralForms('%sヶ月後'),
                    aboutOneYear: '約1年後',
                    years: new PluralForms('%s年以上後'),
                ),
                plain: new TenseVocabulary(
                    lessThanAMinute: '1分未満',
                    oneMinute: '1分',
                    minutes: new PluralForms('%s分'),
                    aboutOneHour: '約1時間',
                    hours: new PluralForms('%s時間'),
                    aboutOneDay: '1日',
                    days: new PluralForms('%s日'),
                    aboutOneMonth: '約1ヶ月',
                    months: new PluralForms('%sヶ月'),
                    aboutOneYear: '約1年',
                    years: new PluralForms('%s年以上'),
                ),
            ),
            never: 'なし',
        );
    }
}
