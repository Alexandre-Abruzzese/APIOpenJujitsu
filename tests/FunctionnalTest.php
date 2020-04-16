<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use SebastianBergmann\CodeCoverage\CodeCoverage;


class FunctionnalTest extends TestCase
{
    // To test : seed DB with FakerSeeder
    // and run vendor/bin/phpunit
    // use DatabaseMigrations;
    // use DatabaseTransactions;

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

    public function testpostContact()
    {
        $contact = factory('App\Contact')->make();
        $response = $this->call('POST','/contact', ['firstname'=>$contact->firstname, 'lastname'=>$contact->lastname, "email"=>$contact->email,"body"=>$contact->body,'phone'=>$contact->phone]);

        $this->assertEquals(
            200, $response->status()
        );
    }

    public function testgetContact()
    {
        $response = $this->call('GET','/contacts');

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
        $user = factory('App\User')->make();
        $response = $this->call('POST','/register',['firstname'=>$user->firstname, 'lastname'=>$user->lastname, "email"=>$user->email,"password"=>$user->password]);
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

}
