<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            'Paciente',
            'Doctor',
            'Recepcionista',
            'Administrador',
            'Super administrador',
            'Contador',
            'Enfermero',
            'Técnico de laboratorio',
            'Farmacéutico',        
        ];

        foreach ($roles as $name) {
            Role::query()->updateOrCreate(
                ['name' => $name, 'guard_name' => 'web'],
                ['is_system' => true]
            );
          
        }
    }
}

