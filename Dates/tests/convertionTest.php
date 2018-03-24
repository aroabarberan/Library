<?php

require_once '../Convertion.php';


function testSecondsTo()
{
    // CONVERTIR DE SEGUNDOS A MINUTOS, HORAS, DIAS, MESES, ANIOS.
    echo '<br>FUNCIONES DE SEGUNDOS A ...<br><br>';
    echo '60 segundos es ' . Convertion::secondsToMinutes(60) . ' minuto<br>';
    echo '3600 segundos es ' . Convertion::secondsToHours(3600) . ' hora<br>';
    echo '86400 segundos es ' . Convertion::secondsToDays(86400) . ' dia<br>';
    echo '2592000 segundos es ' . Convertion::secondsToMonths(2592000) . ' mes<br>';
    echo '31104000 segundos es ' . Convertion::secondsToYears(31104000) . ' anio<br>';
}


testSecondsTo();

