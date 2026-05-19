@extends('layouts.app')

@section('titulo_pagina', 'Propietarios')

@section('contenido')
    <div class="container-fluid mt-4">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 font-weight-bold">
                <i class="fas fa-users text-primary mr-2"></i>Propietarios
            </h1>
            <div class="d-flex">
                <a href="{{ route('duenos.create') }}" class="btn btn-primary btn-icon-split shadow mr-2">
                    <span class="icon text-white-50">
                        <i class="fas fa-user-plus"></i>
                    </span>
                    <span class="text">Nuevo Dueño</span>
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

        <!-- Owners Table -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Listado de Dueños</h6>
                <form action="{{ route('duenos.index') }}" method="GET" class="input-group col-md-4 px-0">
                    <input type="text" name="buscar" value="{{ request('buscar') }}" class="form-control form-control-sm bg-light border-0 small" placeholder="Buscar dueño..." aria-label="Search">
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
                                <th>Nombre Completo</th>
                                <th>Teléfono</th>
                                <th>Dirección</th>
                                <th class="text-center">Mascotas</th>
                                <th class="text-center pr-4">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($items as $dueno)
                                <tr>
                                    <td class="pl-4 font-weight-bold text-primary">#OWN-{{ str_pad($dueno->id, 3, '0', STR_PAD_LEFT) }}</td>
                                    <td class="font-weight-bold text-dark">{{ $dueno->nombre_completo }}</td>
                                    <td>{{ $dueno->telefono }}</td>
                                    <td>{{ $dueno->direccion }}</td>
                                    <td class="text-center"><span class="badge badge-info px-2 py-1 font-weight-bold">{{ $dueno->mascotas_count }}</span></td>
                                    <td class="text-center pr-4">
                                        <a href="{{ route('duenos.show', $dueno->id) }}" class="btn btn-sm btn-info btn-circle"><i class="fas fa-eye"></i></a>
                                        <a href="{{ route('duenos.edit', $dueno->id) }}" class="btn btn-sm btn-warning btn-circle"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('duenos.destroy', $dueno->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Está seguro de eliminar a este propietario? Se eliminarán todas sus mascotas asociadas.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger btn-circle"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">
                                        <i class="fas fa-info-circle mr-1"></i> No se encontraron propietarios.
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
