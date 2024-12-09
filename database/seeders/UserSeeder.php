<?php

namespace Database\Seeders;

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
        User::create([
            'name' => 'John Doe',
            'email' => 'admin@example.com',
            'password' => Hash::make('johnsch'),
            'role' => 'Admin',
        ]);

        User::create([
            'name' => 'John Doe',
            'email' => 'kasir@example.com',
            'password' => Hash::make('johnsch'),
            'role' => 'Kasir',
        ]);
        
        User::create([
            'name' => 'John Doe',
            'email' => 'user@example.com',
            'password' => Hash::make('johnsch'),
            'role' => 'User',
        ]);
    }
}