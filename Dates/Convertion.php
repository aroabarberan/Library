<?php


class Convertion
{
    const SECONDS_PER_HOURS = 3600;
    const SECONDS_PER_MINUTES = 60;

    const MINUTES_PER_DAY = self::SECONDS_PER_HOURS * self::HOURS_PER_DAY;

    const HOURS_PER_DAY = 24;
    const DAYS_PER_MONTH = 30;
    const MONTHS_PER_YEAR = 12;

    // SECONDS.
    public static function secondsToMinutes($seconds)
    {
        return $seconds / self::SECONDS_PER_MINUTES;
    }

    public static function secondsToHours($seconds)
    {
        return $seconds / self::SECONDS_PER_HOURS;
    }

    public static function secondsToDays($seconds)
    {
        return $seconds / self::MINUTES_PER_DAY;
    }

    public static function secondsToMonths($seconds)
    {
        return $seconds / (self::MINUTES_PER_DAY * self::DAYS_PER_MONTH);
    }

    public static function secondsToYears($seconds)
    {
        return $seconds / (self::MINUTES_PER_DAY * self::DAYS_PER_MONTH * self::MONTHS_PER_YEAR);
    }

    // MINUTES.
    public static function minutesToSeconds($minutes)
    {
        return $minutes * self::SECONDS_PER_MINUTES;
    }

    public static function minutesToHours($minutes)
    {
        return Convertion::secondsToHours(Convertion::minutesToSeconds($minutes));
    }

    public static function minutesToDays($minutes)
    {
        return Convertion::secondsToDays(Convertion::minutesToSeconds($minutes));
    }

    public static function minutesToMonths($minutes)
    {
        return Convertion::secondsToMonths(Convertion::minutesToSeconds($minutes));
    }

    public static function minutesToYears($minutes)
    {
        return Convertion::secondsToYears(Convertion::minutesToSeconds($minutes));
    }

    // HOURS.
    public static function hoursToSeconds($hours)
    {
        return $hours * self::SECONDS_PER_HOURS;
    }

    public static function hoursToMinutes($hours)
    {
        return $hours * self::SECONDS_PER_MINUTES;
    }

    public static function hoursToDays($hours)
    {
        return Convertion::secondsToDays(Convertion::hoursToSeconds($hours));
    }

    public static function hoursToMonths($hours)
    {
        return Convertion::secondsToMonths(Convertion::hoursToSeconds($hours));
    }

    public static function hoursToYears($hours)
    {
        return Convertion::secondsToYears(Convertion::hoursToSeconds($hours));
    }

    // DAYS.
    public static function daysToSeconds($days)
    {
        return $days * self::MINUTES_PER_DAY;
    }

    public static function daysToMinutes($days)
    {
        return Convertion::secondsToMinutes(Convertion::daysToSeconds($days));
    }

    public static function daysToHours($days)
    {
        return Convertion::secondsToHours(Convertion::daysToSeconds($days));
    }

    public static function daysToMonths($days)
    {
        return Convertion::secondsToMonths(Convertion::daysToSeconds($days));
    }

    public static function daysToYears($days)
    {
        return Convertion::secondsToYears(Convertion::daysToSeconds($days));
    }

    // MONTHS.
    public static function monthsToSeconds($months)
    {
        return $months * (self::MINUTES_PER_DAY * self::DAYS_PER_MONTH);
    }

    public static function monthsToMinutes($months)
    {
        return Convertion::secondsToMinutes(Convertion::monthsToSeconds($months));
    }

    public static function monthsToHours($months)
    {
        return Convertion::secondsToHours(Convertion::monthsToSeconds($months));
    }

    public static function monthsToDays($months)
    {
        return Convertion::secondsToDays(Convertion::monthsToSeconds($months));
    }

    public static function monthsToYears($months)
    {
        return Convertion::secondsToYears(Convertion::monthsToSeconds($months));
    }

    // YEARS.
    public static function yearsToSeconds($years)
    {
        return $years * (self::MINUTES_PER_DAY * self::DAYS_PER_MONTH * self::MONTHS_PER_YEAR);
    }

    public static function yearsToMinutes($years)
    {
        return Convertion::secondsToMinutes(Convertion::yearsToSeconds($years));
    }

    public static function yearsToDays($years)
    {
        return Convertion::secondsToDays(Convertion::yearsToSeconds($years));
    }

    public static function yearsToHours($years)
    {
        return Convertion::secondsToHours(Convertion::yearsToSeconds($years));
    }

    public static function yearsToMonths($years)
    {
        return Convertion::secondsToMonths(Convertion::yearsToSeconds($years));
    }


}