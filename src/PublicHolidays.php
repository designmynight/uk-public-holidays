<?php

namespace DesignMyNight\UKPublicHolidays;

use Carbon\Carbon;

abstract class PublicHolidays
{
    protected static $holidays = null;
    protected static $region = 'england-and-wales';

    public static function all(): array
    {
        if (static::$holidays === null) {
            $json = file_get_contents('https://www.gov.uk/bank-holidays.json');

            static::$holidays = json_decode($json, true);
        }

        return static::$holidays;
    }

    public static function getDate(Carbon $carbon): ?array
    {
        $filtered = array_filter(PublicHolidays::region(self::$region), function($holiday) use($carbon) {
            return $holiday['date'] === $carbon->format('Y-m-d');
        });

        return $filtered[0] ?? null;
    }

    public static function region(string $region): array
    {
        return static::all()[$region]['events'];
    }

    public static function setRegion(string $region): void
    {
        static::$region = $region;
    }
}
