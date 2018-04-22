<?php

include dirname(__FILE__) . '/../Date.php';
include dirname(__FILE__) . '/../FamilyDate.php';
include dirname(__FILE__) . '/../Filter.php';
include dirname(__FILE__) . '/../enum/Season.php';
include dirname(__FILE__) . '/../enum/Weekday.php';

// 2/10/2016 29/10/2017
// de lunes a vieres trabaja 8 horas y cobra 11€ al día,
// los sábados trabaja 5 horas,
// los domingos no trabaja,
// cobra 15€ en verano,
// libra una semana cada 6 trabajadas.

$star = Date::createDate(2016, 10, 2);
$end = Date::createDate(2017, 10, 29);

$dates = FamilyDate::datesBetween($star, $end);

$earning = 0;
$filterSummer = Filter::BySeasons($dates, [Season::SUMMER]);
$filterSummerWeekdays = Filter::ByWeekday($filterSummer, [
    Weekday::MONDAY,
    Weekday::THUESDAY,
    Weekday::WEDNESDAY,
    Weekday::THURSDAY,
    Weekday::FRIDAY,
]);
$filterSummerSaturdays = Filter::ByWeekday($filterSummer, [Weekday::SATURDAY]);

$earning = count($filterSummerWeekdays) * 8 * 15;
$earning += count($filterSummerSaturdays) * 5 * 15;

$filterSeasons = Filter::BySeasons($dates, [
    Season::SPRING,
    Season::AUTUMN,
    Season::WINTER,
]);
$filterWeekdays = Filter::ByWeekday($filterSeasons, [
    Weekday::MONDAY,
    Weekday::THUESDAY,
    Weekday::WEDNESDAY,
    Weekday::THURSDAY,
    Weekday::FRIDAY,
]);
$filterSaturdays = Filter::ByWeekday($filterSeasons, [Weekday::SATURDAY]);

$earning += count($filterWeekdays) * 8 * 11;
$earning += count($filterSaturdays) * 5 * 11;


echo 'En total ha ganado => ' . $earning;