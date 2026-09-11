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
 * Belarusian translations.
 */
final class Be implements Language
{
    public function vocabulary(): Vocabulary
    {
        return new Vocabulary(
            plurals: PluralRule::EastSlavic,
            full: new TenseSet(
                past: new TenseVocabulary(
                    lessThanAMinute: 'менш за хвіліну таму',
                    oneMinute: 'хвіліну таму',
                    minutes: new PluralForms(
                        other: '%s хвілін таму',
                        one: '%s хвіліну таму',
                        few: '%s хвіліны таму',
                        many: '%s хвілін таму',
                    ),
                    aboutOneHour: 'каля гадзіны таму',
                    hours: new PluralForms(
                        other: '%s гадзін таму',
                        one: '%s гадзіну таму',
                        few: '%s гадзіны таму',
                        many: '%s гадзін таму',
                    ),
                    aboutOneDay: 'дзень таму',
                    days: new PluralForms(
                        other: '%s дзён таму',
                        one: '%s дзень таму',
                        few: '%s дні таму',
                        many: '%s дзён таму',
                    ),
                    aboutOneMonth: 'прыкладна месяц таму',
                    months: new PluralForms(
                        other: '%s месяцаў таму',
                        one: '%s месяц таму',
                        few: '%s месяцы таму',
                        many: '%s месяцаў таму',
                    ),
                    aboutOneYear: 'прыкладна год таму',
                    years: new PluralForms(
                        other: 'больш за %s гадоў таму',
                        one: 'больш за %s год таму',
                        few: 'больш за %s гады таму',
                        many: 'больш за %s гадоў таму',
                    ),
                ),
                future: new TenseVocabulary(
                    lessThanAMinute: 'менш чым праз хвіліну',
                    oneMinute: 'праз хвіліну',
                    minutes: new PluralForms(
                        other: 'праз %s хвілін',
                        one: 'праз %s хвіліну',
                        few: 'праз %s хвіліны',
                        many: 'праз %s хвілін',
                    ),
                    aboutOneHour: 'прыкладна праз гадзіну',
                    hours: new PluralForms(
                        other: 'праз %s гадзін',
                        one: 'праз %s гадзіну',
                        few: 'праз %s гадзіны',
                        many: 'праз %s гадзін',
                    ),
                    aboutOneDay: 'праз дзень',
                    days: new PluralForms(
                        other: 'праз %s дзён',
                        one: 'праз %s дзень',
                        few: 'праз %s дні',
                        many: 'праз %s дзён',
                    ),
                    aboutOneMonth: 'прыкладна праз месяц',
                    months: new PluralForms(
                        other: 'праз %s месяцаў',
                        one: 'праз %s месяц',
                        few: 'праз %s месяцы',
                        many: 'праз %s месяцаў',
                    ),
                    aboutOneYear: 'прыкладна праз год',
                    years: new PluralForms(
                        other: 'больш чым праз %s гадоў',
                        one: 'больш чым праз %s год',
                        few: 'больш чым праз %s гады',
                        many: 'больш чым праз %s гадоў',
                    ),
                ),
                plain: new TenseVocabulary(
                    lessThanAMinute: 'менш за хвіліну',
                    oneMinute: 'хвіліна',
                    minutes: new PluralForms('%s хвілін', one: '%s хвіліна', few: '%s хвіліны', many: '%s хвілін'),
                    aboutOneHour: 'каля гадзіны',
                    hours: new PluralForms('%s гадзін', one: '%s гадзіна', few: '%s гадзіны', many: '%s гадзін'),
                    aboutOneDay: 'дзень',
                    days: new PluralForms('%s дзён', one: '%s дзень', few: '%s дні', many: '%s дзён'),
                    aboutOneMonth: 'каля месяца',
                    months: new PluralForms('%s месяцаў', one: '%s месяц', few: '%s месяцы', many: '%s месяцаў'),
                    aboutOneYear: 'каля года',
                    years: new PluralForms(
                        other: 'больш за %s гадоў',
                        one: 'больш за %s год',
                        few: 'больш за %s гады',
                        many: 'больш за %s гадоў',
                    ),
                ),
            ),
            never: 'Ніколі',
            short: new TenseSet(
                past: new TenseVocabulary(
                    lessThanAMinute: '<1 хв таму',
                    oneMinute: '1 хв таму',
                    minutes: PluralForms::invariant('%s хв таму'),
                    aboutOneHour: '~1 гадз таму',
                    hours: PluralForms::invariant('%s гадз таму'),
                    aboutOneDay: '1 дн таму',
                    days: PluralForms::invariant('%s дн таму'),
                    aboutOneMonth: '~1 мес таму',
                    months: PluralForms::invariant('%s мес таму'),
                    aboutOneYear: '~1 г таму',
                    years: PluralForms::invariant('>%s г таму'),
                ),
                future: new TenseVocabulary(
                    lessThanAMinute: 'праз <1 хв',
                    oneMinute: 'праз 1 хв',
                    minutes: PluralForms::invariant('праз %s хв'),
                    aboutOneHour: 'праз ~1 гадз',
                    hours: PluralForms::invariant('праз %s гадз'),
                    aboutOneDay: 'праз 1 дн',
                    days: PluralForms::invariant('праз %s дн'),
                    aboutOneMonth: 'праз ~1 мес',
                    months: PluralForms::invariant('праз %s мес'),
                    aboutOneYear: 'праз ~1 г',
                    years: PluralForms::invariant('праз >%s г'),
                ),
                plain: new TenseVocabulary(
                    lessThanAMinute: '<1 хв',
                    oneMinute: '1 хв',
                    minutes: PluralForms::invariant('%s хв'),
                    aboutOneHour: '~1 гадз',
                    hours: PluralForms::invariant('%s гадз'),
                    aboutOneDay: '1 дн',
                    days: PluralForms::invariant('%s дн'),
                    aboutOneMonth: '~1 мес',
                    months: PluralForms::invariant('%s мес'),
                    aboutOneYear: '~1 г',
                    years: PluralForms::invariant('>%s г'),
                ),
            ),
        );
    }
}
