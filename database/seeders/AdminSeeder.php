<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'name' => 'Manger',
            'username' => 'amr ayman',
            'email' => 'admin@admin.com',
            'password' => bcrypt('12345678'),
            'remember_token' => "on",
            'role_id' => 1,
        ]);
    }
}
