<?php

namespace Westsworld\TimeAgo\Translations;

use \Westsworld\TimeAgo\Language;

/**
 * Brazilian Portuguese translations
 */
class Pt_BR extends Language
{
    public function __construct()
    {
        $this->setTranslations([
            'aboutOneDay' => "1 dia atrás",
            'aboutOneHour' => "cerca de 1 hora atrás",
            'aboutOneMonth' => "cerca de 1 mês atrás",
            'aboutOneYear' => "cerca de 1 ano atrás",
            'days' => "%s dias atrás",
            'hours' => "%s horas atrás",
            'lessThanAMinute' => "menos de um minuto atras",
            'lessThanOneHour' => "%s minutos atrás",
            'months' => "%s meses atrás",
            'oneMinute' => "1 minuto atrás",
            'years' => "mais de %s anos atrás"
        ]);
    }
}
