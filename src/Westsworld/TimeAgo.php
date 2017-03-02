<?php

namespace Westsworld;

// just making life easier :)
use Exception;

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
    // defines the number of seconds per "unit"
    private $secondsPerMinute = 60;
    private $secondsPerHour = 3600;
    private $secondsPerDay = 86400;
    private $secondsPerMonth = 2592000;
    private $secondsPerYear = 31536000; // 31622400 seconds on leap years though...
    private $timezone;
    private $previousTimezone;

    // translations variables
    private static $language;
    private static $timeAgoStrings = null;

    /**
     * TimeAgo constructor.
     * @param null|DateTimeZone $timezone the timezone to use (uses system if none is given)
     * @param string $language the language to use (defaults to 'en' for english)
     */
    public function __construct($timezone = null, $language = 'en')
    {
        // loads the translation files
        self::loadTranslations($language);
        // storing the current timezone
        $this->timezone = $timezone;
    }

    /**
     * Fetches the different between $past and $now in a spoken format.
     * NOTE: both past and now should be parseable by strtotime
     * @param string $past the past date to use
     * @param string $now the current time, defaults to now (can be an other time though)
     * @return string the difference in spoken format, e.g. 1 day ago
     */
    public function inWords($past, $now = "now")
    {
        // sets the default timezone
        $this->changeTimezone();
        // finds the past in datetime
        $past = strtotime($past);
        // finds the current datetime
        $now = strtotime($now);

        // creates the "time ago" string. This always starts with an "about..."
        $timeAgo = "";

        // finds the time difference
        $timeDifference = $now - $past;

        // rule 0
        // $past is null or empty or ''
        if ($this->isPastEmpty($past)) {
            $timeAgo = $this->translate('never');
        }
        // rule 1
        // less than 29secs
        else if ($this->isLessThan29Seconds($timeDifference)) {
            $timeAgo = $this->translate('lessThanAMinute');
        }
        // rule 2
        // more than 29secs and less than 1min29secss
        else if ($this->isLessThan1Min29Seconds($timeDifference)) {
            $timeAgo = $this->translate('oneMinute');
        }
        // rule 3
        // between 1min30secs and 44mins29secs
        else if ($this->isLessThan44Min29Secs($timeDifference)) {
            $minutes = round($timeDifference / $this->secondsPerMinute);
            $timeAgo = $this->translate('lessThanOneHour', $minutes);
        }
        // rule 4
        // between 44mins30secs and 1hour29mins59secs
        else if ($this->isLessThan1Hour29Mins59Seconds($timeDifference)) {
            $timeAgo = $this->translate('aboutOneHour');
        }
        // rule 5
        // between 1hour29mins59secs and 23hours59mins29secs
        else if ($this->isLessThan23Hours59Mins29Seconds($timeDifference)) {
            $hours = round($timeDifference / $this->secondsPerHour);
            $timeAgo = $this->translate('hours', $hours);
        }
        // rule 6
        // between 23hours59mins30secs and 47hours59mins29secs
        else if ($this->isLessThan47Hours59Mins29Seconds($timeDifference)) {
            $timeAgo = $this->translate('aboutOneDay');
        }
        // rule 7
        // between 47hours59mins30secs and 29days23hours59mins29secs
        else if ($this->isLessThan29Days23Hours59Mins29Seconds($timeDifference)) {
            $days = round($timeDifference / $this->secondsPerDay);
            $timeAgo = $this->translate('days', $days);
        }
        // rule 8
        // between 29days23hours59mins30secs and 59days23hours59mins29secs
        else if ($this->isLessThan59Days23Hours59Mins29Secs($timeDifference)) {
            $timeAgo = $this->translate('aboutOneMonth');
        }
        // rule 9
        // between 59days23hours59mins30secs and 1year (minus 1sec)
        else if ($this->isLessThan1Year($timeDifference)) {
            $months = round($timeDifference / $this->secondsPerMonth);
            // if months is 1, then set it to 2, because we are "past" 1 month
            if ($months == 1) {
                $months = 2;
            }

            $timeAgo = $this->translate('months', $months);
        }
        // rule 10
        // between 1year and 2years (minus 1sec)
        else if ($this->isLessThan2Years($timeDifference)) {
            $timeAgo = $this->translate('aboutOneYear');
        }
        // rule 11
        // 2years or more
        else {
            $years = floor($timeDifference / $this->secondsPerYear);
            $timeAgo = $this->translate('years', $years);
        }

        $this->restoreTimezone();

        return $timeAgo;
    }

    /**
     * Fetches the date difference between the two given dates.
     * NOTE: both past and now should be parseable by strtotime
     *
     * @param string $past the "past" time to parse
     * @param string $now the "now" time to parse
     * @return array the difference in dates, using the two dates
     */
    public function dateDifference($past, $now = "now")
    {
        // initializes the placeholders for the different "times"
        $seconds = 0;
        $minutes = 0;
        $hours = 0;
        $days = 0;
        $months = 0;
        $years = 0;

        // sets the default timezone
        $this->changeTimezone();

        // finds the past in datetime
        $past = strtotime($past);
        // finds the current datetime
        $now = strtotime($now);

        // calculates the difference
        $timeDifference = $now - $past;

        // starts determining the time difference
        if ($timeDifference >= 0) {
            switch ($timeDifference) {
                // finds the number of years
                case ($timeDifference >= $this->secondsPerYear):
                    // uses floor to remove decimals
                    $years = floor($timeDifference / $this->secondsPerYear);
                    // saves the amount of seconds left
                    $timeDifference = $timeDifference - ($years * $this->secondsPerYear);

                // finds the number of months
                case ($timeDifference >= $this->secondsPerMonth && $timeDifference <= ($this->secondsPerYear - 1)):
                    // uses floor to remove decimals
                    $months = floor($timeDifference / $this->secondsPerMonth);
                    // saves the amount of seconds left
                    $timeDifference = $timeDifference - ($months * $this->secondsPerMonth);

                // finds the number of days
                case ($timeDifference >= $this->secondsPerDay && $timeDifference <= ($this->secondsPerYear - 1)):
                    // uses floor to remove decimals
                    $days = floor($timeDifference / $this->secondsPerDay);
                    // saves the amount of seconds left
                    $timeDifference = $timeDifference - ($days * $this->secondsPerDay);

                // finds the number of hours
                case ($timeDifference >= $this->secondsPerHour && $timeDifference <= ($this->secondsPerDay - 1)):
                    // uses floor to remove decimals
                    $hours = floor($timeDifference / $this->secondsPerHour);
                    // saves the amount of seconds left
                    $timeDifference = $timeDifference - ($hours * $this->secondsPerHour);

                // finds the number of minutes
                case ($timeDifference >= $this->secondsPerMinute && $timeDifference <= ($this->secondsPerHour - 1)):
                    // uses floor to remove decimals
                    $minutes = floor($timeDifference / $this->secondsPerMinute);
                    // saves the amount of seconds left
                    $timeDifference = $timeDifference - ($minutes * $this->secondsPerMinute);

                // finds the number of seconds
                case ($timeDifference <= ($this->secondsPerMinute - 1)):
                    // seconds is just what there is in the timeDifference variable
                    $seconds = $timeDifference;
            }
        }

        $this->restoreTimezone();

        $difference = [
            "years" => $years,
            "months" => $months,
            "days" => $days,
            "hours" => $hours,
            "minutes" => $minutes,
            "seconds" => $seconds,
        ];

        return $difference;
    }

    /**
     * Translates the given $label, and adds the given $time.
     * @param string $label the label to translate
     * @param string $time the time to add to the translated text.
     * @return string the translated label text including the time.
     */
    protected function translate($label, $time = '')
    {
        // handles a usecase introduced in #18, where a new translation was added.
        // This would cause an array-out-of-bound exception, since the index does not
        // exist in most translations.
        if (!isset(self::$timeAgoStrings[$label])) {
            return '';
        }

        return sprintf(self::$timeAgoStrings[$label], $time);
    }

    /**
     * Loads the translations into the system.
     * NOTE: Removed alternativePath in 0.6.0, instead, define that path using TIMEAGO_TRANSLATION_PATH
     * @param string $language the language iso to use
     * @throws Exception if a language file cannot be found or there are no translations
     */
    protected static function loadTranslations($language)
    {
        // no time strings loaded? load them and store it all in static variables
        if (self::$timeAgoStrings == null || self::$language != $language) {
            // default path to the translations
            $basePath = __DIR__ . '/../../translations/';

            // adding the possibility for an alternate translations path
            if (defined('TIMEAGO_TRANSLATION_PATH')) {
                $basePath = TIMEAGO_TRANSLATION_PATH;
            }

            // setting the translation path
            $path = $basePath . $language . '.php';

            if (! file_exists($path)) {
                throw new Exception("No translation file found at: " . $path);
            }

            // loads the translation file
            include($path);

            // throws an exception, if the are no translations, in the currently loaded translation file
            if (! isset($timeAgoStrings)) {
                throw new Exception('No translations found in translation file at: ' . $path);
            }

            // storing the time strings in the current object
            self::$timeAgoStrings = $timeAgoStrings;
        }

        // storing the language
        self::$language = $language;
    }

    /**
     * Changes the timezone
     */
    protected function changeTimezone()
    {
        $this->previousTimezone = false;
        if ($this->timezone) {
            $this->previousTimezone = date_default_timezone_get();
            date_default_timezone_set($this->timezone);
        }
    }

    /**
     * Restores a previous timezone
     */
    protected function restoreTimezone()
    {
        if ($this->previousTimezone) {
            date_default_timezone_set($this->previousTimezone);
            $this->previousTimezone = false;
        }
    }

    /**
     * Checks if the given past is empty
     * @param string $past the "past" to check
     * @return bool true if empty, else false
     */
    private function isPastEmpty($past)
    {
        return $past === '' || is_null($past) || empty($past);
    }

    /**
     * Checks if the time difference is less than 29seconds
     * @param int $timeDifference the time difference in seconds
     * @return bool
     */
    private function isLessThan29Seconds($timeDifference)
    {
        return $timeDifference <= 29;
    }

    /**
     * Checks if the time difference is less than 1min 29seconds
     * @param int $timeDifference the time difference in seconds
     * @return bool
     */
    private function isLessThan1Min29Seconds($timeDifference)
    {
        return $timeDifference >= 30 && $timeDifference <= 89;
    }

    /**
     * Checks if the time difference is less than 44mins 29seconds
     * @param int $timeDifference the time difference in seconds
     * @return bool
     */
    private function isLessThan44Min29Secs($timeDifference)
    {
        return $timeDifference >= 90 &&
        $timeDifference <= (($this->secondsPerMinute * 44) + 29);
    }

    /**
     * Checks if the time difference is less than 1hour 29mins 59seconds
     * @param int $timeDifference the time difference in seconds
     * @return bool
     */
    private function isLessThan1Hour29Mins59Seconds($timeDifference)
    {
        return $timeDifference >= (($this->secondsPerMinute * 44) + 30)
        &&
        $timeDifference <= ($this->secondsPerHour + ($this->secondsPerMinute * 29) + 59);
    }

    /**
     * Checks if the time difference is less than 23hours 59mins 29seconds
     * @param int $timeDifference the time difference in seconds
     * @return bool
     */
    private function isLessThan23Hours59Mins29Seconds($timeDifference)
    {
        return $timeDifference >= (
            $this->secondsPerHour +
            ($this->secondsPerMinute * 30)
        )
        &&
        $timeDifference <= (
            ($this->secondsPerHour * 23) +
            ($this->secondsPerMinute * 59) +
            29
        );
    }

    /**
     * Checks if the time difference is less than 27hours 59mins 29seconds
     * @param int $timeDifference the time difference in seconds
     * @return bool
     */
    private function isLessThan47Hours59Mins29Seconds($timeDifference)
    {
        return $timeDifference >= (
            ($this->secondsPerHour * 23) +
            ($this->secondsPerMinute * 59) +
            30
        )
        &&
        $timeDifference <= (
            ($this->secondsPerHour * 47) +
            ($this->secondsPerMinute * 59) +
            29
        );
    }

    /**
     * Checks if the time difference is less than 29days 23hours 59mins 29seconds
     * @param int $timeDifference the time difference in seconds
     * @return bool
     */
    private function isLessThan29Days23Hours59Mins29Seconds($timeDifference)
    {
        return $timeDifference >= (
            ($this->secondsPerHour * 47) +
            ($this->secondsPerMinute * 59) +
            30
        )
        &&
        $timeDifference <= (
            ($this->secondsPerDay * 29) +
            ($this->secondsPerHour * 23) +
            ($this->secondsPerMinute * 59) +
            29
        );
    }

    /**
     * Checks if the time difference is less than 59days 23hours 59mins 29seconds
     * @param int $timeDifference the time difference in seconds
     * @return bool
     */
    private function isLessThan59Days23Hours59Mins29Secs($timeDifference)
    {
        return $timeDifference >= (
            ($this->secondsPerDay * 29) +
            ($this->secondsPerHour * 23) +
            ($this->secondsPerMinute * 59) +
            30
        )
        &&
        $timeDifference <= (
            ($this->secondsPerDay * 59) +
            ($this->secondsPerHour * 23) +
            ($this->secondsPerMinute * 59) +
            29
        );
    }

    /**
     * Checks if the time difference is less than 1 year
     * @param int $timeDifference the time difference in seconds
     * @return bool
     */
    private function isLessThan1Year($timeDifference)
    {
        return $timeDifference >= (
            ($this->secondsPerDay * 59) +
            ($this->secondsPerHour * 23) +
            ($this->secondsPerMinute * 59) +
            30
        )
        &&
        $timeDifference < $this->secondsPerYear;
    }

    /**
     * Checks if the time difference is less than 2 years
     * @param int $timeDifference the time difference in seconds
     * @return bool
     */
    private function isLessThan2Years($timeDifference)
    {
        return $timeDifference >= $this->secondsPerYear
        &&
        $timeDifference < ($this->secondsPerYear * 2);
    }
}
