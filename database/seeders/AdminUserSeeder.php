<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'), // Default password
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Warehouse Officer',
            'email' => 'officer@admin.com',
            'password' => Hash::make('password'),
            'role' => 'officer',
        ]);
    }
}
