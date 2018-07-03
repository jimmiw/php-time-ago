<?php

namespace Westsworld\TimeAgo\Translations;

use \Westsworld\TimeAgo\Language;

/**
 * Swedish translations
 */
class Sv_SE extends Language
{
    public function __construct()
    {
        $this->setTranslations([
            'aboutOneDay' => "en dag sedan",
            'aboutOneHour' => "en timme sedan",
            'aboutOneMonth' => "en månad sedan",
            'aboutOneYear' => "ett år sedan",
            'days' => "%s dagar sedan",
            'hours' => "%s timmar sedan",
            'lessThanAMinute' => "mindre än en minut sedan",
            'lessThanOneHour' => "%s minuter sedan",
            'months' => "%s månader sedan",
            'oneMinute' => "en minut sedan",
            'years' => "över %s år sedan",
            'never' => 'aldrig'
        ]);
    }
}
