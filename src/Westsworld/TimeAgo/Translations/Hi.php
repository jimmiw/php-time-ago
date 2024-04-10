<?php

namespace Westsworld\TimeAgo\Translations;

use \Westsworld\TimeAgo\Language;

/**
 * Hindi translations
 */
class Hi extends Language
{
    public function __construct()
    {
        $this->setTranslations([
            'aboutOneDay' => '1 दिन पहले',
            'aboutOneHour' => 'लगभग 1 घंटे पहले',
            'aboutOneMonth' => 'लगभग 1 महीने पहले',
            'aboutOneYear' => 'लगभग 1 साल पहले',
            'days' => '%s दिन पहले',
            'hours' => '%s घंटे पहले',
            'lessThanAMinute' => 'एक मिनट से भी कम पहले',
            'lessThanOneHour' => '%s मिनट पहले',
            'months' => '%s महीने पहले',
            'oneMinute' => '1 मिनट पहले',
            'years' => '%s से ज़्यादा साल पहले',
            'never' => 'कभी नहीं'
        ]);
    }
}
