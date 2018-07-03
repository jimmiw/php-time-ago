<?php

namespace Westsworld\TimeAgo\Translations;

use \Westsworld\TimeAgo\Language;

/**
 * Finnish translations
 */
class Fi extends Language
{
    public function __construct()
    {
        $this->setTranslations([
            'aboutOneDay' => "1 päivä",
            'aboutOneHour' => "noin tunti sitten",
            'aboutOneMonth' => "noin kuukausi sitten",
            'aboutOneYear' => "noin vuosi sitten",
            'days' => "%s päivää sitten",
            'hours' => "%s tuntia sitten",
            'lessThanAMinute' => "alle minuutti sitten",
            'lessThanOneHour' => "%s minuuttia sitten",
            'months' => "%s kuukautta sitten",
            'oneMinute' => "1 minuutti sitten",
            'years' => "yli %s vuotta sitten"
        ]);
    }
}
