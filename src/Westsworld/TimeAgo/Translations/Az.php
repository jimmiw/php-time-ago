<?php declare(strict_types=1);

namespace Westsworld\TimeAgo\Translations;

use \Westsworld\TimeAgo\Language;

/**
 * Azerbaijani translations
 */
class Az extends Language
{
    public function __construct()
    {
        $this->setTranslations([
            'aboutOneDay' => "dünən",
            'aboutOneHour' => "təxminən 1 saat əvvəl",
            'aboutOneMonth' => "təxminən 1 ay əvvəl",
            'aboutOneYear' => "1 il əvvəl",
            'days' => "%s gün əvvəl",
            'hours' => "%s saat əvvəl",
            'lessThanAMinute' => "bir dəqiqədən az əvvəl",
            'lessThanOneHour' => "%s dəqiqə əvvəl",
            'months' => "%s ay əvvəl",
            'oneMinute' => "1 dəqiqə əvvəl",
            'years' => "%s ildən çox əvvəl",
            'never' => 'heç vaxt'
        ]);
    }
}
