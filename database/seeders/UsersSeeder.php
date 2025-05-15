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
                'user_id' => 'admin',
                'password' => bcrypt('admin'),
                'nama' => 'Administrator',
                'level_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'mahasiswa',
                'password' => bcrypt('mahasiswa'),
                'level_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'dosen',
                'password' => bcrypt('dosen'),
                'level_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'tendik',
                'password' => bcrypt('tendik'),
                'level_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'teknisi',
                'password' => bcrypt('teknisi'),
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
