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
 * Korean translations.
 */
final class Ko implements Language
{
    public function vocabulary(): Vocabulary
    {
        return new Vocabulary(
            plurals: PluralRule::OtherOnly,
            full: new TenseSet(
                past: new TenseVocabulary(
                    lessThanAMinute: '방금',
                    oneMinute: '1분 전',
                    minutes: new PluralForms('%s분 전'),
                    aboutOneHour: '약 1시간 전',
                    hours: new PluralForms('%s시간 전'),
                    aboutOneDay: '하루 전',
                    days: new PluralForms('%s일 전'),
                    aboutOneMonth: '약 1개월 전',
                    months: new PluralForms('%s개월 전'),
                    aboutOneYear: '약 1년 전',
                    years: new PluralForms('%s년 이상 전'),
                ),
                future: new TenseVocabulary(
                    lessThanAMinute: '곧',
                    oneMinute: '1분 후',
                    minutes: new PluralForms('%s분 후'),
                    aboutOneHour: '약 1시간 후',
                    hours: new PluralForms('%s시간 후'),
                    aboutOneDay: '하루 후',
                    days: new PluralForms('%s일 후'),
                    aboutOneMonth: '약 1개월 후',
                    months: new PluralForms('%s개월 후'),
                    aboutOneYear: '약 1년 후',
                    years: new PluralForms('%s년 이상 후'),
                ),
                plain: new TenseVocabulary(
                    lessThanAMinute: '1분 미만',
                    oneMinute: '1분',
                    minutes: new PluralForms('%s분'),
                    aboutOneHour: '약 1시간',
                    hours: new PluralForms('%s시간'),
                    aboutOneDay: '하루',
                    days: new PluralForms('%s일'),
                    aboutOneMonth: '약 1개월',
                    months: new PluralForms('%s개월'),
                    aboutOneYear: '약 1년',
                    years: new PluralForms('%s년 이상'),
                ),
            ),
            never: '없음',
        );
    }
}
