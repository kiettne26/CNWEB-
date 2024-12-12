<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        
        for ($i = 1; $i <= 10; $i++) { 
            DB::table('classes')->insert([
                'grade_level' => $faker->randomElement(['Pre-K', 'Kindergarten']),
                'room_number' => 'VH' . $i, // Example room numbering
            ]);
        }
    }
}