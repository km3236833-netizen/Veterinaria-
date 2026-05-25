@extends('layouts.app')

@section('titulo_pagina', 'Gestión de Diagnósticos')

@section('contenido')
    <div class="container-fluid mt-4">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 font-weight-bold">
                <i class="fas fa-file-medical-alt text-primary mr-2"></i>Gestión de Diagnósticos
            </h1>
            <div class="d-flex">
                <a href="{{ route('consultas.create') }}" class="btn btn-primary btn-icon-split shadow">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text font-weight-bold">Nuevo Diagnóstico</span>
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

        <!-- Diagnósticos List Card -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 bg-white d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-clipboard-list mr-1"></i> Listado de Diagnósticos Médicos</h6>
                <form action="{{ route('consultas.index') }}" method="GET" class="col-md-5 px-0">
                    <div class="input-group">
                        <input type="text" name="buscar" value="{{ request('buscar') }}" class="form-control form-control-sm bg-light border-0 small px-3" style="border-radius: 10px 0 0 10px;" placeholder="Buscar por paciente, diagnóstico, tratamiento o veterinario..." aria-label="Search">
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
                                <th class="pl-4">Fecha</th>
                                <th>Paciente</th>
                                <th>Veterinario</th>
                                <th>Diagnóstico</th>
                                <th class="text-center pr-4">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($items as $item)
                                <tr>
                                    <td class="pl-4 font-weight-bold text-primary text-nowrap">
                                        <i class="far fa-calendar-alt text-muted mr-1"></i>
                                        {{ \Carbon\Carbon::parse($item->fecha_consulta)->format('d/m/Y H:i') }}
                                    </td>
                                    <td>
                                        <span class="font-weight-bold text-dark">{{ $item->mascota->nombre ?? 'N/A' }}</span>
                                        <small class="d-block text-muted">{{ $item->mascota->especie ?? '' }} • {{ $item->mascota->raza ?? '' }}</small>
                                    </td>
                                    <td>
                                        <span class="font-weight-bold text-secondary">{{ $item->veterinario->nombre_completo ?? 'N/A' }}</span>
                                        <small class="d-block text-muted">Cédula: {{ $item->veterinario->cedula_profesional ?? '—' }}</small>
                                    </td>
                                    <td>
                                        <span class="text-dark d-inline-block text-truncate" style="max-width: 250px;" title="{{ strip_tags($item->diagnostico) }}">
                                            {!! strip_tags($item->diagnostico) !!}
                                        </span>
                                    </td>
                                    <td class="text-center pr-4 text-nowrap">
                                        <a href="{{ route('consultas.detalle', ['consulta' => $item->id, 'mascota' => $item->mascota_id]) }}" class="btn btn-sm btn-info shadow-sm px-2" title="Ver Detalle Completo">
                                            <i class="fas fa-eye"></i> Ver
                                        </a>
                                        <a href="{{ route('consultas.edit', $item->id) }}" class="btn btn-sm btn-warning text-dark font-weight-bold shadow-sm px-2 ml-1" title="Editar Diagnóstico">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('consultas.destroy', $item->id) }}" method="POST" class="d-inline ml-1" 
                                              onsubmit="return confirm('⚠️ ¡ATENCIÓN! Estás a punto de eliminar permanentemente el diagnóstico médico:\n\n• Paciente: {{ addslashes($item->mascota->nombre ?? 'N/A') }}\n• Fecha: {{ \Carbon\Carbon::parse($item->fecha_consulta)->format('d/m/Y H:i') }}\n• Diagnóstico: {{ addslashes(Str::limit(strip_tags($item->diagnostico), 60)) }}\n\n¿Estás completamente seguro de continuar con la eliminación?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger shadow-sm px-2" title="Eliminar Diagnóstico">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">
                                        <div class="mb-3">
                                            <i class="fas fa-notes-medical fa-3x text-gray-300"></i>
                                        </div>
                                        <h5 class="font-weight-bold text-dark">No se encontraron diagnósticos médicos</h5>
                                        <p class="mb-2 text-xs">Registra una nueva consulta médica para comenzar a registrar diagnósticos.</p>
                                        <p class="text-xs text-muted mb-3">
                                            <strong>Ruta Laravel:</strong> <code>consultas.create</code><br>
                                            <strong>URL:</strong> <code>/consultas/create</code>
                                        </p>
                                        <a href="{{ route('consultas.create') }}" class="btn btn-primary btn-sm shadow">
                                            <i class="fas fa-plus mr-1"></i> Registrar Primer Diagnóstico
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
