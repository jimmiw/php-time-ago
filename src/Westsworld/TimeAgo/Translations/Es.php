<?php

namespace Westsworld\TimeAgo\Translations;

use \Westsworld\TimeAgo\Language;

/**
 * Spanish translations
 */
class Es extends Language
{
    public function __construct()
    {
        $this->setTranslations([
            'aboutOneDay' => "hace 1 día",
            'aboutOneHour' => "hace 1 hora",
            'aboutOneMonth' => "hace 1 mes",
            'aboutOneYear' => "hace 1 año",
            'days' => "hace %s días",
            'hours' => "hace %s horas",
            'lessThanAMinute' => "hace menos de 1 minuto",
            'lessThanOneHour' => "hace %s minutos",
            'months' => "hace %s meses",
            'oneMinute' => "hace 1 minuto",
            'years' => "hace %s años"
        ]);
    }
}
