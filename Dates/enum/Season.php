<?php

require_once 'Month.php';

class Season
{
    const SPRING = 1;
    const SUMMER = 2;
    const AUTUMN = 3;
    const WINTER = 4;

    public static function isSpring($dateInSeconds, $year)
    {
        $start = mktime(0, 0, 0, Month::MARCH, 21, $year);
        $end = mktime(0, 0, 0, Month::JUNE, 20, $year);

        if ($dateInSeconds >= $start && $dateInSeconds <= $end) return true;
        return false;
    }

    public static function isSummer($dateInSeconds, $year)
    {
        $start = mktime(0, 0, 0, Month::JUNE, 21, $year);
        $end = mktime(0, 0, 0, Month::SEPTEMBER, 22, $year);

        if ($dateInSeconds >= $start && $dateInSeconds <= $end) return true;
        return false;
    }

    public static function isSAutumn($dateInSeconds, $year)
    {
        $start = mktime(0, 0, 0, Month::SEPTEMBER, 23, $year);
        $end = mktime(0, 0, 0, Month::DECEMBER, 20, $year);

        if ($dateInSeconds >= $start && $dateInSeconds <= $end) return true;
        return false;
    }

    public static function isWinter($dateInSeconds, $year)
    {
        $start = mktime(0, 0, 0, Month::DECEMBER, 22, $year);
        $end = mktime(0, 0, 0, Month::MARCH, 20, $year);

        if ($dateInSeconds >= $start && $dateInSeconds <= $end) return true;
        return false;
    }
}