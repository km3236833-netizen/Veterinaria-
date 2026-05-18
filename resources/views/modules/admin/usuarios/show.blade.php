@extends('layouts.admin')

@section('titulo_pagina', 'Detalles del Usuario')

@section('contenido')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detalles del Usuario</h1>
        <a href="{{ route('admin.usuarios.index') }}" class="btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Volver al Listado
        </a>
    </div>

    <div class="row">
        <!-- Tarjeta de Detalles del Usuario -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Información General</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <th style="width: 35%">ID del Usuario:</th>
                                    <td>{{ $item->id }}</td>
                                </tr>
                                <tr>
                                    <th>Nombre Completo:</th>
                                    <td>{{ $item->name }}</td>
                                </tr>
                                <tr>
                                    <th>Correo Electrónico:</th>
                                    <td>{{ $item->email }}</td>
                                </tr>
                                <tr>
                                    <th>Rol del Usuario:</th>
                                    <td>
                                        <span class="badge {{ $item->rol == 'administrador' ? 'badge-danger' : 'badge-info' }}">
                                            {{ ucfirst($item->rol) }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Estado:</th>
                                    <td>
                                        <span class="badge {{ $item->activo ? 'badge-success' : 'badge-secondary' }}">
                                            {{ $item->activo ? 'Activo' : 'Inactivo' }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Fecha de Creación:</th>
                                    <td>{{ $item->created_at ? $item->created_at->format('d/m/Y H:i') : 'N/D' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tarjeta de Confirmación / Bloqueo de Eliminación -->
        <div class="col-lg-6 mb-4">
            @if ($hasDependencies)
                <!-- CASO: Bloqueo de eliminación debido a dependencias (Consultas) -->
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    Eliminación Bloqueada (Seguridad de Datos)</div>
                                <div class="h5 mb-3 font-weight-bold text-gray-800">No se puede eliminar</div>
                                <p class="text-gray-600">
                                    El usuario <strong>{{ $item->name }}</strong> cuenta con registros de <strong>consultas médicas</strong> asociados a su perfil veterinario en el sistema.
                                </p>
                                <div class="alert alert-danger border-left-danger" role="alert">
                                    <i class="fas fa-ban mr-2"></i> 
                                    <strong>Restricción por Llave Foránea (FK):</strong> No puedes eliminar a este usuario debido a que contiene datos activos. Para poder eliminarlo, debes reasignar o eliminar primero sus consultas médicas asociadas.
                                </div>
                                
                                <div class="mt-4">
                                    <a href="{{ route('admin.usuarios.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left mr-1"></i> Regresar al Listado
                                    </a>
                                </div>
                            </div>
                            <div class="col-auto d-none d-sm-block">
                                <i class="fas fa-lock fa-3x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- CASO: Eliminación segura permitida (Solo existe en Users / Veterinarios sin consultas) -->
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Confirmación de Eliminación</div>
                                <div class="h5 mb-3 font-weight-bold text-gray-800">¿Proceder con la eliminación?</div>
                                <p class="text-gray-600">
                                    ¿Estás seguro de que deseas eliminar permanentemente al usuario <strong>{{ $item->name }}</strong>?
                                </p>
                                <div class="alert alert-warning border-left-warning" role="alert">
                                    <i class="fas fa-exclamation-triangle mr-2"></i> 
                                    <strong>¡Advertencia!</strong> Esta acción no se puede deshacer y borrará permanentemente la cuenta del usuario de la base de datos.
                                </div>
                                <p class="text-xs text-muted mb-4">
                                    * Este usuario no tiene dependencias de consultas médicas asociadas, por lo que es seguro eliminarlo.
                                </p>
                                
                                <form action="{{ route('admin.usuarios.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ route('admin.usuarios.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-times mr-1"></i> Cancelar
                                    </a>
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-trash-alt mr-1"></i> Sí, Eliminar de Todos Modos
                                    </button>
                                </form>
                            </div>
                            <div class="col-auto d-none d-sm-block">
                                <i class="fas fa-user-minus fa-3x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
