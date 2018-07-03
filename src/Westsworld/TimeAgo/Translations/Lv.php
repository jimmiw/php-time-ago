<?php

namespace Westsworld\TimeAgo\Translations;

use \Westsworld\TimeAgo\Language;

/**
 * Latvian translations
 */
class Lv extends Language
{
    public function __construct()
    {
        $this->setTranslations([
            'aboutOneDay' => "pirms 1 dienas",
            'aboutOneHour' => "pirms 1 stundas",
            'aboutOneMonth' => "pirms 1 mēneša",
            'aboutOneYear' => "pirms 1 gada",
            'days' => "pirms %s dienām",
            'hours' => "pirms %s stundām",
            'lessThanAMinute' => "šajā minūtē",
            'lessThanOneHour' => "pirms %s minūtēm",
            'months' => "pirms %s mēnešiem",
            'oneMinute' => "pirms 1 minūtes",
            'years' => "pirms %s gadiem",
            'never' => 'Nekad'
        ]);
    }
}
