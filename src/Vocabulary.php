<?php

declare(strict_types=1);

namespace Alexxiy\TimeIntervals;

/**
 * The complete set of strings a language needs to describe an interval.
 *
 * The full style is required, so a language cannot be built knowing how to say
 * "3 days ago" but not "in 3 days". The short style is optional because plenty
 * of languages have no abbreviation convention to speak of.
 */
final readonly class Vocabulary
{
    public function __construct(
        public PluralRule $plurals,
        public TenseSet $full,
        public string $never,
        public ?TenseSet $short = null,
    ) {
    }

    /**
     * The wording for one tense in one style, falling back to the full style when
     * the language does not abbreviate.
     */
    #[\NoDiscard]
    public function forTense(Tense $tense, Style $style = Style::Full): TenseVocabulary
    {
        return $this->forStyle($style)->forTense($tense);
    }

    #[\NoDiscard]
    public function forStyle(Style $style): TenseSet
    {
        return match ($style) {
            Style::Full => $this->full,
            Style::Short => $this->short ?? $this->full,
        };
    }

    /**
     * Whether the language spells out its own abbreviated forms.
     */
    #[\NoDiscard]
    public function abbreviates(): bool
    {
        return $this->short !== null;
    }
}
