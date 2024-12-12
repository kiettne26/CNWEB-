<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MedicinesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for ($i = 0; $i < 10; $i++) {
            DB::table('medicines')->insert([
                'name' => $faker->word(),
                'brand' => $faker->company(),
                'dosage' => $faker->randomElement(['10mg tablets', '500mg capsules', '2ml injection']),
                'form' => $faker->randomElement(['viên nén', 'viên nang', 'xi-rô', 'dung dịch']),
                'price' => $faker->randomFloat(2, 1000, 10000), 
                'stock' => $faker->numberBetween(10, 100),
            ]);
        }
    }
}