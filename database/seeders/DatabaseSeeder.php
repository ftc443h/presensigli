<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Fathimah',
            'email' => 'fathimah3.0820.5fyn@gmail.com',
            'username' => 'fathimah@globallintas2025',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'status' => 'active'
        ]);

        User::factory()->create([
            'name' => 'Ridho',
            'email' => 'ridho.global.lintas@gmail.com',
            'username' => 'ridho@globallintas2025',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'status' => 'active'
        ]);
    }
}
