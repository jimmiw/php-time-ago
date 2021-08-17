<?php

namespace Westsworld\TimeAgo\Translations;

use \Westsworld\TimeAgo\Language;

/**
 * Translations
 */
class Tr extends Language
{
    public function __construct()
    {
        $this->setTranslations([
            'aboutOneDay' => "1 gün önce",
            'aboutOneHour' => "1 saat önce",
            'aboutOneMonth' => "1 ay önce",
            'aboutOneYear' => "1 yıl önce",
            'days' => "%s gün önce",
            'hours' => "%s saat önce",
            'lessThanAMinute' => "biraz önce",
            'lessThanOneHour' => "%s dakika önce",
            'months' => "%s ay önce",
            'oneMinute' => "1 dakika önce",
            'years' => "%s yıldan fazla",
            'never' => 'Asla'
        ]);
    }
}
