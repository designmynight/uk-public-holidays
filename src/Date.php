<?php

namespace DesignMyNight\UKPublicHolidays;

use Carbon\Carbon;

abstract class Date
{
    /**
     * @param Carbon $carbon
     * @return bool
     */
    public static function isFirstWorkingDayOfTheMonth(Carbon $carbon)
    {
        $date = $carbon->copy()->startOfMonth();

        for ($date; $date->lte($carbon); $date->addDay()) {
            if (static::isWorkingDay($date)) {
                return $date->format('Y-m-d') === $carbon->format('Y-m-d');
            }
        }

        return false;
    }

    /**
     * @param Carbon $carbon
     * @return bool
     */
    public static function isHoliday(Carbon $carbon)
    {
        return PublicHolidays::getDate($carbon) !== null;
    }

    /**
     * @param Carbon $carbon
     * @return bool
     */
    public static function isWorkingDay(Carbon $carbon)
    {
        return $carbon->isWeekday() && static::isHoliday($carbon) === false;
    }

    /**
     * @return Carbon
     */
    public static function nextWorkingDay()
    {
        $date = Carbon::today();

        do {
            $date->addWeekday();
        } while(static::isHoliday($date) === true);

        return $date;
    }

    /**
     * @return Carbon
     */
    public static function previousWorkingDay()
    {
        $date = Carbon::today();

        do {
            $date->subWeekday();
        } while(static::isHoliday($date) === true);

        return $date;
    }
}
