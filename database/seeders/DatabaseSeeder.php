<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Skripsi;

class SkripsiSeeder extends Seeder
{
    public function run()
    {
        Skripsi::insert([
            [
                'judul' => 'Analisis Sistem Informasi',
                'nama' => 'fitri destika',
                'nim' => '6304221485',
                'angkatan' => 2022,
                'dosen_pembimbing1' => 'Fajri Profesio Putra, M.Kom',
                'dosen_pembimbing2' => 'Elvi Rahmi, M.Kom'
            ],
            
            // Tambahkan lebih banyak data jika diperlukan
        ]);
    }
}

/*namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    /*public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'user1',
            'email' => 'user@gmail.com',
            'password' => bcrypt('123456789'),
            'point' => 10000,
        ]);

        Admin::create([
            'name' => 'admin',
            'username' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456789'),
            
        ]);
    }
}*/
