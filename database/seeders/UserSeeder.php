<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'adli Admin',
            'email' => 'adli@example.com',
            'password' => Hash::make('password123'),
            'role' => 'super_admin',
        ]);

        User::create([
            'name' => 'Kepala RO',
            'email' => 'kepalaro@example.com',
            'password' => Hash::make('password123'),
            'role' => 'kepala_ro',
        ]);

        User::create([
            'name' => 'Kepala Gudang',
            'email' => 'kepalagudang@example.com',
            'password' => Hash::make('password123'),
            'role' => 'kepala_gudang',
        ]);

        User::create([
            'name' => 'User Biasa',
            'email' => 'user@example.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);
    }
}
