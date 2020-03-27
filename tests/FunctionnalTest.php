<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class FunctionnalTest extends TestCase
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

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testgetMedias()
    {
       $response = $this->call('GET','/medias');

        $this->assertEquals(
            200, $response->status()
        );
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testgetLastMedias()
    {
       $response = $this->call('GET','/last-medias');

        $this->assertEquals(
            200, $response->status()
        );
    }


    /**
     * A basic test example.
     *
     * @return void
     */
    public function testgetNews()
    {
       $response = $this->call('GET','/news');
        $this->assertEquals(
            200, $response->status()
        );
    }


    /**
     * A basic test example.
     *
     * @return void
     */
    public function testPostRegister()
    {
        $faker = Faker\Factory::create();
        $response = $this->call('POST','/register',['firstname'=>$faker->firstname, 'lastname'=>$faker->lastname, "email"=>$faker->email,"password"=>"testtest"]);
        $this->assertEquals(
            200, $response->status()
        );
    }

       /**
     * A basic test example.
     *
     * @return void
     */
    public function testPostRegisterWithUserInDB()
    {
       $response = $this->call('POST','/register',['firstname'=>'TEST', 'lastname'=>"TEST", "email"=>"test@test.com","password"=>"testtest"]);

        $this->assertEquals(
            500, $response->status()
        );
    }


    /**
     * A basic test example.
     *
     * @return void
     */
    public function testPostLogin()
    {
       $response = $this->call('POST','/login',['email'=>'test@test.com','password'=>'testtest']);
       $this->seeJson(
        ['success'=> true]
        );
        $this->assertEquals(
            200, $response->status()
        );
    }

    // /**
    //  * A basic test example.
    //  *
    //  * @return void
    //  */
    // public function getLogout()
    // {
    //    $response = $this->call('GET','/logout');

    //     $this->assertEquals(
    //         200, $response->status()
    //     );
    // }
}
