<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['admin', 'pmt', 'office-head', 'rater'];
        foreach ($roles as $r) {
            $role = Role::create(['name' => $r]);
            Permission::create(['name' => $r . '.create']);
            $permission = Permission::create(['name' => $r . '.read']);
            Permission::create(['name' => $r . '.update']);
            Permission::create(['name' => $r . '.delete']);

            $role->givePermissionTo($permission);
        }
    }
}
