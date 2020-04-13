<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\News;
use SebastianBergmann\CodeCoverage\CodeCoverage;

class NewsTest extends TestCase
{
    // To test : seed DB with FakerSeeder
    // and run vendor/bin/phpunit

    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetByIdNews()
    {
        $newsInDb = News::find(1);
        $this->assertSame("TEST GET", $newsInDb->description);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateNews()
    {
        $news = factory('App\News')->make();
        $news->save();
        $this->seeInDatabase('news', ['description' => $news->description]);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUpdateNews()
    {
        $news = News::find(1);
        $news->description = "TEST UPDATE";
        $news->save();
        $newsinDB = News::find(1);
        $this->assertSame($news->description, $newsinDB->description);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testDeleteNews()
    {
        $news = factory('App\News')->make();
        $news->description = "TEST DELETE";
        $news->save();
        News::Where("description", $news->description)->delete();
        $this->notSeeInDatabase('news',['description'=> $news->description]);

    }
}

