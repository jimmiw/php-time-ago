# Add time ago functionality to your project

[![Latest Stable Version](https://poser.pugx.org/jimmiw/php-time-ago/v/stable)](https://packagist.org/packages/jimmiw/php-time-ago)
[![Total Downloads](https://poser.pugx.org/jimmiw/php-time-ago/downloads)](https://packagist.org/packages/jimmiw/php-time-ago)
[![Build Status](https://travis-ci.org/jimmiw/php-time-ago.svg?branch=master)](https://travis-ci.org/jimmiw/php-time-ago)
[![License](https://poser.pugx.org/jimmiw/php-time-ago/license)](https://packagist.org/packages/jimmiw/php-time-ago)
[![OpenCollective](https://opencollective.com/php-time-ago/backers/badge.svg)](#backers)
[![OpenCollective](https://opencollective.com/php-time-ago/sponsors/badge.svg)](#sponsors)


# Getting started

The package is availabe here on Github and on Packagist

* https://github.com/jimmiw/php-time-ago
* https://packagist.org/packages/jimmiw/php-time-ago

## Installing

Using composer you can just do the following

```
composer require jimmiw/php-time-ago
```

## Using the component

There are two ways of getting the time ago in words.

By passing `DateTime` objects:

```
$timeAgo = new Westsworld\TimeAgo();
echo $timeAgo->inWords(new DateTime("2010-01-10 23:05:00"));
```

By passing strings:

```
$timeAgo = new Westsworld\TimeAgo();
echo $timeAgo->inWordsFromStrings("2010/1/10 23:05:00");
```

Both methods give the same answer, and use the same internal logic.

## Do you want the actual years, months, days, hours, minutes, seconds difference?

Good news for you then!
I've implemented a nice little function that does just that for you. Simply do the
following:

```
$timeAgo = new Westsworld\TimeAgo();
// NOTE: this is actually deprecated, since DateTime does the same. Still works though :)
$dateDifferenceArray =  $timeAgo->dateDifference("2017-03-02 07:53:00", "2017-03-02 07:53:01");
```

This will return an array with the following data:

```
[
	'years' => 0
	'months' => 0
	'days' => 0
	'hours' => 0
	'minutes' => 0
	'seconds' => 1
]
```


# How to determine, what "ago" is

```
  0 <-> 29 secs                                                             # => less than a minute
  30 secs <-> 1 min, 29 secs                                                # => 1 minute
  1 min, 30 secs <-> 44 mins, 29 secs                                       # => [2..44] minutes
  44 mins, 30 secs <-> 89 mins, 29 secs                                     # => about 1 hour
  89 mins, 29 secs <-> 23 hrs, 59 mins, 29 secs                             # => about [2..24] hours
  23 hrs, 59 mins, 29 secs <-> 47 hrs, 59 mins, 29 secs                     # => 1 day
  47 hrs, 59 mins, 29 secs <-> 29 days, 23 hrs, 59 mins, 29 secs            # => [2..29] days
  29 days, 23 hrs, 59 mins, 30 secs <-> 59 days, 23 hrs, 59 mins, 29 secs   # => about 1 month
  59 days, 23 hrs, 59 mins, 30 secs <-> 1 yr minus 1 sec                    # => [2..12] months
  1 yr <-> 2 yrs minus 1 secs                                               # => about 1 year
  2 yrs <-> max time or date                                                # => over [2..X] years
```

# Changes since last version

Lots have changed since the last version. The WWDateTime class is no longer supported.
I have implemented a new class which takes a time string as parameter (and a
timezone if needed), and calculates the time between them.

By request from "lsolesen" (a guy from here on github) I did removed the whole
DateTime dependence thingy.

# About

Inspired by the comments at:

http://dk.php.net/time

http://api.rubyonrails.org/classes/ActionView/Helpers/DateHelper.html#M001695

You should really look in to the Carbon project, it looks very nice and gives the same functionality and a lot more.

This class is here to give you the same functionality that DateTime::diff will give you.


# Translations added

*Version 0.4.x was the big translations release.*

You can now translate the texts returned using the $timeAgo->inWords() or timeAgoInWords() methods.
The translation is simply a language code string added to the end of the class init or timeAgoInWords() method.

Examples using the Danish translations:

```
$myLang = new \Westsworld\TimeAgo\Translations\Da();

$timeAgo = new Westsworld\TimeAgo($myLang); // default language is en (english)
echo $timeAgo->inWords("2010/1/10 23:05:00");
```

# Available translation languages

You can view the file of available list inside /src/Westsworld/TimeAgo/Translations/ folder.

# Changelog

For a full list of changes, please see Changelog.md

# Backers

Support us with a monthly donation and help us continue our activities. [[Become a backer](https://opencollective.com/php-time-ago#backer)]

<a href="https://opencollective.com/php-time-ago/backer/0/website" target="_blank"><img src="https://opencollective.com/php-time-ago/backer/0/avatar.svg"></a>
<a href="https://opencollective.com/php-time-ago/backer/1/website" target="_blank"><img src="https://opencollective.com/php-time-ago/backer/1/avatar.svg"></a>
<a href="https://opencollective.com/php-time-ago/backer/2/website" target="_blank"><img src="https://opencollective.com/php-time-ago/backer/2/avatar.svg"></a>
<a href="https://opencollective.com/php-time-ago/backer/3/website" target="_blank"><img src="https://opencollective.com/php-time-ago/backer/3/avatar.svg"></a>
<a href="https://opencollective.com/php-time-ago/backer/4/website" target="_blank"><img src="https://opencollective.com/php-time-ago/backer/4/avatar.svg"></a>
<a href="https://opencollective.com/php-time-ago/backer/5/website" target="_blank"><img src="https://opencollective.com/php-time-ago/backer/5/avatar.svg"></a>
<a href="https://opencollective.com/php-time-ago/backer/6/website" target="_blank"><img src="https://opencollective.com/php-time-ago/backer/6/avatar.svg"></a>
<a href="https://opencollective.com/php-time-ago/backer/7/website" target="_blank"><img src="https://opencollective.com/php-time-ago/backer/7/avatar.svg"></a>
<a href="https://opencollective.com/php-time-ago/backer/8/website" target="_blank"><img src="https://opencollective.com/php-time-ago/backer/8/avatar.svg"></a>
<a href="https://opencollective.com/php-time-ago/backer/9/website" target="_blank"><img src="https://opencollective.com/php-time-ago/backer/9/avatar.svg"></a>
<a href="https://opencollective.com/php-time-ago/backer/10/website" target="_blank"><img src="https://opencollective.com/php-time-ago/backer/10/avatar.svg"></a>
<a href="https://opencollective.com/php-time-ago/backer/11/website" target="_blank"><img src="https://opencollective.com/php-time-ago/backer/11/avatar.svg"></a>
<a href="https://opencollective.com/php-time-ago/backer/12/website" target="_blank"><img src="https://opencollective.com/php-time-ago/backer/12/avatar.svg"></a>
<a href="https://opencollective.com/php-time-ago/backer/13/website" target="_blank"><img src="https://opencollective.com/php-time-ago/backer/13/avatar.svg"></a>
<a href="https://opencollective.com/php-time-ago/backer/14/website" target="_blank"><img src="https://opencollective.com/php-time-ago/backer/14/avatar.svg"></a>
<a href="https://opencollective.com/php-time-ago/backer/15/website" target="_blank"><img src="https://opencollective.com/php-time-ago/backer/15/avatar.svg"></a>
<a href="https://opencollective.com/php-time-ago/backer/16/website" target="_blank"><img src="https://opencollective.com/php-time-ago/backer/16/avatar.svg"></a>
<a href="https://opencollective.com/php-time-ago/backer/17/website" target="_blank"><img src="https://opencollective.com/php-time-ago/backer/17/avatar.svg"></a>
<a href="https://opencollective.com/php-time-ago/backer/18/website" target="_blank"><img src="https://opencollective.com/php-time-ago/backer/18/avatar.svg"></a>
<a href="https://opencollective.com/php-time-ago/backer/19/website" target="_blank"><img src="https://opencollective.com/php-time-ago/backer/19/avatar.svg"></a>
<a href="https://opencollective.com/php-time-ago/backer/20/website" target="_blank"><img src="https://opencollective.com/php-time-ago/backer/20/avatar.svg"></a>
<a href="https://opencollective.com/php-time-ago/backer/21/website" target="_blank"><img src="https://opencollective.com/php-time-ago/backer/21/avatar.svg"></a>
<a href="https://opencollective.com/php-time-ago/backer/22/website" target="_blank"><img src="https://opencollective.com/php-time-ago/backer/22/avatar.svg"></a>
<a href="https://opencollective.com/php-time-ago/backer/23/website" target="_blank"><img src="https://opencollective.com/php-time-ago/backer/23/avatar.svg"></a>
<a href="https://opencollective.com/php-time-ago/backer/24/website" target="_blank"><img src="https://opencollective.com/php-time-ago/backer/24/avatar.svg"></a>
<a href="https://opencollective.com/php-time-ago/backer/25/website" target="_blank"><img src="https://opencollective.com/php-time-ago/backer/25/avatar.svg"></a>
<a href="https://opencollective.com/php-time-ago/backer/26/website" target="_blank"><img src="https://opencollective.com/php-time-ago/backer/26/avatar.svg"></a>
<a href="https://opencollective.com/php-time-ago/backer/27/website" target="_blank"><img src="https://opencollective.com/php-time-ago/backer/27/avatar.svg"></a>
<a href="https://opencollective.com/php-time-ago/backer/28/website" target="_blank"><img src="https://opencollective.com/php-time-ago/backer/28/avatar.svg"></a>
<a href="https://opencollective.com/php-time-ago/backer/29/website" target="_blank"><img src="https://opencollective.com/php-time-ago/backer/29/avatar.svg"></a>

# Sponsors

Become a sponsor and get your logo on our README on Github with a link to your site. [[Become a sponsor](https://opencollective.com/php-time-ago#sponsor)]

<a href="https://opencollective.com/php-time-ago/sponsor/0/website" target="_blank"><img src="https://opencollective.com/php-time-ago/sponsor/0/avatar.svg"></a>
<a href="https://opencollective.com/php-time-ago/sponsor/1/website" target="_blank"><img src="https://opencollective.com/php-time-ago/sponsor/1/avatar.svg"></a>
<a href="https://opencollective.com/php-time-ago/sponsor/2/website" target="_blank"><img src="https://opencollective.com/php-time-ago/sponsor/2/avatar.svg"></a>
<a href="https://opencollective.com/php-time-ago/sponsor/3/website" target="_blank"><img src="https://opencollective.com/php-time-ago/sponsor/3/avatar.svg"></a>
<a href="https://opencollective.com/php-time-ago/sponsor/4/website" target="_blank"><img src="https://opencollective.com/php-time-ago/sponsor/4/avatar.svg"></a>
<a href="https://opencollective.com/php-time-ago/sponsor/5/website" target="_blank"><img src="https://opencollective.com/php-time-ago/sponsor/5/avatar.svg"></a>
<a href="https://opencollective.com/php-time-ago/sponsor/6/website" target="_blank"><img src="https://opencollective.com/php-time-ago/sponsor/6/avatar.svg"></a>
<a href="https://opencollective.com/php-time-ago/sponsor/7/website" target="_blank"><img src="https://opencollective.com/php-time-ago/sponsor/7/avatar.svg"></a>
<a href="https://opencollective.com/php-time-ago/sponsor/8/website" target="_blank"><img src="https://opencollective.com/php-time-ago/sponsor/8/avatar.svg"></a>
<a href="https://opencollective.com/php-time-ago/sponsor/9/website" target="_blank"><img src="https://opencollective.com/php-time-ago/sponsor/9/avatar.svg"></a>
<a href="https://opencollective.com/php-time-ago/sponsor/10/website" target="_blank"><img src="https://opencollective.com/php-time-ago/sponsor/10/avatar.svg"></a>
<a href="https://opencollective.com/php-time-ago/sponsor/11/website" target="_blank"><img src="https://opencollective.com/php-time-ago/sponsor/11/avatar.svg"></a>
<a href="https://opencollective.com/php-time-ago/sponsor/12/website" target="_blank"><img src="https://opencollective.com/php-time-ago/sponsor/12/avatar.svg"></a>
<a href="https://opencollective.com/php-time-ago/sponsor/13/website" target="_blank"><img src="https://opencollective.com/php-time-ago/sponsor/13/avatar.svg"></a>
<a href="https://opencollective.com/php-time-ago/sponsor/14/website" target="_blank"><img src="https://opencollective.com/php-time-ago/sponsor/14/avatar.svg"></a>
<a href="https://opencollective.com/php-time-ago/sponsor/15/website" target="_blank"><img src="https://opencollective.com/php-time-ago/sponsor/15/avatar.svg"></a>
<a href="https://opencollective.com/php-time-ago/sponsor/16/website" target="_blank"><img src="https://opencollective.com/php-time-ago/sponsor/16/avatar.svg"></a>
<a href="https://opencollective.com/php-time-ago/sponsor/17/website" target="_blank"><img src="https://opencollective.com/php-time-ago/sponsor/17/avatar.svg"></a>
<a href="https://opencollective.com/php-time-ago/sponsor/18/website" target="_blank"><img src="https://opencollective.com/php-time-ago/sponsor/18/avatar.svg"></a>
<a href="https://opencollective.com/php-time-ago/sponsor/19/website" target="_blank"><img src="https://opencollective.com/php-time-ago/sponsor/19/avatar.svg"></a>
<a href="https://opencollective.com/php-time-ago/sponsor/20/website" target="_blank"><img src="https://opencollective.com/php-time-ago/sponsor/20/avatar.svg"></a>
<a href="https://opencollective.com/php-time-ago/sponsor/21/website" target="_blank"><img src="https://opencollective.com/php-time-ago/sponsor/21/avatar.svg"></a>
<a href="https://opencollective.com/php-time-ago/sponsor/22/website" target="_blank"><img src="https://opencollective.com/php-time-ago/sponsor/22/avatar.svg"></a>
<a href="https://opencollective.com/php-time-ago/sponsor/23/website" target="_blank"><img src="https://opencollective.com/php-time-ago/sponsor/23/avatar.svg"></a>
<a href="https://opencollective.com/php-time-ago/sponsor/24/website" target="_blank"><img src="https://opencollective.com/php-time-ago/sponsor/24/avatar.svg"></a>
<a href="https://opencollective.com/php-time-ago/sponsor/25/website" target="_blank"><img src="https://opencollective.com/php-time-ago/sponsor/25/avatar.svg"></a>
<a href="https://opencollective.com/php-time-ago/sponsor/26/website" target="_blank"><img src="https://opencollective.com/php-time-ago/sponsor/26/avatar.svg"></a>
<a href="https://opencollective.com/php-time-ago/sponsor/27/website" target="_blank"><img src="https://opencollective.com/php-time-ago/sponsor/27/avatar.svg"></a>
<a href="https://opencollective.com/php-time-ago/sponsor/28/website" target="_blank"><img src="https://opencollective.com/php-time-ago/sponsor/28/avatar.svg"></a>
<a href="https://opencollective.com/php-time-ago/sponsor/29/website" target="_blank"><img src="https://opencollective.com/php-time-ago/sponsor/29/avatar.svg"></a>

# MIT License

Copyright © 2014 Jimmi Westerberg (http://westsworld.dk)

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the “Software”), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED “AS IS”, WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
