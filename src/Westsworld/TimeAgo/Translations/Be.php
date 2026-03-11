<?php declare(strict_types=1);

namespace Westsworld\TimeAgo\Translations;

use \Westsworld\TimeAgo\Language;

/**
 * Belarusian translations
 */
class Be extends Language
{
    public function __construct()
    {
        $this->setTranslations([
            'aboutOneDay' => "учора",
            'aboutOneHour' => "гадзіну таму",
            'aboutOneMonth' => "прыкладна месяц таму",
            'aboutOneYear' => "год таму",
            'days' => "%s дзён таму",
            'hours' => "%s гадзін таму",
            'lessThanAMinute' => "менш за хвіліну",
            'lessThanOneHour' => "%s хвілін таму",
            'months' => "%s месяцаў таму",
            'oneMinute' => "хвіліну таму",
            'years' => "больш за %s гадоў таму",
            'never' => 'ніколі'
        ]);
    }
}
