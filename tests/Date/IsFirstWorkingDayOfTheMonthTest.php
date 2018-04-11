<?php

namespace DesignMyNight\UKPublicHolidays\Tests\Date;

use Carbon\Carbon;
use DesignMyNight\UKPublicHolidays\Date;
use PHPUnit\Framework\TestCase;

class IsFirstWorkingDayOfTheMonthTest extends TestCase
{
    public function test_that_false_is_returned_when_first_day_of_month_is_staturday()
    {
        $date = Carbon::parse('2018-04-01');

        $this->assertFalse(Date::isFirstWorkingDayOfTheMonth($date));
    }

    public function test_that_true_is_returned_for_monday_following_month_start_over_weekend()
    {
        $date = Carbon::parse('2017-10-02');

        $this->assertTrue(Date::isFirstWorkingDayOfTheMonth($date));
    }

    public function test_that_false_is_returned_when_monday_is_a_holiday()
    {
        $date = Carbon::parse('2018-04-02');

        $this->assertFalse(Date::isFirstWorkingDayOfTheMonth($date));
    }

    public function test_that_true_is_returned_for_tuesday_following_public_holiday()
    {
        $date = Carbon::parse('2018-04-03');

        $this->assertTrue(Date::isFirstWorkingDayOfTheMonth($date));
    }

    public function test_that_false_is_returned_for_tuesday_that_isnt_the_first_working_day()
    {
        $date = Carbon::parse('2017-10-03');

        $this->assertFalse(Date::isFirstWorkingDayOfTheMonth($date));
    }
}
