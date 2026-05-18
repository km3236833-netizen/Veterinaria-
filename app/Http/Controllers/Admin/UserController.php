<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    public function index()
    {
        $items = User::paginate(2);
        return view('modules/admin/usuarios/index', compact('items'));
    }

    public function create()
    {
        return view('modules/admin/usuarios/create');
    }

    public function store(StoreUserRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->rol = $request->rol;
        $user->save();

        return to_route('admin.usuarios.index')->with('success', 'Usuario registrado correctamente.');
    }

    public function edit($id)
    {
        $item = User::findOrFail($id);
        return view('modules/admin/usuarios/edit', compact('item'));
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        
        $user->rol = $request->rol;
        $user->activo = $request->activo;
        $user->save();

        return to_route('admin.usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }

    public function show($id)
    {
        $item = User::findOrFail($id);
        
        $hasDependencies = false;
        if ($item->veterinario && $item->veterinario->consultas()->exists()) {
            $hasDependencies = true;
        }

        return view('modules/admin/usuarios/show', compact('item', 'hasDependencies'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        if ($user->veterinario && $user->veterinario->consultas()->exists()) {
            return redirect()->route('admin.usuarios.index')->with('error', 'No se puede eliminar el usuario porque tiene consultas médicas asociadas.');
        }

        $user->delete();

        return to_route('admin.usuarios.index')->with('success', 'Usuario eliminado correctamente.');
    }
}
