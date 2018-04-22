<?php

include dirname(__FILE__) . '/enum/Weekday.php';


class Filter
{

    public static function BySeasons($dates, $seasons)
    {
        $date = array_filter($dates, function (Date $dates) use ($seasons) {
            return in_array($dates->getNumberSeason(), $seasons);
        });
        return $date;
    }

    public static function ByWeekday($dates, $weekdays)
    {
        $date = array_filter($dates, function (Date $dates) use ($weekdays) {
            return in_array($dates->getNumberWeekday(), $weekdays);
        });
        return $date;
    }
}