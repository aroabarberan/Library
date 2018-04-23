<?php


include dirname(__FILE__) . '/../Date.php';
include dirname(__FILE__) . '/../FamilyDate.php';
include dirname(__FILE__) . '/../Filter.php';
include dirname(__FILE__) . '../enum/Season.php';
include dirname(__FILE__) . '../enum/Month.php';

$date1 = Date::createDate(2017, Month::JANUARY, 1);
$date2 = Date::createDate(2017, Month::DECEMBER, 31);


$dates = FamilyDate::datesBetween($date1, $date2);

$filter = Filter::bySeasons($dates, [Season::WINTER, Season::SPRING]);
echo "<pre>" . print_r($filter, true) . "</pre>";