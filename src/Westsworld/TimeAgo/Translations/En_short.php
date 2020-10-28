<?php

namespace Westsworld\TimeAgo\Translations;

use \Westsworld\TimeAgo\Language;

/**
 * short English translations
 */
class En_short extends Language
{
    public function __construct()
    {
        $this->setTranslations([
              'aboutOneDay' => "1d",
            'aboutOneHour' => "~1h",
            'aboutOneMonth' => "~1M",
            'aboutOneYear' => "~y",
            'days' => "%sd",
            'hours' => "%sh",
            'lessThanAMinute' => "<1m",
            'lessThanOneHour' => "%sm",
            'months' => "%sM",
            'oneMinute' => "1m",
            'years' => ">%sy"
        ]);
    }
}
