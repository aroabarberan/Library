<?php

require_once 'autoload.php';
require_once 'dates/TimeConverter.php';

function testSecondsTo()
{
    // CONVERTIR DE SEGUNDOS A MINUTOS, HORAS, DIAS, MESES, ANIOS.
    echo '<br>FUNCIONES DE SEGUNDOS A ...<br><br>';
    echo '60 segundos es ' . TimeConverter::secondsToMinutes(60) . ' minuto<br>';
    echo '3600 segundos es ' . TimeConverter::secondsToHours(3600, 0) . ' hora<br>';
    echo '86400 segundos es ' . TimeConverter::secondsToDays(86400, 0) . ' dia<br>';
    echo '2629800 segundos es ' . TimeConverter::secondsToMonths(2629800) . ' mese<br>';
    echo '31560000 segundos es ' . TimeConverter::secondsToYears(31560000) . ' anio<br>';
}

function testMinutesTo()
{
    // CONVERTIR DE MINUTOS A SEGUNDOS, HORAS, DIAS, MESES, ANIOS.
    echo '<br><br>FUNCIONES DE MINUTOS A ...<br><br>';
    echo '1 minutos son ' . TimeConverter::minutesToSeconds(1) . ' segundos<br>';
    echo '60 minutos es ' . TimeConverter::minutesToHours(60, 0) . ' hora<br>';
    echo '1440 minutos es ' . TimeConverter::minutesToDays(1440, 0) . ' dia<br>';
    echo '44000 minutos es ' . TimeConverter::minutesToMonths(44000) . ' mese<br>';
    echo '528000 minutos es ' . TimeConverter::minutesToYears(528000) . ' anio<br>';
}

function testHoursTo()
{
    // CONVERTIR DE HORAS A SEGUNDOS, MINUTOS, DIAS, MESES, ANIOS.
    echo '<br><br>FUNCIONES DE HORAS A ...<br><br>';
    echo '1 hora son ' . TimeConverter::hoursToSeconds(1) . ' segundos<br>';
    echo '1 hora son ' . TimeConverter::hoursToMinutes(1, 0) . ' minutos<br>';
    echo '24 horas es ' . TimeConverter::hoursToDays(24, 0) . ' dia<br>';
    echo '730 horas es ' . TimeConverter::hoursToMonths(730) . ' mes<br>';
    echo '8760 horas es ' . TimeConverter::hoursToYears(8760) . ' anio<br>';
}

function testDaysTo()
{
    // CONVERTIR DE DIAS A SEGUNDOS, MINUTOS, HORAS, MESES, ANIOS.
    echo '<br><br>FUNCIONES DE DIAS A ...<br><br>';
    echo '1 dia son ' . TimeConverter::daysToSeconds(1) . ' segundos<br>';
    echo '1 dia son ' . TimeConverter::daysToMinutes(1, 0) . ' minutos<br>';
    echo '1 dia tiene ' . TimeConverter::daysToHours(1, 0) . ' horas<br>';
    echo '31 dias es ' . TimeConverter::daysToMonths(31) . ' mes<br>';
    echo '365 dia es ' . TimeConverter::daysToYears(365) . ' anio<br>';
}

function testMonthsTo()
{
    // CONVERTIR DE MESES A SEGUNDOS, MINUTOS, HORAS, DIAS, ANIOS.
    echo '<br><br>FUNCIONES DE MESES A ...<br><br>';
    echo '1 mes son ' . TimeConverter::monthsToSeconds(1) . ' segundos<br>';
    echo '1 mes son ' . TimeConverter::monthsToMinutes(1) . ' minutos<br>';
    echo '1 mes son ' . TimeConverter::monthsToHours(1, 1) . ' horas<br>';
    echo '1 mes son ' . TimeConverter::monthsToDays(1) . ' dias<br>';
    echo '12 meses es ' . TimeConverter::monthsToYears(12) . ' anio<br>';
}

function testYearsTo()
{
    // CONVERTIR DE ANIOS A SEGUNDOS, MINUTOS, HORAS, DIAS, MESES.
    echo '<br><br>FUNCIONES DE ANIOS A ...<br><br>';
    echo '1 anio son ' . TimeConverter::yearsToSeconds(1) . ' segundos<br>';
    echo '1 anio son ' . TimeConverter::yearsToMinutes(1) . ' minutos<br>';
    echo '1 anio son ' . TimeConverter::yearsToHours(1, 1) . ' horas<br>';
    echo '1 anio son ' . TimeConverter::yearsToDays(1) . ' dias<br>';
    echo '1 anio son ' . TimeConverter::yearsToMonths(1) . ' meses<br>';
}


testSecondsTo();
testMinutesTo();
testHoursTo();
testDaysTo();
testMonthsTo();
testYearsTo();
