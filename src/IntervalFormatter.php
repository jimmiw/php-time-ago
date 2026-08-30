<?php

declare(strict_types=1);

namespace Alexxiy\TimeIntervals;

use Alexxiy\TimeIntervals\Translations\En;
use DateTimeImmutable;
use DateTimeInterface;

/**
 * Describes the distance between two points in time in words.
 *
 *     $formatter = new IntervalFormatter();
 *
 *     $formatter->inWords(new DateTimeImmutable('-3 days'));   // "3 days ago"
 *     $formatter->inWords(new DateTimeImmutable('+3 days'));   // "in 3 days"
 *     $formatter->inWords($date, tense: Tense::Plain);         // "3 days"
 *     $formatter->inWords($date, style: Style::Short);         // "3d ago"
 *
 * Tense and style are independent, so every combination of the two is available.
 * Instances are immutable and stateless; create one per language and reuse it.
 */
final readonly class IntervalFormatter
{
    private Vocabulary $vocabulary;

    /**
     * @param Tense|null $tense the tense to use for every call, or null to take
     *                          it from the direction of each interval
     * @param Style      $style how verbose the wording should be
     */
    public function __construct(
        private Language $language = new En(),
        private ?Tense $tense = null,
        private Style $style = Style::Full,
        private Classifier $classifier = new Classifier(),
    ) {
        // Resolved once: languages are static data, and inWords() is often called
        // in a loop over a list of records.
        $this->vocabulary = $language->vocabulary();
    }

    /**
     * Builds an instance for one of the languages bundled with this package.
     */
    #[\NoDiscard]
    public static function forLocale(
        Locale $locale,
        ?Tense $tense = null,
        Style $style = Style::Full,
    ): self {
        return new self($locale->language(), $tense, $style);
    }

    /**
     * The language this instance speaks.
     */
    #[\NoDiscard]
    public function language(): Language
    {
        return $this->language;
    }

    /**
     * The tense this instance is pinned to, or null if it follows each interval.
     */
    #[\NoDiscard]
    public function tense(): ?Tense
    {
        return $this->tense;
    }

    /**
     * The style this instance uses.
     */
    #[\NoDiscard]
    public function style(): Style
    {
        return $this->style;
    }

    /**
     * Returns a copy speaking a different language.
     */
    #[\NoDiscard]
    public function withLanguage(Language $language): self
    {
        return new self($language, $this->tense, $this->style, $this->classifier);
    }

    /**
     * Returns a copy speaking one of the bundled languages.
     */
    #[\NoDiscard]
    public function withLocale(Locale $locale): self
    {
        return $this->withLanguage($locale->language());
    }

    /**
     * Returns a copy pinned to a tense, or following the interval when given null.
     */
    #[\NoDiscard]
    public function withTense(?Tense $tense): self
    {
        return new self($this->language, $tense, $this->style, $this->classifier);
    }

    /**
     * Returns a copy using a different style.
     */
    #[\NoDiscard]
    public function withStyle(Style $style): self
    {
        return new self($this->language, $this->tense, $style, $this->classifier);
    }

    /**
     * Describes the distance between $date and $now in words.
     *
     * @param DateTimeInterface      $date  the moment to describe
     * @param DateTimeInterface|null $now   the moment to measure against, defaulting
     *                                      to the current time in $date's timezone
     * @param Tense|null             $tense overrides the tense for this call only
     * @param Style|null             $style overrides the style for this call only
     *
     * @return string e.g. "1 day ago", "in 1 day", "1 day", "1d ago"
     */
    #[\NoDiscard]
    public function inWords(
        DateTimeInterface $date,
        ?DateTimeInterface $now = null,
        ?Tense $tense = null,
        ?Style $style = null,
    ): string {
        $now ??= new DateTimeImmutable('now', $date->getTimezone());
        $difference = $date->diff($now);

        // diff() marks the interval inverted when $now falls before $date, which
        // is exactly the case where $date is still ahead of us.
        $tense ??= $this->tense ?? ($difference->invert === 1 ? Tense::Future : Tense::Past);

        return $this->render($this->classifier->classify($difference), $tense, $style ?? $this->style);
    }

    /**
     * The language's word for "never", for rendering records that have no date
     * at all.
     */
    #[\NoDiscard]
    public function never(): string
    {
        return $this->vocabulary->never;
    }

    private function render(Classification $classification, Tense $tense, Style $style): string
    {
        $forms = $this->vocabulary->forTense($tense, $style);
        $count = $classification->count;

        // Uncounted phrases are literal text and must not go through sprintf(),
        // or a stray percent sign in a translation would blow up at runtime.
        if ($count === null) {
            return $forms->pattern($classification->phrase);
        }

        return sprintf(
            $forms->pattern($classification->phrase, $this->vocabulary->plurals->categoryFor($count)),
            $count,
        );
    }
}
