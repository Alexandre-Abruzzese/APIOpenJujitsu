<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class UnitTest extends TestCase
{
    // To test : seed DB with FakerSeeder
    // and run vendor/bin/phpunit

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUnitRegister()
    {
        $this->asserttrue(true);
    }
}
