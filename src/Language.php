<?php

declare(strict_types=1);

namespace Alexxiy\TimeIntervals;

/**
 * A language is nothing but a bag of translated phrases.
 *
 * All the "how long ago was this" logic lives in {@see Classifier}, so adding
 * a language means implementing this one method and nothing else. Implementations
 * are expected to be stateless and cheap to construct.
 */
interface Language
{
    public function vocabulary(): Vocabulary;
}
