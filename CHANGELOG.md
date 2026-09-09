# Changelog

All notable changes to this package. This project adheres to
[Semantic Versioning](https://semver.org/).

## 1.1.0

### The interval is now described by the unit it is nearest to

Every threshold is now the point at which the rounded count changes, replacing a
mix of rounded and floored rules inherited from the original. Three defects went
with it.

* **The "about one X" phrases covered `[1X, 2X)`.** "about 1 month" ran from 30
  days to 60, so 59 days — very nearly two months — read "about 1 month". The same
  held for "1 day" (24h to 48h, so 47 hours read "1 day") and "about 1 year" (12
  to 24 months). Each now sits centred on its unit: "about 1 month" is roughly
  29.5 to 45 days, "about 1 day" is 23.5 to 36 hours, "about 1 year" is 12 to 17
  months.
* **Counts floored instead of rounding**, so every value read up to a whole unit
  low: 2m40s was "2 minutes", 3h59m was "3 hours", 91 days was "2 months". They
  now round to the nearest.
* **The month handover was a fixed day count** while months are calendar units, so
  the same calendar delta answered differently from year to year: 1 February to 1
  April read "about 1 month" in 2021 (59 days) but "2 months" in 2024 (60 days).
  Months are now taken from the interval's calendar fields, so it reads
  "2 months" in both.

`over N years` counts whole years elapsed rather than rounded months, so it stays
literally true; an interval of 1 year 11 months reads "over 1 year". This is why
the year bucket floors where every other unit rounds.

The `atLeastTwo()` floor disappeared with the rewrite. It only existed because
buckets began halfway through their first unit; with rounding, a count of one is
unreachable for any unit that has its own singular phrase.

No API changed, and no translation string changed. What changed is which phrase a
given interval selects — if you have snapshot tests over the output, expect them
to move.

### Tests

* Added a monotonicity property test: across every second of the first 55 hours
  and hourly out to 900 days, the described magnitude may never decrease. A
  threshold that overlapped or left a gap fails it with the exact second.
* Added a property test that "over N years" never overstates the interval.
* 7504 tests, still at 100% line coverage.

## 1.0.0

First release of `alexxiy/php-time-intervals`, forked from
[`jimmiw/php-time-ago`](https://github.com/jimmiw/php-time-ago) 3.3.0.

This is a rewrite of the public API rather than a drop-in replacement. Nothing
from the `Westsworld\` namespace survives; the translations do.

### Tense

* `inWords()` now phrases future dates as futures: a date three days out reads
  "in 3 days" rather than "3 days ago". The direction of the interval picks the
  tense on its own; nothing needs configuring.
* Added `Tense::Plain` for the bare span with no direction — "3 days" — which
  suits table columns and durations.
* The tense can be pinned per instance (`new IntervalFormatter(tense: ...)`,
  `withTense()`) or overridden for a single call
  (`inWords($date, tense: Tense::Plain)`). A pinned tense beats the direction of
  the interval; a per-call tense beats both.
* All three tenses are separate strings rather than a prefix bolted onto one, so
  languages that inflect can do it properly. German says `vor 5 Tagen` in the past
  but `5 Tage` plain; Finnish switches from partitive to genitive between past and
  future.

### Style

* Added `Style::Full` and `Style::Short`, orthogonal to `Tense`, so every
  combination is expressible: "5 minutes ago", "in 5 minutes", "5 minutes",
  "5m ago", "in 5m", "5m". Set it on the constructor, with `withStyle()`, or per
  call; it survives `withLanguage()` and `withTense()`.
* Short was deliberately *not* added as a fourth `Tense`. Verbosity and direction
  are independent, so folding one into the other would have made "in 5m"
  inexpressible and would have silently discarded the direction of any interval
  rendered in the short style.
* `Vocabulary` now groups the three tenses into a `TenseSet` per style. The full
  set is required, and the short set is optional, which makes a style
  all-or-nothing: a language cannot know how to say "5m ago" but not "in 5m".
* 23 languages ship abbreviations. The other 12 fall back to their full forms,
  reported by `Vocabulary::abbreviates()`. For the CJK set that fallback is the
  correct answer rather than a gap, since `5日前` is already minimal.
* Added `PluralForms::invariant()` for phrases that do not inflect at any count,
  which is the normal case for abbreviations. It reads as deliberate and keeps
  the completeness check meaningful instead of demanding six copies of one string.

### Plural forms

* Counts are now pluralized with the CLDR rules. Russian says `2 дня`, `5 дней`
  and `21 день` where it previously said `дней` for all three. The same applies to
  Ukrainian, Belarusian, Polish, Czech, Slovak, Latvian and Arabic, and to the
  singular forms of every other language.
* Added `PluralRule`, a nine-case enum implementing the integer branches of the
  CLDR cardinal rules, and `PluralCategory` for its output. The rules are checked
  against the published tables in `tests/PluralRuleTest.php`.
* Added `PluralForms`, which holds one counted phrase in all its forms. Only
  `other` is required — CLDR guarantees every language has it, so lookup always
  has somewhere to land — and the suite checks that each language fills in every
  category its own rule can select.
* Arabic's dual is a word rather than a digit (`منذ يومين`), so `zero`, `one` and
  `two` forms are allowed to omit the `%s`. Every other category must carry it.

### Bug fixes

* The bottom of every counted bucket no longer renders as a singular count. An
  interval of 47h59m30s reported "1 days ago" and 90 seconds reported
  "1 minutes ago", because each bucket starts halfway through its first unit but
  the count came straight from the raw interval field. Counts are now floored at
  two, which is what the documented rules always said (`[2..44] minutes`,
  `[2..29] days`).
* A missing translation key returned an empty string instead of failing. That is
  now impossible to express: see "Type safety" below.
* Arabic rendered every plural count as singular — "months" and "years" had no
  `%s` placeholder at all, so five months read as "a month ago". Both patterns
  now carry the count.
* Several inherited past-tense strings were wrong rather than merely missing:
  "about one day" was the word for *yesterday* in seven languages even though the
  bucket spans 24 to 48 hours, Italian said "now" for "less than a minute",
  Norwegian had a typo in `years`, and Indonesian's past strings were bare
  durations with no "ago" at all. `TRANSLATIONS.md` lists every change.
* `never` was missing from 17 of the 35 languages and was unreachable from the
  public API besides. It is now present everywhere and exposed as
  `IntervalFormatter::never()`. The 17 newly added strings are machine-assisted
  and would benefit from native-speaker review.
* Intervals not produced by `DateTimeInterface::diff()` were silently classified
  as "less than a minute", because `DateInterval::$days` is `false` on hand-built
  intervals. `Classifier` now throws `InvalidIntervalException`.

### Type safety

* `declare(strict_types=1)` in every file.
* Every parameter, return, property, and class constant is typed. PHPStan runs at
  level `max` with no baseline and no ignored errors.
* Translations moved from an untyped `array<string, string>` to `Vocabulary`, a
  `final readonly` class holding a `TenseVocabulary` per tense, each of whose
  eleven phrases is a required constructor argument. A language cannot be
  constructed partially translated, so the entire "missing key" class of bugs is
  gone at compile time.
* `Phrase` is an enum, and `TenseVocabulary::pattern()` is an exhaustive `match`,
  so adding a phrase is a compile-time error everywhere it needs handling. The
  same holds for `Tense`, `PluralCategory` and `PluralRule`.
* `Locale` is a string-backed enum of all 35 bundled languages, keyed by BCP 47
  tag, replacing "know the class name and hope you spelled it right".

### API changes

* Namespace is now `Alexxiy\TimeIntervals\`, mapped to `src/`. The redundant
  `src/Westsworld/TimeAgo/` nesting is gone.
* The entry class is `IntervalFormatter`, not `TimeAgo`. The old name described
  only one of the three tenses it now renders; "ago" and "in" are both framings of
  an interval, and `Tense::Plain` has no framing at all.
* `Language` is an interface with a single `vocabulary()` method rather than an
  abstract class carrying the rule engine. Languages are data; rules are code.
* The rule engine moved to `Classifier`, which is injectable into
  `IntervalFormatter`, so the thresholds can be replaced without forking. Its eleven mutually recursive
  `isLessThanNHoursNMinsNSecs()` predicates — each of which called the previous
  one and negated it — collapsed into one ordered `match` over elapsed seconds.
* `IntervalFormatter` is `final readonly`, with the language resolved once in the
  constructor instead of lazily on every call. `withLanguage()` and
  `withLocale()` return copies.
* Added `IntervalFormatter::forLocale()`, `IntervalFormatter::never()`,
  `IntervalFormatter::withTense()`, `IntervalFormatter::tense()`, `Locale::label()`.
* Removed `Westsworld\TimeAgo::dateDifference()`, deprecated since 3.0.0; use
  `DateTimeInterface::diff()`.
* Removed `Westsworld\TimeAgo::inWordsFromStrings()`; construct a `DateTimeImmutable`
  yourself so parse failures surface at the call site.
* Removed `Westsworld\TimeAgo::create()` and the public `Westsworld\TimeAgo::getNow()`.
* Language classes with underscores were renamed to satisfy PSR-1: `Fa_IR` to
  `FaIr`, `nb_NO` to `NbNo`, `Pt_BR` to `PtBr`, `Sv_SE` to `SvSe`, `Zh_CN` to
  `ZhCn`, `Zh_Tw` to `ZhTw`. `Ge` was renamed to `Ka`, the ISO 639-1 code for
  Georgian.
* Dropped the `En_Short` language. It is a presentation format rather than a
  language: `en-short` is not a valid BCP 47 tag, so it could never come out of an
  Accept-Language header, and it was the only entry whose past and plain forms
  were correctly identical — which had cost the test suite its one exemption. Its
  strings are now the worked example in the README's "Your own language" section,
  compiled and asserted by `tests/CustomLanguageTest.php`. That leaves `Locale`
  holding 35 real languages and nothing else.

### Tooling

* Requires PHP 8.5.
* PHPUnit 12 with a valid configuration file. The previous `phpunit.xml` still
  used the PHPUnit 8 schema — `<filter><whitelist>` and `<logging type="...">` —
  which PHPUnit 10 ignores.
* 7478 tests covering every rule boundary, every plural rule branch, and every
  phrase of every language in every tense and style, at 100% line coverage. The previous
  suite had a test named `te1stInit` that never ran, a `testIsAlive` that
  asserted `true`, and depended on the wall clock.
* No coverage report is configured in `phpunit.xml`. A configured report makes
  PHPUnit collect coverage on every run, and on a machine with neither xdebug nor
  pcov that becomes a runner warning which `failOnWarning` escalates into running
  no tests at all. `composer test:coverage` asks for it explicitly instead.
* Travis CI replaced with GitHub Actions.
* PHPStan and PSR-12 linting wired up as `composer check`.

---

# Changelog of jimmiw/php-time-ago

Kept for the history of the translations.

### 3.2.3
* Added a "short" english translation, thanks to @MoPaMo

### 3.2.2
* Update to TR translation to remove three dots from "years" translation, thanks @ozgurg 

### 3.2.1
* Unittest update around leap years

### 3.2.0
* Added Italian translation, thanks to @vegagame
* Added Norweigan translation, thanks to @zreedeecom

### 3.1.1
* Updated a classname psr-4 bug in Zh_Tw, since the file was named Zh_TW.
* Updated php requirement to >=7.0.0, since we are using return types anyways.
* Updated return type in phpdoc on inWordsFromStrings()
* Removed En import in TimeAgo as well.

### 3.1.0
* Changed from psr-0 to psr-4, since some language classes could not be loaded properly
* Added support for DateTimeImmutable objects, thanks to @xtreamwayz
* Added Indonesian translation, thanks to @dhutapratama

### 3.0.6
* Fixed #79 where 1h30m would be 1 hours ago instead of 2 hours ago

### 3.0.5
* Cs translation more correct, thanks @MartkCz

### 3.0.4
* Fixed a bug with isLessThan44Min29Secs, thanks @ruben-haegeman
* Added Polish translations, thanks to @biegacz1

### 3.0.3
* Updated Pt-BR, thanks to @ivesbrito

### 3.0.2
* updated phpdoc for constructor

### 3.0.1
* Typo fixes, thanks @jlratwil
* Did some changes to composer, so php 7.0 can also be tested on travis.
* Removed hhvm and 5.6 from travis, since phpunit cannot go that low.

### 3.0.0
* Redid most of the code, to work with DateTime objects instead.
* Renamed the old inWords method to inWordsFromStrings, so that still works.
* Added a new inWords method to accept DateTime instances.
* Translations are now classes, inheriting from the Language class.
* Fixed the inWords unit tests, to use inWordsFromStrings.
* Added a few unit tests for the new inWords, since both inWords and inWordsFromStrings use the same internals.
* Added a test for changing language.
* Moved changelog things to this file (changelog.md) instead.
* Updated the Readme, to show how to work with the module.

### 2.0.5
* Added Bulgarian translation, thanks to @ironsmile
* Added Latvian translation, thanks to @intarstudents
* Updated French translation, thanks to a team of two? @ArthurHoaro and @blaugueux
* Updated Portuguese translations, thanks to @ivesbrito

### 2.0.4
* Added Catalan translation, thanks to @Ajenbo and @esrefesen

### 2.0.3
* Added Swedish translation, thanks to @khromov
* Added Gregorian translation, thanks to @nikopeikrishvili
* Added Vietnamese translation, thanks to @baivong

### 2.0.2

* Removed user specific files from .gitignore
* Using strict comparison
* Added a method for rounding the number of months to use

### 2.0.1

* Fixed a file encoding problem on the korean translation
* Added a never translate on the turkish translation (thanks to @esrefesen)

### 2.0.0

Now using namespaces to handle the source.

* Added Westsworld namespace to the TimeAgo project.
* Removed the function "timeAgoInWords", since i really didn't like having it around.
* Removed the very deprecated WWDateTime class.
* Fixed unittests after namespace introduction.
* Updated composer.lock
* Updated .travis.yml

### 1.1.0

### The interval is now described by the unit it is nearest to

Every threshold is now the point at which the rounded count changes, replacing a
mix of rounded and floored rules inherited from the original. Three defects went
with it.

* **The "about one X" phrases covered `[1X, 2X)`.** "about 1 month" ran from 30
  days to 60, so 59 days — very nearly two months — read "about 1 month". The same
  held for "1 day" (24h to 48h, so 47 hours read "1 day") and "about 1 year" (12
  to 24 months). Each now sits centred on its unit: "about 1 month" is roughly
  29.5 to 45 days, "about 1 day" is 23.5 to 36 hours, "about 1 year" is 12 to 17
  months.
* **Counts floored instead of rounding**, so every value read up to a whole unit
  low: 2m40s was "2 minutes", 3h59m was "3 hours", 91 days was "2 months". They
  now round to the nearest.
* **The month handover was a fixed day count** while months are calendar units, so
  the same calendar delta answered differently from year to year: 1 February to 1
  April read "about 1 month" in 2021 (59 days) but "2 months" in 2024 (60 days).
  Months are now taken from the interval's calendar fields, so it reads
  "2 months" in both.

`over N years` counts whole years elapsed rather than rounded months, so it stays
literally true; an interval of 1 year 11 months reads "over 1 year". This is why
the year bucket floors where every other unit rounds.

The `atLeastTwo()` floor disappeared with the rewrite. It only existed because
buckets began halfway through their first unit; with rounding, a count of one is
unreachable for any unit that has its own singular phrase.

No API changed, and no translation string changed. What changed is which phrase a
given interval selects — if you have snapshot tests over the output, expect them
to move.

### Tests

* Added a monotonicity property test: across every second of the first 55 hours
  and hourly out to 900 days, the described magnitude may never decrease. A
  threshold that overlapped or left a gap fails it with the exact second.
* Added a property test that "over N years" never overstates the interval.
* 7504 tests, still at 100% line coverage.

## 1.0.0

Introducing exceptions (so remember to handle them) and removed the old way of overloading the translations
path. Also renamed a few methods.
Both things breaks the current API, so I've bumped it to version 1.0.0

* An exception is now thrown, if a translation file cannot be added.
* An exception is now thrown, if the translation file is empty.
* Made timechecks a lot easier to read, by moving them into a "isLessThanX" method.
* Added unittests to test the loading of translations.
* Added unittest for dateDifference.
* Removed: _loadTranslations($language, $alternativePath), you can no longer use alternativePath, if extending the
component. Instead I added a define called TIMEAGO_TRANSLATION_PATH, which can be used to override the translations path
* Renamed _loadTranslations to loadTranslations
* Renamed _translate to translate

### 0.4.15
Added Turkish translation (@esrefesen), and Thai (@jaideejung007) and iranian- Farsi(Persian) (@datamweb) and French (@lamberttraccard)

### 0.4.14
Added Arabic translation (@xc0d3rz)
### 0.4.13
@jmontoyaa fixed a timezone setting bug
### 0.4.12
Merged #18, #33 (you can now supply an alternative translations folder), #35 and Added Czech (@misaon)
### 0.4.11
Changes to French translation (@souhailmerroun). Added Russian and Ukranian translations (@akavolkol)
### 0.4.10
Added Korean and Finnish translations (thanks to @easylogic and @tk1sul1)
### 0.4.9
Added Spanish and Hungarian and Brazilian Portuguese (thanks to @khrizt and @technodelight and @gugoan)
### 0.4.8
Added French and Japanese and Taiwanese translations (thanks to @barohatoum and @hotengchang)
### 0.4.7
Changes to fix annoying "floor" bugs.
### 0.4.6
Added Dutch and Chinese translations (thanks to @NielsdeBlaauw and @su-xiaolin)
### 0.4.5
Fix for wrongly named variable - patch from @rimager
### 0.4.4
Changed the previous fix, since it caused a problem with the "Scheme" at the start of this document. "about 1 hour ago" is between 44mins30secs and 89mins29secs.
### 0.4.3
Added a fix for "about 1 hour ago", which would yield "1 hours ago" if the time was 1hour 30minutes. Giving a pluralization error.
### 0.4.2
Added German translations .
### 0.4.1
Added "ago" to the end of the translations, so the texts now read "about 1 hour ago".
### 0.4.0
Added translations (Danish and English) to the plugin.

# The old way of doing things.

Just if you wanted to try out the old "time ago" class, I've kept it in the project.
It will eventually be deleted, but hey, go have fun with it. Perhaps even extend it etc.
Bear in mind though, that the new DateTime::diff in PHP version 5.3.0 will eventually
replace it completely. (PHP 5.3.0 DateTime::diff link: http://www.php.net/manual/en/datetime.diff.php)
