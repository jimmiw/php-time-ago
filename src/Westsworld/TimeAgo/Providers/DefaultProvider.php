<?php

namespace Westsworld\TimeAgo\Providers;

use Westsworld\TimeAgo\Translations\Language;

class DefaultProvider implements Provider
{
    /** @var Language */
    private $language;
    /** @var DateTimeZone */
    private $timezone;

    public function __construct(Language $language, DateTimeZone $timezone)
    {
        $this->language = $language;
        $this->timezone = $timezone;
    }
}
