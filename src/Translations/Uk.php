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
 * Ukrainian translations.
 */
final class Uk implements Language
{
    public function vocabulary(): Vocabulary
    {
        return new Vocabulary(
            plurals: PluralRule::EastSlavic,
            full: new TenseSet(
                past: new TenseVocabulary(
                    lessThanAMinute: 'менше хвилини тому',
                    oneMinute: 'хвилину тому',
                    minutes: new PluralForms(
                        other: '%s хвилин тому',
                        one: '%s хвилину тому',
                        few: '%s хвилини тому',
                        many: '%s хвилин тому',
                    ),
                    aboutOneHour: 'близько години тому',
                    hours: new PluralForms(
                        other: '%s годин тому',
                        one: '%s годину тому',
                        few: '%s години тому',
                        many: '%s годин тому',
                    ),
                    aboutOneDay: 'день тому',
                    days: new PluralForms(
                        other: '%s днів тому',
                        one: '%s день тому',
                        few: '%s дні тому',
                        many: '%s днів тому',
                    ),
                    aboutOneMonth: 'близько місяця тому',
                    months: new PluralForms(
                        other: '%s місяців тому',
                        one: '%s місяць тому',
                        few: '%s місяці тому',
                        many: '%s місяців тому',
                    ),
                    aboutOneYear: 'близько року тому',
                    years: new PluralForms(
                        other: 'більше %s років тому',
                        one: 'більше %s року тому',
                        few: 'більше %s років тому',
                        many: 'більше %s років тому',
                    ),
                ),
                future: new TenseVocabulary(
                    lessThanAMinute: 'менше ніж через хвилину',
                    oneMinute: 'через хвилину',
                    minutes: new PluralForms(
                        other: 'через %s хвилин',
                        one: 'через %s хвилину',
                        few: 'через %s хвилини',
                        many: 'через %s хвилин',
                    ),
                    aboutOneHour: 'приблизно через годину',
                    hours: new PluralForms(
                        other: 'через %s годин',
                        one: 'через %s годину',
                        few: 'через %s години',
                        many: 'через %s годин',
                    ),
                    aboutOneDay: 'через день',
                    days: new PluralForms(
                        other: 'через %s днів',
                        one: 'через %s день',
                        few: 'через %s дні',
                        many: 'через %s днів',
                    ),
                    aboutOneMonth: 'приблизно через місяць',
                    months: new PluralForms(
                        other: 'через %s місяців',
                        one: 'через %s місяць',
                        few: 'через %s місяці',
                        many: 'через %s місяців',
                    ),
                    aboutOneYear: 'приблизно через рік',
                    years: new PluralForms(
                        other: 'більше ніж через %s років',
                        one: 'більше ніж через %s рік',
                        few: 'більше ніж через %s роки',
                        many: 'більше ніж через %s років',
                    ),
                ),
                plain: new TenseVocabulary(
                    lessThanAMinute: 'менше хвилини',
                    oneMinute: 'хвилина',
                    minutes: new PluralForms('%s хвилин', one: '%s хвилина', few: '%s хвилини', many: '%s хвилин'),
                    aboutOneHour: 'близько години',
                    hours: new PluralForms('%s годин', one: '%s година', few: '%s години', many: '%s годин'),
                    aboutOneDay: 'день',
                    days: new PluralForms('%s днів', one: '%s день', few: '%s дні', many: '%s днів'),
                    aboutOneMonth: 'близько місяця',
                    months: new PluralForms('%s місяців', one: '%s місяць', few: '%s місяці', many: '%s місяців'),
                    aboutOneYear: 'близько року',
                    years: new PluralForms(
                        other: 'більше %s років',
                        one: 'більше %s року',
                        few: 'більше %s років',
                        many: 'більше %s років',
                    ),
                ),
            ),
            never: 'Ніколи',
            short: new TenseSet(
                past: new TenseVocabulary(
                    lessThanAMinute: '<1 хв тому',
                    oneMinute: '1 хв тому',
                    minutes: PluralForms::invariant('%s хв тому'),
                    aboutOneHour: '~1 год тому',
                    hours: PluralForms::invariant('%s год тому'),
                    aboutOneDay: '1 дн тому',
                    days: PluralForms::invariant('%s дн тому'),
                    aboutOneMonth: '~1 міс тому',
                    months: PluralForms::invariant('%s міс тому'),
                    aboutOneYear: '~1 р тому',
                    years: PluralForms::invariant('>%s р тому'),
                ),
                future: new TenseVocabulary(
                    lessThanAMinute: 'через <1 хв',
                    oneMinute: 'через 1 хв',
                    minutes: PluralForms::invariant('через %s хв'),
                    aboutOneHour: 'через ~1 год',
                    hours: PluralForms::invariant('через %s год'),
                    aboutOneDay: 'через 1 дн',
                    days: PluralForms::invariant('через %s дн'),
                    aboutOneMonth: 'через ~1 міс',
                    months: PluralForms::invariant('через %s міс'),
                    aboutOneYear: 'через ~1 р',
                    years: PluralForms::invariant('через >%s р'),
                ),
                plain: new TenseVocabulary(
                    lessThanAMinute: '<1 хв',
                    oneMinute: '1 хв',
                    minutes: PluralForms::invariant('%s хв'),
                    aboutOneHour: '~1 год',
                    hours: PluralForms::invariant('%s год'),
                    aboutOneDay: '1 дн',
                    days: PluralForms::invariant('%s дн'),
                    aboutOneMonth: '~1 міс',
                    months: PluralForms::invariant('%s міс'),
                    aboutOneYear: '~1 р',
                    years: PluralForms::invariant('>%s р'),
                ),
            ),
        );
    }
}
