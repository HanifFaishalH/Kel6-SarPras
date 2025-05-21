<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class TeknisiSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        // Gunakan level_id 5
        $levelId = 5;

        // Ambil user_id dari m_users dengan filter user_id antara 5 sampai 9
        $userIds = DB::table('m_users')
            ->whereBetween('user_id', [5, 9])
            ->pluck('user_id')
            ->toArray();

        if (empty($userIds)) {
            $this->command->warn('Tabel m_users dengan user_id 5-9 kosong. Seeder Teknisi dibatalkan.');
            return;
        }

        // Insert data teknisi sesuai user_id range 5-9
        foreach ($userIds as $userId) {
            DB::table('m_teknisi')->insert([
                'level_id' => $levelId,
                'user_id' => $userId,
                'keahlian' => $faker->randomElement(['Listrik', 'Jaringan', 'AC', 'Perabot', 'Komputer']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
