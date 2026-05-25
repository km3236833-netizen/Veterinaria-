<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Tratamiento;
use App\Models\Mascota;

class TratamientoController extends Controller
{
    /**
     * Muestra la lista de tratamientos médicos.
     */
    public function index(Request $request)
    {
        $query = Tratamiento::with('mascota.dueno');

        if ($request->filled('buscar')) {
            $buscar = $request->buscar;
            $query->where(function ($q) use ($buscar) {
                $q->where('medicamento', 'like', "%{$buscar}%")
                  ->orWhere('dosis', 'like', "%{$buscar}%")
                  ->orWhere('frecuencia', 'like', "%{$buscar}%")
                  ->orWhereHas('mascota', function ($mq) use ($buscar) {
                      $mq->where('nombre', 'like', "%{$buscar}%")
                         ->orWhere('especie', 'like', "%{$buscar}%")
                         ->orWhere('raza', 'like', "%{$buscar}%");
                  });
            });
        }

        $items = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('modules.tratamientos.index', compact('items'));
    }

    /**
     * Muestra el formulario de registro de un nuevo tratamiento.
     */
    public function create(Request $request)
    {
        $mascotas = Mascota::orderBy('nombre')->get();
        $mascotaPreseleccionada = $request->query('mascota');

        return view('modules.tratamientos.create', compact('mascotas', 'mascotaPreseleccionada'));
    }

    /**
     * Almacena un nuevo tratamiento médico.
     */
    public function store(Request $request)
    {
        $request->validate([
            'mascota_id' => 'required|exists:mascotas,id',
            'medicamento' => 'required|string|max:255',
            'dosis' => 'required|string|max:255',
            'frecuencia' => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'indicaciones' => 'nullable|string',
        ]);

        Tratamiento::create($request->all());

        return redirect()->route('tratamientos.index')
            ->with('success', 'Se guardó la nueva información.');
    }

    /**
     * Muestra los detalles de un tratamiento.
     */
    public function show($id)
    {
        $item = Tratamiento::with('mascota.dueno')->findOrFail($id);

        return view('modules.tratamientos.show', compact('item'));
    }

    /**
     * Muestra el formulario para editar un tratamiento.
     */
    public function edit($id)
    {
        $item = Tratamiento::findOrFail($id);
        $mascotas = Mascota::orderBy('nombre')->get();

        return view('modules.tratamientos.edit', compact('item', 'mascotas'));
    }

    /**
     * Actualiza el tratamiento seleccionado.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'mascota_id' => 'required|exists:mascotas,id',
            'medicamento' => 'required|string|max:255',
            'dosis' => 'required|string|max:255',
            'frecuencia' => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'indicaciones' => 'nullable|string',
        ]);

        $item = Tratamiento::findOrFail($id);
        $item->update($request->all());

        return redirect()->route('tratamientos.index')
            ->with('success', 'Se actualizó con éxito.');
    }

    /**
     * Elimina el tratamiento de la base de datos.
     */
    public function destroy($id)
    {
        $item = Tratamiento::findOrFail($id);
        $item->delete();

        return redirect()->route('tratamientos.index')
            ->with('success', 'Se eliminó la información con éxito.');
    }

    /**
     * Genera una receta de tratamiento interactiva en PDF/Impresión.
     */
    public function pdf($id)
    {
        $item = Tratamiento::with('mascota.dueno')->findOrFail($id);

        return view('modules.tratamientos.pdf', compact('item'));
    }
}
