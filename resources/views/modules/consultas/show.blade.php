@extends('layouts.app')

@section('titulo_pagina', 'Detalle de Consulta - ' . $mascota->nombre)

@section('contenido')
<div class="container-fluid mt-4">

    {{-- Encabezado --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 font-weight-bold">
            <i class="fas fa-stethoscope text-primary mr-2"></i>Detalle de Consulta
        </h1>
        <a href="{{ route('mascotas.show', $mascota->id) }}" class="btn btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm mr-1"></i> Volver al Expediente
        </a>
    </div>

    <div class="row">

        {{-- ===================== SIDEBAR IZQUIERDO ===================== --}}
        <div class="col-xl-3 col-lg-4">

            {{-- Sección: Consulta --}}
            <div class="card shadow mb-3">
                <div class="card-header py-2 bg-primary text-white">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-stethoscope mr-1"></i> Consulta
                    </h6>
                </div>
                <div class="list-group list-group-flush">
                    <a href="#sec-diagnostico"
                       class="list-group-item list-group-item-action d-flex align-items-center py-2">
                        <i class="fas fa-file-medical-alt text-primary mr-2"></i>
                        <span>Diagnóstico</span>
                    </a>
                    <a href="#sec-tratamiento"
                       class="list-group-item list-group-item-action d-flex align-items-center py-2">
                        <i class="fas fa-pills text-success mr-2"></i>
                        <span>Tratamiento</span>
                    </a>
                </div>
            </div>

            {{-- Sección: Antecedentes --}}
            <div class="card shadow mb-3">
                <div class="card-header py-2 bg-secondary text-white">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-clipboard-list mr-1"></i> Antecedentes
                    </h6>
                </div>
                <div class="list-group list-group-flush">
                    <a href="#sec-alergias"
                       class="list-group-item list-group-item-action d-flex align-items-center py-2">
                        <i class="fas fa-allergies text-danger mr-2"></i>
                        <span>Alergias</span>
                        <span class="badge badge-danger ml-auto">{{ $mascota->antecedentesAlergias->count() }}</span>
                    </a>
                    <a href="#sec-lesiones"
                       class="list-group-item list-group-item-action d-flex align-items-center py-2">
                        <i class="fas fa-crutch text-warning mr-2"></i>
                        <span>Lesiones / Cirugías</span>
                        <span class="badge badge-warning ml-auto">{{ $mascota->antecedentesLesiones->count() }}</span>
                    </a>
                    <a href="#sec-patologias"
                       class="list-group-item list-group-item-action d-flex align-items-center py-2">
                        <i class="fas fa-virus-slash text-info mr-2"></i>
                        <span>Patológicos</span>
                        <span class="badge badge-info ml-auto">{{ $mascota->antecedentesPatologicos->count() }}</span>
                    </a>
                    <a href="#sec-dieta"
                       class="list-group-item list-group-item-action d-flex align-items-center py-2">
                        <i class="fas fa-utensils text-success mr-2"></i>
                        <span>Historial Alimentación</span>
                        <span class="badge badge-success ml-auto">{{ $mascota->historialAlimentacion->count() }}</span>
                    </a>
                </div>
            </div>

        </div>
        {{-- ===================== FIN SIDEBAR ===================== --}}

        {{-- ===================== CONTENIDO PRINCIPAL ===================== --}}
        <div class="col-xl-9 col-lg-8">

            {{-- Tarjeta de Detalle de Consulta --}}
            <div class="card shadow mb-4 border-left-primary">
                <div class="card-header py-3 d-flex align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-stethoscope mr-1"></i> Detalles de la Consulta
                    </h6>
                    <span class="badge badge-primary px-3 py-2">
                        {{ \Carbon\Carbon::parse($consulta->fecha_consulta)->format('d/m/Y') }}
                    </span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <div class="card bg-light border-0 text-center py-3">
                                <i class="fas fa-weight fa-2x text-primary mb-2"></i>
                                <small class="text-muted d-block">Peso</small>
                                <span class="font-weight-bold text-dark">{{ $consulta->peso ?? '—' }} kg</span>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card bg-light border-0 text-center py-3">
                                <i class="fas fa-ruler-vertical fa-2x text-info mb-2"></i>
                                <small class="text-muted d-block">Talla</small>
                                <span class="font-weight-bold text-dark">{{ $consulta->talla ?? '—' }} cm</span>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card bg-light border-0 text-center py-3">
                                <i class="fas fa-calendar-check fa-2x text-success mb-2"></i>
                                <small class="text-muted d-block">Fecha</small>
                                <span class="font-weight-bold text-dark">{{ \Carbon\Carbon::parse($consulta->fecha_consulta)->format('d/m/Y') }}</span>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card bg-light border-0 text-center py-3">
                                <i class="fas fa-user-md fa-2x text-warning mb-2"></i>
                                <small class="text-muted d-block">Veterinario</small>
                                <span class="font-weight-bold text-dark">{{ $consulta->veterinario->name ?? 'N/A' }}</span>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row mt-2">
                        <div id="sec-diagnostico" class="col-md-12 mb-3">
                            <label class="font-weight-bold text-muted text-uppercase small"><i class="fas fa-file-medical-alt text-primary mr-1"></i> Diagnóstico</label>
                            @if(!empty($consulta->diagnostico) && trim($consulta->diagnostico) !== 'Sin diagnóstico registrado.')
                                <div class="border rounded p-3 bg-light text-dark shadow-sm" style="min-height:90px; border-left: 4px solid #4e73df !important;">
                                    {!! $consulta->diagnostico !!}
                                </div>
                            @else
                                <div class="border rounded p-3 bg-light text-center shadow-sm" style="min-height:90px; border-left: 4px solid #e74a3b !important;">
                                    <span class="text-danger font-weight-bold d-block mb-2">
                                        <i class="fas fa-exclamation-circle mr-1"></i> No se ha registrado un diagnóstico.
                                    </span>
                                    <p class="text-xs text-muted mb-2">
                                        <strong>Ruta Laravel:</strong> <code>consultas.edit</code><br>
                                        <strong>URL:</strong> <code>/consultas/{{ $consulta->id }}/edit</code>
                                    </p>
                                    <a href="{{ route('consultas.edit', $consulta->id) }}" class="btn btn-sm btn-danger font-weight-bold shadow-sm">
                                        <i class="fas fa-plus mr-1"></i> Registrar Diagnóstico
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- ---- ANTECEDENTES ---- --}}

            {{-- Alergias --}}
            <div id="sec-alergias" class="card shadow mb-4">
                <div class="card-header py-3 bg-danger text-white d-flex align-items-center">
                    <i class="fas fa-allergies mr-2"></i>
                    <h6 class="m-0 font-weight-bold">Antecedentes de Alergias</h6>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="pl-3">Sustancia Alergénica</th>
                                    <th>Reacción Reportada</th>
                                    <th>Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($mascota->antecedentesAlergias as $alergia)
                                    <tr>
                                        <td class="pl-3 font-weight-bold text-danger">{{ $alergia->sustancia_alergena }}</td>
                                        <td>{{ $alergia->reaccion }}</td>
                                        <td>{{ $alergia->created_at->format('d/m/Y') }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="3" class="text-center text-muted py-3">Sin alergias registradas.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Lesiones --}}
            <div id="sec-lesiones" class="card shadow mb-4">
                <div class="card-header py-3 bg-warning text-dark d-flex align-items-center">
                    <i class="fas fa-crutch mr-2"></i>
                    <h6 class="m-0 font-weight-bold">Lesiones y Cirugías</h6>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="pl-3">Lesión / Cirugía</th>
                                    <th>Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($mascota->antecedentesLesiones as $lesion)
                                    <tr>
                                        <td class="pl-3 font-weight-bold">{{ $lesion->tipo_lesion }}</td>
                                        <td>{{ $lesion->created_at->format('d/m/Y') }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="2" class="text-center text-muted py-3">Sin lesiones o cirugías registradas.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Patologías --}}
            <div id="sec-patologias" class="card shadow mb-4">
                <div class="card-header py-3 bg-info text-white d-flex align-items-center">
                    <i class="fas fa-virus-slash mr-2"></i>
                    <h6 class="m-0 font-weight-bold">Enfermedades Crónicas / Patologías</h6>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="pl-3">Enfermedad / Patología</th>
                                    <th class="text-center">Crónica</th>
                                    <th>Fecha de Diagnóstico</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($mascota->antecedentesPatologicos as $patologia)
                                    <tr>
                                        <td class="pl-3 font-weight-bold">{{ $patologia->enfermedad }}</td>
                                        <td class="text-center">
                                            @if($patologia->es_cronica)
                                                <span class="badge badge-danger px-2 py-1">Sí</span>
                                            @else
                                                <span class="badge badge-success px-2 py-1">No</span>
                                            @endif
                                        </td>
                                        <td>{{ $patologia->created_at->format('d/m/Y') }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="3" class="text-center text-muted py-3">Sin patologías registradas.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Dieta --}}
            <div id="sec-dieta" class="card shadow mb-4">
                <div class="card-header py-3 bg-success text-white d-flex align-items-center">
                    <i class="fas fa-utensils mr-2"></i>
                    <h6 class="m-0 font-weight-bold">Historial Alimenticio</h6>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="pl-3">Descripción de Dieta</th>
                                    <th>Frecuencia</th>
                                    <th>Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($mascota->historialAlimentacion as $dieta)
                                    <tr>
                                        <td class="pl-3 font-weight-bold">{{ $dieta->descripcion_dieta }}</td>
                                        <td><span class="badge badge-light border">{{ $dieta->frecuencia_diaria }}x al día</span></td>
                                        <td>{{ $dieta->created_at->format('d/m/Y') }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="3" class="text-center text-muted py-3">Sin dietas registradas.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Todas las Consultas del paciente --}}
            <div id="sec-consultas" class="card shadow mb-4">
                <div class="card-header py-3 bg-primary text-white d-flex align-items-center">
                    <i class="fas fa-stethoscope mr-2"></i>
                    <h6 class="m-0 font-weight-bold">Historial de Consultas del Paciente</h6>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="pl-3">Fecha</th>
                                    <th>Diagnóstico</th>
                                    <th>Tratamiento</th>
                                    <th class="text-center">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($mascota->consultas as $c)
                                    <tr @if($c->id == $consulta->id) class="table-primary" @endif>
                                        <td class="pl-3">{{ \Carbon\Carbon::parse($c->fecha_consulta)->format('d/m/Y') }}</td>
                                        <td>{{ $c->diagnostico }}</td>
                                        <td><span class="text-success font-weight-bold">{{ $c->tratamiento }}</span></td>
                                        <td class="text-center">
                                            @if($c->id == $consulta->id)
                                                <span class="badge badge-primary px-2 py-1">Actual</span>
                                            @else
                                                <a href="{{ route('consultas.detalle', ['consulta' => $c->id, 'mascota' => $mascota->id]) }}"
                                                   class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-eye mr-1"></i> Ver
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="4" class="text-center text-muted py-3">No hay consultas registradas.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        {{-- ===================== FIN CONTENIDO PRINCIPAL ===================== --}}

    </div>
</div>
@endsection
