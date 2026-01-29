<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('secret@123'),
            'phone_number' => '03001234567',
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create Regular User
        User::create([
            'name' => 'Regular User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('secret@123'),
            'phone_number' => '03007654321',
            'role' => 'user',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Seed Categories and Addons
        $this->call([
            CategoriesSeeder::class,
            AddonsSeeder::class,
        ]);
    }
}
