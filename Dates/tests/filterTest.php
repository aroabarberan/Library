<?php

require_once '../Date.php';
require_once '../Filter.php';
require_once '../FamilyDate.php';
require_once '../enum/Month.php';
require_once '../enum/Season.php';

$date1 = Date::createDate(2017, Month::JANUARY, 1);
$date2 = Date::createDate(2017, Month::DECEMBER, 31);


$dates = FamilyDate::datesBetween($date1, $date2);

$filter = Filter::bySeasons($dates, [Season::WINTER, Season::SPRING]);
echo "<pre>" . print_r($filter, true) . "</pre>";