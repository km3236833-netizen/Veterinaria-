@extends('layouts.admin')

@section('titulo_pagina', 'Editar Usuario')

@section('contenido')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Editar Usuario: {{ $item->name }}</h1>
        <a href="{{ route('admin.usuarios.index') }}" class="btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Volver
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulario de actualización</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.usuarios.update', $item->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Nombre Completo</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required value="{{ old('name', $item->name) }}" placeholder="Ej. Juan Pérez">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" required value="{{ old('email', $item->email) }}" placeholder="ejemplo@correo.com">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="rol" class="form-label">Rol del Usuario</label>
                        <select class="form-control @error('rol') is-invalid @enderror" id="rol" name="rol" required>
                            <option value="" disabled>Seleccione un rol</option>
                            <option value="veterinario" {{ old('rol', $item->rol) == 'veterinario' ? 'selected' : '' }}>Veterinario</option>
                            <option value="administrador" {{ old('rol', $item->rol) == 'administrador' ? 'selected' : '' }}>Administrador</option>
                        </select>
                        @error('rol')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="activo" class="form-label">Estado del Usuario</label>
                        <select class="form-control @error('activo') is-invalid @enderror" id="activo" name="activo" required>
                            <option value="1" {{ old('activo', $item->activo) == '1' ? 'selected' : '' }}>Activo</option>
                            <option value="0" {{ old('activo', $item->activo) == '0' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                        @error('activo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label">Nueva Contraseña</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                        <small class="form-text text-muted">Dejar en blanco si deseas conservar la contraseña actual.</small>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <hr>
                <div class="text-right">
                    <button type="reset" class="btn btn-secondary">Deshacer Cambios</button>
                    <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
                </div>
            </form>
        </div>
    </div>
@endsection
