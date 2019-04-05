<?php

namespace Westsworld\TimeAgo\Tests;

use Westsworld\TimeAgo\Translations\En;
use Westsworld\TimeAgo\Translations\Da;
use Westsworld\TimeAgo\Translations\De;
use Westsworld\TimeAgo;
use PHPUnit\Framework\TestCase;
use DateTime;
use DateInterval;

/**
 * Testing timeago dates
 * @author jimmiw
 * @since 2016-03-11
 */
class TimeagoTest extends TestCase
{
    public function testCreate()
    {
        $timeAgo = TimeAgo::create(new En());

        $this->assertInstanceOf(TimeAgo::class, $timeAgo);
    }

    public function testDateDifference()
    {
        $timeAgo = TimeAgo::create(new En());
        $past = new DateTime(date('2019-04-04'));
        $result = $timeAgo->dateDifference($past);

        $this->assertContains('years', $result);
        $this->assertContains('months', $result);
        $this->assertContains('days', $result);
        $this->assertContains('hours', $result);
        $this->assertContains('minutes', $result);
        $this->assertContains('seconds', $result);
    }

    public function testIsAlive()
    {
        $this->assertTrue(true);
    }

    public function te1stInit()
    {
        $timeAgo = new TimeAgo();
        $this->assertNotNull($timeAgo);
    }

    /**
     * Tests the old core functionality, by being in the same timezone and not changing language.
     */
    public function testTimeAgoInWords()
    {
        $timeAgo = new TimeAgo();

        // testing "less than a minute"
        $this->assertEquals('less than a minute ago', $timeAgo->inWordsFromStrings("now"));
        $this->assertEquals('less than a minute ago', $timeAgo->inWordsFromStrings("-1 second"));
        $this->assertEquals('less than a minute ago', $timeAgo->inWordsFromStrings("-29 second"));
        $this->assertNotEquals('less than a minute ago', $timeAgo->inWordsFromStrings("-30 second"));
        // testing "1 minute"
        $this->assertEquals('1 minute ago', $timeAgo->inWordsFromStrings("-30 second"));
        $this->assertEquals('1 minute ago', $timeAgo->inWordsFromStrings("-60 second"));
        $this->assertEquals('1 minute ago', $timeAgo->inWordsFromStrings("-89 second"));
        $this->assertNotEquals('1 minute ago', $timeAgo->inWordsFromStrings("-90 second"));


        // testing 2..44 minutes
        $this->assertContains('minutes ago', $timeAgo->inWordsFromStrings("-2 minute"));
        $this->assertContains('minutes ago', $timeAgo->inWordsFromStrings("-2 minute -40 second"));
        $this->assertContains('minutes ago', $timeAgo->inWordsFromStrings("-44 minute"));
        $this->assertContains('minutes ago', $timeAgo->inWordsFromStrings("-44 minute -29 second"));
        $this->assertNotContains('minutes ago', $timeAgo->inWordsFromStrings("-44 minute -30 second"));

        // testing about 1 hour
        $this->assertEquals('about 1 hour ago', $timeAgo->inWordsFromStrings("-44 minute -30 second"));
        $this->assertEquals('about 1 hour ago', $timeAgo->inWordsFromStrings("-89 minute -29 second"));
        $this->assertNotEquals('about 1 hour ago', $timeAgo->inWordsFromStrings("-90 minute"));

        // testing about 2..24 hours
        $this->assertContains('hours ago', $timeAgo->inWordsFromStrings("-90 minute"));
        $this->assertContains('hours ago', $timeAgo->inWordsFromStrings("-23 hour -59 minute -29 second"));
        $this->assertNotContains('hours ago', $timeAgo->inWordsFromStrings("-23 hour -59 minute -30 second"));
        $this->assertNotContains('hours ago', $timeAgo->inWordsFromStrings("-24 hour"));

        // testing 1 day
        $this->assertEquals('1 day ago', $timeAgo->inWordsFromStrings("-23 hour -59 minute -30 second"));
        $this->assertEquals('1 day ago', $timeAgo->inWordsFromStrings("-47 hour -59 minute -29 second"));
        $this->assertNotEquals('1 day ago', $timeAgo->inWordsFromStrings("-47 hour -59 minute -30 second"));

        // testing 2..24 days
        $this->assertContains('days ago', $timeAgo->inWordsFromStrings("-47 hour -59 minute -30 second"));
        $this->assertContains('days ago', $timeAgo->inWordsFromStrings("-29 day -23 hour -59 minute -29 second"));
        $this->assertNotContains('days ago', $timeAgo->inWordsFromStrings("-29 day -23 hour -59 minute -30 second"));

        // testing 1 month
        $this->assertEquals('about 1 month ago', $timeAgo->inWordsFromStrings("-29 day -23 hour -59 minute -30 second"));
        $this->assertEquals('about 1 month ago', $timeAgo->inWordsFromStrings("-59 day -23 hour -59 minute -29 second"));
        $this->assertNotEquals('about 1 month ago', $timeAgo->inWordsFromStrings("-59 day -23 hour -59 minute -30 second"));

        // testing 2..12 months
        $this->assertContains('months ago', $timeAgo->inWordsFromStrings("-59 day -23 hour -59 minute -30 second"));

        // seemed to be the easiest way to get 1 year - 1 second, which should be the day before 1 year ago :)
        $oneYearAgo = strtotime("-1 year");
        // NOTE: this fails around leap years... so... -2 days must be accurate enough
        $twoDays = (2*86400); // 2 days in seconds
        $this->assertContains('months ago', $timeAgo->inWordsFromStrings(date('c', $oneYearAgo + $twoDays)));
        $this->assertNotContains('months ago', $timeAgo->inWordsFromStrings(date('c', $oneYearAgo)));

        // testing 1 year
        $this->assertContains('1 year ago', $timeAgo->inWordsFromStrings(date('c', $oneYearAgo - $twoDays)));
        $twoYearsAgo = strtotime("-2 year");
        $this->assertContains('1 year ago', $timeAgo->inWordsFromStrings(date('c', $twoYearsAgo + $twoDays)));
        $this->assertNotContains('1 year ago', $timeAgo->inWordsFromStrings(date('c', $twoYearsAgo)));

        // testing 2 years or more
        $this->assertEquals('over 2 years ago', $timeAgo->inWordsFromStrings("-2 year"));
        $this->assertEquals('over 2 years ago', $timeAgo->inWordsFromStrings("-2 year - 59 day"));
        $this->assertEquals('over 3 years ago', $timeAgo->inWordsFromStrings("-3 year"));
        $this->assertEquals('over 4 years ago', $timeAgo->inWordsFromStrings("-4 year"));
        $this->assertEquals('over 5 years ago', $timeAgo->inWordsFromStrings("-5 year"));
        $this->assertEquals('over 6 years ago', $timeAgo->inWordsFromStrings("-6 year"));
        $this->assertEquals('over 7 years ago', $timeAgo->inWordsFromStrings("-7 year"));
        $this->assertEquals('over 8 years ago', $timeAgo->inWordsFromStrings("-8 year"));
        $this->assertEquals('over 9 years ago', $timeAgo->inWordsFromStrings("-9 year"));
        $this->assertEquals('over 10 years ago', $timeAgo->inWordsFromStrings("-10 year"));
        // you get the point right?...
    }

