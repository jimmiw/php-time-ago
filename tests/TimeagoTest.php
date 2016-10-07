<?php

/**
 * Testing timeago dates
 * @author jimmiw
 * @since 2016-03-11
 */
class TimeagoTest extends PHPUnit_Framework_TestCase
{
    public function testIsAlive()
    {
        $this->assertTrue(true);
    }

    public function testInit()
    {
        $timeAgo = new TimeAgo();
        $this->assertNotNull($timeAgo);
    }

    public function testTimeAgoInWords()
    {
        $timeAgo = new TimeAgo();

        // testing "less than a minute"
        $this->assertEquals('less than a minute ago', $timeAgo->inWords("now"));
        $this->assertEquals('less than a minute ago', $timeAgo->inWords("-1 second"));
        $this->assertEquals('less than a minute ago', $timeAgo->inWords("-29 second"));
        $this->assertNotEquals('less than a minute ago', $timeAgo->inWords("-30 second"));

        // testing "1 minute"
        $this->assertEquals('1 minute ago', $timeAgo->inWords("-30 second"));
        $this->assertEquals('1 minute ago', $timeAgo->inWords("-60 second"));
        $this->assertEquals('1 minute ago', $timeAgo->inWords("-89 second"));
        $this->assertNotEquals('1 minute ago', $timeAgo->inWords("-90 second"));

        // testing 2..44 minutes
        $this->assertContains('minutes ago', $timeAgo->inWords("-2 minute"));
        $this->assertContains('minutes ago', $timeAgo->inWords("-44 minute"));
        $this->assertContains('minutes ago', $timeAgo->inWords("-44 minute -29 second"));
        $this->assertNotContains('minutes ago', $timeAgo->inWords("-44 minute -30 second"));

        // testing about 1 hour
        $this->assertEquals('about 1 hour ago', $timeAgo->inWords("-44 minute -30 second"));
        $this->assertEquals('about 1 hour ago', $timeAgo->inWords("-89 minute -29 second"));
        $this->assertNotEquals('about 1 hour ago', $timeAgo->inWords("-90 minute"));

        // testing about 2..24 hours
        $this->assertContains('hours ago', $timeAgo->inWords("-90 minute"));
        $this->assertContains('hours ago', $timeAgo->inWords("-23 hour -59 minute -29 second"));
        $this->assertNotContains('hours ago', $timeAgo->inWords("-23 hour -59 minute -30 second"));
        $this->assertNotContains('hours ago', $timeAgo->inWords("-24 hour"));

        // testing 1 day
        $this->assertEquals('1 day ago', $timeAgo->inWords("-23 hour -59 minute -30 second"));
        $this->assertEquals('1 day ago', $timeAgo->inWords("-47 hour -59 minute -29 second"));
        $this->assertNotEquals('1 day ago', $timeAgo->inWords("-47 hour -59 minute -30 second"));

        // testing 2..24 days
        $this->assertContains('days ago', $timeAgo->inWords("-47 hour -59 minute -30 second"));
        $this->assertContains('days ago', $timeAgo->inWords("-29 day -23 hour -59 minute -29 second"));
        $this->assertNotContains('days ago', $timeAgo->inWords("-29 day -23 hour -59 minute -30 second"));

        // testing 1 month
        $this->assertEquals('about 1 month ago', $timeAgo->inWords("-29 day -23 hour -59 minute -30 second"));
        $this->assertEquals('about 1 month ago', $timeAgo->inWords("-59 day -23 hour -59 minute -29 second"));
        $this->assertNotEquals('about 1 month ago', $timeAgo->inWords("-59 day -23 hour -59 minute -30 second"));

        // testing 2..12 months
        $this->assertContains('months ago', $timeAgo->inWords("-59 day -23 hour -59 minute -30 second"));
        //$this->assertContains('months ago', $timeAgo->inWords("-1 year 0 second"));
        //$this->assertNotContains('months ago', $timeAgo->inWords("-29 day -23 hour -59 minute -30 second"));
    }
}
