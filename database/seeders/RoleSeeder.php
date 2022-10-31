<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'SuperAdmin',
            'Admin',
            'user',
        ];
        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }
        // Role::create(['name' => 'SuperAdmin']);
        // Role::create(['name' => 'Admin']);
        // Role::create(['name' => 'user']);
    }
}
