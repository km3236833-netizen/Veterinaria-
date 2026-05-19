<?php

namespace Database\Seeders;

use App\Models\Dueno;
use App\Models\Mascota;
use App\Models\Veterinario;
use App\Models\Consulta;
use App\Models\User;
use Illuminate\Database\Seeder;

class DuenoMascotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Fetch the veterinarian user and create the Veterinarian profile
        $userVet = User::where('email', 'veterinario@gmail.com')->first();
        
        $vet = Veterinario::create([
            'usuario_id' => $userVet->id,
            'nombre_completo' => 'Dr. Fernando Ortiz',
            'especialidad' => 'Medicina Veterinaria y Cirugía General',
            'cedula_profesional' => 'VET-9876543-A',
        ]);

        // 2. Create owners (without redes_sociales)
        $dueno1 = Dueno::create([
            'nombre_completo' => 'Carlos Mendoza',
            'telefono' => '555-0199',
            'direccion' => 'Av. de la Constitución 123, Colonia Centro',
        ]);

        $dueno2 = Dueno::create([
            'nombre_completo' => 'María Fernanda Rojas',
            'telefono' => '555-0248',
            'direccion' => 'Calle Violeta 45, Las Flores',
        ]);

        $dueno3 = Dueno::create([
            'nombre_completo' => 'Jorge Silva',
            'telefono' => '555-0371',
            'direccion' => 'Paseo de la Cañada 890, Lomas Altas',
        ]);

        $dueno4 = Dueno::create([
            'nombre_completo' => 'Ana Patricia Gomez',
            'telefono' => '555-0412',
            'direccion' => 'Avenida Juárez 567, San Rafael',
        ]);

        // 3. Create pets associated with these owners
        $mascota1 = Mascota::create([
            'dueno_id' => $dueno1->id,
            'nombre' => 'Max',
            'especie' => 'Canino',
            'raza' => 'Golden Retriever',
            'fecha_nacimiento' => '2023-04-15',
            'tipo_sangre' => 'DEA 1.1 Positivo',
            'comportamiento' => 'Dócil y juguetón',
            'es_adoptado' => true,
        ]);

        $mascota2 = Mascota::create([
            'dueno_id' => $dueno2->id,
            'nombre' => 'Luna',
            'especie' => 'Felino',
            'raza' => 'Persa',
            'fecha_nacimiento' => '2025-05-10',
            'tipo_sangre' => 'A',
            'comportamiento' => 'Tranquila, reservada',
            'es_adoptado' => false,
        ]);

        $mascota3 = Mascota::create([
            'dueno_id' => $dueno3->id,
            'nombre' => 'Rocky',
            'especie' => 'Canino',
            'raza' => 'Pastor Alemán',
            'fecha_nacimiento' => '2021-01-20',
            'tipo_sangre' => 'DEA 1.1 Negativo',
            'comportamiento' => 'Alerta, guardián',
            'es_adoptado' => false,
        ]);

        $mascota4 = Mascota::create([
            'dueno_id' => $dueno4->id,
            'nombre' => 'Bella',
            'especie' => 'Canino',
            'raza' => 'Husky Siberiano',
            'fecha_nacimiento' => '2024-08-30',
            'tipo_sangre' => 'DEA 1.2 Positivo',
            'comportamiento' => 'Activa, ruidosa',
            'es_adoptado' => true,
        ]);

        // 4. Create consultations for the pets linked to the Veterinarian
        Consulta::create([
            'mascota_id' => $mascota1->id,
            'veterinario_id' => $vet->id,
            'fecha_consulta' => '2026-05-15 10:30:00',
            'peso' => 28.50,
            'talla' => 60.00,
            'diagnostico' => 'Chequeo general de rutina y desparasitación anual.',
            'tratamiento' => 'Se administró tableta desparasitante oral NexGard Spectra. Todo en orden.',
        ]);

        Consulta::create([
            'mascota_id' => $mascota2->id,
            'veterinario_id' => $vet->id,
            'fecha_consulta' => '2026-05-12 14:15:00',
            'peso' => 4.20,
            'talla' => 25.00,
            'diagnostico' => 'Otitis externa leve en oído derecho.',
            'tratamiento' => 'Limpieza de conducto auditivo y gotas Otoclean (5 gotas cada 12 horas por 7 días).',
        ]);

        Consulta::create([
            'mascota_id' => $mascota3->id,
            'veterinario_id' => $vet->id,
            'fecha_consulta' => '2026-05-18 09:00:00',
            'peso' => 35.10,
            'talla' => 65.00,
            'diagnostico' => 'Gastroenteritis bacteriana aguda debido a ingesta de alimento descompuesto.',
            'tratamiento' => 'Tratamiento antibiótico con Enrofloxacina oral, dieta blanda y suero de hidratación por 5 días.',
        ]);

        Consulta::create([
            'mascota_id' => $mascota4->id,
            'veterinario_id' => $vet->id,
            'fecha_consulta' => '2026-05-10 16:45:00',
            'peso' => 22.30,
            'talla' => 52.00,
            'diagnostico' => 'Vacunación de refuerzo óctuple y de rabia.',
            'tratamiento' => 'Se aplicaron vacunas Nobivac DHPPi y Rabia. Sin reacciones adversas reportadas.',
        ]);
    }
}
