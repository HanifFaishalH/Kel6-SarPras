<?php

namespace Database\Seeders;

use App\Models\LaporanModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LaporanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LaporanModel::create([
            'user_id' => 1,
            'gedung_id' => 1,
            'lantai_id' => 1,
            'ruang_id' => 1,
            'sarana_id' => 1,
            'laporan_judul' =>
        ])
    }
}
