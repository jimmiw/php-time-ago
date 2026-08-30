# php-time-intervals

Describe the distance between two points in time in words — "3 days ago", "in 3 days",
"3 days", or "3d ago" — in 35 languages, with CLDR plural rules applied in each.

```php
use Alexxiy\TimeIntervals\IntervalFormatter;

echo (new IntervalFormatter())->inWords(new DateTimeImmutable('2010-01-10 23:05:00'));
```

## Requirements

PHP 8.5 or newer. No extensions, no runtime dependencies.

## Installation

```
composer require alexxiy/php-time-intervals
```

## Usage

### The basics

```php
use Alexxiy\TimeIntervals\IntervalFormatter;

$formatter = new IntervalFormatter();

echo $formatter->inWords(new DateTimeImmutable('-3 days'));   // "3 days ago"
echo $formatter->inWords(new DateTimeImmutable('+3 days'));   // "in 3 days"

// Against an explicit second date rather than the current time.
echo $formatter->inWords(
    new DateTimeImmutable('2022-07-01 15:00:00'),
    new DateTimeImmutable('2022-09-01 14:00:00'),
);                                                          // "2 months ago"
```

`inWords()` accepts any `DateTimeInterface`, so `DateTime` and `DateTimeImmutable`
both work, and neither argument is modified. When `$now` is omitted, it defaults to
the current time in the given date's timezone.

### Tense

By default, the direction of the interval decides how it is phrased: a date in the
past reads "3 days ago", one in the future reads "in 3 days". Ask for `Tense::Plain`
to get the bare span with no direction attached.

```php
use Alexxiy\TimeIntervals\Tense;

echo $formatter->inWords($date, tense: Tense::Plain);    // "3 days"
```

Pin a tense for every call by passing it to the constructor or derive a pinned
instance from an existing one:

```php
$plain = new IntervalFormatter(tense: Tense::Plain);
$plain = $formatter->withTense(Tense::Plain);

echo $plain->inWords(new DateTimeImmutable('-2 hours'));   // "2 hours"
echo $plain->inWords(new DateTimeImmutable('+2 hours'));   // "2 hours"
```

A pinned tense overrides the direction of the interval, so `Tense::Past` will say
"3 days ago" about a date three days from now. `withTense(null)` goes back to
following the interval.

The per-call `tense:` argument beats the pinned one and leaves the instance alone.

### Style

Independently of the tense, the wording can be full or abbreviated:

```php
use Alexxiy\TimeIntervals\Style;

$fiveDaysAgo = new DateTimeImmutable('-5 days');

echo $formatter->inWords($fiveDaysAgo, style: Style::Short);   // "5d ago"
```

The two axes are orthogonal, so every combination is available:

|                  | `Style::Full`   | `Style::Short` |
| ---------------- | --------------- | -------------- |
| `Tense::Past`    | `5 minutes ago` | `5m ago`       |
| `Tense::Future`  | `in 5 minutes`  | `in 5m`        |
| `Tense::Plain`   | `5 minutes`     | `5m`           |

Style is set the same three ways as tense — constructor, `withStyle()`, or a
per-call argument:

```php
$short = new IntervalFormatter(style: Style::Short);
$short = $formatter->withStyle(Style::Short);

$short->inWords(new DateTimeImmutable('-5 days'));   // "5d ago"
$short->inWords(new DateTimeImmutable('+5 days'));   // "in 5d"
```

Abbreviations do not inflect, which is a feature rather than a shortcut: Russian
writes `2 д`, `5 д` and `21 д` alike where the spelled-out noun would need three
different endings.

23 of the 35 languages ship abbreviations. The rest fall back to their full forms,
which is the right answer rather than a gap — Japanese `5日前` is already as short
as it gets. `Locale::Japanese->language()->vocabulary()->abbreviates()` tells you
which is which, and `TRANSLATIONS.md` lists them.

### Languages

Pick one of the bundled languages through the `Locale` enum:

```php
use Alexxiy\TimeIntervals\IntervalFormatter;
use Alexxiy\TimeIntervals\Locale;

echo IntervalFormatter::forLocale(Locale::Russian)->inWords($date);   // "3 дня назад"
echo IntervalFormatter::forLocale(Locale::German)->inWords($date);    // "vor 3 Tagen"
```

`Locale` is a string-backed enum keyed by BCP 47 tag, which makes it easy to drive
from user input without a lookup table of your own:

```php
$locale = Locale::tryFrom($request->getLocale()) ?? Locale::English;

echo IntervalFormatter::forLocale($locale)->inWords($date);
```

`Locale::label()` returns the English name of each locale for building a picker:

```php
foreach (Locale::cases() as $locale) {
    printf('<option value="%s">%s</option>', $locale->value, $locale->label());
}
```

`IntervalFormatter` is immutable, so you can also derive one instance from
another. The pinned tense carries across:

```php
$english = new IntervalFormatter(tense: Tense::Plain);
$polish  = $english->withLocale(Locale::Polish);
```

### Plural forms

Counts are pluralized with the CLDR rules for each language, so the languages that
need more than one plural form get them:

```php
$ru = IntervalFormatter::forLocale(Locale::Russian);

$ru->inWords($twoDaysAgo);          // "2 дня назад"
$ru->inWords($fiveDaysAgo);         // "5 дней назад"
$ru->inWords($twentyOneDaysAgo);    // "21 день назад"
```

