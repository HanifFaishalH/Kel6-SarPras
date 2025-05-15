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
                'username' => 'teknisi',
                'password' => bcrypt('teknisi'),
                'nama' => 'Teknisi1',
                'level_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($users as $user) {
            DB::table('m_users')->insert($user);
        }
    }
}