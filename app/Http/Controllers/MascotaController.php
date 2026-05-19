<?php

namespace App\Http\Controllers;

use App\Models\Mascota;
use App\Models\Dueno;
use Illuminate\Http\Request;

class MascotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Mascota::query()->with('dueno');

        if ($request->filled('buscar')) {
            $buscar = $request->buscar;
            $query->where(function($q) use ($buscar) {
                $q->where('nombre', 'like', "%{$buscar}%")
                  ->orWhere('especie', 'like', "%{$buscar}%")
                  ->orWhere('raza', 'like', "%{$buscar}%")
                  ->orWhere('comportamiento', 'like', "%{$buscar}%")
                  ->orWhereHas('dueno', function($dq) use ($buscar) {
                      $dq->where('nombre_completo', 'like', "%{$buscar}%");
                  });
            });
        }

        $items = $query->paginate(10);

        return view('modules.mascotas.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $duenos = Dueno::orderBy('nombre_completo')->get();
        return view('modules.mascotas.create', compact('duenos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'dueno_id' => 'required|exists:duenos,id',
            'nombre' => 'required|string|max:255',
            'especie' => 'required|string|max:255',
            'raza' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'tipo_sangre' => 'required|string|max:50',
            'comportamiento' => 'required|string|max:255',
            'es_adoptado' => 'sometimes|boolean',
        ]);

        Mascota::create([
            'dueno_id' => $request->dueno_id,
            'nombre' => $request->nombre,
            'especie' => $request->especie,
            'raza' => $request->raza,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'tipo_sangre' => $request->tipo_sangre,
            'comportamiento' => $request->comportamiento,
            'es_adoptado' => $request->has('es_adoptado') ? (bool)$request->es_adoptado : false,
        ]);

        return redirect()->route('mascotas.index')
            ->with('success', 'Mascota registrada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $item = Mascota::with(['dueno', 'consultas', 'antecedentesAlergias', 'antecedentesLesiones', 'antecedentesPatologicos', 'historialAlimentacion'])
            ->findOrFail($id);
            
        return view('modules.mascotas.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $item = Mascota::findOrFail($id);
        $duenos = Dueno::orderBy('nombre_completo')->get();
        return view('modules.mascotas.edit', compact('item', 'duenos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'dueno_id' => 'required|exists:duenos,id',
            'nombre' => 'required|string|max:255',
            'especie' => 'required|string|max:255',
            'raza' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'tipo_sangre' => 'required|string|max:50',
            'comportamiento' => 'required|string|max:255',
            'es_adoptado' => 'sometimes|boolean',
        ]);

        $mascota = Mascota::findOrFail($id);
        
        $mascota->update([
            'dueno_id' => $request->dueno_id,
            'nombre' => $request->nombre,
            'especie' => $request->especie,
            'raza' => $request->raza,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'tipo_sangre' => $request->tipo_sangre,
            'comportamiento' => $request->comportamiento,
            'es_adoptado' => $request->has('es_adoptado') ? (bool)$request->es_adoptado : false,
        ]);

        return redirect()->route('mascotas.index')
            ->with('success', 'Mascota actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $mascota = Mascota::findOrFail($id);
        $mascota->delete();

        return redirect()->route('mascotas.index')
            ->with('success', 'Mascota eliminada correctamente.');
    }
}
