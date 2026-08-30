# Translations

35 languages ship with this package. This file records where each one's strings
came from, so you know what has been reviewed by a speaker and what has not.

## Where the strings come from

**Past tense** — inherited from the contributors to
[`jimmiw/php-time-ago`](https://github.com/jimmiw/php-time-ago), which is the
reason this fork exists. A handful was corrected; see "Changes to inherited
strings" below.

**Future and plain tenses** — new in this package, for all 35 languages.

**Abbreviations** — new in this package, for the 23 languages with a convention
worth shipping. See "Short forms" below.

**Plural forms** — new in this package, for the 28 languages that need more than
one; the other seven use a single form for every count. The *rules* deciding which form applies are implemented from the published
CLDR tables and are verified against them in `tests/PluralRuleTest.php`; it is the
*strings* that want a human eye.

**"Never"** — 17 languages had no translation for it and were given one here:
ar, cs, da, de, es, fi, fr, hu, ja, ko, nl, pt-BR, ru, sk, uk, zh-CN, zh-TW.

## Short forms

`Style::Short` needs one thing per language beyond what the full style already
provides: an abbreviation for each of minute, hour, day, month, and year. The
direction markers ("ago", "in", "vor", "назад") are reused from the full forms, so
the short style inherits whatever those got right.

These 23 abbreviate:

`be`, `bg`, `ca`, `cs`, `da`, `de`, `en`, `es`, `fi`, `fr`, `id`, `it`, `lv`,
`nb-NO`, `nl`, `pl`, `pt`, `pt-BR`, `ru`, `sk`, `sv-SE`, `tr`, `uk`.

These 12 serve their full forms for the short style:

`ar`, `az`, `fa-IR`, `hi`, `hu`, `ja`, `ka`, `ko`, `th`, `vi`, `zh-CN`, `zh-TW`.

Two different reasons for that list. For `ja`, `ko`, `zh-CN`, `zh-TW` there is
nothing to shorten — `5日前` is already minimal. For the others there is either no
settled abbreviation convention, or abbreviating breaks the grammar: Hungarian
`5 napja` carries the past tense in the noun's own suffix, so clipping the noun
loses it. Adding any of them is a one-line entry in the language class.

`Vocabulary::abbreviates()` reports which case a language is in.

## Review status

Every string in every language was read through once more before 1.0.0, and the
defects that pass found are listed under "Corrections" below. What the pass could
not do is confirm idiom for languages where the right answer is a matter of a
speaker's ear rather than of grammar. Those are called out here so nobody assumes
more verification than actually happened.

The test suite guarantees the structural half regardless: every phrase in every
tense and style, every plural category the language's rule can select, and a
well-formed `sprintf()` pattern throughout.

### Worth a speaker's eye

| Locale  | What to look at |
| ------- | --------------- |
| `ja`    | `%s年以上後` for the future "over N years". It parses, but `先` may read better than `後` here. |
| `hi`    | Future "over N years" is `%s साल से ज़्यादा में`, which is clumsy. A better phrasing is welcome. |
| `ka`    | Future "over N years", `%s წელზე მეტში`. |
| `de`    | `Tg.` for Tage is attested but dated; some UIs prefer `T.` |
| `id`    | `mnt`, `hr`, `bln`, `thn` — confirm these are the abbreviations you would use. |
| `fi`    | Past uses the partitive (`5 päivää sitten`), future the genitive (`5 päivän kuluttua`). |
| `lv`    | The new short forms (`pirms 5 d.`) and the `zero` form used for 10, 20 and the teens. |
| `ar`    | Whether `بعد` is the future preposition you want, and the 11-99 accusative singular. |

### Checked and believed correct

Grammar-level checks that were made and hold: the Slavic case government after
each preposition, the Czech and Slovak instrumental in the past versus accusative
in the future, the Latvian genitive singular against the dative plural, the German
dative in `vor 5 Tagen` against the nominative in the bare `5 Tage`, the Arabic
dual in nominative (`دقيقتان`) when bare and genitive (`دقيقتين`) after `منذ`, and
the Turkic and CJK languages not inflecting after a numeral at all.

## Corrections

Found by the pre-1.0.0 review pass:

* `ru` — the future "over N years" used the genitive after `через`, which takes
  the accusative. It read `больше чем через 21 года` and `больше чем через 22 лет`;
  it now reads `21 год` and `22 года`. Ukrainian and Belarusian already had this
  right, which is what made the Russian stand out.
* `es` — the short month form had no plural, rendering `hace 5 mes`. Now
  `hace 5 meses`.
* `it` — the short month form was `mes`, which is not an Italian word. Now
  `mese` / `mesi`.
* `pt`, `pt-BR` — the short month form was `mes.`, not a Portuguese abbreviation.
  Now `mês` / `meses`.
* `da` — the short month form used the plural `mdr` for the singular too, giving
  `~1 mdr`. Now `~1 md` against `5 mdr`.
* `cs`, `pl` — the short year form spelled out `let` / `lat` next to an abbreviated
  `r`. Both are now `l`, matching how the languages abbreviate elsewhere.
* `ru`, `uk`, `be` — the short day form was `д`; `дн` is the usual abbreviation.
* `vi` — the future doubled its marker as `trong ... nữa`. Now just `5 phút nữa`.
* `lv` — gained short forms; its abbreviations (`min.`, `st.`, `d.`, `mēn.`, `g.`)
  are settled enough to ship.

## Changes to inherited strings

Beyond adding tenses and plurals, these past-tense strings were changed:

* `ar` — `months` and `years` had no `%s`, so every count read as a singular
  ("a month ago" for five months). Both now carry the count.
* `nb-NO` — `years` read `over %s år sidenn`; corrected to `siden`.
* `ru`, `uk`, `be`, `pl`, `it`, `az`, `ka` — the "about one day" phrase was the
  word for *yesterday* (`вчера`, `wczoraj`, `ieri`, `dünən`, `გუშინ`). That bucket
  covers everything from 24 to 48 hours, which is often not yesterday, so it now
  reads "one day ago".
* `it` — "less than a minute" was `adesso` ("now"); it now says less than a minute.
* `fi` — "about one day" was `1 päivä`, missing `sitten`.
* `id` — the past strings were bare durations (`5 hari`); they now say
  `5 hari yang lalu`. The bare forms live in the plain tense, where they belong.
* `pt` — mixed `há ...` and `... atrás`; standardised on `há`. The `atrás` style is
  kept for `pt-BR`, which used it throughout.
* `ko` — `months` used `%s달 전`; changed to the more usual `%s개월 전`.
* `en-short` — dropped as a locale. It is a presentation format, not a language:
  the tag is not valid BCP 47, and it was the only entry where the past and the
  bare span were correctly identical. Its strings live on as the worked example in
  the README's "Your own language" section, with the `~y` typo in `aboutOneYear`
  corrected to `~1y`.

## Adding or fixing a language

Edit the class in `src/Translations/`, then:

```bash
composer check
```

The suite will tell you if a plural category is missing, if a `%s` is missing or
doubled, if the tenses were filled in by copying one column across, or if the class
is not reachable through the `Locale` enum.
