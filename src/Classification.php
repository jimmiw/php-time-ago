<?php

declare(strict_types=1);

namespace Alexxiy\TimeIntervals;

/**
 * The outcome of running an interval through the {@see Classifier}: which phrase
 * describes it, and the number to substitute into that phrase (if it takes one).
 */
final readonly class Classification
{
    private function __construct(
        public Phrase $phrase,
        public ?int $count,
    ) {
    }

    /**
     * A phrase that stands on its own such as "about 1 hour ago".
     */
    #[\NoDiscard]
    public static function of(Phrase $phrase): self
    {
        return new self($phrase, null);
    }

    /**
     * A phrase that carries a number such as "%s days ago".
     */
    #[\NoDiscard]
    public static function counted(Phrase $phrase, int $count): self
    {
        return new self($phrase, $count);
    }
}
