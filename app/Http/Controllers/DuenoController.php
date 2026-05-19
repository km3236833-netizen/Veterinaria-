<?php

namespace App\Http\Controllers;

use App\Models\Dueno;
use Illuminate\Http\Request;

class DuenoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Dueno::query();

        if ($request->filled('buscar')) {
            $buscar = $request->buscar;
            $query->where(function($q) use ($buscar) {
                $q->where('nombre_completo', 'like', "%{$buscar}%")
                  ->orWhere('telefono', 'like', "%{$buscar}%")
                  ->orWhere('direccion', 'like', "%{$buscar}%");
            });
        }

        $items = $query->withCount('mascotas')->paginate(10);

        return view('modules.duenos.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('modules.duenos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre_completo' => 'required|string|max:255',
            'telefono' => 'required|string|max:50',
            'direccion' => 'required|string',
        ]);

        Dueno::create([
            'nombre_completo' => $request->nombre_completo,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
        ]);

        return redirect()->route('duenos.index')
            ->with('success', 'Dueño registrado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $item = Dueno::with('mascotas')->findOrFail($id);
        return view('modules.duenos.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $item = Dueno::findOrFail($id);
        return view('modules.duenos.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre_completo' => 'required|string|max:255',
            'telefono' => 'required|string|max:50',
            'direccion' => 'required|string',
        ]);

        $dueno = Dueno::findOrFail($id);
        $dueno->update([
            'nombre_completo' => $request->nombre_completo,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
        ]);

        return redirect()->route('duenos.index')
            ->with('success', 'Dueño actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $dueno = Dueno::findOrFail($id);
        
        // Safety check: if owner has pets, we could warn, but since cascade is defined, we delete directly
        // or check if the user wants custom validation. Let's delete directly.
        $dueno->delete();

        return redirect()->route('duenos.index')
            ->with('success', 'Dueño eliminado correctamente.');
    }
}
