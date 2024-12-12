<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComputersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 10; $i++) {
            DB::table('computers')->insert([
                'computer_name' => "Lab1-PC" . sprintf('%02d', $i),
                'model' => $faker->randomElement(['Dell Optiplex 7090', 'HP EliteDesk 800 G6', 'Lenovo ThinkCentre M920']),
                'operating_system' => 'Windows 10 Pro',
                'processor' => $faker->randomElement(['Intel Core i5-11400', 'AMD Ryzen 5 5600X']),
                'memory' => $faker->randomElement([8, 16, 32]),
                'available' => $faker->boolean(),
            ]);
        }
    }
}