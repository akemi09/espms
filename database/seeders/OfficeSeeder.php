<?php

namespace Database\Seeders;

use App\Models\Office;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $offices = [
            "College of Engineering",
            "Records Office",
            "Human Resource Management Office",
            "Supply and Property Office",
            "Medical and Dental Office",
            "Budget Office",
            "Accounting Office",
            "Cashier Office",
            "Facilities Management Office",
            "Internal Audit Office",
            "Institutional Planning Office",
            "Procurement /BAC",
            "College of Business Administration",
            "College of Health Sciences",
            "College of Computer Studies",
            "College of Education Arts and Sciences",
            "Library",
            "Registrar",
            "Guidance",
            "Office of Student Affairs and Services",
            "Extension",
            "Research",
        ];

        foreach ($offices as $office) {
            Office::create([
                'name' => $office,
            ]);
        }
    }
}