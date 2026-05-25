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

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm border-left-success" role="alert">
                <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show shadow-sm border-left-danger" role="alert">
                <i class="fas fa-exclamation-triangle mr-2"></i><strong>¡Error!</strong> Por favor corrige los errores ingresados:
                <ul class="mb-0 mt-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

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
                                    <a href="{{ route('consultas.create', ['mascota' => $item->id]) }}" class="btn btn-primary btn-sm shadow-sm"><i class="fas fa-plus mr-1"></i> Nueva Consulta</a>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>Fecha</th>
                                                <th>Diagnóstico</th>
                                                <th class="text-center">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($item->consultas as $consulta)
                                                <tr>
                                                    <td>{{ \Carbon\Carbon::parse($consulta->fecha_consulta)->format('d/m/Y') }}</td>
                                                    <td>{!! strip_tags($consulta->diagnostico) !!}</td>
                                                    <td class="text-center">
                                                        <a href="{{ route('consultas.detalle', ['consulta' => $consulta->id, 'mascota' => $item->id]) }}"
                                                           class="btn btn-sm btn-primary shadow-sm"
                                                           title="Ver detalles de consulta">
                                                            <i class="fas fa-eye mr-1"></i> Ver
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="3" class="text-center text-muted py-4">
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
                                    <button class="btn btn-danger btn-sm shadow-sm" data-toggle="modal" data-target="#addAlergiaModal">
                                        <i class="fas fa-plus mr-1"></i> Agregar Alergia
                                    </button>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped align-middle mb-0">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>Sustancia Alergénica</th>
                                                <th>Reacción Reportada</th>
                                                <th>Fecha de Registro</th>
                                                <th class="text-center" style="width: 100px;">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($item->antecedentesAlergias as $alergia)
                                                <tr>
                                                    <td class="font-weight-bold text-danger">{{ $alergia->sustancia_alergena }}</td>
                                                    <td>{{ $alergia->reaccion }}</td>
                                                    <td>{{ $alergia->created_at->format('d/m/Y') }}</td>
                                                    <td class="text-center">
                                                        <form action="{{ route('alergias.destroy', $alergia->id) }}" method="POST" class="d-inline"
                                                              onsubmit="return confirm('⚠️ ¡ATENCIÓN! Estás a punto de eliminar permanentemente el registro de alergia:\n\n• Sustancia Alergénica: {{ $alergia->sustancia_alergena }}\n• Reacción Reportada: {{ $alergia->reaccion }}\n\n¿Estás completamente seguro de continuar con la eliminación?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger px-2 shadow-sm" title="Eliminar Alergia">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="text-center text-muted py-4">
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
                                    <button class="btn btn-warning btn-sm shadow-sm text-dark font-weight-bold" data-toggle="modal" data-target="#addLesionModal">
                                        <i class="fas fa-plus mr-1"></i> Registrar Lesión
                                    </button>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped align-middle mb-0">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>Lesión / Cirugía</th>
                                                <th>Fecha de Registro</th>
                                                <th class="text-center" style="width: 100px;">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($item->antecedentesLesiones as $lesion)
                                                <tr>
                                                    <td class="font-weight-bold text-dark">{{ $lesion->tipo_lesion }}</td>
                                                    <td>{{ $lesion->created_at->format('d/m/Y') }}</td>
                                                    <td class="text-center">
                                                        <form action="{{ route('lesiones.destroy', $lesion->id) }}" method="POST" class="d-inline"
                                                              onsubmit="return confirm('⚠️ ¡ATENCIÓN! Estás a punto de eliminar permanentemente el historial de lesión/cirugía:\n\n• Lesión o Cirugía: {{ $lesion->tipo_lesion }}\n\n¿Estás completamente seguro de continuar con la eliminación?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger px-2 shadow-sm" title="Eliminar Lesión">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="3" class="text-center text-muted py-4">
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
                                    <button class="btn btn-info btn-sm shadow-sm" data-toggle="modal" data-target="#addPatologiaModal">
                                        <i class="fas fa-plus mr-1"></i> Agregar Patología
                                    </button>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped align-middle mb-0">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>Enfermedad / Patología</th>
                                                <th class="text-center">Crónica</th>
                                                <th>Fecha de Diagnóstico</th>
                                                <th class="text-center" style="width: 100px;">Acciones</th>
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
                                                    <td class="text-center">
                                                        <form action="{{ route('patologias.destroy', $patologia->id) }}" method="POST" class="d-inline"
                                                              onsubmit="return confirm('⚠️ ¡ATENCIÓN! Estás a punto de eliminar permanentemente el antecedente patológico:\n\n• Enfermedad/Patología: {{ $patologia->enfermedad }}\n• ¿Crónica?: {{ $patologia->es_cronica ? "Sí" : "No" }}\n\n¿Estás completamente seguro de continuar con la eliminación?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger px-2 shadow-sm" title="Eliminar Patología">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="text-center text-muted py-4">
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
                                    <button class="btn btn-success btn-sm shadow-sm" data-toggle="modal" data-target="#addDietaModal">
                                        <i class="fas fa-plus mr-1"></i> Registrar Dieta
                                    </button>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped align-middle mb-0">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>Descripción de Dieta / Alimento</th>
                                                <th>Frecuencia Diaria</th>
                                                <th>Fecha de Registro</th>
                                                <th class="text-center" style="width: 100px;">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($item->historialAlimentacion as $dieta)
                                                <tr>
                                                    <td class="font-weight-bold text-dark">{{ $dieta->descripcion_dieta }}</td>
                                                    <td><span class="badge badge-light border">{{ $dieta->frecuencia_diaria }}</span></td>
                                                    <td>{{ $dieta->created_at->format('d/m/Y') }}</td>
                                                    <td class="text-center">
                                                        <form action="{{ route('alimentacion.destroy', $dieta->id) }}" method="POST" class="d-inline"
                                                              onsubmit="return confirm('⚠️ ¡ATENCIÓN! Estás a punto de eliminar permanentemente el registro alimenticio:\n\n• Descripción de Dieta: {{ $dieta->descripcion_dieta }}\n• Frecuencia Diaria: {{ $dieta->frecuencia_diaria }}\n\n¿Estás completamente seguro de continuar con la eliminación?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger px-2 shadow-sm" title="Eliminar Dieta">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="text-center text-muted py-4">
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

    <!-- ========================================== -->
    <!-- MODALS SECTION: CREATE RECORD FOR TABS     -->
    <!-- ========================================== -->

    <!-- Modal: Agregar Alergia -->
    <div class="modal fade" id="addAlergiaModal" tabindex="-1" role="dialog" aria-labelledby="addAlergiaModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('mascotas.alergias.store', $item->id) }}" method="POST">
                    @csrf
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title font-weight-bold" id="addAlergiaModalLabel"><i class="fas fa-allergies mr-2"></i>Agregar Nueva Alergia</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="font-weight-bold text-dark">Sustancia Alergénica <span class="text-danger">*</span></label>
                            <input type="text" name="sustancia_alergena" class="form-control" placeholder="Ej. Penicilina, Pollo, Antipulgas..." required>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold text-dark">Reacción Reportada <span class="text-danger">*</span></label>
                            <input type="text" name="reaccion" class="form-control" placeholder="Ej. Shock, Dermatitis, Vómito..." required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary font-weight-bold" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger font-weight-bold shadow-sm">Registrar Alergia</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal: Registrar Lesión -->
    <div class="modal fade" id="addLesionModal" tabindex="-1" role="dialog" aria-labelledby="addLesionModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('mascotas.lesiones.store', $item->id) }}" method="POST">
                    @csrf
                    <div class="modal-header bg-warning text-dark">
                        <h5 class="modal-title font-weight-bold" id="addLesionModalLabel"><i class="fas fa-user-md mr-2"></i>Registrar Lesión / Cirugía</h5>
                        <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="font-weight-bold text-dark">Descripción de la Lesión o Cirugía <span class="text-danger">*</span></label>
                            <input type="text" name="tipo_lesion" class="form-control" placeholder="Ej. Cirugía de ligamento cruzado, Fractura..." required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary font-weight-bold" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-warning text-dark font-weight-bold shadow-sm">Registrar Lesión</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal: Agregar Patología -->
    <div class="modal fade" id="addPatologiaModal" tabindex="-1" role="dialog" aria-labelledby="addPatologiaModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('mascotas.patologias.store', $item->id) }}" method="POST">
                    @csrf
                    <div class="modal-header bg-info text-white">
                        <h5 class="modal-title font-weight-bold" id="addPatologiaModalLabel"><i class="fas fa-heartbeat mr-2"></i>Agregar Nueva Patología</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="font-weight-bold text-dark">Enfermedad / Patología <span class="text-danger">*</span></label>
                            <input type="text" name="enfermedad" class="form-control" placeholder="Ej. Insuficiencia renal, Diabetes..." required>
                        </div>
                        <div class="form-group mb-0">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="es_cronica" value="1" class="custom-control-input" id="es_cronica">
                                <label class="custom-control-label font-weight-bold text-dark" for="es_cronica">¿Es una enfermedad crónica?</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary font-weight-bold" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-info font-weight-bold shadow-sm">Registrar Patología</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal: Registrar Dieta -->
    <div class="modal fade" id="addDietaModal" tabindex="-1" role="dialog" aria-labelledby="addDietaModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('mascotas.alimentacion.store', $item->id) }}" method="POST">
                    @csrf
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title font-weight-bold" id="addDietaModalLabel"><i class="fas fa-utensils mr-2"></i>Registrar Nueva Dieta</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="font-weight-bold text-dark">Descripción de Dieta / Alimento <span class="text-danger">*</span></label>
                            <input type="text" name="descripcion_dieta" class="form-control" placeholder="Ej. Croquetas Royal Canin Urinary..." required>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold text-dark">Frecuencia Diaria <span class="text-danger">*</span></label>
                            <input type="text" name="frecuencia_diaria" class="form-control" placeholder="Ej. 2 veces al día, Libre acceso..." required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary font-weight-bold" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success font-weight-bold shadow-sm">Registrar Dieta</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