    public function testTimeAgoInWordsDateTime()
    {
        $timeAgo = new TimeAgo(new En());

        // testing "less than a minute"
        $this->assertEquals('less than a minute ago', $timeAgo->inWords(new DateTime()));
        $this->assertEquals('less than a minute ago', $timeAgo->inWords((new DateTime())->sub(new DateInterval('PT1S'))));
        $this->assertEquals('less than a minute ago', $timeAgo->inWords((new DateTime())->sub(new DateInterval('PT29S'))));
        $this->assertNotEquals('less than a minute ago', $timeAgo->inWords((new DateTime())->sub(new DateInterval('PT30S'))));

        // testing "1 minute"
        $this->assertEquals('1 minute ago', $timeAgo->inWords((new DateTime())->sub(new DateInterval('PT30S'))));
        $this->assertEquals('1 minute ago', $timeAgo->inWords((new DateTime())->sub(new DateInterval('PT60S'))));
        $this->assertEquals('1 minute ago', $timeAgo->inWords((new DateTime())->sub(new DateInterval('PT89S'))));
        $this->assertNotEquals('1 minute ago', $timeAgo->inWords((new DateTime())->sub(new DateInterval('PT90S'))));
    }

    public function languageDataProvider()
    {
        return [
            [null, 'less than a minute ago', 'using default (english)'],
            [new Da(), 'mindre end et minut siden', 'switching to danish', 'switching to danish'],
            [new De(), 'vor weniger als einer Minute', 'switching to danish', 'switching to german'],
        ];
    }

    /**
     * @dataProvider languageDataProvider
     */
    public function testLanguage($language, $expected, $message)
    {
        $timeAgo = new TimeAgo($language);
        $this->assertEquals($expected, $timeAgo->inWords(new DateTime()), $message);
    }
}
