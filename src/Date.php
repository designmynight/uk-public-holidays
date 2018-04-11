<?php

namespace DesignMyNight\UKPublicHolidays;

use Carbon\Carbon;

abstract class Date
{
    public static function isFirstWorkingDayOfTheMonth(Carbon $carbon): bool
    {
        $date = $carbon->copy()->startOfMonth();

        for ($date; $date->lte($carbon); $date->addDay()) {
            if (static::isWorkingDay($date)) {
                return $date->format('Y-m-d') === $carbon->format('Y-m-d');
            }
        }

        return false;
    }

    public static function isHoliday(Carbon $carbon): bool
    {
        return PublicHolidays::getDate($carbon) !== null;
    }

    public static function isWorkingDay(Carbon $carbon): bool
    {
        return $carbon->isWeekday() && static::isHoliday($carbon) === false;
    }

    public static function nextWorkingDay(): Carbon
    {
        $date = Carbon::today();

        do {
            $date->addWeekday();
        } while(static::isHoliday($date) === true);

        return $date;
    }

    public static function previousWorkingDay(): Carbon
    {
        $date = Carbon::today();

        do {
            $date->subWeekday();
        } while(static::isHoliday($date) === true);

        return $date;
    }
}
