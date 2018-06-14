<?php

namespace Westsworld\TimeAgo\Translations;

use \DateTime;

abstract class Language
{
    private $translations = [];

    /**
     * Fetches the current list of translations
     *
     * @return string[]
     */
    public function getTranslations(): array
    {
        return $this->translations;
    }

    /**
     * Sets the list of translations, in a key->value format
     *
     * @param array $translations the translations to set
     * @return void
     */
    public function setTranslations(array $translations): void
    {
        $this->translations = $translations;
    }

    /**
     * Checks if the given translation key exists
     *
     * @param string $key
     * @return boolean
     */
    public function hasTranslation($key): bool
    {
        return isset($this->translations[$key]);
    }

    /**
     * Fetches the different between $past and $now in a spoken format.
     * NOTE: both past and now should be instances of DateTime
     *
     * @param DateTime $past the past date to use
     * @param DateTime $now the current timezone, defaults to now.
     * @return string the difference in spoken format, e.g. 1 day ago
     */
    public function inWords(DateTime $past, DateTime $now = null)
    {
        // handles cases where $now is null
        if (null === $now) {
            $now = new DateTime('now', new DateTimeZone('GMT'));
        }

        // finds the time difference as a string
        $timeAgo = $this->getTimeDifference($past, $past->diff($now));

        $this->restoreTimezone();

        return $timeAgo;
    }

    /**
     * Applies rules to find the time difference as a string
     *
     * @param DateTime $past
     * @param array $timeDifference
     * @return string
     */
    private function getTimeDifference(DateTime $past, array $timeDifference)
    {
        // rule 11
        // 2years or more
        if ($this->isMoreThan2Years($timeDifference)) {
            return $this->translate('years', $timeDifference->y);
        }

        // rule 10
        // between 1year and 2years (minus 1sec)
        if ($this->isLessThan2Years($timeDifference)) {
            return $this->translate('aboutOneYear');
        }

        // rule 9
        // between 59days23hours59mins30secs and 1year (minus 1sec)
        if ($this->isLessThan1Year($timeDifference)) {
            $months = $this->roundMonthsAboveOneMonth($timeDifference);
            return $this->translate('months', $months);
        }

        // rule 8
        // between 29days23hours59mins30secs and 59days23hours59mins29secs
        if ($this->isLessThan59Days23Hours59Mins29Secs($timeDifference)) {
            return $this->translate('aboutOneMonth');
        }

        // rule 7
        // between 47hours59mins30secs and 29days23hours59mins29secs
        if ($this->isLessThan29Days23Hours59Mins29Seconds($timeDifference)) {
            return $this->translate('days', $timeDifference->d);
        }

        // rule 6
        // between 23hours59mins30secs and 47hours59mins29secs
        if ($this->isLessThan47Hours59Mins29Seconds($timeDifference)) {
            return $this->translate('aboutOneDay');
        }

        // rule 5
        // between 1hour29mins59secs and 23hours59mins29secs
        if ($this->isLessThan23Hours59Mins29Seconds($timeDifference)) {
            return $this->translate('hours', $timeDifference->h);
        }

        // rule 4
        // between 44mins30secs and 1hour29mins59secs
        if ($this->isLessThan1Hour29Mins59Seconds($timeDifference)) {
            return $this->translate('aboutOneHour');
        }

        // rule 3
        // between 1min30secs and 44mins29secs
        if ($this->isLessThan44Min29Secs($timeDifference)) {
            return $this->translate('lessThanOneHour', $timeDifference->i);
        }

        // rule 2
        // more than 29secs and less than 1min29secss
        if ($this->isLessThan1Min29Seconds($timeDifference)) {
            return $this->translate('oneMinute');
        }

        // rule 1
        // less than 29secs
        if ($this->isLessThan29Seconds($timeDifference)) {
            return $this->translate('lessThanAMinute');
        }

        // rule 0
        // $past is null or empty or ''
        // if ($this->isPastEmpty($past)) {
            return $this->translate('never');
        // }
    }


