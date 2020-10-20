<?php
namespace Westsworld\TimeAgo\Translations;
use \Westsworld\TimeAgo\Language;
/**
 * Italian translations
 */
class It extends Language
{
    public function __construct()
    {
        $this->setTranslations([
            'aboutOneDay' => "ieri",
            'aboutOneHour' => "un'ora fa",
            'aboutOneMonth' => "un mese fa",
            'aboutOneYear' => "un anno fa",
            'days' => "%s giorni fa",
            'hours' => "%s ore fa",
            'lessThanAMinute' => "adesso",
            'lessThanOneHour' => "%s minuti fa",
            'months' => "%s mesi fa",
            'oneMinute' => "1 minuto fa",
            'years' => "più di %s anni fa",
            'never' => 'Mai'
        ]);
    }
}
