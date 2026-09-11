<?php

declare(strict_types=1);

namespace Alexxiy\TimeIntervals;

/**
 * How an interval is framed relative to the moment it is measured against.
 *
 * Left unset, {@see IntervalFormatter} picks Past or Future from the direction
 * of the interval itself; Plain has to be asked for, since no date can imply it.
 */
enum Tense: string
{
    /** "3 days ago" */
    case Past = 'past';

    /** "in 3 days" */
    case Future = 'future';

    /** "3 days" — the bare span, with no direction attached. */
    case Plain = 'plain';
}
