<?php

// To allow overriding this function as will, if someone wants to use a derived class of `TimeAgo`
if (!function_exists('timeAgoInWords')) {
    function timeAgoInWords($timestring, $timezone = null, $language = 'en')
    {
        $timeAgo = new TimeAgo($timezone, $language);

        return $timeAgo->inWords($timestring, "now");
    }
}


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
        self::_loadTranslations($language);
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
        if ($past === '' || is_null($past) || empty($past)) {
            $timeAgo = $this->_translate('never');
        }
        // rule 1
        // less than 29secs
        else if ($timeDifference <= 29) {
            $timeAgo = $this->_translate('lessThanAMinute');
        }
        // rule 2
        // more than 29secs and less than 1min29secss
        else if ($timeDifference >= 30 && $timeDifference <= 89) {
            $timeAgo = $this->_translate('oneMinute');
        }
        // rule 3
        // between 1min30secs and 44mins29secs
        else if ($timeDifference >= 90 &&
            $timeDifference <= (($this->secondsPerMinute * 44) + 29)
        ) {
            $minutes = round($timeDifference / $this->secondsPerMinute);
            $timeAgo = $this->_translate('lessThanOneHour', $minutes);
        }
        // rule 4
        // between 44mins30secs and 1hour29mins59secs
        else if (
            $timeDifference >= (($this->secondsPerMinute * 44) + 30)
            &&
            $timeDifference <= ($this->secondsPerHour + ($this->secondsPerMinute * 29) + 59)
        ) {
            $timeAgo = $this->_translate('aboutOneHour');
        }
        // rule 5
        // between 1hour29mins59secs and 23hours59mins29secs
        else if (
            $timeDifference >= (
                $this->secondsPerHour +
                ($this->secondsPerMinute * 30)
            )
            &&
            $timeDifference <= (
                ($this->secondsPerHour * 23) +
                ($this->secondsPerMinute * 59) +
                29
            )
        ) {
            $hours = round($timeDifference / $this->secondsPerHour);
            $timeAgo = $this->_translate('hours', $hours);
        }
        // rule 6
        // between 23hours59mins30secs and 47hours59mins29secs
        else if (
            $timeDifference >= (
                ($this->secondsPerHour * 23) +
                ($this->secondsPerMinute * 59) +
                30
            )
            &&
            $timeDifference <= (
                ($this->secondsPerHour * 47) +
                ($this->secondsPerMinute * 59) +
                29
            )
        ) {
            $timeAgo = $this->_translate('aboutOneDay');
        }
        // rule 7
        // between 47hours59mins30secs and 29days23hours59mins29secs
        else if (
            $timeDifference >= (
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
            )
        ) {
            $days = round($timeDifference / $this->secondsPerDay);
            $timeAgo = $this->_translate('days', $days);
        }
        // rule 8
        // between 29days23hours59mins30secs and 59days23hours59mins29secs
        else if (
            $timeDifference >= (
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
            )
        ) {
            $timeAgo = $this->_translate('aboutOneMonth');
        }
        // rule 9
        // between 59days23hours59mins30secs and 1year (minus 1sec)
        else if (
            $timeDifference >= (
                ($this->secondsPerDay * 59) +
                ($this->secondsPerHour * 23) +
                ($this->secondsPerMinute * 59) +
                30
            )
            &&
            $timeDifference < $this->secondsPerYear
        ) {
            $months = round($timeDifference / $this->secondsPerMonth);
            // if months is 1, then set it to 2, because we are "past" 1 month
            if ($months == 1) {
                $months = 2;
            }

            $timeAgo = $this->_translate('months', $months);
        }
        // rule 10
        // between 1year and 2years (minus 1sec)
        else if (
            $timeDifference >= $this->secondsPerYear
            &&
            $timeDifference < ($this->secondsPerYear * 2)
        ) {
            $timeAgo = $this->_translate('aboutOneYear');
        }
        // rule 11
        // 2years or more
        else {
            $years = floor($timeDifference / $this->secondsPerYear);
            $timeAgo = $this->_translate('years', $years);
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
    protected function _translate($label, $time = '')
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
     */
    protected static function _loadTranslations($language, $alternate_path = null)
    {
        // no time strings loaded? load them and store it all in static variables
        if (self::$timeAgoStrings == null || self::$language != $language) {
            $file = __DIR__ . '/translations/' . $language . '.php';             
            if (!file_exists($file) {            
                $file = __DIR__ . '/translations/en.php';                            
            }
                
            include($file);

            if (!isset($timeAgoStrings) && $alternate_path) {
                include($alternate_path);
            }

            // storing the time strings in the current object
            self::$timeAgoStrings = $timeAgoStrings;

            // loads the language files
            if (self::$timeAgoStrings == null) {
                error_log('Could not load language file for language ' . $language . '. Please ensure that the file exists in ' . __DIR__ . 'translations/' . $language . '.php');
            }
        }

        // storing the language
        self::$language = $language;
    }

    protected function changeTimezone()
    {
        $this->previousTimezone = false;
        if ($this->timezone) {
            $this->previousTimezone = date_default_timezone_get();
            date_default_timezone_set($this->timezone);
        }
    }

    protected function restoreTimezone()
    {
        if ($this->previousTimezone) {
            date_default_timezone_set($this->previousTimezone);
            $this->previousTimezone = false;
        }
    }
}
