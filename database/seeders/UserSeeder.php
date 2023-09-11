<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Super User',
                'email' => 'root@example.com',
                'office_id' => 1,
                'role' => 'Super Admin',
            ],
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'office_id' => 1,
                'role' => 'Admin',
            ],
            [
                'name' => 'PMT User',
                'email' => 'pmt@example.com',
                'office_id' => 1,
                'role' => 'PMT',
            ],
            [
                'name' => 'Office Head User',
                'email' => 'officehead@example.com',
                'office_id' => 1,
                'role' => 'Office Head',
            ],
            [
                'name' => 'Rater User',
                'email' => 'rater@example.com',
                'office_id' => 1,
                'role' => 'Rater',
            ]
        ];

        foreach ($users as $user) {
            $u = User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'designation' => 'Test Designation',
                'office_id' => $user['office_id'],
                'password' => Hash::make('password'),
            ]);
    
            $u->assignRole($user['role']);
        }
    }
}
