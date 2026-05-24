<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use App\Models\Mascota;
use Illuminate\Http\Request;

class ConsultaController extends Controller
{
    /**
     * Muestra el detalle de una consulta específica junto con los antecedentes del paciente.
     * URL: /consultas/{consulta}/detalle?mascota={mascota_id}
     */
    public function detalle(Request $request, $consulta)
    {
        $consulta = Consulta::with(['mascota.dueno', 'veterinario'])->findOrFail($consulta);

        // Obtener la mascota usando el parámetro de la URL o a través de la relación de la consulta
        $mascota_id = $request->query('mascota', $consulta->mascota_id);
        $mascota = Mascota::with([
            'dueno',
            'consultas',
            'antecedentesAlergias',
            'antecedentesLesiones',
            'antecedentesPatologicos',
            'historialAlimentacion'
        ])->findOrFail($mascota_id);

        return view('modules.consultas.show', compact('consulta', 'mascota'));
    }
}
