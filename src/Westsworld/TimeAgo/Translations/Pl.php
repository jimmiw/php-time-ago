<?php

namespace Westsworld\TimeAgo\Translations;

use \Westsworld\TimeAgo\Language;

/**
 * Polish translations
 */
class Pl extends Language
{
    public function __construct()
    {
        $this->setTranslations([
            'aboutOneDay' => "wczoraj",
            'aboutOneHour' => "godzinę temu",
            'aboutOneMonth' => "miesiąc temu",
            'aboutOneYear' => "rok temu",
            'days' => "%s dni temu",
            'hours' => "%s godzin temu",
            'lessThanAMinute' => "mniej niż minutę temu",
            'lessThanOneHour' => "%s minut temu",
            'months' => "%s miesięcy temu",
            'oneMinute' => "minutę temu",
            'years' => "ponad %s lat temu",
            'never' => 'Nigdy'
        ]);
    }
}
