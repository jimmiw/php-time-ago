<?php

namespace Westsworld\TimeAgo\Translations;

use \Westsworld\TimeAgo\Language;

/**
 * Georgian translations
 */
class Ge extends Language
{
    public function __construct()
    {
        $this->setTranslations([
            'aboutOneDay' => "გუშინ",
            'aboutOneHour' => "1 საათის წინ",
            'aboutOneMonth' => "1 თვის წინ",
            'aboutOneYear' => "1 წლის წინ",
            'days' => "%s დღის წინ",
            'hours' => "%s საათის წინ",
            'lessThanAMinute' => "წუთზე ნაკლები",
            'lessThanOneHour' => "%s წუთის წინ",
            'months' => "%s თვის წინ",
            'oneMinute' => "1 წუთის წინ",
            'years' => "%s წელზე მეტი",
            'never' => 'არასდროს'
        ]);
    }
}
