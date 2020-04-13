<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Event;
use SebastianBergmann\CodeCoverage\CodeCoverage;

class EventTest extends TestCase
{
    // To test : seed DB with FakerSeeder
    // and run vendor/bin/phpunit

    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetByIdEvent()
    {
        $eventInDb = Event::find(1);
        $this->assertSame("TEST GET", $eventInDb->author);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateEvent()
    {
        $event = factory('App\Event')->make();
        $event->save();
        $this->seeInDatabase('events', ['author' => $event->author]);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUpdateEvent()
    {
        $event = Event::find(1);
        $event->author = "TEST UPDATE";
        $event->save();
        $eventinDB = Event::find(1);
        $this->assertSame($event->author, $eventinDB->author);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testDeleteEvent()
    {
        $event = factory('App\Event')->make();
        $event->author = "TEST DELETE";
        $event->save();
        Event::Where("author", $event->author)->delete();
        $this->notSeeInDatabase('events',['author'=> $event->author]);

    }
}

