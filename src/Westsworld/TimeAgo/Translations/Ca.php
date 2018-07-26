<?php

namespace Westsworld\TimeAgo\Translations;

use \Westsworld\TimeAgo\Language;

/**
 * Catalan translations
 */
class Ca extends Language
{
    public function __construct()
    {
        $this->setTranslations([
            'aboutOneDay' => "fa 1 dia",
            'aboutOneHour' => "fa 1 hora",
            'aboutOneMonth' => "fa 1 mes",
            'aboutOneYear' => "fa 1 any",
            'days' => "fa %s dies",
            'hours' => "fa %s hores",
            'lessThanAMinute' => "fa menys d'un minut",
            'lessThanOneHour' => "fa %s minuts",
            'months' => "fa %s mesos",
            'oneMinute' => "fa 1 minut",
            'years' => "fa %s anys",
            'never' => "mai",
        ]);
    }
}
