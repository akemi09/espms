<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $this->call([
            RoleSeeder::class,
            OfficeSeeder::class,
        ]);

        $users = [
            [
                'name' => 'Root User',
                'email' => 'root@example.com',
                'role' => 'Super Admin',
            ],
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'role' => 'Admin',
            ],
            [
                'name' => 'PMT User',
                'email' => 'pmt@example.com',
                'role' => 'PMT',
            ],
            [
                'name' => 'Office Head User',
                'email' => 'officehead@example.com',
                'role' => 'Office Head',
            ],
            [
                'name' => 'Rater User',
                'email' => 'rater@example.com',
                'role' => 'Rater',
            ]
        ];

        foreach ($users as $user) {
            $u = User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make('password'),
            ]);
    
            $u->assignRole($user['role']);
        }
    }
}
