<?php

namespace Westsworld\TimeAgo\Providers;

class Default implements Provider
{
    /** @var string */
    private $language;
    /** @var DateTimeZone */
    private $timezone;

    public function __construct(string $language, DateTimeZone $timezone)
    {
        $this->language = $language;
        $this->timezone = $timezone;
    }

    /**
     * Loads the translations into the system.
     * NOTE: Removed alternativePath in 0.6.0, instead, define that path using TIMEAGO_TRANSLATION_PATH
     * @param string $language the language iso to use
     * @throws Exception if a language file cannot be found or there are no translations
     */
    protected function loadTranslations($language)
    {
        // no time strings loaded? load them and store it all in static variables
        if (self::$timeAgoStrings === null || self::$language !== $language) {
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
}
