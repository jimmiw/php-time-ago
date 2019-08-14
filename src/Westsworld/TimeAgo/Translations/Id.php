<?php

namespace Westsworld\TimeAgo\Translations;

use \Westsworld\TimeAgo\Language;

/**
 * Indonesian translations
 */
class Id extends Language
{
    public function __construct()
    {
        $this->setTranslations([
            'aboutOneDay' => "1 hari",
            'aboutOneHour' => "1 jam",
            'aboutOneMonth' => "1 bulan",
            'aboutOneYear' => "1 tahun",
            'days' => "%s hari",
            'hours' => "%s jam",
            'lessThanAMinute' => "Baru saja",
            'lessThanOneHour' => "%s menit",
            'months' => "%s bulan",
            'oneMinute' => "1 menit",
            'years' => "%s tahun",
            'never' => 'Tidak pernah'
        ]);
    }
}
