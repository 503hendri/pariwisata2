<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'RoamingVirgo',
            'email' => '503hendri@gmail.com',
            'password' => bcrypt('q1W@e3R$@#_'),
        ]);

        Role::create([
            'name' => 'admin',
            'guard_name' => 'web',
        ]);

        Role::create([
            'name' => 'editor',
            'guard_name' => 'web',
        ]);

        // Assign roles to user
        $user->assignRole('admin');
    }
}
