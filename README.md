# Add time ago functionality to your project

[![Latest Stable Version](https://poser.pugx.org/jimmiw/php-time-ago/v/stable)](https://packagist.org/packages/jimmiw/php-time-ago)
[![Total Downloads](https://poser.pugx.org/jimmiw/php-time-ago/downloads)](https://packagist.org/packages/jimmiw/php-time-ago)
[![Build Status](https://travis-ci.org/jimmiw/php-time-ago.svg?branch=master)](https://travis-ci.org/jimmiw/php-time-ago)
[![License](https://poser.pugx.org/jimmiw/php-time-ago/license)](https://packagist.org/packages/jimmiw/php-time-ago)

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

There is now only one way to get the time ago in words

```
$timeAgo = new Westsworld\TimeAgo();
echo $timeAgo->inWords("2010/1/10 23:05:00");
```

Both methods gives the same answer, the "timeAgoInWords()" function is just a
convenience wrapper for you.

## Do you want the actual years, months, days, hours, minutes, seconds difference?

Good news for you then!
I've implemented a nice little function that does just that for you. Simply do the 
following:

```
$timeAgo = new Westsworld\TimeAgo();
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
$timeZone = null; // just use the system timezone
 
$timeAgo = new Westsworld\TimeAgo($timeZone, 'da'); // default language is en (english)
echo $timeAgo->inWords("2010/1/10 23:05:00");
```

## Changelog

### 2.0.0

Now using namespaces to handle the source.

* Added Westsworld namespace to the TimeAgo project.
* Removed the function "timeAgoInWords", since i really didn't like having it around.
* Removed the very deprecated WWDateTime class.
* Fixed unittests after namespace introduction.
* Updated composer.lock
* Updated .travis.yml

### 1.0.0

Introducing exceptions (so remember to handle them) and removed the old way of overloading the translations
path. Also renamed a few methods.
Both things breaks the current API, so I've bumped it to version 1.0.0

* An exception is now thrown, if a translation file cannot be added.
* An exception is now thrown, if the translation file is empty.
* Made timechecks a lot easier to read, by moving them into a "isLessThanX" method.
* Added unittests to test the loading of translations.
* Added unittest for dateDifference.
* Removed: _loadTranslations($language, $alternativePath), you can no longer use alternativePath, if extending the
component. Instead I added a define called TIMEAGO_TRANSLATION_PATH, which can be used to override the translations path
* Renamed _loadTranslations to loadTranslations
* Renamed _translate to translate

### 0.4.15
Added Turkish translation (@esrefesen), and Thai (@jaideejung007) and iranian- Farsi(Persian) (@datamweb) and French (@lamberttraccard)

### 0.4.14
Added Arabic translation (@xc0d3rz)
### 0.4.13
@jmontoyaa fixed a timezone setting bug
### 0.4.12
Merged #18, #33 (you can now supply an alternative translations folder), #35 and Added Czech (@misaon)
### 0.4.11
Changes to French translation (@souhailmerroun). Added Russian and Ukranian translations (@akavolkol)
### 0.4.10
Added Korean and Finnish translations (thanks to @easylogic and @tk1sul1)
### 0.4.9
Added Spanish and Hungarian and Brazilian Portuguese (thanks to @khrizt and @technodelight and @gugoan)
### 0.4.8
Added French and Japanese and Taiwanese translations (thanks to @barohatoum and @hotengchang)
### 0.4.7
Changes to fix annoying "floor" bugs.
### 0.4.6
Added Dutch and Chinese translations (thanks to @NielsdeBlaauw and @su-xiaolin)
### 0.4.5
Fix for wrongly named variable - patch from @rimager
### 0.4.4
Changed the previous fix, since it caused a problem with the "Scheme" at the start of this document. "about 1 hour ago" is between 44mins30secs and 89mins29secs.
### 0.4.3
Added a fix for "about 1 hour ago", which would yield "1 hours ago" if the time was 1hour 30minutes. Giving a pluralization error.
### 0.4.2
Added German translations .
### 0.4.1
Added "ago" to the end of the translations, so the texts now read "about 1 hour ago".
### 0.4.0
Added translations (Danish and English) to the plugin.

# The old way of doing things.

Just if you wanted to try out the old "time ago" class, I've kept it in the project.
It will eventually be deleted, but hey, go have fun with it. Perhaps even extend it etc.
Bear in mind though, that the new DateTime::diff in PHP version 5.3.0 will eventually
replace it completely. (PHP 5.3.0 DateTime::diff link: http://www.php.net/manual/en/datetime.diff.php)

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
