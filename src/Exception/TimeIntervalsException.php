<?php

declare(strict_types=1);

namespace Alexxiy\TimeIntervals\Exception;

use Throwable;

/**
 * Implemented by every exception this library throws, so callers can catch the
 * whole package with a single `catch`.
 */
interface TimeIntervalsException extends Throwable
{
}
