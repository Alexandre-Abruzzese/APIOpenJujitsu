<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Contact;
use SebastianBergmann\CodeCoverage\CodeCoverage;

class ContactTest extends TestCase
{
    // To test : seed DB with FakerSeeder
    // and run vendor/bin/phpunit

    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetByIdContact()
    {
        $contactInDb = Contact::find(1);
        $this->assertSame("TEST GET", $contactInDb->firstname);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateContact()
    {
        $contact = factory('App\Contact')->make();
        $contact->save();
        $this->seeInDatabase('contacts', ['firstname' => $contact->firstname]);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUpdateContact()
    {
        $contact = Contact::find(1);
        $contact->firstname = "TEST UPDATE";
        $contact->save();
        $contactinDB = Contact::find(1);
        $this->assertSame($contact->firstname, $contactinDB->firstname);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testDeleteContact()
    {
        $contact = factory('App\Contact')->make();
        $contact->firstname = "TEST DELETE";
        $contact->save();
        Contact::Where("firstname", $contact->firstname)->delete();
        $this->notSeeInDatabase('contacts',['firstname'=> $contact->firtname]);

    }
}

