<?php

declare(strict_types=1);

namespace Alexxiy\TimeIntervals\Tests;

use Alexxiy\TimeIntervals\PluralCategory;
use Alexxiy\TimeIntervals\PluralRule;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(PluralRule::class)]
#[CoversClass(PluralCategory::class)]
final class PluralRuleTest extends TestCase
{
    /**
     * Counts that exercise every branch of every rule, checked against the CLDR
     * plural rule charts.
     *
     * @return iterable<string, array{PluralRule, int, PluralCategory}>
     */
    public static function categoryProvider(): iterable
    {
        $cases = [
            // A single form no matter the count.
            [PluralRule::OtherOnly, 1, PluralCategory::Other],
            [PluralRule::OtherOnly, 2, PluralCategory::Other],
            [PluralRule::OtherOnly, 21, PluralCategory::Other],

            [PluralRule::OneOther, 1, PluralCategory::One],
            [PluralRule::OneOther, 0, PluralCategory::Other],
            [PluralRule::OneOther, 2, PluralCategory::Other],
            [PluralRule::OneOther, 21, PluralCategory::Other],

            // Portuguese, Hindi and Persian treat zero as singular.
            [PluralRule::ZeroOneOther, 0, PluralCategory::One],
            [PluralRule::ZeroOneOther, 1, PluralCategory::One],
            [PluralRule::ZeroOneOther, 2, PluralCategory::Other],

            [PluralRule::French, 0, PluralCategory::One],
            [PluralRule::French, 1, PluralCategory::One],
            [PluralRule::French, 2, PluralCategory::Other],
            [PluralRule::French, 1000000, PluralCategory::Many],
            [PluralRule::French, 1000001, PluralCategory::Other],

            // 1 день, 2 дня, 5 дней, 11 дней, 21 день, 22 дня, 111 дней.
            [PluralRule::EastSlavic, 1, PluralCategory::One],
            [PluralRule::EastSlavic, 2, PluralCategory::Few],
            [PluralRule::EastSlavic, 4, PluralCategory::Few],
            [PluralRule::EastSlavic, 5, PluralCategory::Many],
            [PluralRule::EastSlavic, 11, PluralCategory::Many],
            [PluralRule::EastSlavic, 12, PluralCategory::Many],
            [PluralRule::EastSlavic, 14, PluralCategory::Many],
            [PluralRule::EastSlavic, 20, PluralCategory::Many],
            [PluralRule::EastSlavic, 21, PluralCategory::One],
            [PluralRule::EastSlavic, 22, PluralCategory::Few],
            [PluralRule::EastSlavic, 25, PluralCategory::Many],
            [PluralRule::EastSlavic, 101, PluralCategory::One],
            [PluralRule::EastSlavic, 111, PluralCategory::Many],

            // Polish differs from East Slavic only at 21, 31, 101 and so on.
            [PluralRule::Polish, 1, PluralCategory::One],
            [PluralRule::Polish, 2, PluralCategory::Few],
            [PluralRule::Polish, 5, PluralCategory::Many],
            [PluralRule::Polish, 12, PluralCategory::Many],
            [PluralRule::Polish, 21, PluralCategory::Many],
            [PluralRule::Polish, 22, PluralCategory::Few],

            [PluralRule::CzechSlovak, 1, PluralCategory::One],
            [PluralRule::CzechSlovak, 2, PluralCategory::Few],
            [PluralRule::CzechSlovak, 4, PluralCategory::Few],
            [PluralRule::CzechSlovak, 5, PluralCategory::Other],
            [PluralRule::CzechSlovak, 22, PluralCategory::Other],

            [PluralRule::Latvian, 0, PluralCategory::Zero],
            [PluralRule::Latvian, 1, PluralCategory::One],
            [PluralRule::Latvian, 10, PluralCategory::Zero],
            [PluralRule::Latvian, 11, PluralCategory::Zero],
            [PluralRule::Latvian, 19, PluralCategory::Zero],
            [PluralRule::Latvian, 20, PluralCategory::Zero],
            [PluralRule::Latvian, 21, PluralCategory::One],
            [PluralRule::Latvian, 22, PluralCategory::Other],

            [PluralRule::Arabic, 0, PluralCategory::Zero],
            [PluralRule::Arabic, 1, PluralCategory::One],
            [PluralRule::Arabic, 2, PluralCategory::Two],
            [PluralRule::Arabic, 3, PluralCategory::Few],
            [PluralRule::Arabic, 10, PluralCategory::Few],
            [PluralRule::Arabic, 11, PluralCategory::Many],
            [PluralRule::Arabic, 99, PluralCategory::Many],
            [PluralRule::Arabic, 100, PluralCategory::Other],
            [PluralRule::Arabic, 103, PluralCategory::Few],
        ];

        foreach ($cases as [$rule, $count, $category]) {
            yield sprintf('%s/%d', $rule->name, $count) => [$rule, $count, $category];
        }
    }

    #[DataProvider('categoryProvider')]
    public function testCategoryFor(PluralRule $rule, int $count, PluralCategory $expected): void
    {
        self::assertSame($expected, $rule->categoryFor($count));
    }

    /**
     * @return iterable<string, array{PluralRule}>
     */
    public static function ruleProvider(): iterable
    {
        foreach (PluralRule::cases() as $rule) {
            yield $rule->name => [$rule];
        }
    }

    /**
     * categories() is handwritten, so it is checked against what the rule
     * actually produces rather than trusted.
     */
    #[DataProvider('ruleProvider')]
    public function testCategoriesMatchesWhatTheRuleProduces(PluralRule $rule): void
    {
        $produced = [];
        foreach ([...range(1, 10000), 1000000, 1000001, 2000000] as $count) {
            $produced[$rule->categoryFor($count)->value] = true;
        }

        $declared = array_map(
            static fn(PluralCategory $category): string => $category->value,
            $rule->categories(),
        );

        sort($declared);
        $actual = array_keys($produced);
        sort($actual);

        self::assertSame($actual, $declared);
    }

    #[DataProvider('ruleProvider')]
    public function testACountIsNeverNegativeButIsHandledAnyway(PluralRule $rule): void
    {
        self::assertSame($rule->categoryFor(21), $rule->categoryFor(-21));
    }
}
