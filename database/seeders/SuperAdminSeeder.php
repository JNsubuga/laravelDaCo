<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Joseph Nsubuga',
            // 'username' => 'SuperAdmin',
            'email' => 'jkiwanjago@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('020069Nkj')
        ]);
        // ->assignRole('SuperAdmin');
    }
}
