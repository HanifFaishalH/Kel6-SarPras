<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $barang = [
            [
                'barang_id' => 1,
                'kategori_id' => 1,
                'barang_nama' => 'Meja Kursi Kuliah Lipat',
                'spesifikasi' => 'Meja dan kursi jadi satu, kayu dengan rangka besi, ukuran meja 60x120 cm, kursi tahan beban 100 kg',
            ],
            [
                'barang_id' => 2,
                'kategori_id' => 1,
                'barang_nama' => 'Meja Kuliah Terpisah',
                'spesifikasi' => 'Meja kayu dengan rangka besi, ukuran 60x120 cm, digunakan dengan kursi terpisah',
            ],
            [
                'barang_id' => 3,
                'kategori_id' => 1,
                'barang_nama' => 'Kursi Kuliah Terpisah',
                'spesifikasi' => 'Kursi plastik dengan rangka besi, tahan beban hingga 100 kg, untuk meja terpisah',
            ],
            [
                'barang_id' => 4,
                'kategori_id' => 1,
                'barang_nama' => 'Kursi Bantal Biru',
                'spesifikasi' => 'Kursi dengan bantal warna biru, rangka besi, ukuran 60x120 cm, tahan beban 120 kg',
            ],
            [
                'barang_id' => 5,
                'kategori_id' => 1,
                'barang_nama' => 'Meja Kuliah Dua Kursi',
                'spesifikasi' => 'Meja kayu untuk dua kursi, ukuran 80x120 cm, rangka besi, termasuk dua kursi plastik',
            ],
            [
                'barang_id' => 6,
                'kategori_id' => 1,
                'barang_nama' => 'Kursi Besi 4 Jajar',
                'spesifikasi' => 'Kursi besi dengan 4 jajar, ukuran 60x120 cm, tahan beban 120 kg',
            ],
            [
                'barang_id' => 7,
                'kategori_id' => 1,
                'barang_nama' => 'Lemari Arsip',
                'spesifikasi' => 'Lemari kayu 2 pintu, ukuran 80x40x180 cm',
            ],
            [
                'barang_id' => 8,
                'kategori_id' => 2,
                'barang_nama' => 'Proyektor',
                'spesifikasi' => 'Proyektor LED, resolusi 1080p, koneksi HDMI/VGA',
            ],
            [
                'barang_id' => 9,
                'kategori_id' => 2,
                'barang_nama' => 'Komputer Desktop',
                'spesifikasi' => 'Intel Core i5, RAM 8GB, SSD 256GB, monitor 22 inch',
            ],
            [
                'barang_id' => 10,
                'kategori_id' => 2,
                'barang_nama' => 'AC Ruangan',
                'spesifikasi' => 'AC split 1 PK, inverter, daya 900W',
            ],
            [
                'barang_id' => 11,
                'kategori_id' => 2,
                'barang_nama' => 'CCTV',
                'spesifikasi' => 'Kamera CCTV IP, resolusi 4MP, night vision, koneksi PoE',
            ],
            [
                'barang_id' => 12,
                'kategori_id' => 3,
                'barang_nama' => 'Router WiFi',
                'spesifikasi' => 'Dual-band, kecepatan hingga 1200 Mbps, 4 port LAN',
            ],
            [
                'barang_id' => 13,
                'kategori_id' => 3,
                'barang_nama' => 'Kabel LAN',
                'spesifikasi' => 'Kabel UTP Cat6, panjang 50 meter',
            ],
            [
                'barang_id' => 14,
                'kategori_id' => 3,
                'barang_nama' => 'Switch Jaringan',
                'spesifikasi' => '24 port, kecepatan 1 Gbps, managed switch',
            ],
            [
                'barang_id' => 15,
                'kategori_id' => 3,
                'barang_nama' => 'Access Point',
                'spesifikasi' => 'WiFi 6, kecepatan hingga 1800 Mbps, mendukung PoE, jangkauan 100 meter',
            ],
            [
                'barang_id' => 16,
                'kategori_id' => 4,
                'barang_nama' => 'Toilet Duduk',
                'spesifikasi' => 'Keramik, dual flush, termasuk jet spray',
            ],
            [
                'barang_id' => 17,
                'kategori_id' => 4,
                'barang_nama' => 'Urinoir',
                'spesifikasi' => 'Toilet berdiri berbahan keramik',
            ],
            [
                'barang_id' => 18,
                'kategori_id' => 4,
                'barang_nama' => 'Kran Air',
                'spesifikasi' => 'Kran tembaga, ukuran 1/2 inch, anti bocor',
            ],
            [
                'barang_id' => 19,
                'kategori_id' => 4,
                'barang_nama' => 'Wastafel',
                'spesifikasi' => 'Wastafel keramik, ukuran 50x40 cm, termasuk sifon',
            ],
            [
                'barang_id' => 20,
                'kategori_id' => 4,
                'barang_nama' => 'Dispenser Sabun Cair',
                'spesifikasi' => 'Kapasitas 500 ml, bahan plastik ABS, sensor otomatis',
            ],
            [
                'barang_id' => 21,
                'kategori_id' => 5,
                'barang_nama' => 'Printer',
                'spesifikasi' => 'Printer laser, kecepatan 20 ppm, koneksi USB/WiFi',
            ],
            [
                'barang_id' => 22,
                'kategori_id' => 5,
                'barang_nama' => 'Mesin Fotokopi',
                'spesifikasi' => 'Fotokopi A3/A4, kecepatan 25 ppm, fitur scan dan print',
            ],
            [
                'barang_id' => 23,
                'kategori_id' => 5,
                'barang_nama' => 'Alat Tulis Kantor',
                'spesifikasi' => 'Paket pena, spidol, kertas A4, dan stapler',
            ],
            [
                'barang_id' => 24,
                'kategori_id' => 6,
                'barang_nama' => 'Papan Tulis',
                'spesifikasi' => 'Whiteboard magnetik, ukuran 120x240 cm, termasuk stand',
            ],
            [
                'barang_id' => 25,
                'kategori_id' => 6,
                'barang_nama' => 'Tong Sampah',
                'spesifikasi' => 'Kapasitas 30 liter, plastik',
            ],
            [
                'barang_id' => 26,
                'kategori_id' => 6,
                'barang_nama' => 'Mesin Uji Kuat Tekan Beton',
                'spesifikasi' => 'Kapasitas 2000 kN, digital, untuk uji kuat tekan silinder beton',
            ],
            [
                'barang_id' => 27,
                'kategori_id' => 6,
                'barang_nama' => 'Alat Slump Test',
                'spesifikasi' => 'Baja tahan karat, untuk uji konsistensi beton, termasuk corong dan batang pemadat',
            ],
            [
                'barang_id' => 28,
                'kategori_id' => 6,
                'barang_nama' => 'Mixer Beton',
                'spesifikasi' => 'Kapasitas 0.5 m³, daya 5.5 kW, untuk pencampuran beton di lab',
            ],
            [
                'barang_id' => 29,
                'kategori_id' => 6,
                'barang_nama' => 'Alat Sondir',
                'spesifikasi' => 'Manual, kapasitas 2 ton, untuk uji penetrasi tanah',
            ],
            [
                'barang_id' => 30,
                'kategori_id' => 6,
                'barang_nama' => 'CBR Tester',
                'spesifikasi' => 'California Bearing Ratio tester, untuk uji kekuatan tanah, kapasitas 50 kN',
            ],
            [
                'barang_id' => 31,
                'kategori_id' => 6,
                'barang_nama' => 'Alat Uji Triaxial',
                'spesifikasi' => 'Digital, untuk uji kekuatan geser tanah, kapasitas 100 kN',
            ],
            [
                'barang_id' => 32,
                'kategori_id' => 6,
                'barang_nama' => 'Alat Ukur Debit',
                'spesifikasi' => 'Flow meter digital, untuk pengukuran aliran air di lab hidrolika',
            ],
            [
                'barang_id' => 33,
                'kategori_id' => 6,
                'barang_nama' => 'Model Saluran Terbuka',
                'spesifikasi' => 'Panjang 3 meter, bahan akrilik, untuk simulasi aliran hidrolika',
            ],
            [
                'barang_id' => 34,
                'kategori_id' => 6,
                'barang_nama' => 'Pompa Hidrolik',
                'spesifikasi' => 'Daya 1.5 kW, kapasitas 100 L/menit, untuk lab hidrolika',
            ],
            [
                'barang_id' => 35,
                'kategori_id' => 6,
                'barang_nama' => 'Mesin Las Listrik',
                'spesifikasi' => 'Inverter welding, arus 200 A, untuk bengkel baja',
            ],
            [
                'barang_id' => 36,
                'kategori_id' => 6,
                'barang_nama' => 'Bor Baja',
                'spesifikasi' => 'Mesin bor meja, daya 750 W, untuk pengerjaan baja',
            ],
            [
                'barang_id' => 37,
                'kategori_id' => 6,
                'barang_nama' => 'Alat Potong Plasma',
                'spesifikasi' => 'Kapasitas potong 12 mm, daya 5 kW, untuk bengkel baja',
            ],
            [
                'barang_id' => 38,
                'kategori_id' => 6,
                'barang_nama' => 'Mesin Ketam Kayu',
                'spesifikasi' => 'Lebar ketam 300 mm, daya 2.2 kW, untuk bengkel kayu',
            ],
            [
                'barang_id' => 39,
                'kategori_id' => 6,
                'barang_nama' => 'Gergaji Pita Kayu',
                'spesifikasi' => 'Diameter roda 400 mm, daya 1.5 kW, untuk pemotongan kayu',
            ],
            [
                'barang_id' => 40,
                'kategori_id' => 6,
                'barang_nama' => 'Router Kayu',
                'spesifikasi' => 'Daya 1.8 kW, kecepatan 24.000 rpm, untuk ukiran kayu',
            ],
        ];

        $data = [];

        foreach ($barang as $item) {
            $data[] = [
                'barang_id' => $item['barang_id'],
                'kategori_id' => $item['kategori_id'],
                'barang_nama' => $item['barang_nama'],
                'spesifikasi' => $item['spesifikasi'],
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        DB::table('m_barang')->insertOrIgnore($data);
    }
}
