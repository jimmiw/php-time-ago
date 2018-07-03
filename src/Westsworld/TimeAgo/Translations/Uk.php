<?php

namespace Westsworld\TimeAgo\Translations;

use \Westsworld\TimeAgo\Language;

/**
 * Ukranian translations
 */
class Uk extends Language
{
    public function __construct()
    {
        $this->setTranslations([
            'aboutOneDay' => "вчора",
            'aboutOneHour' => "годину тому",
            'aboutOneMonth' => "близько одного місяця",
            'aboutOneYear' => "рік тому",
            'days' => "%s днів тому",
            'hours' => "%s годин тому",
            'lessThanAMinute' => "менше хвилини",
            'lessThanOneHour' => "%s хвилин тому",
            'months' => "%s місяців тому",
            'oneMinute' => "хвилину тому",
            'years' => "більше %s років тому"
        ]);
    }
}
