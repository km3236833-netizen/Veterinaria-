@extends('layouts.app')

@section('titulo_pagina', 'Editar Dueño')

@section('contenido')
    <div class="container-fluid mt-4">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 font-weight-bold">
                <i class="fas fa-edit text-primary mr-2"></i>Editar Dueño
            </h1>
            <a href="{{ route('expedientes') }}" class="btn btn-sm btn-secondary shadow-sm">
                <i class="fas fa-arrow-left fa-sm text-white-50 mr-1"></i> Volver a Expedientes
            </a>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Modificar Datos de {{ $item->nombre_completo }}</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('duenos.update', $item->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nombre_completo" class="form-label font-weight-bold">Nombre Completo <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nombre_completo') is-invalid @enderror" id="nombre_completo" name="nombre_completo" required value="{{ old('nombre_completo', $item->nombre_completo) }}" placeholder="Ej. Carlos Mendoza">
                            @error('nombre_completo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="telefono" class="form-label font-weight-bold">Teléfono de Contacto <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('telefono') is-invalid @enderror" id="telefono" name="telefono" required value="{{ old('telefono', $item->telefono) }}" placeholder="Ej. 555-0199">
                            @error('telefono')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="direccion" class="form-label font-weight-bold">Dirección Completa <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('direccion') is-invalid @enderror" id="direccion" name="direccion" rows="3" required placeholder="Ej. Av. de la Constitución 123, Colonia Centro">{{ old('direccion', $item->direccion) }}</textarea>
                            @error('direccion')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <hr>
                    <div class="text-right">
                        <a href="{{ route('expedientes') }}" class="btn btn-secondary mr-2">Cancelar</a>
                        <button type="submit" class="btn btn-warning shadow text-dark font-weight-bold">
                            <i class="fas fa-save mr-1"></i> Actualizar Dueño
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
