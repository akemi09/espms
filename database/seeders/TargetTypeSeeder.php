<?php

namespace Database\Seeders;

use App\Models\TargetType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TargetTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $target_types = ['IPCR', 'OPCR'];
        foreach ($target_types as $target_type) {
            TargetType::create(['name' => $target_type]);
        }
    }
}
