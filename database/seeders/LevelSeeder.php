<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $levels = [
            ['level_nama' => 'admin', 'created_at' => now(), 'updated_at' => now()],
            ['level_nama' => 'mahasiswa', 'created_at' => now(), 'updated_at' => now()],
            ['level_nama' => 'dosen', 'created_at' => now(), 'updated_at' => now()],
            ['level_nama' => 'tendik', 'created_at' => now(), 'updated_at' => now()],
            ['level_nama' => 'teknisi', 'created_at' => now(), 'updated_at' => now()],
        ];
        foreach ($levels as $level) {
            DB::table('m_level')->insert($level);
        }
    }
}
