<?php

namespace Database\Seeders;

use App\Models\TargetFuntion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TargetFuntionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $target_functions = [
            [
                'name' => 'Strategic Functions',
                'percentage' => 45
            ],
            [
                'name' => 'Core Functions',
                'percentage' => 45
            ],
            [
                'name' => 'Support Functions',
                'percentage' => 10
            ]
        ];

        foreach ($target_functions as $target_function) {
            TargetFuntion::create([
                'name' => $target_function['name'],
                'percentage' => $target_function['percentage']
            ]);
        }
    }
}
