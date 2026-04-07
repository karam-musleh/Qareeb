<?php

namespace Database\Seeders;

use App\Enum\UserRole;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345678'),
            'role' => UserRole::ADMIN,
            'location_id' => 1,
        ]);

        User::create([
            'name' => 'Normal User',
            'email' => 'user@user.com',
            'password' => Hash::make('12345678'),
            'role' => UserRole::USER,
            'location_id' => 1,
        ]);
    }
}
