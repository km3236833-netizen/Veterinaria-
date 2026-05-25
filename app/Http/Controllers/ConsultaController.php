<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use App\Models\Mascota;
use App\Models\Veterinario;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ConsultaController extends Controller
{
    /**
     * Muestra el listado de diagnósticos/consultas registradas.
     */
    public function index(Request $request)
    {
        $query = Consulta::with(['mascota.dueno', 'veterinario']);

        if ($request->filled('buscar')) {
            $buscar = $request->buscar;
            $query->where(function($q) use ($buscar) {
                $q->where('diagnostico', 'like', "%{$buscar}%")
                  ->orWhereHas('mascota', function($mq) use ($buscar) {
                      $mq->where('nombre', 'like', "%{$buscar}%")
                         ->orWhere('especie', 'like', "%{$buscar}%")
                         ->orWhere('raza', 'like', "%{$buscar}%");
                  })
                  ->orWhereHas('veterinario', function($vq) use ($buscar) {
                      $vq->where('nombre_completo', 'like', "%{$buscar}%");
                  });
            });
        }

        $items = $query->orderBy('fecha_consulta', 'desc')->paginate(10);

        return view('modules.consultas.index', compact('items'));
    }

    /**
     * Muestra el formulario para crear un nuevo diagnóstico/consulta.
     */
    public function create(Request $request)
    {
        $mascotas = Mascota::orderBy('nombre')->get();
        $veterinarios = Veterinario::orderBy('nombre_completo')->get();
        $mascotaPreseleccionada = $request->query('mascota');
        $fechaActual = Carbon::now()->format('Y-m-d\TH:i');

        return view('modules.consultas.create', compact('mascotas', 'veterinarios', 'mascotaPreseleccionada', 'fechaActual'));
    }

    /**
     * Almacena un nuevo diagnóstico/consulta en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'mascota_id' => 'required|exists:mascotas,id',
            'veterinario_id' => 'required|exists:veterinarios,id',
            'fecha_consulta' => 'required|date',
            'peso' => 'required|numeric|min:0',
            'talla' => 'required|numeric|min:0',
            'diagnostico' => 'required|string',
        ]);

        $data = $request->all();
        $data['tratamiento'] = 'Sin tratamiento';

        $consulta = Consulta::create($data);

        return redirect()->route('consultas.index')
            ->with('success', 'Se guardó la nueva información.');
    }

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

    /**
     * Muestra el formulario para editar un diagnóstico/consulta.
     */
    public function edit($id)
    {
        $item = Consulta::findOrFail($id);
        $mascotas = Mascota::orderBy('nombre')->get();
        $veterinarios = Veterinario::orderBy('nombre_completo')->get();

        return view('modules.consultas.edit', compact('item', 'mascotas', 'veterinarios'));
    }

    /**
     * Actualiza un diagnóstico/consulta específico en la base de datos.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'mascota_id' => 'required|exists:mascotas,id',
            'veterinario_id' => 'required|exists:veterinarios,id',
            'fecha_consulta' => 'required|date',
            'peso' => 'required|numeric|min:0',
            'talla' => 'required|numeric|min:0',
            'diagnostico' => 'required|string',
        ]);

        $consulta = Consulta::findOrFail($id);
        $data = $request->all();
        $data['tratamiento'] = $consulta->tratamiento ?? 'Sin tratamiento';
        $consulta->update($data);

        return redirect()->route('consultas.index')
            ->with('success', 'Se actualizó con éxito.');
    }

    /**
     * Elimina un diagnóstico/consulta específico de la base de datos.
     */
    public function destroy($id)
    {
        $consulta = Consulta::findOrFail($id);
        $consulta->delete();

        return redirect()->route('consultas.index')
            ->with('success', 'Diagnóstico eliminado correctamente.');
    }

    /**
     * Genera el informe de consulta médica en formato imprimible PDF.
     */
    public function pdf($id)
    {
        $consulta = Consulta::with(['mascota.dueno', 'veterinario'])->findOrFail($id);
        
        return view('modules.consultas.pdf', compact('consulta'));
    }
}
