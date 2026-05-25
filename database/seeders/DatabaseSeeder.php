<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@lifeabujacollegeoftheology.com'],
            [
                'name'              => 'Admin Staff',
                'password'          => Hash::make('password123'),
                'role'              => 'super_admin',
                'email_verified_at' => now(),
            ]
        );
    }
}
