<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LaptopsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for ($i = 0; $i < 30; $i++) {
            DB::table('laptops')->insert([
                'brand' => $faker->company,
                'model' => $faker->word . ' ' . $faker->numberBetween(1000, 9999),
                'specifications' => $faker->words(3, true),
                'rental_status' => $faker->boolean,
                'renter_id' => $faker->optional()->numberBetween(1, 20),
            ]);
        }
    }
}
