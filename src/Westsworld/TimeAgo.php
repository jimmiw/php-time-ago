<?php

namespace Westsworld;

// just making life easier :)
use Exception;
use DateTime;
// importing the language class
use Westsworld\TimeAgo\Language;
use Westsworld\TimeAgo\Translations\En;

/**
 * This class can help you find out just how much time has passed between
 * two dates.
 *
 * It has two functions you can call:
 * inWords() which gives you the "time ago in words" between two dates.
 * dateDifference() which returns an array of years,months,days,hours,minutes and
 * seconds between the two dates.
 *
 * @author jimmiw
 * @since 0.2.0 (2010/05/05)
 * @site http://github.com/jimmiw/php-time-ago
 */
class TimeAgo
{
    /** @var Language */
    private $language;

    /**
     * TimeAgo constructor.
     * @param null|DateTimeZone $timezone the timezone to use (uses system if none is given)
     * @param string $language the language to use (defaults to 'en' for english)
     */
    public function __construct(Language $language = null)
    {
        $this->language = $language;
    }

    public static function create(Language $language)
    {
        return new self($language);
    }

    /**
     * Fetches the current language set.
     *
     * @return Language
     */
    protected function getLanguage(): Language
    {
        if (! empty($this->language)) {
            return $this->language;
        }

        $this->language = new \Westsworld\TimeAgo\Translations\En();

        return $this->language;
    }

    /**
     * Fetches the different between $past and $now in a spoken format.
     * @param DateTime $past the past date to use
     * @param DateTime $now the current time, defaults to now, using timezone from $past
     * @return string the time difference in a spoken format, e.g. 1 day ago
     */
    public function inWords(DateTime $past, DateTime $now = null)
    {
        // ensuring that "now" is a DateTime object, using the past's timeZone
        // if needed, to create a new now object.
        $now = $this->getNow($past, $now);

        return $this->getLanguage()->inWords($past, $now);
    }

    /**
     * Handling the old functionality, by taking two string dates and returning them
     * in a spoken format.
     * @NOTE: both past and now should be parseable by strtotime
     *
     * @param string $past
     * @param string $now
     * @return void
     */
    public function inWordsFromStrings(string $past, string $now = 'now')
    {
        return $this->getLanguage()->inWords(new DateTime($past), new DateTime($now));
    }

    /**
     * Fetches the date difference between the two given dates.
     *
     * @param DateTime $past the "past" time to parse
     * @param DateTime $now the "now" time to parse
     * @return array the difference in dates, using the two dates
     * @deprecated 3.0.0 this method is not really needed anymore, since DateTime can do it
     */
    public function dateDifference(DateTime $past, DateTime $now = null)
    {
        $now = $this->getNow($past, $now);

        $difference = $past->diff($now);

        return [
            "years" => $difference->y,
            "months" => $difference->m,
            "days" => $difference->d,
            "hours" => $difference->h,
            "minutes" => $difference->i,
            "seconds" => $difference->s,
        ];
    }

    /**
     * Fetches the given $now variable, but initializes it if it's null
     *
     * @param DateTime $past the past tiem
     * @param DateTime $now the now to use or initialize
     * @return DateTime $now initialized, if it was not, else the original object
     */
    public function getNow(DateTime $past, DateTime $now = null): DateTime
    {
        // handles cases where $now is null
        if (null === $now) {
            // using the timezone from the "past" object
            $now = new DateTime('now', $past->getTimezone());
        }

        return $now;
    }
}
