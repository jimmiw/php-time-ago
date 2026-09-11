<?php

declare(strict_types=1);

namespace Alexxiy\TimeIntervals;

/**
 * The CLDR plural categories.
 *
 * Which of these a language actually distinguishes is decided by its
 * {@see PluralRule}. Every language uses Other; most use nothing else.
 *
 * @see https://cldr.unicode.org/index/cldr-spec/plural-rules
 */
enum PluralCategory: string
{
    case Zero = 'zero';
    case One = 'one';
    case Two = 'two';
    case Few = 'few';
    case Many = 'many';
    case Other = 'other';
}
