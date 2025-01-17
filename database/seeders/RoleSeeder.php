<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [];
        foreach (config('permissions.permissions') as $key => $permission) {
            $permissions[] = $key;
        }
        Role::create([
            'name' => 'Manger',
            'permissions' => json_encode($permissions),
        ]);
    }
}
