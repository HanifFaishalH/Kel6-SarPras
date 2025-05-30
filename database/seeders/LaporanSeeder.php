<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class LaporanSeeder extends Seeder
{
    public function run(): void
    {
        $ruangs = DB::table('m_ruang')->get();
        $laporan = [];
        $count = 0;

        foreach ($ruangs as $index => $ruang) {
            $lantai = DB::table('m_lantai')->where('lantai_id', $ruang->lantai_id)->first();
            $gedung = DB::table('m_gedung')->where('gedung_id', $lantai->gedung_id ?? 1)->first();
            $sarana = DB::table('m_sarana')->where('ruang_id', $ruang->ruang_id)->first();

            if (!$sarana) continue;

            $barang = DB::table('m_barang')->where('barang_id', $sarana->barang_id)->first();

            $laporan[] = [
                'user_id' => rand(2, 4),
                'role' => ['mhs', 'dosen', 'tendik'][rand(0, 2)],
                'gedung_id' => $gedung->gedung_id,
                'lantai_id' => $lantai->lantai_id,
                'ruang_id' => $ruang->ruang_id,
                'sarana_id' => $sarana->sarana_id,
                'teknisi_id' => null,

                'laporan_judul' => 'Kerusakan pada ' . $barang->barang_nama . ' (' . $sarana->sarana_kode . ') di ' . $ruang->ruang_nama,
                'laporan_foto' => null,

                'tingkat_kerusakan' => ['rendah', 'sedang', 'tinggi', 'kritis'][rand(0, 3)],
                'tingkat_urgensi' => ['rendah', 'sedang', 'tinggi', 'kritis'][rand(0, 3)],
                'frekuensi_penggunaan' => ['harian', 'mingguan', 'bulanan', 'tahunan'][rand(0, 3)],
                'dampak_kerusakan' => ['minor', 'kecil', 'sedang', 'besar'][rand(0, 3)],
                'tanggal_operasional' => Carbon::now()->subDays(rand(10, 100)),

                'status_laporan' => 'pending',
                'tanggal_diproses' => null,
                'tanggal_perbaikan' => null,
                'tanggal_selesai' => null,

                'status_admin' => 'pending',
                'status_sarpras' => 'belum diproses',
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $count++;
            if ($count >= 10) {
                break; // Batasi jumlah laporan yang dibuat
            }
        }

        DB::table('t_laporan_kerusakan')->insert($laporan);
    }
}
