<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Schedule;
use SebastianBergmann\CodeCoverage\CodeCoverage;

class ScheduleTest extends TestCase
{
    // To test : seed DB with FakerSeeder
    // and run vendor/bin/phpunit

    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetByIdSchedule()
    {
        $scheduleInDb = Schedule::find(1);
        $this->assertSame("TEST GET", $scheduleInDb->location);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateSchedule()
    {
        $schedule = factory('App\Schedule')->make();
        $schedule->save();
        $this->seeInDatabase('schedule', ['location' => $schedule->location]);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUpdateSchedule()
    {
        $schedule = Schedule::find(1);
        $schedule->location = "TEST UPDATE";
        $schedule->save();
        $scheduleinDB = Schedule::find(1);
        $this->assertSame($schedule->location, $scheduleinDB->location);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testDeleteSchedule()
    {
        $schedule = factory('App\Schedule')->make();
        $schedule->location = "TEST DELETE";
        $schedule->save();
        Schedule::Where("location", $schedule->location)->delete();
        $this->notSeeInDatabase('schedule',['location'=> $schedule->location]);

    }
}

