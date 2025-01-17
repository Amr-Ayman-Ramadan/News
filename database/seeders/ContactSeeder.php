<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            Contact::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'title' => $faker->sentence,
                'body' => $faker->paragraph,
                'phone' => $faker->phoneNumber,
                'ip_address' => $faker->ipv4,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
