<?php

namespace DesignMyNight\UKPublicHolidays\Tests;

use Carbon\Carbon;
use DesignMyNight\UKPublicHolidays\PublicHolidays;
use PHPUnit\Framework\TestCase;

class PublicHolidaysTest extends TestCase
{
    public function test_get_date_that_is_a_holiday()
    {
        $date = Carbon::parse('2018-04-02');
        $holiday = PublicHolidays::getDate($date);

        $this->assertInternalType('array', $holiday);
        $this->assertEquals('Easter Monday', $holiday['title']);
    }
}
