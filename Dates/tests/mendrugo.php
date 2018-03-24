<?php

use Date\Date;
use Date\DateFilterBuilder;
use Date\DayOfWeek;
use Date\Season;

require_once 'vendor/autoload.php';

const WORKED_HOURS_PER_DAY = 8;
const WORKED_HOURS_PER_DAY_FRIDAY = 4;
const EARNINGS_PER_HOUR = 7;
const EARNINGS_PER_HOUR_WINTER = 10;

/**
 * @param Date[] $dates
 * @return int
 */
function getHoursWithHalfFriday($dates) {
    // EXTRAIGO TODOS LOS DIAS QUE TRABAJA 8 HORAS
    $workedDatesExceptFriday = DateFilterBuilder::generate($dates)
        ->filterByDaysOfWeek([
            DayOfWeek::MONDAY,
            DayOfWeek::TUESDAY,
            DayOfWeek::WEDNESDAY,
            DayOfWeek::THURSDAY,
        ])->build();

    // EXTRAIGO TODOS LOS DIAS QUE TRABAJA 4 HORAS
    $workedDatesFriday = DateFilterBuilder::generate($dates)
        ->filterByDaysOfWeek([
            DayOfWeek::FRIDAY,
        ])->build();

    $hours =
        (count($workedDatesExceptFriday) * WORKED_HOURS_PER_DAY) +
        (count($workedDatesFriday) * WORKED_HOURS_PER_DAY_FRIDAY);

    return $hours;
}


$start = Date::createDate(2016, 05, 20);
$end = Date::createDate(2017, 10, 10);
$dates = Date::datesBetween($start, $end);

// EXTRAIGO EL RANGO BASICO
$dates = DateFilterBuilder::generate($dates)
    ->filterByDaysOfWeek([
        DayOfWeek::MONDAY,
        DayOfWeek::TUESDAY,
        DayOfWeek::WEDNESDAY,
        DayOfWeek::THURSDAY,
        DayOfWeek::FRIDAY,
    ])->filterBySeasons([
        Season::SPRING,
        Season::AUTUMN,
        Season::WINTER,
    ])->build();


// EXTRAIGO LOS DIAS QUE COBRA 7 EUROS
$workedDatesLowerPrice = DateFilterBuilder::generate($dates)
    ->filterBySeasons([
        Season::SPRING,
        Season::AUTUMN,
    ])->build();

// CALCULO LAS HORAS TRABAJADAS A 7 EUROS
$hoursLowerPrice = getHoursWithHalfFriday($workedDatesLowerPrice);


// EXTRAIGO LOS DIAS QUE COBRA 10 EUROS
$workedDatesHigherPrice = DateFilterBuilder::generate($dates)
    ->filterBySeasons([
        Season::WINTER,
    ])->build();

// CALCULO LAS HORAS TRABAJADAS A 10 EUROS
$hoursHigherPrice = getHoursWithHalfFriday($workedDatesHigherPrice);

$earnings = ($hoursLowerPrice * EARNINGS_PER_HOUR) + ($hoursHigherPrice * EARNINGS_PER_HOUR_WINTER);

echo $earnings;
