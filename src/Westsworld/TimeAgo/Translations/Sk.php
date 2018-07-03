<?php

namespace Westsworld\TimeAgo\Translations;

use \Westsworld\TimeAgo\Language;

/**
 * Translations
 */
class Sk extends Language
{
    public function __construct()
    {
        $this->setTranslations([
            'aboutOneDay' => "pred 1 dňom",
            'aboutOneHour' => "pred 1 hodinou",
            'aboutOneMonth' => "pred 1 mesiacom",
            'aboutOneYear' => "pred 1 rokom",
            'days' => "pred %s dňami",
            'hours' => "pred %s hodinami",
            'lessThanAMinute' => "pred menej ako minútou",
            'lessThanOneHour' => "pred  %s minútami",
            'months' => "pred %s mesiacmi",
            'oneMinute' => "pred 1 minútou",
            'years' => "pred %s rokmi"
        ]);
    }
}