    /**
     * Checks if the given past is empty
     *
     * @param DateTime $past the "past" to check
     * @return bool true if empty, else false
     */
    private function isPastEmpty($past)
    {
        return null === $past || is_null($past) || empty($past);
    }

    /**
     * Checks if the time difference is less than 29seconds
     *
     * @param array $timeDifference the time difference from DateTime
     * @return bool
     */
    private function isLessThan29Seconds(array $timeDifference)
    {
        return $timeDifference->s < 30;
    }

    /**
     * Checks if the time difference is less than 1min 29seconds
     *
     * @param array $timeDifference the time difference from DateTime
     * @return bool
     */
    private function isLessThan1Min29Seconds(array $timeDifference)
    {
        return $timeDifference->s >= 30 && $timeDifference->i < 2;
    }

    /**
     * Checks if the time difference is less than 44mins 29seconds
     *
     * @param array $timeDifference the time difference from DateTime
     * @return bool
     */
    private function isLessThan44Min29Secs(array $timeDifference)
    {
        return $timeDifference->s < 30 && $timeDifference->i <= 44;
    }

    /**
     * Checks if the time difference is less than 1hour 29mins 59seconds
     *
     * @param array $timeDifference the time difference from DateTime
     * @return bool
     */
    private function isLessThan1Hour29Mins59Seconds(array $timeDifference)
    {
        return $timeDifference->s <= 59 &&
            $timeDifference->i < 30 &&
            $timeDifference->h <= 1;
    }

    /**
     * Checks if the time difference is less than 23hours 59mins 29seconds
     *
     * @param array $timeDifference the time difference from DateTime
     * @return bool
     */
    private function isLessThan23Hours59Mins29Seconds(array $timeDifference)
    {
        return $timeDifference->h <= 23 &&
            $timeDifference->i <= 59 &&
            $timeDifference->s < 30;
    }

    /**
     * Checks if the time difference is less than 27hours 59mins 29seconds
     *
     * @param int $timeDifference the time difference from DateTime
     * @return bool
     */
    private function isLessThan47Hours59Mins29Seconds($timeDifference)
    {
        return $timeDifference->h <= 47 &&
            $timeDifference->i <= 59 &&
            $timeDifference->s < 30;
    }

    /**
     * Checks if the time difference is less than 29days 23hours 59mins 29seconds
     *
     * @param int $timeDifference the time difference from DateTime
     * @return bool
     */
    private function isLessThan29Days23Hours59Mins29Seconds($timeDifference)
    {
        return $timeDifference->d <= 29 &&
            $timeDifference->h <= 23 &&
            $timeDifference->i <= 59 &&
            $timeDifference->s < 30;
    }

    /**
     * Checks if the time difference is less than 59days 23hours 59mins 29seconds
     *
     * @param int $timeDifference the time difference from DateTime
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
     *
     * @param int $timeDifference the time difference from DateTime
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
     *
     * @param int $timeDifference the time difference from DateTime
     * @return bool
     */
    private function isLessThan2Years($timeDifference)
    {
        return $timeDifference >= $this->secondsPerYear
        &&
        $timeDifference < ($this->secondsPerYear * 2);
    }

    /**
     * Rounds of the months, and checks if months is 1, then it's increased to 2, since this should be taken
     * from a different rule
     *
     * @param int $timeDifference the time difference from DateTime
     * @return int the number of months the difference is un
     */
    private function roundMonthsAboveOneMonth($timeDifference)
    {
        $months = round($timeDifference / $this->secondsPerMonth);
        // if months is 1, then set it to 2, because we are "past" 1 month
        if ($months == 1) {
            $months = 2;
        }
        return $months;
    }

    /**
     * Translates the given $label, and adds the given $time.
     *
     * @param string $label the label to translate
     * @param string $time the time string to add to the translated text.
     * @return string the translated label text including the time.
     */
    private function translate($label, $time = '')
    {
        // handles a usecase introduced in #18, where a new translation was added.
        // This would cause an array-out-of-bound exception, since the index does not
        // exist in most translations.
        if ($this->hasTranslation($label)) {
            return '';
        }

        return sprintf($this->getTranslations()[$label], $time);
    }
}
