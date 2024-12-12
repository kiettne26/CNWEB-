<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            LibrariesSeeder::class,
            BooksSeeder::class,
            RentersSeeder::class,
            LaptopsSeeder::class,
            ItCentersSeeder::class,
            HardwareDevicesSeeder::class,
            CinemasSeeder::class,
            MoviesSeeder::class,
        ]);
    }
}
