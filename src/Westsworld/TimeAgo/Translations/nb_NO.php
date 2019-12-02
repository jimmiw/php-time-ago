<?php

namespace Westsworld\TimeAgo\Translations;

use \Westsworld\TimeAgo\Language;

/**
 * Norwegian translations
 */
class nb_NO extends Language
{
    public function __construct()
    {
        $this->setTranslations([
            'aboutOneDay' => "en dag siden",
            'aboutOneHour' => "en time siden",
            'aboutOneMonth' => "en måned siden",
            'aboutOneYear' => "ett år siden",
            'days' => "%s dager siden",
            'hours' => "%s timer siden",
            'lessThanAMinute' => "mindre enn ett minutt siden",
            'lessThanOneHour' => "%s minutter siden",
            'months' => "%s måneder siden",
            'oneMinute' => "ett minutt siden",
            'years' => "over %s år sidenn",
            'never' => 'aldri'
        ]);
    }
}
