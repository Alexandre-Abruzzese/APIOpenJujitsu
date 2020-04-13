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
