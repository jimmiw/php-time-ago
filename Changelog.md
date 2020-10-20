## Changelog

### 3.2.0
* Added Italian translation, thanks to @vegagame
* Added Norweigan translation, thanks to @zreedeecom

### 3.1.1
* Updated a classname psr-4 bug in Zh_Tw, since the file was named Zh_TW.
* Updated php requirement to >=7.0.0, since we are using return types anyways.
* Updated return type in phpdoc on inWordsFromStrings()
* Removed En import in TimeAgo as well.

### 3.1.0
* Changed from psr-0 to psr-4, since some language classes could not be loaded properly
* Added support for DateTimeImmutable objects, thanks to @xtreamwayz
* Added Indonesian translation, thanks to @dhutapratama

### 3.0.6
* Fixed #79 where 1h30m would be 1 hours ago instead of 2 hours ago

### 3.0.5
* Cs translation more correct, thanks @MartkCz

### 3.0.4
* Fixed a bug with isLessThan44Min29Secs, thanks @ruben-haegeman
* Added Polish translations, thanks to @biegacz1

### 3.0.3
* Updated Pt-BR, thanks to @ivesbrito

### 3.0.2
* updated phpdoc for constructor

### 3.0.1
* Typo fixes, thanks @jlratwil
* Did some changes to composer, so php 7.0 can also be tested on travis.
* Removed hhvm and 5.6 from travis, since phpunit cannot go that low.

### 3.0.0
* Redid most of the code, to work with DateTime objects instead.
* Renamed the old inWords method to inWordsFromStrings, so that still works.
* Added a new inWords method to accept DateTime instances.
* Translations are now classes, inheriting from the Language class.
* Fixed the inWords unit tests, to use inWordsFromStrings.
* Added a few unit tests for the new inWords, since both inWords and inWordsFromStrings use the same internals.
* Added a test for changing language.
* Moved changelog things to this file (changelog.md) instead.
* Updated the Readme, to show how to work with the module.

### 2.0.5
* Added Bulgarian translation, thanks to @ironsmile
* Added Latvian translation, thanks to @intarstudents
* Updated French translation, thanks to a team of two? @ArthurHoaro and @blaugueux
* Updated Portuguese translations, thanks to @ivesbrito

### 2.0.4
* Added Catalan translation, thanks to @Ajenbo and @esrefesen

### 2.0.3
* Added Swedish translation, thanks to @khromov
* Added Gregorian translation, thanks to @nikopeikrishvili
* Added Vietnamese translation, thanks to @baivong

### 2.0.2

* Removed user specific files from .gitignore
* Using strict comparison
* Added a method for rounding the number of months to use

### 2.0.1

* Fixed a file encoding problem on the korean translation
* Added a never translate on the turkish translation (thanks to @esrefesen)

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
