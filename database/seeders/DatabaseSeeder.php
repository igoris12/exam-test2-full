<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder

{
    
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('it_IT');
       DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123'),
        ]);

        $horsesCount = 20;
        foreach(range(1, $horsesCount) as $_) {
            $runs = rand(0,25);
            DB::table('horses')->insert([
                'name' => $faker->firstName(),
                'runs' => $runs,
                'wins' => rand(0,$runs),
                'about' => $faker->text($maxNbChars = 200),
            ]);
        }

      foreach(range(1, 50) as $_) {
            DB::table('betters')->insert([
                'name' => $faker->firstName(),
                'surname' => $faker->lastName(),
                'bet' => rand(20, 5000),
                'horse_id' => rand(1,$horsesCount),

            ]);
        }
    }
}
