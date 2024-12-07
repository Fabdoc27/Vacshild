<?php

namespace Database\Seeders;

use App\Enums\Role;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'nid' => '0123456789',
            'phone' => '0123456789',
            'password' => Hash::make('password'),
            'role' => Role::ADMIN,
        ]);

        $this->call(VaccineCenterSeeder::class);
    }
}
