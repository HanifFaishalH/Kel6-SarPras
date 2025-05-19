<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SaranaSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();
        $data = [];
        $ruanganConfig = [];

        // Konfigurasi untuk Ruangan 1 (Lab Teknik Pertambangan)
        $ruanganConfig[] = [
            'ruang_id' => 1,
            'items' => [
                ['kategori_id' => 6, 'barang_id' => 25, 'jumlah' => 10], // Mesin Uji Kuat Tekan Beton
                ['kategori_id' => 6, 'barang_id' => 26, 'jumlah' => 5],  // Alat Slump Test
                ['kategori_id' => 6, 'barang_id' => 27, 'jumlah' => 3],  // Mixer Beton
                ['kategori_id' => 6, 'barang_id' => 28, 'jumlah' => 5],  // Alat Sondir
                ['kategori_id' => 6, 'barang_id' => 29, 'jumlah' => 3],  // CBR Tester
                ['kategori_id' => 6, 'barang_id' => 30, 'jumlah' => 2],  // Alat Uji Triaxial
                ['kategori_id' => 6, 'barang_id' => 31, 'jumlah' => 3],  // Alat Ukur Debit
                ['kategori_id' => 6, 'barang_id' => 32, 'jumlah' => 2],  // Model Saluran Terbuka
                ['kategori_id' => 6, 'barang_id' => 33, 'jumlah' => 2],  // Pompa Hidrolik
                ['kategori_id' => 2, 'barang_id' => 9, 'jumlah' => 4],   // Komputer Desktop
                ['kategori_id' => 2, 'barang_id' => 8, 'jumlah' => 1],   // Proyektor
                ['kategori_id' => 6, 'barang_id' => 23, 'jumlah' => 2],  // Papan Tulis
            ],
        ];

        // Konfigurasi untuk Ruangan 2 (Ruang Rapat Bengkel)
        $ruanganConfig[] = [
            'ruang_id' => 2,
            'items' => [
                ['kategori_id' => 1, 'barang_id' => 2, 'jumlah' => 5],   // Meja Kuliah Terpisah
                ['kategori_id' => 1, 'barang_id' => 4, 'jumlah' => 20],  // Kursi Bantal Biru
                ['kategori_id' => 2, 'barang_id' => 8, 'jumlah' => 1],   // Proyektor
                ['kategori_id' => 6, 'barang_id' => 23, 'jumlah' => 1],  // Papan Tulis
                ['kategori_id' => 2, 'barang_id' => 9, 'jumlah' => 2],   // Komputer Desktop
                ['kategori_id' => 6, 'barang_id' => 34, 'jumlah' => 1],  // Mesin Las Listrik
            ],
        ];

        // Generate konfigurasi untuk ruangan 3 hingga 158 (barang standar)
        for ($ruang_id = 3; $ruang_id <= 158; $ruang_id++) {
            $items = [
                ['kategori_id' => 1, 'barang_id' => 2, 'jumlah' => 10], // Meja Kuliah Terpisah
                ['kategori_id' => 1, 'barang_id' => 3, 'jumlah' => 20], // Kursi Kuliah Terpisah
                ['kategori_id' => 2, 'barang_id' => 9, 'jumlah' => 2],  // Komputer Desktop
            ];

            $ruanganConfig[] = [
                'ruang_id' => $ruang_id,
                'items' => $items,
            ];
        }

        // Loop untuk setiap ruangan
        foreach ($ruanganConfig as $ruangan) {
            foreach ($ruangan['items'] as $item) {
                for ($i = 0; $i < $item['jumlah']; $i++) {
                    $data[] = [
                        'ruang_id' => $ruangan['ruang_id'],
                        'kategori_id' => $item['kategori_id'],
                        'barang_id' => $item['barang_id'],
                        'tanggal_operasional' => $now,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ];
                }
            }
        }

        // Insert data ke tabel m_sarana
        DB::table('m_sarana')->insertOrIgnore($data);
    }
}
