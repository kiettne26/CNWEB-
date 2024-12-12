<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItCentersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for ($i = 0; $i < 5; $i++) {
            DB::table('it_centers')->insert([
                'name' => $faker->company . ' IT Center',
                'location' => $faker->address,
                'contact_email' => $faker->unique()->companyEmail,
            ]);
        }
    }
}
