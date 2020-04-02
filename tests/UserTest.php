<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\User;

class UserTest extends TestCase
{
    // To test : seed DB with FakerSeeder
    // and run vendor/bin/phpunit

    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetByIdUser()
    {
        $user = User::find(2);
        $this->assertSame("test@test.com", $user->email);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateUser()
    {
        $user = factory('App\User')->make();
        $user->save();
        $this->seeInDatabase('users', ['email' => $user->email]);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUpdateUser()
    {
        $user = User::find(2);
        $user->firstname = "TEST UPDATE";
        $user->save();
        $userinDB = User::find(2);
        $this->assertSame($user->firstname, $userinDB->firstname);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testDeleteUser()
    {
        $user = factory('App\User')->make();
        $user->save();
        User::Where("email", $user->email)->delete();
        $userInDb = User::Where("email",$user->email)->get();
        $this->notSeeInDatabase('users',['email'=> $user->email]);

    }
}
