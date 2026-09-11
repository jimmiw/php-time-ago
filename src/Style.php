<?php

declare(strict_types=1);

namespace Alexxiy\TimeIntervals;

/**
 * How verbose the wording is. Orthogonal to {@see Tense}: every style says all
 * three of past, future and plain, so "in 5m" is as expressible as "5m ago".
 *
 * Not every language abbreviates. Where a language supplies no short forms, the
 * short style falls back to its full ones, which is the right answer rather than
 * a gap: Japanese "3日前" is already as short as it gets.
 */
enum Style: string
{
    /** "5 minutes ago" */
    case Full = 'full';

    /** "5m ago" */
    case Short = 'short';
}
