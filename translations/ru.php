<?php

$timeAgoStrings = array(
  'aboutOneDay' => "вчера",
  'aboutOneHour' => "час назад",
  'aboutOneMonth' => "около месяца назад",
  'aboutOneYear' => "год назад",
  'days' => array("%s день назад", "%s дня назад", "%s дней назад"),
  'hours' => array("%s час назад", "%s часа назад", "%s часов назад"),
  'lessThanAMinute' => "меньше минуты",
  'lessThanOneHour' => array("%s минуту назад", "%s минуты назад", "%s минут назад"),
  'months' => array("%s месяцев назад", "%s месяцев назад", "%s месяцев назад"),
  'oneMinute' => "минуту назад",
  'years' => array("больше %s года назад", "больше %s лет назад", "больше %s лет назад")
);

$pluralFormDetection = function ($num, $collection) {
  $num = (int) $num;

  if ($num > 20) {
    $num %= 10;
  }

  if ($num == 1) {
    $form = $collection[0];
  } elseif ($num > 1 && $num < 5) {
    $form = $collection[1];
  } else {
    $form = isset($collection[2]) ? $collection[2] : $collection[1];
  }

  return $form;
};
