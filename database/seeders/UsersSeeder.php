<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'omar',
            'username' => 'omar khaled',
            'phone' => '1126258730',
            'email' => 'omar@yahoo.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'image' => 'default.jpg',
            'status' => 'active',
            'country' => 'Egypt',
            'city' => 'Damitta',
            'street' => '123 Main Street',
            'remember_token' => Str::random(10),
        ]);

        User::factory()->count(10)->create();
    }
}
