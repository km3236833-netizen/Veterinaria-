@extends('layouts.app')

@section('titulo_pagina', 'Expediente de ' . $item->nombre)

@section('contenido')
    <div class="container-fluid mt-4">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 font-weight-bold">
                <i class="fas fa-file-medical text-primary mr-2"></i>Expediente de Mascota
            </h1>
            <div>
                <a href="{{ route('mascotas.edit', $item->id) }}" class="btn btn-warning shadow-sm mr-2 text-dark font-weight-bold">
                    <i class="fas fa-edit mr-1"></i> Editar Mascota
                </a>
                <a href="{{ route('expedientes') }}" class="btn btn-secondary shadow-sm">
                    <i class="fas fa-arrow-left fa-sm mr-1"></i> Volver a Expedientes
                </a>
            </div>
        </div>

        <div class="row">
            <!-- Left Side: Patient & Owner Profile Card -->
            <div class="col-xl-4 col-lg-5">
                <!-- Pet Card -->
                <div class="card shadow mb-4 border-bottom-primary">
                    <div class="card-body text-center">
                        <div class="my-3">
                            <div class="bg-primary text-white rounded-circle p-3 d-inline-flex align-items-center justify-content-center shadow-sm" style="width: 100px; height: 100px;">
                                @if(strtolower($item->especie) == 'canino')
                                    <i class="fas fa-dog fa-4x"></i>
                                @elseif(strtolower($item->especie) == 'felino')
                                    <i class="fas fa-cat fa-4x"></i>
                                @elseif(strtolower($item->especie) == 'ave')
                                    <i class="fas fa-feather fa-4x"></i>
                                @else
                                    <i class="fas fa-paw fa-4x"></i>
                                @endif
                            </div>
                        </div>
                        <h4 class="font-weight-bold text-dark mb-0">{{ $item->nombre }}</h4>
                        <p class="text-muted mb-2">{{ $item->especie }} • {{ $item->raza }}</p>
                        
                        <div class="mb-3">
                            @if(str_contains(strtolower($item->comportamiento), 'urgente') || strtolower($item->comportamiento) === 'agresivo')
                                <span class="badge badge-danger px-3 py-2 font-weight-bold">{{ $item->comportamiento }}</span>
                            @elseif(str_contains(strtolower($item->comportamiento), 'tratamiento') || strtolower($item->comportamiento) === 'nervioso')
                                <span class="badge badge-warning px-3 py-2 font-weight-bold text-dark">{{ $item->comportamiento }}</span>
                            @else
                                <span class="badge badge-success px-3 py-2 font-weight-bold">Estable ({{ $item->comportamiento }})</span>
                            @endif
                        </div>

                        <hr>

                        <div class="text-left">
                            <div class="row mb-2">
                                <div class="col-5 font-weight-bold text-muted">Edad:</div>
                                <div class="col-7 text-dark">{{ \Carbon\Carbon::parse($item->fecha_nacimiento)->age }} años</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-5 font-weight-bold text-muted">Nacimiento:</div>
                                <div class="col-7 text-dark">{{ \Carbon\Carbon::parse($item->fecha_nacimiento)->format('d/m/Y') }}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-5 font-weight-bold text-muted">Sangre:</div>
                                <div class="col-7 text-dark"><span class="badge badge-light border">{{ $item->tipo_sangre }}</span></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-5 font-weight-bold text-muted">Adoptado:</div>
                                <div class="col-7 text-dark">
                                    {!! $item->es_adoptado ? '<span class="text-success"><i class="fas fa-check-circle mr-1"></i>Sí</span>' : '<span class="text-muted"><i class="fas fa-times-circle mr-1"></i>No</span>' !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Owner Card -->
                <div class="card shadow mb-4 border-left-info">
                    <div class="card-header py-3 bg-info text-white">
                        <h6 class="m-0 font-weight-bold"><i class="fas fa-user mr-1"></i> Datos del Propietario</h6>
                    </div>
                    <div class="card-body">
                        @if($item->dueno)
                            <h5 class="font-weight-bold text-dark mb-1">{{ $item->dueno->nombre_completo }}</h5>
                            <p class="text-muted mb-3"><i class="fas fa-phone mr-1"></i> {{ $item->dueno->telefono }}</p>
                            
                            <hr class="my-2">
                            
                            <span class="text-xs text-muted uppercase font-weight-bold d-block">Dirección</span>
                            <p class="text-dark mb-0">{{ $item->dueno->direccion }}</p>

                            <div class="mt-3 text-right">
                                <a href="{{ route('duenos.edit', $item->dueno->id) }}" class="btn btn-sm btn-outline-info">
                                    <i class="fas fa-edit mr-1"></i> Editar Propietario
                                </a>
                            </div>
                        @else
                            <div class="text-center py-3 text-muted">
                                <i class="fas fa-exclamation-circle fa-2x mb-2 text-warning"></i>
                                <p class="mb-0">Esta mascota no tiene dueño asignado.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Right Side: Medical History Tabs -->
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <div class="card-header p-0">
                        <ul class="nav nav-tabs nav-justified" id="medicalTabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active font-weight-bold text-primary py-3" id="consultas-tab" data-toggle="tab" href="#consultas" role="tab" aria-controls="consultas" aria-selected="true">
                                    <i class="fas fa-stethoscope mr-1"></i> Consultas
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link font-weight-bold text-danger py-3" id="alergias-tab" data-toggle="tab" href="#alergias" role="tab" aria-controls="alergias" aria-selected="false">
                                    <i class="fas fa-allergies mr-1"></i> Alergias
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link font-weight-bold text-warning py-3" id="lesiones-tab" data-toggle="tab" href="#lesiones" role="tab" aria-controls="lesiones" aria-selected="false">
                                    <i class="fas fa-crutch mr-1"></i> Lesiones
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link font-weight-bold text-info py-3" id="patologias-tab" data-toggle="tab" href="#patologias" role="tab" aria-controls="patologias" aria-selected="false">
                                    <i class="fas fa-virus-slash mr-1"></i> Patologías
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link font-weight-bold text-success py-3" id="alimentacion-tab" data-toggle="tab" href="#alimentacion" role="tab" aria-controls="alimentacion" aria-selected="false">
                                    <i class="fas fa-utensils mr-1"></i> Dieta
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="medicalTabsContent">
                            <!-- Tab: Consultas -->
                            <div class="tab-pane fade show active" id="consultas" role="tabpanel" aria-labelledby="consultas-tab">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="font-weight-bold text-dark mb-0">Historial de Consultas Médicas</h5>
                                    <button class="btn btn-primary btn-sm shadow-sm"><i class="fas fa-plus mr-1"></i> Nueva Consulta</button>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>Fecha</th>
                                                <th>Motivo</th>
                                                <th>Diagnóstico</th>
                                                <th>Tratamiento</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($item->consultas as $consulta)
                                                <tr>
                                                    <td>{{ \Carbon\Carbon::parse($consulta->fecha)->format('d/m/Y') }}</td>
                                                    <td><strong>{{ $consulta->motivo }}</strong></td>
                                                    <td>{{ $consulta->diagnostico }}</td>
                                                    <td><span class="text-success font-weight-bold">{{ $consulta->tratamiento }}</span></td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="text-center text-muted py-4">
                                                        <i class="fas fa-notes-medical fa-2x mb-2 text-gray-300"></i>
                                                        <p class="mb-0">No hay consultas registradas para esta mascota.</p>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Tab: Alergias -->
                            <div class="tab-pane fade" id="alergias" role="tabpanel" aria-labelledby="alergias-tab">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="font-weight-bold text-danger mb-0">Antecedentes de Alergias</h5>
                                    <button class="btn btn-danger btn-sm shadow-sm"><i class="fas fa-plus mr-1"></i> Agregar Alergia</button>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>Sustancia Alergénica</th>
                                                <th>Reacción Reportada</th>
                                                <th>Fecha de Registro</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($item->antecedentesAlergias as $alergia)
                                                <tr>
                                                    <td class="font-weight-bold text-danger">{{ $alergia->sustancia_alergena }}</td>
                                                    <td>{{ $alergia->reaccion }}</td>
                                                    <td>{{ $alergia->created_at->format('d/m/Y') }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="3" class="text-center text-muted py-4">
                                                        <i class="fas fa-allergies fa-2x mb-2 text-gray-300"></i>
                                                        <p class="mb-0">No hay alergias registradas para esta mascota.</p>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Tab: Lesiones -->
                            <div class="tab-pane fade" id="lesiones" role="tabpanel" aria-labelledby="lesiones-tab">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="font-weight-bold text-warning mb-0">Historial de Lesiones y Cirugías</h5>
                                    <button class="btn btn-warning btn-sm shadow-sm text-dark font-weight-bold"><i class="fas fa-plus mr-1"></i> Registrar Lesión</button>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>Lesión / Cirugía</th>
                                                <th>Fecha de Registro</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($item->antecedentesLesiones as $lesion)
                                                <tr>
                                                    <td class="font-weight-bold text-dark">{{ $lesion->tipo_lesion }}</td>
                                                    <td>{{ $lesion->created_at->format('d/m/Y') }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="2" class="text-center text-muted py-4">
                                                        <i class="fas fa-user-md fa-2x mb-2 text-gray-300"></i>
                                                        <p class="mb-0">No hay lesiones o cirugías registradas.</p>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Tab: Patologías -->
                            <div class="tab-pane fade" id="patologias" role="tabpanel" aria-labelledby="patologias-tab">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="font-weight-bold text-info mb-0">Enfermedades Crónicas / Patologías</h5>
                                    <button class="btn btn-info btn-sm shadow-sm"><i class="fas fa-plus mr-1"></i> Agregar Patología</button>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>Enfermedad / Patología</th>
                                                <th class="text-center">Crónica</th>
                                                <th>Fecha de Diagnóstico</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($item->antecedentesPatologicos as $patologia)
                                                <tr>
                                                    <td class="font-weight-bold text-dark">{{ $patologia->enfermedad }}</td>
                                                    <td class="text-center">
                                                        @if($patologia->es_cronica)
                                                            <span class="badge badge-danger px-2 py-1 font-weight-bold">Sí</span>
                                                        @else
                                                            <span class="badge badge-success px-2 py-1 font-weight-bold">No</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $patologia->created_at->format('d/m/Y') }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="3" class="text-center text-muted py-4">
                                                        <i class="fas fa-heartbeat fa-2x mb-2 text-gray-300"></i>
                                                        <p class="mb-0">No hay patologías previas registradas.</p>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Tab: Alimentación -->
                            <div class="tab-pane fade" id="alimentacion" role="tabpanel" aria-labelledby="alimentacion-tab">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="font-weight-bold text-success mb-0">Historial Alimenticio y Nutrición</h5>
                                    <button class="btn btn-success btn-sm shadow-sm"><i class="fas fa-plus mr-1"></i> Registrar Dieta</button>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>Descripción de Dieta / Alimento</th>
                                                <th>Frecuencia Diaria</th>
                                                <th>Fecha de Registro</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($item->historialAlimentacion as $dieta)
                                                <tr>
                                                    <td class="font-weight-bold text-dark">{{ $dieta->descripcion_dieta }}</td>
                                                    <td><span class="badge badge-light border">{{ $dieta->frecuencia_diaria }} veces al día</span></td>
                                                    <td>{{ $dieta->created_at->format('d/m/Y') }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="3" class="text-center text-muted py-4">
                                                        <i class="fas fa-utensils fa-2x mb-2 text-gray-300"></i>
                                                        <p class="mb-0">No hay dietas o restricciones alimenticias registradas.</p>
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
        </div>
    </div>
@endsection
