@extends('layouts.app')

@section('titulo_pagina', 'Gestión de Tratamientos')

@section('contenido')
    <div class="container-fluid mt-4">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 font-weight-bold">
                <i class="fas fa-capsules text-primary mr-2"></i>Gestión de Tratamientos
            </h1>
            <div class="d-flex">
                <a href="{{ route('tratamientos.create') }}" class="btn btn-primary btn-icon-split shadow">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text font-weight-bold">Nuevo Tratamiento</span>
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm border-left-success" role="alert">
                <i class="fas fa-check-circle mr-2"></i><strong>¡Éxito!</strong> {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- List Card -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 bg-white d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-clipboard-list mr-1"></i> Listado de Tratamientos Médicos</h6>
                <form action="{{ route('tratamientos.index') }}" method="GET" class="col-md-5 px-0">
                    <div class="input-group">
                        <input type="text" name="buscar" value="{{ request('buscar') }}" class="form-control form-control-sm bg-light border-0 small px-3" style="border-radius: 10px 0 0 10px;" placeholder="Buscar por paciente, medicamento o frecuencia..." aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-primary btn-sm" type="submit" style="border-radius: 0 10px 10px 0;">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-body px-0 py-2">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0 align-middle">
                        <thead class="bg-light">
                            <tr>
                                <th class="pl-4">Paciente</th>
                                <th>Medicamento</th>
                                <th>Dosis / Frecuencia</th>
                                <th>Vigencia</th>
                                <th class="text-center pr-4">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($items as $item)
                                <tr>
                                    <td class="pl-4">
                                        <span class="font-weight-bold text-dark">{{ $item->mascota->nombre ?? 'N/A' }}</span>
                                        <small class="d-block text-muted">Propietario: {{ $item->mascota->dueno->nombre_completo ?? '—' }}</small>
                                    </td>
                                    <td>
                                        <span class="badge badge-primary px-2.5 py-1.5 font-weight-bold" style="font-size: 0.85rem;"><i class="fas fa-prescription-bottle-alt mr-1"></i> {{ $item->medicamento }}</span>
                                    </td>
                                    <td>
                                        <span class="font-weight-bold text-secondary">{{ $item->dosis }}</span>
                                        <small class="d-block text-muted"><i class="far fa-clock mr-1"></i> {{ $item->frecuencia }}</small>
                                    </td>
                                    <td class="text-nowrap">
                                        <small class="d-block font-weight-bold text-primary"><i class="far fa-calendar-alt text-muted mr-1"></i> Inicio: {{ \Carbon\Carbon::parse($item->fecha_inicio)->format('d/m/Y') }}</small>
                                        <small class="d-block font-weight-bold text-danger"><i class="far fa-calendar-check text-muted mr-1"></i> Fin: {{ \Carbon\Carbon::parse($item->fecha_fin)->format('d/m/Y') }}</small>
                                    </td>
                                    <td class="text-center pr-4 text-nowrap">
                                        <a href="{{ route('tratamientos.show', $item->id) }}" class="btn btn-sm btn-info shadow-sm px-2.5" title="Ver Detalle Completo">
                                            <i class="fas fa-eye"></i> Ver
                                        </a>
                                        <a href="{{ route('tratamientos.edit', $item->id) }}" class="btn btn-sm btn-warning text-dark font-weight-bold shadow-sm px-2.5 ml-1" title="Editar Tratamiento">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('tratamientos.destroy', $item->id) }}" method="POST" class="d-inline ml-1" 
                                              onsubmit="return confirm('⚠️ ¡ATENCIÓN! Estás a punto de eliminar permanentemente el tratamiento médico:\n\n• Paciente: {{ addslashes($item->mascota->nombre ?? 'N/A') }}\n• Medicamento: {{ addslashes($item->medicamento) }}\n• Frecuencia: {{ addslashes($item->frecuencia) }}\n\n¿Estás completamente seguro de continuar con la eliminación?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger shadow-sm px-2.5" title="Eliminar Tratamiento">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">
                                        <div class="mb-3">
                                            <i class="fas fa-capsules fa-3x text-gray-300"></i>
                                        </div>
                                        <h5 class="font-weight-bold text-dark">No se encontraron tratamientos registrados</h5>
                                        <p class="mb-2 text-xs">Crea un tratamiento independiente para comenzar a recetar.</p>
                                        <a href="{{ route('tratamientos.create') }}" class="btn btn-primary btn-sm shadow mt-2">
                                            <i class="fas fa-plus mr-1"></i> Registrar Primer Tratamiento
                                        </a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($items->hasPages())
                    <div class="card-footer bg-white border-top-0 d-flex justify-content-center">
                        {{ $items->withQueryString()->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
