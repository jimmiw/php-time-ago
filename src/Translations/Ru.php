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
 * Russian translations.
 */
final class Ru implements Language
{
    public function vocabulary(): Vocabulary
    {
        return new Vocabulary(
            plurals: PluralRule::EastSlavic,
            full: new TenseSet(
                past: new TenseVocabulary(
                    lessThanAMinute: 'меньше минуты назад',
                    oneMinute: 'минуту назад',
                    minutes: new PluralForms(
                        other: '%s минут назад',
                        one: '%s минуту назад',
                        few: '%s минуты назад',
                        many: '%s минут назад',
                    ),
                    aboutOneHour: 'около часа назад',
                    hours: new PluralForms(
                        other: '%s часов назад',
                        one: '%s час назад',
                        few: '%s часа назад',
                        many: '%s часов назад',
                    ),
                    aboutOneDay: 'день назад',
                    days: new PluralForms(
                        other: '%s дней назад',
                        one: '%s день назад',
                        few: '%s дня назад',
                        many: '%s дней назад',
                    ),
                    aboutOneMonth: 'около месяца назад',
                    months: new PluralForms(
                        other: '%s месяцев назад',
                        one: '%s месяц назад',
                        few: '%s месяца назад',
                        many: '%s месяцев назад',
                    ),
                    aboutOneYear: 'около года назад',
                    years: new PluralForms(
                        other: 'больше %s лет назад',
                        one: 'больше %s года назад',
                        few: 'больше %s лет назад',
                        many: 'больше %s лет назад',
                    ),
                ),
                future: new TenseVocabulary(
                    lessThanAMinute: 'меньше чем через минуту',
                    oneMinute: 'через минуту',
                    minutes: new PluralForms(
                        other: 'через %s минут',
                        one: 'через %s минуту',
                        few: 'через %s минуты',
                        many: 'через %s минут',
                    ),
                    aboutOneHour: 'примерно через час',
                    hours: new PluralForms(
                        other: 'через %s часов',
                        one: 'через %s час',
                        few: 'через %s часа',
                        many: 'через %s часов',
                    ),
                    aboutOneDay: 'через день',
                    days: new PluralForms(
                        other: 'через %s дней',
                        one: 'через %s день',
                        few: 'через %s дня',
                        many: 'через %s дней',
                    ),
                    aboutOneMonth: 'примерно через месяц',
                    months: new PluralForms(
                        other: 'через %s месяцев',
                        one: 'через %s месяц',
                        few: 'через %s месяца',
                        many: 'через %s месяцев',
                    ),
                    aboutOneYear: 'примерно через год',
                    years: new PluralForms(
                        other: 'больше чем через %s лет',
                        one: 'больше чем через %s год',
                        few: 'больше чем через %s года',
                        many: 'больше чем через %s лет',
                    ),
                ),
                plain: new TenseVocabulary(
                    lessThanAMinute: 'меньше минуты',
                    oneMinute: 'минута',
                    minutes: new PluralForms('%s минут', one: '%s минута', few: '%s минуты', many: '%s минут'),
                    aboutOneHour: 'около часа',
                    hours: new PluralForms('%s часов', one: '%s час', few: '%s часа', many: '%s часов'),
                    aboutOneDay: 'день',
                    days: new PluralForms('%s дней', one: '%s день', few: '%s дня', many: '%s дней'),
                    aboutOneMonth: 'около месяца',
                    months: new PluralForms('%s месяцев', one: '%s месяц', few: '%s месяца', many: '%s месяцев'),
                    aboutOneYear: 'около года',
                    years: new PluralForms(
                        other: 'больше %s лет',
                        one: 'больше %s года',
                        few: 'больше %s лет',
                        many: 'больше %s лет',
                    ),
                ),
            ),
            never: 'Никогда',
            short: new TenseSet(
                past: new TenseVocabulary(
                    lessThanAMinute: '<1 мин назад',
                    oneMinute: '1 мин назад',
                    minutes: PluralForms::invariant('%s мин назад'),
                    aboutOneHour: '~1 ч назад',
                    hours: PluralForms::invariant('%s ч назад'),
                    aboutOneDay: '1 дн назад',
                    days: PluralForms::invariant('%s дн назад'),
                    aboutOneMonth: '~1 мес назад',
                    months: PluralForms::invariant('%s мес назад'),
                    aboutOneYear: '~1 г назад',
                    years: PluralForms::invariant('>%s л назад'),
                ),
                future: new TenseVocabulary(
                    lessThanAMinute: 'через <1 мин',
                    oneMinute: 'через 1 мин',
                    minutes: PluralForms::invariant('через %s мин'),
                    aboutOneHour: 'через ~1 ч',
                    hours: PluralForms::invariant('через %s ч'),
                    aboutOneDay: 'через 1 дн',
                    days: PluralForms::invariant('через %s дн'),
                    aboutOneMonth: 'через ~1 мес',
                    months: PluralForms::invariant('через %s мес'),
                    aboutOneYear: 'через ~1 г',
                    years: PluralForms::invariant('через >%s л'),
                ),
                plain: new TenseVocabulary(
                    lessThanAMinute: '<1 мин',
                    oneMinute: '1 мин',
                    minutes: PluralForms::invariant('%s мин'),
                    aboutOneHour: '~1 ч',
                    hours: PluralForms::invariant('%s ч'),
                    aboutOneDay: '1 дн',
                    days: PluralForms::invariant('%s дн'),
                    aboutOneMonth: '~1 мес',
                    months: PluralForms::invariant('%s мес'),
                    aboutOneYear: '~1 г',
                    years: PluralForms::invariant('>%s л'),
                ),
            ),
        );
    }
}
