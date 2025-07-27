<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Jalankan seeder Role
        $this->call([
            RoleSeeder::class,
        ]);

        // Buat user dan assign role jika diperlukan
        $user = User::factory()->create([
            'name' => 'admin2',
            'email' => 'admin2@simpeg.com',
            'password' => bcrypt('123'),
        ]);

        // Tambahkan role ke user ini (misalnya "karyawan")
        $user->assignRole('karyawan');
    }
}
