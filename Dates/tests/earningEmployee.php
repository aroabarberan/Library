<?php

require_once '../FamilyDate.php';
require_once '../Date.php';
require_once '../Filter.php';

// Un mendrugo trabaja de 2016/05/20 hasta 2017/10/10,
// no trabaja ni los fines de semana ni en verano.
// Los dias de diario trabaja 8 horas diarias y cobra 7 euros la hora.
// Cuantas horas lleva trabajadas y cuanto ha ganado hasta ahora.

// Total de horas trabajadas 1816
// Total de salario ganado 12712

// Pero ahora los viernes solo trabaja 4 horas.
// Y en inverno cobra 10 euros la hora.

$init = Date::createDate(2016, 05, 20);
$end = Date::createDate(2017, 10, 10);
$dates = FamilyDate::datesBetween($init, $end);

$filterBySeason = Filter::BySeasons($dates, [
    Season::SPRING,
    Season::AUTUMN,
    Season::WINTER
]);
$filterByWeekday = Filter::ByWeekday($filterBySeason, [
    Weekday::MONDAY,
    Weekday::THUESDAY,
    Weekday::WEDNESDAY,
    Weekday::THURSDAY,
    Weekday::FRIDAY,
]);
$hours = count($filterByWeekday) * 8;
$earning = count($filterByWeekday) * 8 * 7;

echo 'Total de horas trabajadas ' . $hours . '<br>';
echo 'Total de salario ganado ' . $earning . '<br>';

