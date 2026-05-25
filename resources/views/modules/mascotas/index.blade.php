@extends('layouts.app')

@section('titulo_pagina', 'Mascotas')

@section('contenido')
    <div class="container-fluid mt-4">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 font-weight-bold">
                <i class="fas fa-paw text-primary mr-2"></i>Mascotas
            </h1>
            <div class="d-flex">
                <a href="{{ route('mascotas.create') }}" class="btn btn-primary btn-icon-split shadow mr-2">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Nueva Mascota</span>
                </a>
                <a href="{{ route('expedientes') }}" class="btn btn-secondary shadow">
                    <i class="fas fa-folder-open mr-1"></i> Expedientes
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- Pets Table -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Listado de Mascotas</h6>
                <form action="{{ route('mascotas.index') }}" method="GET" class="input-group col-md-4 px-0">
                    <input type="text" name="buscar" value="{{ request('buscar') }}" class="form-control form-control-sm bg-light border-0 small" placeholder="Buscar mascota, raza, especie o dueño..." aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-primary btn-sm" type="submit">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </form>
            </div>
            <div class="card-body px-0 py-2">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0 align-middle">
                        <thead class="bg-light">
                            <tr>
                                <th class="pl-4">Código</th>
                                <th>Paciente</th>
                                <th>Especie</th>
                                <th>Raza</th>
                                <th>Dueño</th>
                                <th>Comportamiento</th>
                                <th class="text-center pr-4">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($items as $mascota)
                                <tr>
                                    <td class="pl-4 font-weight-bold text-primary">#EXP-{{ str_pad($mascota->id, 3, '0', STR_PAD_LEFT) }}</td>
                                    <td class="font-weight-bold text-dark">{{ $mascota->nombre }}</td>
                                    <td>{{ $mascota->especie }}</td>
                                    <td>{{ $mascota->raza }}</td>
                                    <td class="font-weight-bold">{{ $mascota->dueno->nombre_completo ?? 'Sin Dueño' }}</td>
                                    <td>
                                        @if(str_contains(strtolower($mascota->comportamiento), 'urgente') || strtolower($mascota->comportamiento) === 'agresivo')
                                            <span class="badge badge-danger px-2 py-1">{{ $mascota->comportamiento }}</span>
                                        @elseif(str_contains(strtolower($mascota->comportamiento), 'tratamiento') || strtolower($mascota->comportamiento) === 'nervioso')
                                            <span class="badge badge-warning px-2 py-1">{{ $mascota->comportamiento }}</span>
                                        @else
                                            <span class="badge badge-success px-2 py-1">{{ $mascota->comportamiento }}</span>
                                        @endif
                                    </td>
                                    <td class="text-center pr-4">
                                        <a href="{{ route('mascotas.show', $mascota->id) }}" class="btn btn-sm btn-info btn-circle"><i class="fas fa-eye"></i></a>
                                        <a href="{{ route('mascotas.edit', $mascota->id) }}" class="btn btn-sm btn-warning btn-circle"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('mascotas.destroy', $mascota->id) }}" method="POST" class="d-inline" 
                                              onsubmit="return confirm('⚠️ ¡ATENCIÓN! Estás a punto de eliminar permanentemente a la mascota:\n\n• Nombre: {{ addslashes($mascota->nombre) }}\n• Especie: {{ addslashes($mascota->especie) }}\n• Dueño: {{ addslashes($mascota->dueno->nombre_completo ?? 'Sin Dueño') }}\n\n¿Estás completamente seguro de continuar con la eliminación?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger btn-circle"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-muted">
                                        <i class="fas fa-info-circle mr-1"></i> No se encontraron mascotas.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                @if($items->hasPages())
                    <div class="card-footer bg-white d-flex justify-content-end">
                        {{ $items->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
