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
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'office_id' => 1,
                'role' => 'admin',
            ],
            [
                'name' => 'PMT User',
                'email' => 'pmt@example.com',
                'office_id' => 1,
                'role' => 'pmt',
            ],
            [
                'name' => 'Office Head User',
                'email' => 'officehead@example.com',
                'office_id' => 1,
                'role' => 'office-head',
            ],
            [
                'name' => 'Rater User',
                'email' => 'rater@example.com',
                'office_id' => 1,
                'role' => 'rater',
            ]
        ];

        foreach ($users as $user) {
            $u = User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'designation' => 'Professor',
                'office_id' => $user['office_id'],
                'password' => Hash::make('password'),
            ]);
    
            $u->assignRole($user['role']);
        }
    }
}
