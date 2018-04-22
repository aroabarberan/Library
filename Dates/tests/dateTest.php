<?php

include dirname(__FILE__) . '/../Date.php';
include dirname(__FILE__) . '/../FamilyDate.php';


// Dos maneras de crear fechas.
$date1 = FamilyDate::separateStringDateToObjectDate('2/5/2000');
$date2 = new Date(1114984800);
$date3 = Date::createDate(2017, 12, 21);

// Convierto el objeto fecha a segundos.
$initSeconds = FamilyDate::convertToSeconds($date1->getYear(), $date1->getNumberMonth(), $date1->getDay());
$endSeconds = FamilyDate::convertToSeconds($date2->getYear(), $date2->getNumberMonth(), $date2->getDay());

// Dias que han pasado entre una fecha y otra.
$days = FamilyDate::datesBetween($date1, $date2);
$months = FamilyDate::monthsBetween($date1, $date2);
$years = FamilyDate::yearsBetween($date1, $date2);
//echo 'Han pasado ' . (count($days) -1) . ' dias ' . (count($months) -1) . ' meses y ' . (count($years) -1) . ' año';

// Es bisiesto?
$leap = FamilyDate::isLeap($date3->getYear());

// Ultimo dia del mes.
$lastDay = FamilyDate::lastDayOfMonth($date3);

// Dias que faltan hasta final de anio.
$daysToEnd = FamilyDate::daysToEndYear($date3);

// Es mayor de edad?
$age = FamilyDate::isAdult(Date::createDate(1995, 5, 26));

// Muestro todos los lunes que son dia 2.
$days = FamilyDate::datesBetween(Date::createDate(2016, 1, 1), Date::createDate(2016, 12, 31));
$daysFilters = FamilyDate::showAllSpecificDays($days, 2,1);

echo "<pre>" . print_r($daysFilters, true) . "</pre>";
