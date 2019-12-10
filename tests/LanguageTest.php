<?php

namespace Westsworld\TimeAgo\Tests;

use DateInterval;
use DateTime;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;
use Westsworld\TimeAgo;
use Westsworld\TimeAgo\Translations\nb_NO;

class LanguageTest extends TestCase
{
    /**
     * testing nb_No class
     */
    public function testNbNo()
    {
        $timeAgo = new TimeAgo(new nb_NO());
        // just testing a single translation
        $this->assertEquals('mindre enn ett minutt siden', $timeAgo->inWordsFromStrings("now"));
    }
}
