<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class FakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'firstname'=>"TEST",
            'lastname'=>"TEST",
            'email'=>"test@test.fr",
            'password'=> Hash::make('testtest'),
            'api_token'=>Str::random(40),
            'is_active' => 1,
            'created_at'=>'2020-03-04 15:02:27',
            'updated_at'=>'2020-03-04 15:02:27'
        ]);
        DB::table('users')->insert([
            'firstname'=>"TEST",
            'lastname'=>"TEST",
            'email'=>"test@test.com",
            'password'=> Hash::make('testtest'),
            'api_token'=>Str::random(40),
            'is_active' => 1,
            'created_at'=>'2020-03-04 15:02:27',
            'updated_at'=>'2020-03-04 15:02:27'
        ]);

        DB::table('medias')->insert([
            'path' => 'TEST GET',
            'description' => 'LOREM IPSUM',
            'type' => 'image',
            'created_at'=> Carbon::now(),
        ]);

        DB::table('events')->insert([
            'author' => "TEST GET",
            'event_name' => "TEST" ,
            'description' => "LOREM IPSUM",
            'start_at' => Carbon::now(),
            'end_at' => Carbon::now(),
            'created_at'=> Carbon::now(),
        ]);

        DB::table('news')->insert([
            'title' => 'TEST GET',
            'description' => "TEST GET",
            'linkURL' => "URL",
            'created_at'=> Carbon::now(),
        ]);

        DB::table('schedule')->insert([
            'location' => 'TEST GET',
            'begin_at' => Carbon::now(),
            'end_at' => Carbon::now(),
            'date' => Carbon::now(),
            'created_at'=> Carbon::now(),
        ]);

        DB::table('contacts')->insert([
            'firstname' => 'TEST GET',
            'lastname' => 'test get',
            'email' => 'test get',
            'body' => 'test get',
            'phone'=> 'test get',
        ]);

        $faker = Faker\Factory::create();
        for ($i = 0; $i < 10; $i++) {
            DB::table('medias')->insert([
                    'path' => $faker->imageUrl($width = 640, $height = 480),
                    'description' => $faker->text($maxNbChars = 40),
                    'type' => 'image',
                    'created_at'=> Carbon::now(),
            ]);
        }
    }
}
