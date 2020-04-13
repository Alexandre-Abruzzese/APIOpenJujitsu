<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Media;
use SebastianBergmann\CodeCoverage\CodeCoverage;

class MediaTest extends TestCase
{
    // To test : seed DB with FakerSeeder
    // and run vendor/bin/phpunit

    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetByIdMedia()
    {
        $media = Media::find(2);
        $this->assertSame("https://lorempixel.com/640/480/?70063", $media->path);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateMedia()
    {
        $media = factory('App\Media')->make();
        $media->save();
        $this->seeInDatabase('medias', ['path' => $media->path]);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUpdateMedia()
    {
        $media = Media::find(2);
        $media->path = "TEST UPDATE";
        $media->save();
        $mediainDB = Media::find(2);
        $this->assertSame($media->path, $mediainDB->path);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testDeleteMedia()
    {
        $media = factory('App\Media')->make();
        $media->save();
        Media::Where("path", $media->path)->delete();
        $this->notSeeInDatabase('medias',['path'=> $media->path]);

    }
}

