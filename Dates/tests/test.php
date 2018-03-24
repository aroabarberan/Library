<?php

require_once 'dates/DateFilter.php';
require_once 'dates/Date.php';
require_once 'dates/enum/Season.php';



// FROMAS DE CREAR UNA FECHA.

$date1 = Date::createDate(2017, 10, 20); // FECHA QUE LE PASEMOS.
$date2 = Date::now();   // FECHA ACTUAL.
$date3 = Date::createFromTime(time());  // PASANDOLE LOS SEGUNDOS.

// FECHA DE INICIO Y FECHA DE FIN.
$startDate = Date::createDate(2000, 1, 1);
$endDate = Date::createDate(2000, 2, 31);

// CUENTA LOS DIAS DEL ANIO 2000.
$dates = Date::datesBetween($startDate, $endDate);
echo "<pre>" . print_r($dates, true) . "</pre>";


// CREO UNA LISTA DE FECHAS.
//$list = new DateArrayList();
// AGREGO UNA FECHA A LA LISTA.
//$list->add(Date::now());
//$list->add($dates[7]);
//$list->add($dates[11]);
//$list->add($dates[9]);

// AGREGO VARIAS FECHAS A LA LISTA.
//$list->addAll([
//    $date1,
//    $date2,
//    $date3,
//]);

// DEVUELVO EL TAMANIO DE LA LISTA
//$list->size();
// ELIMINO LA PRIMERA FECHA DE LA LISTA Y SE COLOCAN LOS INDICES
//$list->remove(0);

//$dateList = DateFilter::builder($list);
//echo "<pre>" . print_r($dateList->filterByDaysOfWeek(DayOfWeek::FRIDAY), true) . "</pre>";

// DATES SORTED FROM BEFORE TO AFTER
//$list->sort(new DateTimeComparator());

// DATES SORTED FROM AFTER TO BEFORE
//$list->sort(new DateTimeComparator(), false);

// Date[]
//$dates = Date::between($startDate, $endDate);

// Get only weekends in summer and spring
//$filtered = DateFilterBuilder::generate($dates)
//    ->filterBySeasons([Season::SUMMER, Season::SPRING])
//    ->filterByDaysOfWeek([DayOfWeek::SATURDAY, DayOfWeek::SUNDAY])
//    ->build();

// CREATE THE LIST
//$list = new WorkDateArrayList();

// ADD ELEMENTS TO THE LIST AND HOURS PER DAY / HOUR WAGES
//$list->addAll([
//    WorkDate::now(10, 5),
//    WorkDate::now(10, 5),
//]);

// WORKED HOURS
//$hours = $list->workedHours();

// TOTAL EARNINGS
//$earnings = $list->earnings();