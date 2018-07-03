<?php

namespace Westsworld\TimeAgo\Translations;

use \Westsworld\TimeAgo\Language;

/**
 * French translations
 */
class Fr extends Language
{
    public function __construct()
    {
        $this->setTranslations([
            'aboutOneDay' => "il y a un jour",
            'aboutOneHour' => "il y a une heure",
            'aboutOneMonth' => "il y a un mois",
            'aboutOneYear' => "il y a un an",
            'days' => "il y a %s jours",
            'hours' => "il y a %s heures",
            'lessThanAMinute' => "il y a moins d'une minute",
            'lessThanOneHour' => "il y a %s minutes",
            'months' => "il y a %s mois",
            'oneMinute' => "il y a une minute",
            'years' => "il y a plus de %s ans"
        ]);
    }
}
