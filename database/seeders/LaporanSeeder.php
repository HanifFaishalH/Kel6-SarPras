<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LaporanModel;
use App\Models\UserModel;
use App\Models\GedungModel;
use App\Models\LantaiModel;
use App\Models\RuangModel;
use App\Models\SaranaModel;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LaporanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Mulai transaction untuk memastikan konsistensi data
        DB::transaction(function () {
            $user = UserModel::first();
            $gedung = GedungModel::first();
            
            if (!$user || !$gedung) {
                $this->command->error("Seeder gagal: User atau Gedung belum tersedia.");
                return;
            }

            $lantai = LantaiModel::where('gedung_id', $gedung->gedung_id)->first();
            if (!$lantai) {
                $this->command->error("Seeder gagal: Tidak ada lantai untuk gedung ini.");
                return;
            }

            $ruang = RuangModel::where('lantai_id', $lantai->lantai_id)->first();
            if (!$ruang) {
                $this->command->error("Seeder gagal: Tidak ada ruang untuk lantai ini.");
                return;
            }

            $sarana = SaranaModel::where('ruang_id', $ruang->ruang_id)->first();
            if (!$sarana) {
                $this->command->error("Seeder gagal: Tidak ada sarana untuk ruang ini.");
                return;
            }

            $faker = \Faker\Factory::create('id_ID');
            $statuses = ['pending', 'proses', 'selesai'];
            $today = Carbon::now();

            for ($i = 1; $i <= 10; $i++) {
                $status = $faker->randomElement($statuses);
                $tanggalOperasional = $today->copy()->subDays(rand(0, 365))->toDateString();
                
                $laporanData = [
                    'gedung_id' => $gedung->gedung_id,
                    'lantai_id' => $lantai->lantai_id,
                    'ruang_id' => $ruang->ruang_id,
                    'sarana_id' => $sarana->sarana_id,
                    'user_id' => $user->user_id,
                    'laporan_judul' => "Laporan Kerusakan " . $faker->words(2, true),
                    'laporan_foto' => null,
                    'tingkat_kerusakan' => $faker->randomElement(['rendah', 'sedang', 'tinggi']),
                    'tingkat_urgensi' => $faker->randomElement(['rendah', 'sedang', 'tinggi', 'kritis']),
                    'frekuensi_penggunaan' => $faker->randomElement(['harian', 'mingguan', 'bulanan', 'tahunan']),
                    'tanggal_operasional' => $tanggalOperasional,
                    'status' => $status,
                    'created_at' => $today,
                    'updated_at' => $today,
                ];

                // Tambahkan data khusus untuk laporan yang sudah diproses/selesai
                if ($status !== 'pending') {
                    $teknisi = UserModel::where('user_id', '!=', $user->user_id)->first();
                    if ($teknisi) {
                        $laporanData['teknisi_id'] = $teknisi->user_id;
                        $laporanData['tanggal_diterima_teknisi'] = $today->copy()->subDays(rand(1, 30));
                        
                        if ($status === 'selesai') {
                            $laporanData['tanggal_selesai_diperbaiki'] = $today->copy()->subDays(rand(0, 10));
                            $laporanData['catatan_teknisi'] = $faker->sentence;
                        }
                    }
                }

                LaporanModel::create($laporanData);
            }

            $this->command->info('Berhasil membuat 10 data laporan dummy.');
        });
    }
}