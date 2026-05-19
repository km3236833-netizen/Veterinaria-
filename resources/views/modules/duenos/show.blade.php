@extends('layouts.app')

@section('titulo_pagina', 'Detalles de ' . $item->nombre_completo)

@section('contenido')
    <div class="container-fluid mt-4">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 font-weight-bold">
                <i class="fas fa-user text-primary mr-2"></i>Expediente de Propietario
            </h1>
            <div>
                <a href="{{ route('duenos.edit', $item->id) }}" class="btn btn-warning shadow-sm mr-2 text-dark font-weight-bold">
                    <i class="fas fa-edit mr-1"></i> Editar Propietario
                </a>
                <a href="{{ route('expedientes') }}" class="btn btn-secondary shadow-sm">
                    <i class="fas fa-arrow-left fa-sm mr-1"></i> Volver a Expedientes
                </a>
            </div>
        </div>

        <div class="row">
            <!-- Owner Profile Info -->
            <div class="col-lg-4">
                <div class="card shadow mb-4 border-left-primary">
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <div class="bg-primary text-white rounded-circle p-3 d-inline-flex align-items-center justify-content-center shadow-sm" style="width: 80px; height: 80px;">
                                <i class="fas fa-user fa-3x"></i>
                            </div>
                            <h4 class="font-weight-bold text-dark mt-3 mb-1">{{ $item->nombre_completo }}</h4>
                            <p class="text-muted"><i class="fas fa-phone mr-1"></i> {{ $item->telefono }}</p>
                        </div>
                        
                        <hr>
                        
                        <span class="text-xs text-muted uppercase font-weight-bold d-block mb-1">Dirección</span>
                        <p class="text-dark bg-light p-3 rounded border">{{ $item->direccion }}</p>
                        
                        <span class="text-xs text-muted uppercase font-weight-bold d-block mt-3 mb-1">Mascotas Registradas</span>
                        <div class="h5 mb-0 font-weight-bold text-primary"><i class="fas fa-paw mr-1"></i> {{ $item->mascotas->count() }} mascotas</div>
                    </div>
                </div>
            </div>

            <!-- List of Associated Pets -->
            <div class="col-lg-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-paw mr-1"></i> Mascotas del Propietario</h6>
                        <a href="{{ route('mascotas.create', ['dueno_id' => $item->id]) }}" class="btn btn-primary btn-sm"><i class="fas fa-plus mr-1"></i> Añadir Mascota</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead class="bg-light">
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Especie</th>
                                        <th>Raza</th>
                                        <th>Edad</th>
                                        <th>Estado/Comportamiento</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($item->mascotas as $mascota)
                                        <tr>
                                            <td class="font-weight-bold text-dark">{{ $mascota->nombre }}</td>
                                            <td>{{ $mascota->especie }}</td>
                                            <td>{{ $mascota->raza }}</td>
                                            <td>{{ \Carbon\Carbon::parse($mascota->fecha_nacimiento)->age }} años</td>
                                            <td>
                                                @if(str_contains(strtolower($mascota->comportamiento), 'urgente') || strtolower($mascota->comportamiento) === 'agresivo')
                                                    <span class="badge badge-danger px-2 py-1">{{ $mascota->comportamiento }}</span>
                                                @elseif(str_contains(strtolower($mascota->comportamiento), 'tratamiento') || strtolower($mascota->comportamiento) === 'nervioso')
                                                    <span class="badge badge-warning px-2 py-1">{{ $mascota->comportamiento }}</span>
                                                @else
                                                    <span class="badge badge-success px-2 py-1">{{ $mascota->comportamiento }}</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('mascotas.show', $mascota->id) }}" class="btn btn-sm btn-info btn-circle"><i class="fas fa-eye"></i></a>
                                                <a href="{{ route('mascotas.edit', $mascota->id) }}" class="btn btn-sm btn-warning btn-circle"><i class="fas fa-edit"></i></a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-4 text-muted">
                                                <i class="fas fa-info-circle mr-1"></i> Este dueño no tiene mascotas registradas.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
