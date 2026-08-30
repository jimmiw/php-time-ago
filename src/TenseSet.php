<?php

declare(strict_types=1);

namespace Alexxiy\TimeIntervals;

/**
 * The three tenses of one {@see Style}.
 *
 * Grouping them makes a style all-or-nothing: a language cannot end up knowing
 * how to say "5m ago" but not "in 5m".
 */
final readonly class TenseSet
{
    public function __construct(
        public TenseVocabulary $past,
        public TenseVocabulary $future,
        public TenseVocabulary $plain,
    ) {
    }

    #[\NoDiscard]
    public function forTense(Tense $tense): TenseVocabulary
    {
        return match ($tense) {
            Tense::Past => $this->past,
            Tense::Future => $this->future,
            Tense::Plain => $this->plain,
        };
    }
}
