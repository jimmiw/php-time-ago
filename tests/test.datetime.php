<?php

require('westsworld.datetime.class.php');

function test_time($timeAgo, $timeAsItShouldBe) {
  echo "<p>";
  $datetime = new WWDateTime($timeAgo);
  echo $datetime->format(DATE_RFC3339);
  echo " = ";
  echo $datetime->timeAgoInWords();
  echo " === ";
  echo $timeAsItShouldBe;
  echo "</p>";
}

test_time("-2 year", "over 2 years");
test_time("-1 year", "about 1 year");
test_time("-1 month", "about 1 month");
test_time("-2 month", "about 2 months");
test_time("-1 day", "about 1 day");
test_time("-2 day", "about 2 days");
test_time("-1 hour", "about 1 hour");
test_time("-2 hour", "about 2 hours");
test_time("-1 minute", "about 1 minute");
test_time("-2 minute", "about 2 minutes");
test_time("-44 minute", "about 44 minutes");
test_time("-45 minute", "about 1 hour");
test_time("-1 second", "less than a minute");
test_time("-31 second", "1 minute");

?>
