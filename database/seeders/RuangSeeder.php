<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class RuangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ruangan = [
            1 => [
                // Lantai 1
                ['lantai_id' => 1, 'ruang_nama' => 'Ruang Lab Teknik Pertambangan', 'ruang_kode' => 'RLTB', 'ruang_tipe' => 'lab', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 1, 'ruang_nama' => 'Ruang Rapat Bengkel', 'ruang_kode' => 'RRB', 'ruang_tipe' => 'rapat', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 1, 'ruang_nama' => 'Ruang Rapat Bengkel 2', 'ruang_kode' => 'RRB2', 'ruang_tipe' => 'rapat', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 1, 'ruang_nama' => 'Ruang Instruksional 1', 'ruang_kode' => 'RI1', 'ruang_tipe' => 'kelas', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 1, 'ruang_nama' => 'Ruang Instruksional 2', 'ruang_kode' => 'RI2', 'ruang_tipe' => 'kelas', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 1, 'ruang_nama' => 'Ruang Instruksional 3', 'ruang_kode' => 'RI3', 'ruang_tipe' => 'kelas', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 1, 'ruang_nama' => 'Ruang Gudang', 'ruang_kode' => 'RG', 'ruang_tipe' => 'gudang', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 1, 'ruang_nama' => 'Ruang Gudang 2', 'ruang_kode' => 'RG2', 'ruang_tipe' => 'gudang', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 1, 'ruang_nama' => 'Ruang Bengkel Kayu Mesin', 'ruang_kode' => 'RBKM', 'ruang_tipe' => 'bengkel', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 1, 'ruang_nama' => 'Ruang Rapat Lab 3', 'ruang_kode' => 'RRB3', 'ruang_tipe' => 'rapat', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 1, 'ruang_nama' => 'Ruang Lab Hidrolika', 'ruang_kode' => 'RLH', 'ruang_tipe' => 'lab', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 1, 'ruang_nama' => 'Ruang Instruksional 6', 'ruang_kode' => 'RI6', 'ruang_tipe' => 'kelas', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 1, 'ruang_nama' => 'Ruang Lab Ukur Tanah', 'ruang_kode' => 'RLUT', 'ruang_tipe' => 'lab', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 1, 'ruang_nama' => 'Ruang Teknisi', 'ruang_kode' => 'RT1', 'ruang_tipe' => 'teknisi', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 1, 'ruang_nama' => 'Ruang Toilet Barat 1', 'ruang_kode' => 'RTB1', 'ruang_tipe' => 'toilet', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 1, 'ruang_nama' => 'Ruang Toilet Timur 1', 'ruang_kode' => 'RTS1', 'ruang_tipe' => 'toilet', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 1, 'ruang_nama' => 'Lobby Lantai 1', 'ruang_kode' => 'LL1', 'ruang_tipe' => 'lobby', 'created_at' => now(), 'updated_at' => now()],
            ],
            2 => [
                // Lantai 2
                ['lantai_id' => 2, 'ruang_nama' => 'Lab Komputer 1', 'ruang_kode' => 'Lab.Kom1', 'ruang_tipe' => 'lab', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 2, 'ruang_nama' => 'Lab Komputer 2', 'ruang_kode' => 'Lab.Kom2', 'ruang_tipe' => 'lab', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 2, 'ruang_nama' => 'Lab Komputer 3', 'ruang_kode' => 'Lab.Kom3', 'ruang_tipe' => 'lab', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 2, 'ruang_nama' => 'Lab Komputer 4', 'ruang_kode' => 'Lab.Kom4', 'ruang_tipe' => 'lab', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 2, 'ruang_nama' => 'Ruang Kuliah Teori Sipil 2.01', 'ruang_kode' => 'RKTS2.01', 'ruang_tipe' => 'kelas', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 2, 'ruang_nama' => 'Ruang Kuliah Teori Sipil 2.02', 'ruang_kode' => 'RKTS2.02', 'ruang_tipe' => 'kelas', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 2, 'ruang_nama' => 'Ruang Kuliah Teori Sipil 2.03', 'ruang_kode' => 'RKTS2.03', 'ruang_tipe' => 'kelas', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 2, 'ruang_nama' => 'Ruang Kuliah Teori Sipil 2.04', 'ruang_kode' => 'RKTS2.04', 'ruang_tipe' => 'kelas', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 2, 'ruang_nama' => 'Ruang Kuliah Teori Sipil 2.05', 'ruang_kode' => 'RKTS2.05', 'ruang_tipe' => 'kelas', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 2, 'ruang_nama' => 'Ruang Kuliah Teori Sipil 2.06', 'ruang_kode' => 'RKTS2.06', 'ruang_tipe' => 'kelas', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 2, 'ruang_nama' => 'Ruang Kuliah Teori Sipil 2.07', 'ruang_kode' => 'RKTS2.07', 'ruang_tipe' => 'kelas', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 2, 'ruang_nama' => 'Ruang Kuliah Teori Sipil 2.08', 'ruang_kode' => 'RKTS2.08', 'ruang_tipe' => 'kelas', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 2, 'ruang_nama' => 'Ruang Kuliah Teori Sipil 2.09', 'ruang_kode' => 'RKTS2.09', 'ruang_tipe' => 'kelas', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 2, 'ruang_nama' => 'Ruang Kuliah Teori Sipil 2.10', 'ruang_kode' => 'RKTS2.10', 'ruang_tipe' => 'kelas', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 2, 'ruang_nama' => 'Ruang Mushola 1', 'ruang_kode' => 'RM1', 'ruang_tipe' => 'mushola', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 2, 'ruang_nama' => 'Ruang Kantin 1', 'ruang_kode' => 'RKA1', 'ruang_tipe' => 'kantin', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 2, 'ruang_nama' => 'Ruang Wudhu 1', 'ruang_kode' => 'RW1', 'ruang_tipe' => 'wudhu', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 2, 'ruang_nama' => 'Ruang Toilet Barat 2', 'ruang_kode' => 'RTB2', 'ruang_tipe' => 'toilet', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 2, 'ruang_nama' => 'Ruang Toilet Timur 2', 'ruang_kode' => 'RTS2', 'ruang_tipe' => 'toilet', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 2, 'ruang_nama' => 'Ruang TUK', 'ruang_kode' => 'RTUK', 'ruang_tipe' => 'kantor', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 2, 'ruang_nama' => 'Ruang Teknisi 2', 'ruang_kode' => 'RT2', 'ruang_tipe' => 'teknisi', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 2, 'ruang_nama' => 'Ruang Teknisi 3', 'ruang_kode' => 'RT3', 'ruang_tipe' => 'teknisi', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 2, 'ruang_nama' => 'Lobby Lantai 2', 'ruang_kode' => 'LL2', 'ruang_tipe' => 'lobby', 'created_at' => now(), 'updated_at' => now()],
            ],
            3 => [
                // Lantai 3
                ['lantai_id' => 3, 'ruang_nama' => 'Ruang Kuliah Teori Sipil 3.01', 'ruang_kode' => 'RKTS3.01', 'ruang_tipe' => 'kelas', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 3, 'ruang_nama' => 'Ruang Kuliah Teori Sipil 3.02', 'ruang_kode' => 'RKTS3.02', 'ruang_tipe' => 'kelas', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 3, 'ruang_nama' => 'Ruang Kuliah Teori Sipil 3.03', 'ruang_kode' => 'RKTS3.03', 'ruang_tipe' => 'kelas', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 3, 'ruang_nama' => 'Ruang Kuliah Teori Sipil 3.04', 'ruang_kode' => 'RKTS3.04', 'ruang_tipe' => 'kelas', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 3, 'ruang_nama' => 'Ruang Kuliah Teori Sipil 3.05', 'ruang_kode' => 'RKTS3.05', 'ruang_tipe' => 'kelas', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 3, 'ruang_nama' => 'Ruang Kuliah Teori Sipil 3.06', 'ruang_kode' => 'RKTS3.06', 'ruang_tipe' => 'kelas', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 3, 'ruang_nama' => 'Ruang Kuliah Teori Sipil 3.07', 'ruang_kode' => 'RKTS3.07', 'ruang_tipe' => 'kelas', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 3, 'ruang_nama' => 'Ruang Kuliah Teori Sipil 3.08', 'ruang_kode' => 'RKTS3.08', 'ruang_tipe' => 'kelas', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 3, 'ruang_nama' => 'Ruang Kuliah Teori Sipil 3.09', 'ruang_kode' => 'RKTS3.09', 'ruang_tipe' => 'kelas', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 3, 'ruang_nama' => 'Ruang Kuliah Teori Sipil 3.10', 'ruang_kode' => 'RKTS3.10', 'ruang_tipe' => 'kelas', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 3, 'ruang_nama' => 'Ruang Kuliah Teori Sipil 3.11', 'ruang_kode' => 'RKTS3.11', 'ruang_tipe' => 'kelas', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 3, 'ruang_nama' => 'Ruang Kuliah Teori Sipil 3.12', 'ruang_kode' => 'RKTS3.12', 'ruang_tipe' => 'kelas', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 3, 'ruang_nama' => 'Ruang Kuliah Teori Sipil 3.13', 'ruang_kode' => 'RKTS3.13', 'ruang_tipe' => 'kelas', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 3, 'ruang_nama' => 'Ruang Kuliah Teori Sipil 3.14', 'ruang_kode' => 'RKTS3.14', 'ruang_tipe' => 'kelas', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 3, 'ruang_nama' => 'Ruang Kuliah Teori Sipil 3.15', 'ruang_kode' => 'RKTS3.15', 'ruang_tipe' => 'kelas', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 3, 'ruang_nama' => 'Ruang Kuliah Teori Sipil 3.16', 'ruang_kode' => 'RKTS3.16', 'ruang_tipe' => 'kelas', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 3, 'ruang_nama' => 'Ruang Admin 1', 'ruang_kode' => 'RA1', 'ruang_tipe' => 'kantor', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 3, 'ruang_nama' => 'Ruang Toilet Barat 3', 'ruang_kode' => 'RTB3', 'ruang_tipe' => 'toilet', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 3, 'ruang_nama' => 'Ruang Toilet Timur 3', 'ruang_kode' => 'RTS3', 'ruang_tipe' => 'toilet', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 3, 'ruang_nama' => 'Lobby Lantai 3', 'ruang_kode' => 'LL3', 'ruang_tipe' => 'lobby', 'created_at' => now(), 'updated_at' => now()],
            ],
            4 => [
                // Lantai 4
                ['lantai_id' => 4, 'ruang_nama' => 'Ruang Dosen Geotrans', 'ruang_kode' => 'RDG', 'ruang_tipe' => 'kantor', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 4, 'ruang_nama' => 'Ruang Dosen Struktur', 'ruang_kode' => 'RDS', 'ruang_tipe' => 'kantor', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 4, 'ruang_nama' => 'Ruang Dosen Keairan', 'ruang_kode' => 'RDK', 'ruang_tipe' => 'kantor', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 4, 'ruang_nama' => 'Ruang Dosen Matkul Umum', 'ruang_kode' => 'RDMU', 'ruang_tipe' => 'kantor', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 4, 'ruang_nama' => 'Ruang Dosen Manajemen Konstruksi', 'ruang_kode' => 'RDMK', 'ruang_tipe' => 'kantor', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 4, 'ruang_nama' => 'Ruang Rapat 3', 'ruang_kode' => 'RR3', 'ruang_tipe' => 'rapat', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 4, 'ruang_nama' => 'Ruang Rapat 1', 'ruang_kode' => 'RR1', 'ruang_tipe' => 'rapat', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 4, 'ruang_nama' => 'Ruang KPS', 'ruang_kode' => 'RKPS', 'ruang_tipe' => 'kantor', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 4, 'ruang_nama' => 'Ruang Ketua Jurusan', 'ruang_kode' => 'RKJ1', 'ruang_tipe' => 'kantor', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 4, 'ruang_nama' => 'Ruang Sekretaris Jurusan', 'ruang_kode' => 'RSJ1', 'ruang_tipe' => 'kantor', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 4, 'ruang_nama' => 'Ruang KPS 2', 'ruang_kode' => 'RKPS2', 'ruang_tipe' => 'kantor', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 4, 'ruang_nama' => 'Ruang Rapat 2', 'ruang_kode' => 'RR2', 'ruang_tipe' => 'rapat', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 4, 'ruang_nama' => 'Ruang Admin', 'ruang_kode' => 'RA2', 'ruang_tipe' => 'kantor', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 4, 'ruang_nama' => 'Ruang Toilet Barat 4', 'ruang_kode' => 'RTB4', 'ruang_tipe' => 'toilet', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 4, 'ruang_nama' => 'Ruang Toilet Timur 4', 'ruang_kode' => 'RTS4', 'ruang_tipe' => 'toilet', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 4, 'ruang_nama' => 'Lobby Lantai 4', 'ruang_kode' => 'LL4', 'ruang_tipe' => 'lobby', 'created_at' => now(), 'updated_at' => now()],
            ],
            5 => [
                // Lantai 5
                ['lantai_id' => 5, 'ruang_nama' => 'Ruang Kuliah Teori Sipil 5.01', 'ruang_kode' => 'RKTS5.01', 'ruang_tipe' => 'kelas', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 5, 'ruang_nama' => 'Ruang Kuliah Teori Sipil 5.02', 'ruang_kode' => 'RKTS5.02', 'ruang_tipe' => 'kelas', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 5, 'ruang_nama' => 'Ruang Kuliah Teori Sipil 5.03', 'ruang_kode' => 'RKTS5.03', 'ruang_tipe' => 'kelas', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 5, 'ruang_nama' => 'Ruang Kuliah Teori Sipil 5.04', 'ruang_kode' => 'RKTS5.04', 'ruang_tipe' => 'kelas', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 5, 'ruang_nama' => 'Ruang Kuliah Teori Sipil 5.05', 'ruang_kode' => 'RKTS5.05', 'ruang_tipe' => 'kelas', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 5, 'ruang_nama' => 'Ruang Kuliah Teori Sipil 5.06', 'ruang_kode' => 'RKTS5.06', 'ruang_tipe' => 'kelas', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 5, 'ruang_nama' => 'Ruang Kuliah Teori Sipil 5.07', 'ruang_kode' => 'RKTS5.07', 'ruang_tipe' => 'kelas', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 5, 'ruang_nama' => 'Ruang Kuliah Teori Sipil 5.08', 'ruang_kode' => 'RKTS5.08', 'ruang_tipe' => 'kelas', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 5, 'ruang_nama' => 'Ruang Laboratorium Praktik Y 1', 'ruang_kode' => 'LPY1', 'ruang_tipe' => 'lab', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 5, 'ruang_nama' => 'Ruang Teori 01', 'ruang_kode' => 'RT01', 'ruang_tipe' => 'kelas', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 5, 'ruang_nama' => 'Ruang Teori 02', 'ruang_kode' => 'RT02', 'ruang_tipe' => 'kelas', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 5, 'ruang_nama' => 'Ruang Teori 03', 'ruang_kode' => 'RT03', 'ruang_tipe' => 'kelas', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 5, 'ruang_nama' => 'Ruang Teori 04', 'ruang_kode' => 'RT04', 'ruang_tipe' => 'kelas', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 5, 'ruang_nama' => 'Ruang Teori 05', 'ruang_kode' => 'RT05', 'ruang_tipe' => 'kelas', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 5, 'ruang_nama' => 'Ruang Teori 06', 'ruang_kode' => 'RT06', 'ruang_tipe' => 'kelas', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 5, 'ruang_nama' => 'Ruang Teori 07', 'ruang_kode' => 'RT07', 'ruang_tipe' => 'kelas', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 5, 'ruang_nama' => 'Ruang Teknisi 4', 'ruang_kode' => 'RT4', 'ruang_tipe' => 'teknisi', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 5, 'ruang_nama' => 'Ruang OB 1', 'ruang_kode' => 'ROB1', 'ruang_tipe' => 'kantor', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 5, 'ruang_nama' => 'Ruang OB 2', 'ruang_kode' => 'ROB2', 'ruang_tipe' => 'kantor', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 5, 'ruang_nama' => 'Ruang Toilet Barat 5', 'ruang_kode' => 'RTB5', 'ruang_tipe' => 'toilet', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 5, 'ruang_nama' => 'Ruang Toilet Timur 5', 'ruang_kode' => 'RTS5', 'ruang_tipe' => 'toilet', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 5, 'ruang_nama' => 'Lobby Lantai 5', 'ruang_kode' => 'LL5', 'ruang_tipe' => 'lobby', 'created_at' => now(), 'updated_at' => now()],
            ],
            6 => [
                // Lantai 6
                ['lantai_id' => 6, 'ruang_nama' => 'Ruang Laboratorium Praktik Y 2', 'ruang_kode' => 'LPY2', 'ruang_tipe' => 'lab', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 6, 'ruang_nama' => 'Ruang Laboratorium Praktik Y 3', 'ruang_kode' => 'LPY3', 'ruang_tipe' => 'lab', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 6, 'ruang_nama' => 'Ruang Arsip', 'ruang_kode' => 'RA1', 'ruang_tipe' => 'arsip', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 6, 'ruang_nama' => 'Ruang Workshop Ekosistem', 'ruang_kode' => 'RWE', 'ruang_tipe' => 'workshop', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 6, 'ruang_nama' => 'Lab Sistem Informasi 1', 'ruang_kode' => 'LSI1', 'ruang_tipe' => 'lab', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 6, 'ruang_nama' => 'Lab Sistem Informasi 2', 'ruang_kode' => 'LSI2', 'ruang_tipe' => 'lab', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 6, 'ruang_nama' => 'Lab Sistem Informasi 3', 'ruang_kode' => 'LSI3', 'ruang_tipe' => 'lab', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 6, 'ruang_nama' => 'Ruang Baca', 'ruang_kode' => 'RB', 'ruang_tipe' => 'perpustakaan', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 6, 'ruang_nama' => 'Ruang OB 3', 'ruang_kode' => 'ROB3', 'ruang_tipe' => 'kantor', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 6, 'ruang_nama' => 'Ruang OB 4', 'ruang_kode' => 'ROB4', 'ruang_tipe' => 'kantor', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 6, 'ruang_nama' => 'Ruang Mushola 2', 'ruang_kode' => 'RM2', 'ruang_tipe' => 'mushola', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 6, 'ruang_nama' => 'Ruang Toilet Barat 6', 'ruang_kode' => 'RTB6', 'ruang_tipe' => 'toilet', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 6, 'ruang_nama' => 'Ruang Toilet Timur 6', 'ruang_kode' => 'RTS6', 'ruang_tipe' => 'toilet', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 6, 'ruang_nama' => 'Ruang Rapat 4', 'ruang_kode' => 'RR4', 'ruang_tipe' => 'rapat', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 6, 'ruang_nama' => 'Ruang D.01', 'ruang_kode' => 'RD.01', 'ruang_tipe' => 'kantor', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 6, 'ruang_nama' => 'Ruang D.02', 'ruang_kode' => 'RD.02', 'ruang_tipe' => 'kantor', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 6, 'ruang_nama' => 'Ruang D.03', 'ruang_kode' => 'RD.03', 'ruang_tipe' => 'kantor', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 6, 'ruang_nama' => 'Ruang D.04', 'ruang_kode' => 'RD.04', 'ruang_tipe' => 'kantor', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 6, 'ruang_nama' => 'Ruang D.05', 'ruang_kode' => 'RD.05', 'ruang_tipe' => 'kantor', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 6, 'ruang_nama' => 'Ruang D.06', 'ruang_kode' => 'RD.06', 'ruang_tipe' => 'kantor', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 6, 'ruang_nama' => 'Ruang Jurusan TI', 'ruang_kode' => 'RJT', 'ruang_tipe' => 'kantor', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 6, 'ruang_nama' => 'Ruang Program Studi', 'ruang_kode' => 'RPS', 'ruang_tipe' => 'kantor', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 6, 'ruang_nama' => 'Lobby Lantai 6', 'ruang_kode' => 'LL6', 'ruang_tipe' => 'lobby', 'created_at' => now(), 'updated_at' => now()],
            ],
            7 => [
                // Lantai 7
                ['lantai_id' => 7, 'ruang_nama' => 'Ruang LPR 1', 'ruang_kode' => 'LPR1', 'ruang_tipe' => 'lab', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 7, 'ruang_nama' => 'Ruang LPR 2', 'ruang_kode' => 'LPR2', 'ruang_tipe' => 'lab', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 7, 'ruang_nama' => 'Ruang LPR 3', 'ruang_kode' => 'LPR3', 'ruang_tipe' => 'lab', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 7, 'ruang_nama' => 'Ruang LPR 4', 'ruang_kode' => 'LPR4', 'ruang_tipe' => 'lab', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 7, 'ruang_nama' => 'Ruang LPR 5', 'ruang_kode' => 'LPR5', 'ruang_tipe' => 'lab', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 7, 'ruang_nama' => 'Ruang LPR 6', 'ruang_kode' => 'LPR6', 'ruang_tipe' => 'lab', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 7, 'ruang_nama' => 'Ruang LPR 7', 'ruang_kode' => 'LPR7', 'ruang_tipe' => 'lab', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 7, 'ruang_nama' => 'Ruang LPR 8', 'ruang_kode' => 'LPR8', 'ruang_tipe' => 'lab', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 7, 'ruang_nama' => 'Ruang LKJ 1', 'ruang_kode' => 'LKJ1', 'ruang_tipe' => 'kelas', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 7, 'ruang_nama' => 'Ruang LKJ 2', 'ruang_kode' => 'LKJ2', 'ruang_tipe' => 'kelas', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 7, 'ruang_nama' => 'Ruang LKJ 3', 'ruang_kode' => 'LKJ3', 'ruang_tipe' => 'kelas', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 7, 'ruang_nama' => 'Ruang LERP', 'ruang_kode' => 'LERP', 'ruang_tipe' => 'lab', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 7, 'ruang_nama' => 'Ruang LPY 4', 'ruang_kode' => 'LPY4', 'ruang_tipe' => 'lab', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 7, 'ruang_nama' => 'Ruang LAI 1', 'ruang_kode' => 'LAI1', 'ruang_tipe' => 'lab', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 7, 'ruang_nama' => 'Ruang LIG 1', 'ruang_kode' => 'LIG1', 'ruang_tipe' => 'lab', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 7, 'ruang_nama' => 'Ruang LIG 2', 'ruang_kode' => 'LIG2', 'ruang_tipe' => 'lab', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 7, 'ruang_nama' => 'Ruang OB 5', 'ruang_kode' => 'ROB5', 'ruang_tipe' => 'kantor', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 7, 'ruang_nama' => 'Ruang OB 6', 'ruang_kode' => 'ROB6', 'ruang_tipe' => 'kantor', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 7, 'ruang_nama' => 'Ruang Teknisi 5', 'ruang_kode' => 'RT5', 'ruang_tipe' => 'teknisi', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 7, 'ruang_nama' => 'Ruang Toilet Barat 7', 'ruang_kode' => 'RTB7', 'ruang_tipe' => 'toilet', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 7, 'ruang_nama' => 'Ruang Toilet Timur 7', 'ruang_kode' => 'RTS7', 'ruang_tipe' => 'toilet', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 7, 'ruang_nama' => 'Lobby Lantai 7', 'ruang_kode' => 'LL7', 'ruang_tipe' => 'lobby', 'created_at' => now(), 'updated_at' => now()],
            ],
            8 => [
                // Lantai 8
                ['lantai_id' => 8, 'ruang_nama' => 'Ruang LAI 2', 'ruang_kode' => 'LAI2', 'ruang_tipe' => 'lab', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 8, 'ruang_nama' => 'Ruang Teori 08', 'ruang_kode' => 'RT08', 'ruang_tipe' => 'kelas', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 8, 'ruang_nama' => 'Ruang Teori 09', 'ruang_kode' => 'RT09', 'ruang_tipe' => 'kelas', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 8, 'ruang_nama' => 'Ruang Teori 10', 'ruang_kode' => 'RT10', 'ruang_tipe' => 'kelas', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 8, 'ruang_nama' => 'Ruang Teori 11', 'ruang_kode' => 'RT11', 'ruang_tipe' => 'kelas', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 8, 'ruang_nama' => 'Ruang Teori 12', 'ruang_kode' => 'RT12', 'ruang_tipe' => 'kelas', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 8, 'ruang_nama' => 'Ruang Teori 13', 'ruang_kode' => 'RT13', 'ruang_tipe' => 'kelas', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 8, 'ruang_nama' => 'Ruang Teori 14', 'ruang_kode' => 'RT14', 'ruang_tipe' => 'kelas', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 8, 'ruang_nama' => 'Ruang Kantin 2', 'ruang_kode' => 'RK2', 'ruang_tipe' => 'kantin', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 8, 'ruang_nama' => 'Ruang OB 7', 'ruang_kode' => 'ROB7', 'ruang_tipe' => 'kantor', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 8, 'ruang_nama' => 'Ruang OB 8', 'ruang_kode' => 'ROB8', 'ruang_tipe' => 'kantor', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 8, 'ruang_nama' => 'Ruang Toilet Barat 8', 'ruang_kode' => 'RTB8', 'ruang_tipe' => 'toilet', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 8, 'ruang_nama' => 'Ruang Toilet Timur 8', 'ruang_kode' => 'RTS8', 'ruang_tipe' => 'toilet', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 8, 'ruang_nama' => 'Ruang Musik', 'ruang_kode' => 'RM', 'ruang_tipe' => 'musik', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 8, 'ruang_nama' => 'Ruang Auditorium', 'ruang_kode' => 'R.Audit', 'ruang_tipe' => 'auditorium', 'created_at' => now(), 'updated_at' => now()],
                ['lantai_id' => 8, 'ruang_nama' => 'Lobby Lantai 8', 'ruang_kode' => 'LL8', 'ruang_tipe' => 'lobby', 'created_at' => now(), 'updated_at' => now()],
            ]
        ];

        $now = Carbon::now();

        $data = [];

        foreach ($ruangan as $lantai_id => $listRuangan) {
            foreach ($listRuangan as $ruang) {
                $data[] = [
                    'lantai_id' => $ruang['lantai_id'],
                    'ruang_nama' => $ruang['ruang_nama'],
                    'ruang_kode' => $ruang['ruang_kode'],
                    'ruang_tipe' => $ruang['ruang_tipe'],
                    'created_at' => $ruang['created_at'],
                    'updated_at' => $ruang['updated_at'],
                ];
            }
        }

        DB::table('m_ruang')->insertOrIgnore($data);
    }
}
