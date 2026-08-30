<?php

declare(strict_types=1);

namespace Alexxiy\TimeIntervals\Tests;

use Alexxiy\TimeIntervals\Locale;
use Alexxiy\TimeIntervals\Tense;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(Locale::class)]
final class LocaleTest extends TestCase
{
    /**
     * @return iterable<string, array{Locale}>
     */
    public static function localeProvider(): iterable
    {
        foreach (Locale::cases() as $locale) {
            yield $locale->value => [$locale];
        }
    }

    #[DataProvider('localeProvider')]
    public function testEveryLocaleResolvesToALanguage(Locale $locale): void
    {
        $vocabulary = $locale->language()->vocabulary();

        self::assertNotSame('', $vocabulary->forTense(Tense::Past)->lessThanAMinute);
        self::assertNotSame('', $vocabulary->never);
    }

    #[DataProvider('localeProvider')]
    public function testEveryLocaleHasALabel(Locale $locale): void
    {
        self::assertNotSame('', $locale->label());
    }

    #[DataProvider('localeProvider')]
    public function testEveryLocaleResolvesToItsOwnLanguage(Locale $locale): void
    {
        // Guards against a copy-paste slip in the match arms, which would
        // otherwise silently serve one language under another's name.
        $others = array_filter(
            Locale::cases(),
            static fn(Locale $other): bool => $other !== $locale,
        );

        foreach ($others as $other) {
            self::assertNotEquals(
                $other->language()->vocabulary(),
                $locale->language()->vocabulary(),
                sprintf('%s and %s resolve to identical translations.', $locale->value, $other->value),
            );
        }
    }

    /**
     * Every case has to be a language tag that could plausibly arrive in an
     * Accept-Language header, because that is what the enum is keyed for.
     *
     * Deliberately narrower than the BCP 47 grammar: it allows a language, an
     * optional script and an optional region, and nothing else. Arbitrary variant
     * subtags are syntactically legal BCP 47 but are how `en-short` — an
     * abbreviated *format*, not a language — got in here in the first place.
     *
     * Casing is canonical and enforced: lowercase language, Titlecase script,
     * uppercase region, so callers can compare tags as plain strings.
     */
    private const string LANGUAGE_TAG = '/^[a-z]{2,3}(-[A-Z][a-z]{3})?(-([A-Z]{2}|[0-9]{3}))?$/';

    #[DataProvider('localeProvider')]
    public function testEveryTagIsAWellFormedLanguageTag(Locale $locale): void
    {
        self::assertMatchesRegularExpression(self::LANGUAGE_TAG, $locale->value);
    }

    /**
     * Proves the pattern above actually discriminates. Without this, loosening it
     * by accident would leave every locale passing and the guarantee gone.
     *
     * @return iterable<string, array{string, bool}>
     */
    public static function tagShapeProvider(): iterable
    {
        $accepted = [
            'ru' => 'a bare two-letter language',
            'fil' => 'a three-letter language',
            'pt-BR' => 'language and region',
            'es-419' => 'a numeric region',
            'zh-Hans' => 'language and script',
            'sr-Latn-RS' => 'language, script and region',
        ];
        $rejected = [
            'en-short' => 'a presentation format wearing a variant subtag',
            'en-verbose' => 'the same mistake by another name',
            'zh-cn' => 'a lowercase region',
            'EN' => 'an uppercase language',
            'en_US' => 'an underscore instead of a hyphen',
            'english' => 'a language name rather than a code',
            'en-' => 'a trailing hyphen',
            '' => 'nothing at all',
        ];

        foreach ($accepted as $tag => $why) {
            yield sprintf('accepts %s (%s)', $tag, $why) => [$tag, true];
        }
        foreach ($rejected as $tag => $why) {
            yield sprintf('rejects %s (%s)', $tag, $why) => [$tag, false];
        }
    }

    #[DataProvider('tagShapeProvider')]
    public function testTheTagPatternDiscriminates(string $tag, bool $isALanguageTag): void
    {
        if ($isALanguageTag) {
            self::assertMatchesRegularExpression(self::LANGUAGE_TAG, $tag);

            return;
        }

        self::assertDoesNotMatchRegularExpression(self::LANGUAGE_TAG, $tag);
    }

    public function testLocalesAreLookedUpByTheirTag(): void
    {
        self::assertSame(Locale::Russian, Locale::from('ru'));
        self::assertSame(Locale::ChineseSimplified, Locale::from('zh-CN'));
        self::assertNull(Locale::tryFrom('klingon'));
    }
}
