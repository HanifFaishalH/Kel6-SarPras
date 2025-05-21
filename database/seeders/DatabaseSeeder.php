<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            LevelSeeder::class,
            UsersSeeder::class, // Ensure your seeder is listed here
            GedungSeeder::class,
            BarangSeeder::class,
            KategoriSeeder::class,
            LantaiSeeder::class,
            RuangSeeder::class,
            SaranaSeeder::class,
            TeknisiSeeder::class,
        ]);
    }
}