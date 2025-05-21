<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SaranaSeeder extends Seeder
{
    public function run()
    {
        // Matikan foreign key untuk sementara waktu agar truncate bisa dijalankan
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('m_sarana')->truncate(); // Menghapus semua data & reset auto increment
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $now = Carbon::now();
        $data = [];
        $ruanganConfig = [];

        // Konfigurasi untuk Ruangan 1 (Lab Teknik Pertambangan)
        $ruanganConfig[] = [
            'ruang_id' => 1,
            'items' => [
                ['kategori_id' => 6, 'barang_id' => 25, 'jumlah' => 10],
                ['kategori_id' => 6, 'barang_id' => 26, 'jumlah' => 5],
                ['kategori_id' => 6, 'barang_id' => 27, 'jumlah' => 3],
                ['kategori_id' => 6, 'barang_id' => 28, 'jumlah' => 5],
                ['kategori_id' => 6, 'barang_id' => 29, 'jumlah' => 3],
                ['kategori_id' => 6, 'barang_id' => 30, 'jumlah' => 2],
                ['kategori_id' => 6, 'barang_id' => 31, 'jumlah' => 3],
                ['kategori_id' => 6, 'barang_id' => 32, 'jumlah' => 2],
                ['kategori_id' => 6, 'barang_id' => 33, 'jumlah' => 2],
                ['kategori_id' => 2, 'barang_id' => 9, 'jumlah' => 4],
                ['kategori_id' => 2, 'barang_id' => 8, 'jumlah' => 1],
                ['kategori_id' => 6, 'barang_id' => 23, 'jumlah' => 2],
            ],
        ];

        // Konfigurasi untuk Ruangan 2 (Ruang Rapat Bengkel)
        $ruanganConfig[] = [
            'ruang_id' => 2,
            'items' => [
                ['kategori_id' => 1, 'barang_id' => 2, 'jumlah' => 5],
                ['kategori_id' => 1, 'barang_id' => 4, 'jumlah' => 20],
                ['kategori_id' => 2, 'barang_id' => 8, 'jumlah' => 1],
                ['kategori_id' => 6, 'barang_id' => 23, 'jumlah' => 1],
                ['kategori_id' => 2, 'barang_id' => 9, 'jumlah' => 2],
                ['kategori_id' => 6, 'barang_id' => 34, 'jumlah' => 1],
            ],
        ];

        // Konfigurasi untuk Ruangan 3 hingga 158
        for ($ruang_id = 3; $ruang_id <= 158; $ruang_id++) {
            $items = [
                ['kategori_id' => 1, 'barang_id' => 2, 'jumlah' => 10],
                ['kategori_id' => 1, 'barang_id' => 3, 'jumlah' => 20],
                ['kategori_id' => 2, 'barang_id' => 9, 'jumlah' => 2],
            ];

            $ruanganConfig[] = [
                'ruang_id' => $ruang_id,
                'items' => $items,
            ];
        }

        // Generate data untuk setiap barang
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

        // Insert data
        DB::table('m_sarana')->insertOrIgnore($data);
    }
}
