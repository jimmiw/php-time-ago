<?php

namespace Westsworld\TimeAgo\Translations;

use \Westsworld\TimeAgo\Language;

/**
 * Arabic translations
 */
class Ar extends Language
{
    public function __construct()
    {
        $this->setTranslations([
            'aboutOneDay' => "منذ يوم",
            'aboutOneHour' => "منذ ساعة",
            'aboutOneMonth' => "منذ شهر",
            'aboutOneYear' => "منذ سنة",
            'days' => "منذ %s ايام",
            'hours' => "منذ %s ساعات",
            'lessThanAMinute' => "منذ أقل من دقيقة",
            'lessThanOneHour' => "منذ %s دقيقة",
            'months' => "منذ شهر",
            'oneMinute' => "منذ دقيقة",
            'years' => "منذ أكثر من سنة"
        ]);
    }
}
