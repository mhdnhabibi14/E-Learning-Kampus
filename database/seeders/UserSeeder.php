<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'      => 'Administrator',
            'email'     => 'admin@gmail.com',
            'password'  => 'admin123',
            'role'      => 'admin',
            'is_active' => true,
        ]);

        User::create([
            'name'      => 'Dosen Demo',
            'email'     => 'dosen@gmail.com',
            'password'  => 'dosen123',
            'role'      => 'dosen',
            'is_active' => true,
        ]);

        User::create([
            'name'      => 'Mahasiswa Demo',
            'email'     => 'mahasiswa@gmail.com',
            'password'  => 'mahasiswa123',
            'role'      => 'mahasiswa',
            'is_active' => true,
        ]);
    }
}
