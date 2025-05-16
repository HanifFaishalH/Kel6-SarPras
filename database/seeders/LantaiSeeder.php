<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LantaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lantai = [
            ['lantai_id' => '1', 'lantai_nama' => 'Lantai 1', 'gedung_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['lantai_id' => '2', 'lantai_nama' => 'Lantai 2', 'gedung_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['lantai_id' => '3', 'lantai_nama' => 'Lantai 3', 'gedung_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['lantai_id' => '4', 'lantai_nama' => 'Lantai 4', 'gedung_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['lantai_id' => '5', 'lantai_nama' => 'Lantai 5', 'gedung_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['lantai_id' => '6', 'lantai_nama' => 'Lantai 6', 'gedung_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['lantai_id' => '7', 'lantai_nama' => 'Lantai 7', 'gedung_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['lantai_id' => '8', 'lantai_nama' => 'Lantai 8', 'gedung_id' => 1, 'created_at' => now(), 'updated_at' => now()],
        ];

        foreach ($lantai as $l) {
            DB::table('m_lantai')->insertOrIgnore($l);
        }
    }
}
