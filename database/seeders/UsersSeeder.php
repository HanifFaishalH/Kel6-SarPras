<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $users = [
            [
                'username' => 'admin',
                'password' => bcrypt('admin'),
                'nama' => 'Admin1',
                'level_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'mahasiswa',
                'password' => bcrypt('mahasiswa'),
                'nama' => 'Mahasiswa1',
                'level_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'dosen',
                'password' => bcrypt('dosen'),
                'nama' => 'Dosen1',
                'level_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'tendik',
                'password' => bcrypt('tendik'),
                'nama' => 'Tenaga Pendidik1',
                'level_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'teknisi 1',
                'password' => bcrypt('teknisi1'),
                'nama' => 'Teknisi1',
                'level_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'teknisi 2',
                'password' => bcrypt('teknisi2'),
                'nama' => 'Teknisi1',
                'level_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'teknisi 3',
                'password' => bcrypt('teknisi3'),
                'nama' => 'Teknisi1',
                'level_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'teknisi 4',
                'password' => bcrypt('teknisi4'),
                'nama' => 'Teknisi1',
                'level_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'teknisi 5',
                'password' => bcrypt('teknisi5'),
                'nama' => 'Teknisi1',
                'level_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'sarpras',
                'password' => bcrypt('sarpras'),
                'nama' => 'Sarana Prasarana',
                'level_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];
        foreach ($users as $user) {
            DB::table('m_users')->insertOrIgnore($user);
        }
    }
}