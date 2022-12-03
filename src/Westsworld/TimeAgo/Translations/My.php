<?php

namespace Westsworld\TimeAgo\Translations;

use \Westsworld\TimeAgo\Language;

/**
 * Myanmar translations
 */
class My extends Language
{
    public function __construct()
    {
        $this->setTranslations([
            'aboutOneDay' => "၁ ရက် ခန့်က",
            'aboutOneHour' => "၁ နာရီ ခန့်က",
            'aboutOneMonth' => "၁ လ ခန့်က",
            'aboutOneYear' => "၁ နှစ် ခန့်က",
            'days' => "%s ရက် အကြာက",
            'hours' => "%s နာရီ အကြာက",
            'lessThanAMinute' => "ယခုလေးတင်",
            'lessThanOneHour' => "%s မိနစ် အကြာက",
            'months' => "%s လ အကြာက",
            'oneMinute' => "တစ်မိနစ် အကြာက",
            'years' => "%s နှစ် ကျော်က",
            'never' => 'အချက်အလက် မရှိပါ'
        ]);
    }
}
