<?php


include dirname(__FILE__) . '/enum/Season.php';
include dirname(__FILE__) . '/Date.php';


class FamilyDate
{

    public static function separateStringDateToObjectDate($date, $separator = '/')
    {
        $files = explode($separator, $date);
        return Date::createDate($files[2], $files[1], $files[0]);
    }

    public static function convertToSeconds($year, $month, $day, $hour = 0, $min = 0, $seconds = 0)
    {
        return mktime($hour, $min, $seconds, $month, $day, $year);
    }

    public static function datesBetween($starDate, $endDate)
    {
        $dates = [];
        while ($starDate->getSecondsUnix() <= $endDate->getSecondsUnix()) {
            array_push($dates, $starDate);
            $starDate = new Date(mktime(0, 0, 0, $starDate->getNumberMonth(), $starDate->getDay() + 1, $starDate->getYear()));
        }
        return $dates;
    }

    public static function monthsBetween($starDate, $endDate)
    {
        $dates = [];
        while ($starDate->getSecondsUnix() <= $endDate->getSecondsUnix()) {
            array_push($dates, $starDate);
            $starDate = new Date(mktime(0, 0, 0, $starDate->getNumberMonth() + 1, $starDate->getDay(), $starDate->getYear()));
        }
        return $dates;
    }

    public static function yearsBetween($starDate, $endDate)
    {
        $dates = [];
        while ($starDate->getSecondsUnix() <= $endDate->getSecondsUnix()) {
            $starDate = new Date(mktime(0, 0, 0, $starDate->getNumberMonth(), $starDate->getDay(), $starDate->getYear() + 1));
            array_push($dates, $starDate);
        }
        return $dates;
    }

    public static function isLeap($year)
    {
        if ($year % 4 == 0) return true;
        return false;
    }

    public static function lastDayOfMonth(Date $date)
    {
        return Date::createDate($date->getYear(), $date->getNumberMonth() + 1, 0)->getDay();
    }

    public static function daysToEndYear(Date $date)
    {
        $end = Date::createDate($date->getYear() + 1, 1, 0);
        $dates = FamilyDate::datesBetween($date, $end);
        return $dates;
    }

    public static function isAdult(Date $date)
    {
        $now = new Date(time());
        $temp = FamilyDate::convertToSeconds($now->getYear() - 18, $now->getNumberMonth(), $now->getDay());
        $date = FamilyDate::convertToSeconds($date->getYear(), $date->getNumberMonth(), $date->getDay());

        if ($date < $temp) {
            return true;
        } else {
            return false;
        }
    }

    public static function showAllSpecificDays($dates, $day, $weekday)
    {
        $datesFilters = [];
        foreach ($dates as $date):
            if ($date->getDay() == $day && $date->getNumberWeekday() == $weekday):
                $datesFilters[] = $date;
            endif;
        endforeach;

        return $datesFilters;
    }

}
