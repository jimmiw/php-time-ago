<?php declare(strict_types=1);

namespace Westsworld\TimeAgo\Translations;

use \Westsworld\TimeAgo\Language;

/**
 * Portuguese translations
 */
class Pt extends Language
{
    public function __construct()
    {
        $this->setTranslations([
            'aboutOneDay' => "ontem",
            'aboutOneHour' => "cerca de 1 hora atrás",
            'aboutOneMonth' => "cerca de 1 mês atrás",
            'aboutOneYear' => "1 ano atrás",
            'days' => "%s dias atrás",
            'hours' => "%s horas atrás",
            'lessThanAMinute' => "há menos de um minuto",
            'lessThanOneHour' => "%s minutos atrás",
            'months' => "%s meses atrás",
            'oneMinute' => "há 1 minuto",
            'years' => "há mais de %s anos",
            'never' => 'nunca'
        ]);
    }
}
