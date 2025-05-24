<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SaranaSeeder extends Seeder
{
    public function run()
    {
        // Disable foreign key checks for truncation
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('m_sarana')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $now = Carbon::now();
        $data = [];
        
        // Define room configurations in a more readable way
        $roomConfigurations = [
            // Room ID 1 has specific items
            1 => [
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
            
            // Room ID 2 has different items
            2 => [
                ['kategori_id' => 1, 'barang_id' => 2, 'jumlah' => 5],
                ['kategori_id' => 1, 'barang_id' => 4, 'jumlah' => 20],
                ['kategori_id' => 2, 'barang_id' => 8, 'jumlah' => 1],
                ['kategori_id' => 6, 'barang_id' => 23, 'jumlah' => 1],
                ['kategori_id' => 2, 'barang_id' => 9, 'jumlah' => 2],
                ['kategori_id' => 6, 'barang_id' => 34, 'jumlah' => 1],
            ],
        ];

        // Default configuration for rooms 3-158
        $defaultItems = [
            ['kategori_id' => 1, 'barang_id' => 2, 'jumlah' => 10],
            ['kategori_id' => 1, 'barang_id' => 3, 'jumlah' => 20],
            ['kategori_id' => 2, 'barang_id' => 9, 'jumlah' => 2],
        ];

        // Generate data for all rooms
        for ($roomId = 1; $roomId <= 158; $roomId++) {
            $items = $roomConfigurations[$roomId] ?? $defaultItems;
            
            foreach ($items as $item) {
                for ($i = 0; $i < $item['jumlah']; $i++) {
                    $data[] = [
                        'sarana_kode' => 'SRN-' . Str::upper(Str::random(10)),
                        'ruang_id' => $roomId,
                        'kategori_id' => $item['kategori_id'],
                        'barang_id' => $item['barang_id'],
                        'tanggal_operasional' => $now,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ];
                    
                    // Insert in chunks to avoid memory issues with large datasets
                    if (count($data) >= 500) {
                        DB::table('m_sarana')->insert($data);
                        $data = [];
                    }
                }
            }
        }

        // Insert any remaining records
        if (!empty($data)) {
            DB::table('m_sarana')->insert($data);
        }
    }
}