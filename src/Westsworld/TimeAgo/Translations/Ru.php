<?php

namespace Westsworld\TimeAgo\Translations;

use \Westsworld\TimeAgo\Language;

/**
 * Russian translations
 */
class Ru extends Language
{
    public function __construct()
    {
        $this->setTranslations([
            'aboutOneDay' => "вчера",
            'aboutOneHour' => "час назад",
            'aboutOneMonth' => "около месяца назад",
            'aboutOneYear' => "год назад",
            'days' => "%s дней назад",
            'hours' => "%s часов назад",
            'lessThanAMinute' => "меньше минуты",
            'lessThanOneHour' => "%s минут назад",
            'months' => "%s месяцев назад",
            'oneMinute' => "минуту назад",
            'years' => "больше %s лет назад"
        ]);
    }
}
