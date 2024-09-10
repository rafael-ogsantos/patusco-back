<?php

namespace Database\Seeders;

use App\Modules\User\Domain\Entities\User;
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
            'name' => 'Doctor User',
            'email' => 'doctor@example.com',
            'password' => Hash::make('12345678'),
            'role' => 'doctor',
        ]);

        User::create([
            'name' => 'Receptionist User',
            'email' => 'receptionist@example.com',
            'password' => Hash::make('12345678'),
            'role' => 'receptionist',
        ]);
    }
}
