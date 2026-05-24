@extends('layouts.app')

@section('titulo_pagina', 'Expedientes Médicos')

@section('contenido')
    <style>
        .paciente-row {
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .paciente-row:hover {
            background-color: rgba(78, 115, 223, 0.05) !important;
        }
        .paciente-row.selected,
        .paciente-row.selected td {
            background-color: rgba(78, 115, 223, 0.12) !important;
        }
        .paciente-row.selected td .text-dark,
        .paciente-row.selected td .text-primary {
            color: #4e73df !important;
        }
    </style>
    <div class="container-fluid mt-4">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 font-weight-bold">
                <i class="fas fa-folder-open text-primary mr-2"></i>Expedientes Médicos
            </h1>
            <div class="d-flex">
                <a id="btn-ver-consultas" href="#" class="btn btn-info btn-icon-split shadow mr-2 disabled" style="pointer-events: none; opacity: 0.6; transition: all 0.3s ease;">
                    <span class="icon text-white-50">
                        <i class="fas fa-stethoscope"></i>
                    </span>
                    <span class="text font-weight-bold">Ver Consultas</span>
                </a>
                <a href="{{ route('mascotas.create') }}" class="btn btn-primary btn-icon-split shadow mr-2">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Nueva Mascota</span>
                </a>
                <a href="{{ route('duenos.create') }}" class="btn btn-success btn-icon-split shadow">
                    <span class="icon text-white-50">
                        <i class="fas fa-user-plus"></i>
                    </span>
                    <span class="text">Nuevo Dueño</span>
                </a>
            </div>
        </div>

        <!-- Quick Summary Cards -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total de Mascotas</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $mascotas->count() }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dog fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Consultas Hoy</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    @php
                                        $consultasHoy = 0;
                                        foreach($mascotas as $m) {
                                            $consultasHoy += $m->consultas()->whereDate('created_at', today())->count();
                                        }
                                    @endphp
                                    {{ $consultasHoy }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-stethoscope fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    En Tratamiento</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $mascotas->filter(fn($m) => str_contains(strtolower($m->comportamiento), 'tratamiento') || strtolower($m->comportamiento) === 'nervioso')->count() }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-prescription-bottle-alt fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    Urgencias del Mes</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $mascotas->filter(fn($m) => str_contains(strtolower($m->comportamiento), 'urgente') || str_contains(strtolower($m->comportamiento), 'alerta') || strtolower($m->comportamiento) === 'agresivo')->count() }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-ambulance fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Expedientes Table -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Listado de Pacientes</h6>
                <input type="text" id="buscador-pacientes" class="form-control form-control-sm bg-light border-0 small col-md-4 px-3" style="border-radius: 10px;" placeholder="Buscar expediente por paciente, especie, raza o dueño..." aria-label="Search">
            </div>
            <div class="card-body px-0 py-2">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0 align-middle" id="tabla-pacientes">
                        <thead class="bg-light">
                            <tr>
                                <th class="pl-4">Código</th>
                                <th>Paciente</th>
                                <th>Especie</th>
                                <th>Propietario</th>
                                <th>Última Visita</th>
                                <th>Estado</th>
                                <th class="text-center pr-4">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($mascotas as $mascota)
                                <tr class="paciente-row" data-id="{{ $mascota->id }}" data-url="{{ route('mascotas.show', $mascota->id) }}">
                                    <td class="pl-4 font-weight-bold text-primary id-search" data-id="{{ $mascota->id }}">#EXP-{{ str_pad($mascota->id, 3, '0', STR_PAD_LEFT) }}</td>
                                    <td>
                                        <span class="font-weight-bold text-dark name-search">{{ $mascota->nombre }}</span>
                                        <small class="d-block text-muted breed-search">{{ $mascota->raza }}, {{ \Carbon\Carbon::parse($mascota->fecha_nacimiento)->age }} años</small>
                                    </td>
                                    <td class="species-search">{{ $mascota->especie }}</td>
                                    <td class="owner-search">{{ $mascota->dueno->nombre_completo ?? 'Sin Dueño' }}</td>
                                    <td>{{ $mascota->updated_at->format('d/m/Y') }}</td>
                                    <td>
                                        @if(str_contains(strtolower($mascota->comportamiento), 'urgente') || strtolower($mascota->comportamiento) === 'agresivo')
                                            <span class="badge badge-danger px-2 py-1">{{ $mascota->comportamiento }}</span>
                                        @elseif(str_contains(strtolower($mascota->comportamiento), 'tratamiento') || strtolower($mascota->comportamiento) === 'nervioso')
                                            <span class="badge badge-warning px-2 py-1">{{ $mascota->comportamiento }}</span>
                                        @else
                                            <span class="badge badge-success px-2 py-1">Estable</span>
                                        @endif
                                    </td>
                                    <td class="text-center pr-4">
                                        <a href="{{ route('mascotas.show', $mascota->id) }}" class="btn btn-sm btn-primary shadow-sm px-3" title="Ver expediente del paciente">
                                            <i class="fas fa-eye mr-1"></i> Ver
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-muted">
                                        <i class="fas fa-info-circle mr-2"></i>No hay expedientes médicos registrados.
                                    </td>
                                </tr>
                            @endforelse
                            <tr id="no-results-row" style="display: none;">
                                <td colspan="7" class="text-center py-4 text-muted">
                                    <i class="fas fa-search mr-2"></i>No se encontraron expedientes que coincidan con la búsqueda.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Live Search Implementation -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const buscador = document.getElementById('buscador-pacientes');
            const rows = document.querySelectorAll('.paciente-row');
            const noResultsRow = document.getElementById('no-results-row');
            const btnVerConsultas = document.getElementById('btn-ver-consultas');

            function updateBtnState() {
                const selectedRow = document.querySelector('.paciente-row.selected');
                if (selectedRow && selectedRow.style.display !== 'none') {
                    const url = selectedRow.getAttribute('data-url');
                    btnVerConsultas.classList.remove('disabled');
                    btnVerConsultas.style.pointerEvents = 'auto';
                    btnVerConsultas.style.opacity = '1';
                    btnVerConsultas.setAttribute('href', url);
                } else {
                    btnVerConsultas.classList.add('disabled');
                    btnVerConsultas.style.pointerEvents = 'none';
                    btnVerConsultas.style.opacity = '0.6';
                    btnVerConsultas.setAttribute('href', '#');
                }
            }

            // Search filtering logic
            if (buscador) {
                buscador.addEventListener('input', function () {
                    const query = buscador.value.toLowerCase().trim();
                    let visibleCount = 0;

                    rows.forEach(row => {
                        const nombre = row.querySelector('.name-search').textContent.toLowerCase();
                        const raza = row.querySelector('.breed-search').textContent.toLowerCase();
                        const especie = row.querySelector('.species-search').textContent.toLowerCase();
                        const dueno = row.querySelector('.owner-search').textContent.toLowerCase();
                        
                        const idSearch = row.querySelector('.id-search');
                        const idText = idSearch ? idSearch.textContent.toLowerCase() : '';
                        const idRaw = idSearch ? idSearch.getAttribute('data-id').toLowerCase() : '';

                        if (nombre.includes(query) || 
                            raza.includes(query) || 
                            especie.includes(query) || 
                            dueno.includes(query) ||
                            idText.includes(query) ||
                            idRaw.includes(query)) {
                            row.style.display = '';
                            visibleCount++;
                        } else {
                            row.style.display = 'none';
                            // If selected row gets hidden, deselect it
                            if (row.classList.contains('selected')) {
                                row.classList.remove('selected');
                            }
                        }
                    });

                    updateBtnState();

                    if (visibleCount === 0 && rows.length > 0) {
                        noResultsRow.style.display = '';
                    } else {
                        noResultsRow.style.display = 'none';
                    }
                });
            }

            // Selection logic when clicking a row
            rows.forEach(row => {
                row.addEventListener('click', function (e) {
                    // Do not trigger selection if clicking an action button/link
                    if (e.target.closest('a') || e.target.closest('button')) {
                        return;
                    }

                    const isAlreadySelected = this.classList.contains('selected');

                    // Deselect all other rows
                    rows.forEach(r => r.classList.remove('selected'));

                    if (!isAlreadySelected) {
                        this.classList.add('selected');
                    }

                    updateBtnState();
                });

                // Double click behavior to directly visit consultations
                row.addEventListener('dblclick', function (e) {
                    if (e.target.closest('a') || e.target.closest('button')) {
                        return;
                    }
                    const url = this.getAttribute('data-url');
                    if (url) {
                        window.location.href = url;
                    }
                });
            });
        });
    </script>
@endsection
