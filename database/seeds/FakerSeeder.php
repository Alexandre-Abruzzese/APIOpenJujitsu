<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

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
            'email'=>"test@test.com",
            'password'=> Hash::make('testtest'),
            'api_token'=>Str::random(40),
            'created_at'=>'2020-03-04 15:02:27',
            'updated_at'=>'2020-03-04 15:02:27'
        ]);
        $faker = Faker\Factory::create();
        for ($i = 0; $i < 10; $i++) {
            DB::table('users')->insert([
                'firstname'=>$faker->firstname,
                'lastname'=>$faker->lastname,
                'email'=>$faker->email,
                'password'=> Hash::make('testtest'),
                'api_token'=>Str::random(40),
                'created_at'=>'2020-03-04 15:02:27',
                'updated_at'=>'2020-03-04 15:02:27'
            ]);
        }
    }
}
