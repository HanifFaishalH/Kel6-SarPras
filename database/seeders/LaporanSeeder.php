<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LaporanSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();
        $laporan = [];

        for ($i = 1; $i <= 10; $i++) {
            $laporan[] = [
                'user_id' => 1,
                'gedung_id' => 1,
                'lantai_id' => 1,
                'ruang_id' => 1,
                'sarana_id' => $i,
                'laporan_judul' => "Kerusakan pada Sarana #$i",
                'laporan_foto' => null,
                'tingkat_kerusakan' => ['rendah', 'sedang', 'tinggi'][rand(0, 2)],
                'tingkat_urgensi' => ['rendah', 'sedang', 'tinggi', 'kritis'][rand(0, 3)],
                'frekuensi_penggunaan' => ['harian', 'mingguan', 'bulanan'][rand(0, 2)],
                'tanggal_operasional' => $now->subDays(rand(1, 100))->timestamp,
                'status' => 'pending',
                'teknisi_id' => null,
                'catatan_teknisi' => null,
                'tanggal_diterima' => null,
                'tanggal_selesai_diperbaiki' => null,
                'tanggal_diterima_teknisi' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        DB::table('t_laporan_kerusakan')->truncate();
        DB::table('t_laporan_kerusakan')->insert($laporan);
    }
}
