@extends('layouts.app')

@section('titulo_pagina', 'Expedientes Médicos')

@section('contenido')
    <div class="container-fluid mt-4">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 font-weight-bold">
                <i class="fas fa-folder-open text-primary mr-2"></i>Expedientes Médicos
            </h1>
            <button class="btn btn-primary btn-icon-split shadow">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Nuevo Expediente</span>
            </button>
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
                                <div class="h5 mb-0 font-weight-bold text-gray-800">124</div>
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
                                <div class="h5 mb-0 font-weight-bold text-gray-800">12</div>
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
                                <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
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
                                <div class="h5 mb-0 font-weight-bold text-gray-800">5</div>
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
                <div class="input-group col-md-4 px-0">
                    <input type="text" class="form-control form-control-sm bg-light border-0 small" placeholder="Buscar expediente..." aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-primary btn-sm" type="button">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body px-0 py-2">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0 align-middle">
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
                            <tr>
                                <td class="pl-4 font-weight-bold text-primary">#EXP-001</td>
                                <td>
                                    <span class="font-weight-bold text-dark">Max</span>
                                    <small class="d-block text-muted">Golden Retriever, 3 años</small>
                                </td>
                                <td>Canino</td>
                                <td>Carlos Mendoza</td>
                                <td>15/05/2026</td>
                                <td><span class="badge badge-success px-2 py-1">Estable</span></td>
                                <td class="text-center pr-4">
                                    <button class="btn btn-sm btn-info btn-circle"><i class="fas fa-eye"></i></button>
                                    <button class="btn btn-sm btn-warning btn-circle"><i class="fas fa-edit"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td class="pl-4 font-weight-bold text-primary">#EXP-002</td>
                                <td>
                                    <span class="font-weight-bold text-dark">Luna</span>
                                    <small class="d-block text-muted">Persa, 1 año</small>
                                </td>
                                <td>Felino</td>
                                <td>María Fernanda Rojas</td>
                                <td>12/05/2026</td>
                                <td><span class="badge badge-warning px-2 py-1">En Tratamiento</span></td>
                                <td class="text-center pr-4">
                                    <button class="btn btn-sm btn-info btn-circle"><i class="fas fa-eye"></i></button>
                                    <button class="btn btn-sm btn-warning btn-circle"><i class="fas fa-edit"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td class="pl-4 font-weight-bold text-primary">#EXP-003</td>
                                <td>
                                    <span class="font-weight-bold text-dark">Rocky</span>
                                    <small class="d-block text-muted">Pastor Alemán, 5 años</small>
                                </td>
                                <td>Canino</td>
                                <td>Jorge Silva</td>
                                <td>18/05/2026</td>
                                <td><span class="badge badge-danger px-2 py-1">Urgente</span></td>
                                <td class="text-center pr-4">
                                    <button class="btn btn-sm btn-info btn-circle"><i class="fas fa-eye"></i></button>
                                    <button class="btn btn-sm btn-warning btn-circle"><i class="fas fa-edit"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td class="pl-4 font-weight-bold text-primary">#EXP-004</td>
                                <td>
                                    <span class="font-weight-bold text-dark">Bella</span>
                                    <small class="d-block text-muted">Husky Siberiano, 2 años</small>
                                </td>
                                <td>Canino</td>
                                <td>Ana Patricia Gomez</td>
                                <td>10/05/2026</td>
                                <td><span class="badge badge-success px-2 py-1">Estable</span></td>
                                <td class="text-center pr-4">
                                    <button class="btn btn-sm btn-info btn-circle"><i class="fas fa-eye"></i></button>
                                    <button class="btn btn-sm btn-warning btn-circle"><i class="fas fa-edit"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
