<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for ($i = 0; $i < 20; $i++) {
            DB::table('sales')->insert([
                'medicine_id' => $faker->numberBetween(1, 10), // Assuming you have 10 medicines seeded
                'quantity' => $faker->numberBetween(1, 10),
                'sale_date' => $faker->dateTimeBetween('-1 month', 'now'),
                'customer_phone' => $faker->phoneNumber(), 
            ]);
        }
    }
}