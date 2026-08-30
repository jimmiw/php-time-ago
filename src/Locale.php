<?php

declare(strict_types=1);

namespace Alexxiy\TimeIntervals;

/**
 * The languages bundled with this package, keyed by their BCP 47 tag.
 *
 *     Locale::Russian->language();
 *     Locale::tryFrom($acceptLanguageHeader)?->language();
 *
 * Custom languages do not need to appear here: implement {@see Language} and
 * hand it straight to {@see IntervalFormatter}.
 */
enum Locale: string
{
    case Arabic = 'ar';
    case Azerbaijani = 'az';
    case Belarusian = 'be';
    case Bulgarian = 'bg';
    case Catalan = 'ca';
    case ChineseSimplified = 'zh-CN';
    case ChineseTraditional = 'zh-TW';
    case Czech = 'cs';
    case Danish = 'da';
    case Dutch = 'nl';
    case English = 'en';
    case Finnish = 'fi';
    case French = 'fr';
    case Georgian = 'ka';
    case German = 'de';
    case Hindi = 'hi';
    case Hungarian = 'hu';
    case Indonesian = 'id';
    case Italian = 'it';
    case Japanese = 'ja';
    case Korean = 'ko';
    case Latvian = 'lv';
    case NorwegianBokmal = 'nb-NO';
    case Persian = 'fa-IR';
    case Polish = 'pl';
    case Portuguese = 'pt';
    case PortugueseBrazil = 'pt-BR';
    case Russian = 'ru';
    case Slovak = 'sk';
    case Spanish = 'es';
    case Swedish = 'sv-SE';
    case Thai = 'th';
    case Turkish = 'tr';
    case Ukrainian = 'uk';
    case Vietnamese = 'vi';

    /**
     * The bundled translations for this locale.
     */
    #[\NoDiscard]
    public function language(): Language
    {
        return match ($this) {
            self::Arabic => new Translations\Ar(),
            self::Azerbaijani => new Translations\Az(),
            self::Belarusian => new Translations\Be(),
            self::Bulgarian => new Translations\Bg(),
            self::Catalan => new Translations\Ca(),
            self::ChineseSimplified => new Translations\ZhCn(),
            self::ChineseTraditional => new Translations\ZhTw(),
            self::Czech => new Translations\Cs(),
            self::Danish => new Translations\Da(),
            self::Dutch => new Translations\Nl(),
            self::English => new Translations\En(),
            self::Finnish => new Translations\Fi(),
            self::French => new Translations\Fr(),
            self::Georgian => new Translations\Ka(),
            self::German => new Translations\De(),
            self::Hindi => new Translations\Hi(),
            self::Hungarian => new Translations\Hu(),
            self::Indonesian => new Translations\Id(),
            self::Italian => new Translations\It(),
            self::Japanese => new Translations\Ja(),
            self::Korean => new Translations\Ko(),
            self::Latvian => new Translations\Lv(),
            self::NorwegianBokmal => new Translations\NbNo(),
            self::Persian => new Translations\FaIr(),
            self::Polish => new Translations\Pl(),
            self::Portuguese => new Translations\Pt(),
            self::PortugueseBrazil => new Translations\PtBr(),
            self::Russian => new Translations\Ru(),
            self::Slovak => new Translations\Sk(),
            self::Spanish => new Translations\Es(),
            self::Swedish => new Translations\SvSe(),
            self::Thai => new Translations\Th(),
            self::Turkish => new Translations\Tr(),
            self::Ukrainian => new Translations\Uk(),
            self::Vietnamese => new Translations\Vi(),
        };
    }

    /**
     * The English name of the locale, for building language pickers.
     */
    #[\NoDiscard]
    public function label(): string
    {
        return match ($this) {
            self::Arabic => 'Arabic',
            self::Azerbaijani => 'Azerbaijani',
            self::Belarusian => 'Belarusian',
            self::Bulgarian => 'Bulgarian',
            self::Catalan => 'Catalan',
            self::ChineseSimplified => 'Chinese (Simplified)',
            self::ChineseTraditional => 'Chinese (Traditional)',
            self::Czech => 'Czech',
            self::Danish => 'Danish',
            self::Dutch => 'Dutch',
            self::English => 'English',
            self::Finnish => 'Finnish',
            self::French => 'French',
            self::Georgian => 'Georgian',
            self::German => 'German',
            self::Hindi => 'Hindi',
            self::Hungarian => 'Hungarian',
            self::Indonesian => 'Indonesian',
            self::Italian => 'Italian',
            self::Japanese => 'Japanese',
            self::Korean => 'Korean',
            self::Latvian => 'Latvian',
            self::NorwegianBokmal => 'Norwegian Bokmal',
            self::Persian => 'Persian (Iran)',
            self::Polish => 'Polish',
            self::Portuguese => 'Portuguese',
            self::PortugueseBrazil => 'Portuguese (Brazil)',
            self::Russian => 'Russian',
            self::Slovak => 'Slovak',
            self::Spanish => 'Spanish',
            self::Swedish => 'Swedish (Sweden)',
            self::Thai => 'Thai',
            self::Turkish => 'Turkish',
            self::Ukrainian => 'Ukrainian',
            self::Vietnamese => 'Vietnamese',
        };
    }
}
