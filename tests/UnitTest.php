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
    public function testgetAccount()
    {
       $response = $this->call('GET','/account');

        $this->assertEquals(
            200, $response->status()
        );
    }
}