Arabic gets its dual, Latvian its form for the teens and the round tens, Czech and
Polish their own splits. See `PluralRule` for the rules and which language uses each.

### "Never"

For records that have no date at all:

```php
echo $formatter->never();   // "Never"
```

### Your own language

A language is a bag of strings: the three tenses of the full style, the word for
"never", and optionally the three tenses of the short style. Implement `Language`
and hand it to `IntervalFormatter`; it does not need to be registered anywhere.

Here is a complete one that signs the interval instead of wording it, which is
handy for logs. Its output is already terse, so it omits `short` and lets the
short style serve these same forms:

```php
use Alexxiy\TimeIntervals\IntervalFormatter;
use Alexxiy\TimeIntervals\Language;
use Alexxiy\TimeIntervals\PluralForms;
use Alexxiy\TimeIntervals\PluralRule;
use Alexxiy\TimeIntervals\TenseSet;
use Alexxiy\TimeIntervals\TenseVocabulary;
use Alexxiy\TimeIntervals\Vocabulary;

final class Signed implements Language
{
    public function vocabulary(): Vocabulary
    {
        return new Vocabulary(
            plurals: PluralRule::OtherOnly,
            full: new TenseSet(
                past: new TenseVocabulary(
                    lessThanAMinute: '-0m',
                    oneMinute:       '-1m',
                    minutes:         new PluralForms('-%sm'),
                    aboutOneHour:    '-1h',
                    hours:           new PluralForms('-%sh'),
                    aboutOneDay:     '-1d',
                    days:            new PluralForms('-%sd'),
                    aboutOneMonth:   '-1mo',
                    months:          new PluralForms('-%smo'),
                    aboutOneYear:    '-1y',
                    years:           new PluralForms('-%sy'),
                ),
                future: new TenseVocabulary(/* +0m, +1m, +%sm, ... */),
                plain:  new TenseVocabulary(/* 0m, 1m, %sm, ... */),
            ),
            never: '-',
        );
    }
}

$signed = new IntervalFormatter(new Signed());

echo $signed->inWords(new DateTimeImmutable('-5 days'));   // "-5d"
echo $signed->inWords(new DateTimeImmutable('+5 days'));   // "+5d"
```

The full version of this example lives in `tests/Fixtures/Signed.php` and is
asserted by `tests/CustomLanguageTest.php`, so it cannot drift from the code.

Every tense of the full style is a required constructor argument, so a language
cannot be written half-finished. `short` is optional; supply it as a whole
`TenseSet` or not at all, which stops a language knowing how to say "5m ago" but
not "in 5m". Within a counted phrase only `other` is required, and the remaining
plural categories fall back to it. For a phrase that genuinely does not inflect,
say so with `PluralForms::invariant('%sd ago')` rather than repeating yourself.

Counted phrases are `sprintf()` patterns and must contain exactly one `%s` —
except the `zero`, `one` and `two` forms, which may spell the number out as a word
instead. Uncounted phrases are used verbatim and are never passed through
`sprintf()`, so a literal percent sign in them is safe.

Note that `Locale` holds languages, not formats: its cases are real BCP 47 tags so
that `Locale::tryFrom($acceptLanguageHeader)` is meaningful. Presentation choices
belong on the `Style` axis, or in your own code.

## How the interval is described

```
  0 secs                    <-> 29 secs                                 less than a minute
  30 secs                   <-> 1 min, 29 secs                          1 minute
  1 min, 30 secs            <-> 44 mins, 29 secs                        [2..44] minutes
  44 mins, 30 secs          <-> 1 hr, 29 mins, 59 secs                  about 1 hour
  1 hr, 30 mins             <-> 23 hrs, 59 mins, 29 secs                [2..23] hours
  23 hrs, 59 mins, 30 secs  <-> 47 hrs, 59 mins, 29 secs                1 day
  47 hrs, 59 mins, 30 secs  <-> 29 days, 23 hrs, 59 mins, 29 secs       [2..29] days
  29 days, 23:59:30         <-> 59 days, 23 hrs, 59 mins, 29 secs       about 1 month
  59 days, 23:59:30         <-> 1 year minus 1 sec                      [2..11] months
  1 year                    <-> 2 years minus 1 sec                     about 1 year
  2 years or more                                                       over N years
```

Everything up to the two-month mark is decided on the exact number of elapsed
seconds. Months and years use the calendar fields of the interval instead because
their length varies.

The rules live in `Classifier`, which is a constructor argument of
`IntervalFormatter`, so they can be swapped out wholesale if the defaults do not
suit you.

## Translation quality

The `past` phrases come from the original contributors to `jimmiw/php-time-ago`.
The `future` and `plain` phrases, the plural forms, and the abbreviations were
added in this package and have not all been through a native speaker.
`TRANSLATIONS.md` says which languages that applies to; corrections are very
welcome.

The plural *rules* themselves are implemented from the published CLDR tables and
are checked against them in `tests/PluralRuleTest.php`.

## Development

The project ships a PHPUnit suite, PHPStan at level `max`, and PSR-12 linting.

```bash
composer install
composer check
```

Or individually:

```bash
composer test
composer analyse
composer lint
composer test:coverage
```

## Credits

This is a fork of [jimmiw/php-time-ago](https://github.com/jimmiw/php-time-ago) by
Jimmi Westerberg, whose translations are the bulk of the value here. The public
API, the rule engine, and the type design were rewritten for this package; see
`CHANGELOG.md` for what changed and why.

## License

MIT. See `LICENSE`.
