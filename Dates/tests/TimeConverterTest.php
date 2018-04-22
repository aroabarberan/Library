<?php

include dirname(__FILE__) . '/../Convertion.php';


function testSecondsTo()
{
    // CONVERTIR DE SEGUNDOS A MINUTOS, HORAS, DIAS, MESES, ANIOS.
    echo '<br>FUNCIONES DE SEGUNDOS A ...<br><br>';
    echo '60 segundos es ' . Convertion::secondsToMinutes(60) . ' minuto<br>';
    echo '3600 segundos es ' . Convertion::secondsToHours(3600, 0) . ' hora<br>';
    echo '86400 segundos es ' . Convertion::secondsToDays(86400, 0) . ' dia<br>';
    echo '2629800 segundos es ' . Convertion::secondsToMonths(2629800) . ' mese<br>';
    echo '31560000 segundos es ' . Convertion::secondsToYears(31560000) . ' anio<br>';
}

function testMinutesTo()
{
    // CONVERTIR DE MINUTOS A SEGUNDOS, HORAS, DIAS, MESES, ANIOS.
    echo '<br><br>FUNCIONES DE MINUTOS A ...<br><br>';
    echo '1 minutos son ' . Convertion::minutesToSeconds(1) . ' segundos<br>';
    echo '60 minutos es ' . Convertion::minutesToHours(60, 0) . ' hora<br>';
    echo '1440 minutos es ' . Convertion::minutesToDays(1440, 0) . ' dia<br>';
    echo '44000 minutos es ' . Convertion::minutesToMonths(44000) . ' mese<br>';
    echo '528000 minutos es ' . Convertion::minutesToYears(528000) . ' anio<br>';
}

function testHoursTo()
{
    // CONVERTIR DE HORAS A SEGUNDOS, MINUTOS, DIAS, MESES, ANIOS.
    echo '<br><br>FUNCIONES DE HORAS A ...<br><br>';
    echo '1 hora son ' . Convertion::hoursToSeconds(1) . ' segundos<br>';
    echo '1 hora son ' . Convertion::hoursToMinutes(1, 0) . ' minutos<br>';
    echo '24 horas es ' . Convertion::hoursToDays(24, 0) . ' dia<br>';
    echo '730 horas es ' . Convertion::hoursToMonths(730) . ' mes<br>';
    echo '8760 horas es ' . Convertion::hoursToYears(8760) . ' anio<br>';
}

function testDaysTo()
{
    // CONVERTIR DE DIAS A SEGUNDOS, MINUTOS, HORAS, MESES, ANIOS.
    echo '<br><br>FUNCIONES DE DIAS A ...<br><br>';
    echo '1 dia son ' . Convertion::daysToSeconds(1) . ' segundos<br>';
    echo '1 dia son ' . Convertion::daysToMinutes(1, 0) . ' minutos<br>';
    echo '1 dia tiene ' . Convertion::daysToHours(1, 0) . ' horas<br>';
    echo '31 dias es ' . Convertion::daysToMonths(31) . ' mes<br>';
    echo '365 dia es ' . Convertion::daysToYears(365) . ' anio<br>';
}

function testMonthsTo()
{
    // CONVERTIR DE MESES A SEGUNDOS, MINUTOS, HORAS, DIAS, ANIOS.
    echo '<br><br>FUNCIONES DE MESES A ...<br><br>';
    echo '1 mes son ' . Convertion::monthsToSeconds(1) . ' segundos<br>';
    echo '1 mes son ' . Convertion::monthsToMinutes(1) . ' minutos<br>';
    echo '1 mes son ' . Convertion::monthsToHours(1, 1) . ' horas<br>';
    echo '1 mes son ' . Convertion::monthsToDays(1) . ' dias<br>';
    echo '12 meses es ' . Convertion::monthsToYears(12) . ' anio<br>';
}

function testYearsTo()
{
    // CONVERTIR DE ANIOS A SEGUNDOS, MINUTOS, HORAS, DIAS, MESES.
    echo '<br><br>FUNCIONES DE ANIOS A ...<br><br>';
    echo '1 anio son ' . Convertion::yearsToSeconds(1) . ' segundos<br>';
    echo '1 anio son ' . Convertion::yearsToMinutes(1) . ' minutos<br>';
    echo '1 anio son ' . Convertion::yearsToHours(1, 1) . ' horas<br>';
    echo '1 anio son ' . Convertion::yearsToDays(1) . ' dias<br>';
    echo '1 anio son ' . Convertion::yearsToMonths(1) . ' meses<br>';
}


testSecondsTo();
testMinutesTo();
testHoursTo();
testDaysTo();
testMonthsTo();
testYearsTo();
