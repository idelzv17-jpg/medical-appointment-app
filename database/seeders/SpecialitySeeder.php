<?php

namespace Database\Seeders;

use App\Models\Speciality;
use Illuminate\Database\Seeder;

class SpecialitySeeder extends Seeder
{
    public function run(): void
    {
        $specialities = [
            'Alergología',
            'Cardiología',
            'Dermatología',
            'Ginecología',
            'Endocrinología',
            'Gastroenterología',
            'Hematología',
            'Infectología',
            'Medicina general',
            'Neurología',
            'Oftalmología',
            'Pediatría',
            'Psiquiatría',
            'Traumatología',
        ];

        foreach ($specialities as $name) {
            Speciality::firstOrCreate(['name' => $name]);
        }
    }
}
