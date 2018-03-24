<?php

require_once 'enum/Season.php';

class Date
{
    private $year;
    private $numberMonth;
    private $month;
    private $day;

    private $hour;
    private $minute;
    private $seconds;

    private $numberWeekday;
    private $weekDay;

    private $numberSeason;
    private $season;

    private $secondsUnix;


    public function __construct($dateInSeconds = 0)
    {
        $this->fillDate(getdate($dateInSeconds));
    }

    public static function createDate($year, $month, $day)
    {
        $date = FamilyDate::convertToSeconds($year, $month, $day);
        return new Date($date);
    }

    private function fillDate($date)
    {
        $this->year = $date['year'];
        $this->numberMonth = $date['mon'];
        $this->month = $date['month'];
        $this->day = $date['mday'];

        $this->hour = $date['hours'];
        $this->minute = $date['minutes'];
        $this->seconds = $date['seconds'];

        $this->numberWeekday = $date['wday'];
        $this->weekDay = $date['weekday'];
        $this->typeOfSeason($date[0]);
        $this->secondsUnix = $date[0];

    }

    private function typeOfSeason($date)
    {
        if (Season::isSpring($date, $this->year)) {
            $this->numberSeason = Season::SPRING;
            $this->season = "Spring";
        } elseif (Season::isSummer($date, $this->year)) {
            $this->numberSeason = Season::SUMMER;
            $this->season = "Summer";
        } elseif (Season::isSAutumn($date, $this->year)) {
            $this->numberSeason = Season::AUTUMN;
            $this->season = "Autumn";
        } else {
            $this->numberSeason = Season::WINTER;
            $this->season = "Winter";
        }
    }

    public function getYear()
    {
        return $this->year;
    }

    public function setYear($year)
    {
        $this->year = $year;
    }

    public function getNumberMonth()
    {
        return $this->numberMonth;
    }

    public function setNumberMonth($numberMonth)
    {
        $this->numberMonth = $numberMonth;
    }

    public function getMonth()
    {
        return $this->month;
    }

    public function setMonth($month)
    {
        $this->month = $month;
    }

    public function getDay()
    {
        return $this->day;
    }

    public function setDay($day)
    {
        $this->day = $day;
    }

    public function getHour()
    {
        return $this->hour;
    }

    public function setHour($hour)
    {
        $this->hour = $hour;
    }

    public function getMinute()
    {
        return $this->minute;
    }

    public function setMinute($minute)
    {
        $this->minute = $minute;
    }

    public function getSeconds()
    {
        return $this->seconds;
    }

    public function setSeconds($seconds)
    {
        $this->seconds = $seconds;
    }

    public function getNumberWeekday()
    {
        return $this->numberWeekday;
    }

    public function setNumberWeekday($numberWeekday)
    {
        $this->numberWeekday = $numberWeekday;
    }

    public function getWeekDay()
    {
        return $this->weekDay;
    }

    public function setWeekDay($weekDay)
    {
        $this->weekDay = $weekDay;
    }

    public function getNumberSeason()
    {
        return $this->numberSeason;
    }

    public function setNumberSeason($numberSeason)
    {
        $this->numberSeason = $numberSeason;
    }

    public function getSeason()
    {
        return $this->season;
    }

    public function setSeason($season)
    {
        $this->season = $season;
    }

    public function getSecondsUnix()
    {
        return $this->secondsUnix;
    }

    public function setSecondsUnix($secondsUnix)
    {
        $this->secondsUnix = $secondsUnix;
    }
}