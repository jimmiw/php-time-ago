<?php

declare(strict_types=1);

namespace Alexxiy\TimeIntervals;

/**
 * One counted phrase in all the plural forms a language needs for it.
 *
 * Only `other` is required, because CLDR guarantees every language has it, which
 * means lookup can always fall back to something sensible rather than failing.
 * Supplying the rest is not optional in practice: the test suite checks that each
 * language fills in every category its {@see PluralRule} can actually produce.
 *
 * Patterns are `sprintf()` formats taking the count as their only argument. The
 * `zero`, `one` and `two` forms may leave the `%s` out where spelling the number
 * is unnatural — Arabic's dual is a word, not a digit.
 */
final readonly class PluralForms
{
    public function __construct(
        public string $other,
        public ?string $zero = null,
        public ?string $one = null,
        public ?string $two = null,
        public ?string $few = null,
        public ?string $many = null,
    ) {
    }

    /**
     * A phrase that does not inflect, whatever the count.
     *
     * Abbreviations generally do not: Russian writes "1 д", "2 д" and "5 д"
     * alike where the spelled-out noun would need three different endings. This
     * fills every category with the same pattern, so such a phrase reads as
     * deliberately invariant rather than as one somebody forgot to finish.
     */
    #[\NoDiscard]
    public static function invariant(string $pattern): self
    {
        return new self(
            other: $pattern,
            zero: $pattern,
            one: $pattern,
            two: $pattern,
            few: $pattern,
            many: $pattern,
        );
    }

    /**
     * The pattern for a category, falling back to `other` when the language does
     * not distinguish it.
     */
    #[\NoDiscard]
    public function forCategory(PluralCategory $category): string
    {
        return $this->lookUp($category) ?? $this->other;
    }

    /**
     * Whether this phrase spells out a distinct form for the category.
     */
    #[\NoDiscard]
    public function has(PluralCategory $category): bool
    {
        return $this->lookUp($category) !== null;
    }

    private function lookUp(PluralCategory $category): ?string
    {
        return match ($category) {
            PluralCategory::Zero => $this->zero,
            PluralCategory::One => $this->one,
            PluralCategory::Two => $this->two,
            PluralCategory::Few => $this->few,
            PluralCategory::Many => $this->many,
            PluralCategory::Other => $this->other,
        };
    }
}
