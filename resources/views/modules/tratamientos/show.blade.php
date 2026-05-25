@extends('layouts.app')

@section('titulo_pagina', 'Detalle de Tratamiento')

@section('contenido')
    <div class="container-fluid mt-4">
        <!-- Breadcrumbs -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-white shadow-sm">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home mr-1"></i>Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('tratamientos.index') }}">Tratamientos</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detalle de Tratamiento</li>
            </ol>
        </nav>

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 font-weight-bold">
                <i class="fas fa-prescription-bottle-alt text-primary mr-2"></i>Detalle de Tratamiento Médico
            </h1>
            <div class="d-flex">
                <a href="{{ route('tratamientos.pdf', $item->id) }}" target="_blank" class="btn btn-danger btn-icon-split shadow mr-2">
                    <span class="icon text-white-50">
                        <i class="fas fa-file-pdf"></i>
                    </span>
                    <span class="text font-weight-bold">Generar Receta (PDF)</span>
                </a>
                <a href="{{ route('tratamientos.index') }}" class="btn btn-secondary shadow-sm">
                    <i class="fas fa-arrow-left mr-1"></i> Volver
                </a>
            </div>
        </div>

        <div class="row">
            <!-- Left Column: Patient Profile & Vigencia Card -->
            <div class="col-xl-4 col-lg-5">
                <!-- Patient Profile Card -->
                <div class="card shadow mb-4 text-center py-4 border-left-primary">
                    <div class="card-body">
                        <div class="mb-3">
                            <span class="fa-stack fa-3x">
                                <circle cx="50" cy="50" r="40" fill="#e8f0fe" class="text-primary"/>
                                <i class="fas fa-dog fa-stack-1x text-primary" style="font-size: 2.2rem;"></i>
                            </span>
                        </div>
                        <h4 class="font-weight-bold text-dark mb-1">{{ $item->mascota->nombre ?? 'N/A' }}</h4>
                        <p class="text-xs font-weight-bold text-uppercase px-3 py-1 bg-light rounded d-inline-block text-secondary mb-3">
                            {{ $item->mascota->especie ?? 'Especie' }} • {{ $item->mascota->raza ?? 'Raza' }}
                        </p>
                        
                        <hr class="my-3">
                        
                        <div class="text-left px-3">
                            <p class="mb-2 text-sm">
                                <strong class="text-dark">Propietario:</strong><br>
                                <i class="fas fa-user text-muted mr-1"></i> {{ $item->mascota->dueno->nombre_completo ?? '—' }}
                            </p>
                            <p class="mb-2 text-sm">
                                <strong class="text-dark">Celular:</strong><br>
                                <i class="fas fa-phone text-muted mr-1"></i> {{ $item->mascota->dueno->telefono ?? '—' }}
                            </p>
                            <p class="mb-0 text-sm">
                                <strong class="text-dark">Email:</strong><br>
                                <i class="fas fa-envelope text-muted mr-1"></i> {{ $item->mascota->dueno->correo ?? '—' }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Date/Vigencia Card -->
                <div class="card shadow mb-4 border-left-info">
                    <div class="card-header py-3 bg-white">
                        <h6 class="m-0 font-weight-bold text-info"><i class="far fa-calendar-alt mr-1"></i> Vigencia del Tratamiento</h6>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <i class="fas fa-calendar-day text-info fa-2x"></i>
                            </div>
                            <div class="col">
                                <small class="text-uppercase font-weight-bold text-muted d-block">Fecha de Inicio</small>
                                <span class="font-weight-bold text-dark">{{ \Carbon\Carbon::parse($item->fecha_inicio)->format('d \d\e F, Y') }}</span>
                            </div>
                        </div>
                        <hr class="my-2.5">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <i class="fas fa-calendar-check text-danger fa-2x"></i>
                            </div>
                            <div class="col">
                                <small class="text-uppercase font-weight-bold text-muted d-block">Fecha de Término</small>
                                <span class="font-weight-bold text-dark">{{ \Carbon\Carbon::parse($item->fecha_fin)->format('d \d\e F, Y') }}</span>
                            </div>
                        </div>
                        <hr class="my-2.5">
                        <div class="text-center py-1">
                            @php
                                $diasRestantes = \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($item->fecha_fin), false);
                            @endphp
                            @if($diasRestantes >= 0)
                                <span class="badge badge-success px-3 py-2 font-weight-bold shadow-sm" style="font-size: 0.9rem;">
                                    <i class="fas fa-hourglass-half mr-1"></i> {{ $diasRestantes }} Días Restantes
                                </span>
                            @else
                                <span class="badge badge-danger px-3 py-2 font-weight-bold shadow-sm" style="font-size: 0.9rem;">
                                    <i class="fas fa-history mr-1"></i> Tratamiento Concluido
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Medical Prescription Details -->
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 bg-white d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-prescription mr-1"></i> Especificaciones Clínicas</h6>
                        <span class="badge badge-primary px-3 py-2 font-weight-bold" style="font-size: 0.95rem;">
                            {{ $item->medicamento }}
                        </span>
                    </div>
                    <div class="card-body">
                        <!-- Medicine details -->
                        <div class="row bg-light rounded p-3 mb-4 mx-0 shadow-inner">
                            <div class="col-md-6 mb-3 mb-md-0 border-right-md">
                                <small class="text-uppercase font-weight-bold text-muted d-block">Dosis Asignada</small>
                                <h4 class="font-weight-bold text-dark mb-0 mt-1"><i class="fas fa-balance-scale text-primary mr-1"></i> {{ $item->dosis }}</h4>
                            </div>
                            <div class="col-md-6 pl-md-4">
                                <small class="text-uppercase font-weight-bold text-muted d-block">Frecuencia de Toma</small>
                                <h4 class="font-weight-bold text-dark mb-0 mt-1"><i class="far fa-clock text-info mr-1"></i> {{ $item->frecuencia }}</h4>
                            </div>
                        </div>

                        <!-- Indications section -->
                        <h5 class="font-weight-bold text-dark mb-3"><i class="fas fa-notes-medical text-primary mr-1"></i> Indicaciones y Recomendaciones</h5>
                        <div class="indicaciones-content p-4 rounded border" style="background-color: #fafbfc; min-height: 200px; line-height: 1.6; font-size: 1.05rem; color: #3a3b45;">
                            @if($item->indicaciones)
                                {!! $item->indicaciones !!}
                            @else
                                <p class="text-muted italic mb-0"><i class="fas fa-info-circle mr-1"></i> Sin indicaciones especiales de administración.</p>
                            @endif
                        </div>

                        <hr class="my-4">

                        <!-- Footer Actions -->
                        <div class="d-flex justify-content-between">
                            <form action="{{ route('tratamientos.destroy', $item->id) }}" method="POST"
                                  onsubmit="return confirm('⚠️ ¡ATENCIÓN! Estás a punto de eliminar permanentemente el tratamiento médico:\n\n• Paciente: {{ addslashes($item->mascota->nombre ?? 'N/A') }}\n• Medicamento: {{ addslashes($item->medicamento) }}\n• Frecuencia: {{ addslashes($item->frecuencia) }}\n\n¿Estás completamente seguro de continuar con la eliminación?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger font-weight-bold shadow-sm px-4">
                                    <i class="fas fa-trash mr-1"></i> Eliminar
                                </button>
                            </form>
                            
                            <div>
                                <a href="{{ route('tratamientos.edit', $item->id) }}" class="btn btn-warning text-dark font-weight-bold shadow-sm px-4">
                                    <i class="fas fa-edit mr-1"></i> Editar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Extra Styling to support lists in indications container -->
    <style>
        .indicaciones-content ul, .indicaciones-content ol {
            padding-left: 20px;
            margin-bottom: 10px;
        }
        @media(min-width: 768px) {
            .border-right-md {
                border-right: 1px solid #e3e6f0;
            }
        }
    </style>
@endsection
