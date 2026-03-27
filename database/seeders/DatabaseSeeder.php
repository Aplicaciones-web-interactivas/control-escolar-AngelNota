<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Rol;
use App\Models\User;
use App\Models\Materia;
use App\Models\Grupo;
use App\Models\Horario;
use App\Models\Inscripcion;
use App\Models\Calificacion;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Crear Roles
        $rolAdmin = Rol::create(['name' => 'Administrador']);
        $rolProfe = Rol::create(['name' => 'Profesor']);
        $rolAlumno = Rol::create(['name' => 'Alumno']);

        // 2. Crear Usuarios (Administrador principal)
        $admin = User::create([
            'name' => 'Admin',
            'last_name' => 'Principal',
            'clave_institucional' => 'ADM001',
            'email' => 'admin@controlescolar.com',
            'password' => Hash::make('password123'),
            'rol_id' => $rolAdmin->id,
            'active' => true,
        ]);

        // Crear Profesor
        $profesor = User::create([
            'name' => 'Juan',
            'last_name' => 'Pérez',
            'clave_institucional' => 'PRO001',
            'email' => 'juan.perez@controlescolar.com',
            'password' => Hash::make('password123'),
            'rol_id' => $rolProfe->id,
            'active' => true,
        ]);

        // Crear Alumno
        $alumno = User::create([
            'name' => 'María',
            'last_name' => 'García',
            'clave_institucional' => 'ALU001',
            'email' => 'maria.garcia@controlescolar.com',
            'password' => Hash::make('password123'),
            'rol_id' => $rolAlumno->id,
            'active' => true,
        ]);

        // 3. Crear Materias
        $materia1 = Materia::create([
            'name' => 'Matemáticas Avanzadas',
            'clave' => 'MAT101',
        ]);
        
        $materia2 = Materia::create([
            'name' => 'Historia Universal',
            'clave' => 'HIS101',
        ]);

        // 4. Crear Grupos
        $grupo1 = Grupo::create([
            'name' => '1A - Matemáticas',
            'materia_id' => $materia1->id,
            'profesor_id' => $profesor->id,
        ]);

        // 5. Crear Horarios
        Horario::create([
            'grupo_id' => $grupo1->id,
            'dia' => 'Lunes',
            'hora_inicio' => '08:00:00',
            'hora_fin' => '10:00:00',
        ]);

        // 6. Crear Inscripciones
        $inscripcion = Inscripcion::create([
            'grupo_id' => $grupo1->id,
            'alumno_id' => $alumno->id,
        ]);

        // 7. Crear Calificaciones
        Calificacion::create([
            'inscripcion_id' => $inscripcion->id,
            'calificacion' => 9.5,
            'tipo_evaluacion' => 'Primer Parcial',
        ]);
        
        Calificacion::create([
            'inscripcion_id' => $inscripcion->id,
            'calificacion' => 8.0,
            'tipo_evaluacion' => 'Segundo Parcial',
        ]);
        
        echo "¡Base de datos poblada exitosamente con roles, un usuario admin (admin@controlescolar.com / password123), materias, grupos, horarios, inscripciones y calificaciones!\n";
    }
}
