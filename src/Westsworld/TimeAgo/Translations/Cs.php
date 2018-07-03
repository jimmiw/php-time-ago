<?php

namespace Westsworld\TimeAgo\Translations;

use \Westsworld\TimeAgo\Language;

/**
 * Czech translations
 */
class Cs extends Language
{
    public function __construct()
    {
        $this->setTranslations([
            'aboutOneDay' => "před 1 dnem",
            'aboutOneHour' => "před 1 hodinou",
            'aboutOneMonth' => "před 1 měsícem",
            'aboutOneYear' => "před 1 rokem",
            'days' => "před %s dny",
            'hours' => "před %s hodinami",
            'lessThanAMinute' => "před méně jak minutou",
            'lessThanOneHour' => "před %s minutami",
            'months' => "před %s měsíci",
            'oneMinute' => "před 1 minutou",
            'years' => "před %s lety"
        ]);
    }
}
