<?php

namespace DesignMyNight\UKPublicHolidays;

use Carbon\Carbon;

abstract class PublicHolidays
{
    protected static $holidays = null;
    protected static $region = 'england-and-wales';

    /**
     * @return array
     */
    public static function all()
    {
        if (static::$holidays === null) {
            $json = file_get_contents('https://www.gov.uk/bank-holidays.json');

            static::$holidays = json_decode($json, true);
        }

        return static::$holidays;
    }

    /**
     * @param Carbon $carbon
     * @return array|null
     */
    public static function getDate(Carbon $carbon)
    {
        $filtered = array_filter(PublicHolidays::region(self::$region), function($holiday) use($carbon) {
            return $holiday['date'] === $carbon->format('Y-m-d');
        });

        return array_values($filtered)[0] ?? null;
    }

    /**
     * @param string $region
     * @return array
     */
    public static function region(string $region)
    {
        return static::all()[$region]['events'];
    }

    /**
     * @param string $region
     */
    public static function setRegion(string $region)
    {
        static::$region = $region;
    }
}
